
const uploadForm = document.getElementById('uploadForm');
const uploadButton = document.getElementById('uploadButton');

uploadForm.addEventListener('submit', (event) => {
    if (filesList.length === 0) {
        event.preventDefault(); // Evita el envío si no hay archivos
        alert('Por favor, selecciona al menos un archivo.');
    }
    filesList.forEach(archivo => {
        var ruta = $('#year').val() + '/' + $('#mes').val() + '/' + $('#pago').val() + '/';
        var form_data = new FormData();
        form_data.append('archivo', archivo);
        console.log(ruta + '/'+ archivo.name);

         /* $.ajax({
            url: '../php/uploadArchivos.php',
            type: 'POST',
            data: {
                data: form_data,
                ruta: ruta
            },
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
            } 
        }); */
    });
});
