$(document).ready(function(){
    $("#boton_listar").click(function(){
        // Obtenemos los valores seleccionados de año y mes
        var año = $("#year").val();
        var mes = $("#mes").val();
        
        $.ajax({
            type: "POST",
            url: "../php/listadoArchivos.php",
            data: {anio: año, mes: mes, rfc: "12345"}, // Aquí puedes cambiar el RFC por uno dinámico
            cache: false,
            success: (respuesta_ajax) => {
                let json = JSON.parse(respuesta_ajax);
                
                // Limpiamos la tabla antes de llenarla
                // $("#tabla_datos .archivos").html("");

                // Recorrer la respuesta para llenar la tabla con los archivos
                $.each(json, function(quincena, archivos) {
                    let fila = $("#tabla_datos").find("tr:contains('"+quincena+"')").find(".archivos");
                    
                    if (archivos.length > 0) {
                        archivos.forEach(function(archivo) {
                            // Crear un botón para cada archivo
                            let ext = archivo.split('.').pop();
                            let icono = ext == 'pdf' ? 'pdf-icon.png' : 'xml-icon.png'; // Cambia estos iconos según los archivos
                            let boton = `<button class="descargar_btn" onclick="window.open('../php/descargarArchivo.php?archivo=${quincena}/${archivo}', '_blank')">${archivo}</button>`;
                            fila.append(boton);
                        });
                    } else {
                        fila.append("<span>No hay archivos</span>");
                    }
                });
            }
        });
    });
});
