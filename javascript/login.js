$(document).ready(() => {
  const inicio = document.getElementById("inicio-sesion");

  // Añade un evento al formulario de inicio de sesión cuando se envía
  inicio.addEventListener("submit", (event) => {
    // Evita el envío normal del formulario
    event.preventDefault();
    var isAdmin = 0;


    // Realiza una petición AJAX al archivo PHP para verificar el inicio de sesión
    $.ajax({
      method: "POST",
      url: "./php/inicio-sesion.php",
      data: $("form#inicio-sesion").serialize(),
      cache: false,
      success: async (respuesta_ajax) => {
        let json = JSON.parse(respuesta_ajax); // Convierte la respuesta en JSON para manejarla
        let icono;
        json.code != 2 ? (icono = "success") : (icono = "error");
        isAdmin = json.isAdmin;


        // Muestra mensajes de éxito o error dependiendo de la respuesta
        if (json.code == 2) {
          Swal.fire({
            title: "Error",
            html: json.message,
            icon: icono,
            confirmButtonText: "OK",
            didDestroy: () => {},
          });
        }

        // Redirecciona a la página principal si el inicio de sesión es correcto
        if (json.code == 1) {
          
          Swal.fire({
            title: "Inicio Correcto",
            html: json.message,
            icon: icono,
            confirmButtonText: "OK",
            didDestroy: () => {
              if(json.isAdmin == 1){
                console.log("Es admin");
                window.location.href = "/html/alta.php";
              }
              if (json.isAdmin == 0){
                console.log("No es Admin");
                window.location.href = "/html/empleado.php";
              }
            },
          });
        }

        // Solicita el cambio de contraseña si es la primera vez que inicia sesión
        if (json.code == 0) {
          const { value: formValues } = await Swal.fire({
            title: "Cambio de contraseña",
            html: `
              <label for="swal-input1">Nueva contraseña</label>
              <input id="swal-input1" class="swal2-input" type="password"> </br>
              <label for="swal-input2">Confirmar contraseña</label>
              <input id="swal-input2" class="swal2-input" type="password">
            `,
            focusConfirm: false,
            preConfirm: () => {
              return [
                document.getElementById("swal-input1").value,
                document.getElementById("swal-input2").value,
              ];
            },
          });

          // Obtiene los valores de las contraseñas ingresadas por el usuario
          var contrasena = document.getElementById("swal-input1").value;
          var confirmacion = document.getElementById("swal-input2").value;

          // Validación para asegurar que los campos de contraseña no están vacíos
          if (contrasena === "" || confirmacion === "") {
            Swal.fire({
              title: "Error",
              html: "<h4>La contraseña no puede estar vacía</h4>",
              icon: "error",
              confirmButtonText: "OK",
            });
            return; // Sale de la función si alguna de las contraseñas está vacía
          }

          // Continúa si las contraseñas coinciden y no están vacías
          if (contrasena === confirmacion) {
            $.ajax({
              url: "./php/subir-contra.php",
              type: "POST",
              data: JSON.stringify({
                nueva_contrasena: contrasena,
                confirma_contrasena: confirmacion,
                no_empleado: document.getElementById("no_empleado").value,
              }),
              contentType: "application/json", // Cambié a "application/json" para asegurar el tipo correcto
              processData: false,
              success: (respuesta_ajax) => {
                let json = JSON.parse(respuesta_ajax);
                let icono;
                json.code == 1 ? (icono = "success") : (icono = "error");
                Swal.fire({
                  title: "Cambio de contraseña",
                  html: json.message,
                  icon: icono,
                  confirmButtonText: "OK",
                  didDestroy: () => {
                    if(isAdmin == 0){
                      window.location.href = "/html/empleado.php";

                    }
                    if (isAdmin == 1){
                      window.location.href = "/html/alta.php";
                    }
                  },
                });
              },
            });
          } else {
            // Muestra un error si las contraseñas no coinciden
            Swal.fire({
              title: "Error",
              html: "<h4>Las contraseñas no coinciden</h4>",
              icon: "error",
              confirmButtonText: "OK",
              didDestroy: () => {},
            });
          }
        }
      },
    });
  });
});

