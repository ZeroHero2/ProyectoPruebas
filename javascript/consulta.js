$(document).ready(() => {
  var no_empleado = 0;
  var rfc = 0;
  
  // Escuchador de eventos para cuando se envía el formulario con id "consulta"
  $('form#consulta').submit((event) => {
    // Evitar el comportamiento predeterminado del formulario para que no recargue la página
    event.preventDefault();
    
    // Seleccionar el formulario y serializar sus datos para la petición AJAX
    var consulta = $('form#consulta');

    // Limpiar los resultados previos en la tabla (aquí se añade el cambio para refrescar la tabla)
    $('#tabla_datos').find("tr:gt(0)").remove(); // Elimina todas las filas excepto la cabecera de la tabla

    // Petición AJAX al archivo PHP para obtener la información del usuario
    $.ajax({
        type: "POST",                    // Tipo de petición (POST)
        url: "../php/consulta.php",       // URL del script PHP que recibe y procesa los datos
        data: consulta.serialize(),       // Datos serializados del formulario para enviar al servidor
        cache: false,                     // Desactiva el almacenamiento en caché para obtener siempre los datos actuales
        dataType: 'JSON',                 // Formato esperado de la respuesta (JSON)
        
        success: function (response) {    // Función de éxito en caso de respuesta exitosa
          // Inserta una nueva fila en la tabla con los datos recibidos en la respuesta
          document.getElementById('tabla_datos').insertRow(-1).innerHTML = 
            '<td>' + response["no_empleado"] + '</td>' + 
            '<td>' + response["nombre"] + '</td>' + 
            '<td>' + response["rfc"] + '</td>';
          
          // Almacenar los datos recibidos en las variables para referencia futura
          no_empleado = response["no_empleado"];
          rfc = response["rfc"];
        }
    });
  });



$('#reiniciar').click(()=>{
   $.ajax({
    type: "POST",
    url: "../php/reiniciar.php",
    data: {no_empleado: no_empleado, rfc : rfc},
    cache: false,
      
      success: (respuesta_ajax) => {
        let json = JSON.parse(respuesta_ajax);
        let icono;
        json.code == 1 ? icono = "success" : icono = "error";
        Swal.fire({
            title: "Contraseña modificada",
            html: json.msj,
            icon: icono,
            confirmButtonText: "OK",
            
        });
    }
    }); 
});

});