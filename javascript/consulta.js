// -------------- Mensaje de reinicio exitoso -------------------
$(document).ready(() => {
  var no_empleado = 0;
  var rfc = 0;
  
   $('form#consulta').submit((event) => {
    consulta = $('form#consulta');
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../php/consulta.php",
        data: $('form#consulta').serialize(),
        cache: false,
          dataType: 'JSON',
          success: function (response){
            
            document.getElementById('tabla_datos').insertRow(-1).innerHTML = '<td>'+response["no_empleado"]+'</td>'+'<td>'+response["nombre"]+'</td>'+'<td>'+response["rfc"]+'</td>';
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