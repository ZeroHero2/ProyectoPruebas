$(document).ready(() => {
  const inicio = document.getElementById("inicio-sesion");

  inicio.addEventListener("submit", (event) => {
    event.preventDefault();
    $.ajax({
      method: "POST",
      url: "./php/inicio-sesion.php",
      data: $('form#inicio-sesion').serialize(),
      cache: false,
      success: async (respuesta_ajax) => {
        let json = JSON.parse(respuesta_ajax);
        let icono;
        json.code != 2 ? (icono = "success") : (icono = "error");
        if (json.code == 2) {
          Swal.fire({
            title: "Error",
            html: json.message,
            icon: icono,
            confirmButtonText: "OK",
            didDestroy: () => { },
          });
        }
        if(json.code == 1){
          Swal.fire({
            title: "Inicio Correcto",
            html: json.message,
            icon: icono,
            confirmButtonText: "OK",
            didDestroy: () => {
              window.location.href = "/r3cibos/html/alta.html";
            },
          });
        }
        if (json.code == 0) {
          const { value: formValues } = await Swal.fire({
            title: "Cambio de contraseña",
            html: `
                        <label for="swal-input1">Nueva contraseña</label>
                          <input id="swal-input1" class="swal2-input"> </br>
                        <label for="swal-input2">Confirmar contraseña</label>
                          <input id="swal-input2" class="swal2-input">
                        `,
            focusConfirm: false,
            preConfirm: () => {
              return [
                document.getElementById("swal-input1").value,
                document.getElementById("swal-input2").value,
              ];
            },
          });
          if (formValues) {
            var contrasena = document.getElementById("swal-input1").value;
            var confirmacion =  document.getElementById("swal-input2").value;
            if(contrasena === confirmacion){
              $.ajax({
                url: "./php/subir-contra.php",
                type: "POST",
                data: JSON.stringify({
                  nueva_contrasena: contrasena,
                  confirma_contrasena: confirmacion,
                  no_empleado: document.getElementById("no_empleado").value
                }),
                contentType: false,
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
                      window.location.href = "/r3cibos/html/alta.html";
                    },
                  });
                },
              });
            }else{
              Swal.fire({
                title: "Error",
                html: "<h4>Las contraseñas no coincide</h4>",
                icon: "error",
                confirmButtonText: "OK",
                didDestroy: () => {
                },
              });
            }
          }
        }
      },
    });
  });
});
