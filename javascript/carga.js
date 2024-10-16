function removeFile(fileName) {
    console.log('hola');
    filesList = filesList.filter(file => file.name !== fileName);
    const itemToRemove = [...preview.children].find(item => item.querySelector('p').textContent === fileName);
    if (itemToRemove) {
        preview.removeChild(itemToRemove);
    }
}




const dropArea = document.getElementById('drop-area');
const fileElem = document.getElementById('fileElem');
const fileSelect = document.getElementById('fileSelect');
const preview = document.getElementById('preview');
let filesList = [];

fileSelect.addEventListener('click', () => {
    fileElem.click();
});

fileElem.addEventListener('change', handleFiles);
dropArea.addEventListener('dragover', (event) => {
    event.preventDefault();
    dropArea.classList.add('highlight');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('highlight');
});

dropArea.addEventListener('drop', (event) => {
    event.preventDefault();
    dropArea.classList.remove('highlight');
    const files = event.dataTransfer.files;
    handleFiles({ target: { files } });
});

function handleFiles(event) {
    const files = event.target.files;
    if (filesList.length + files.length > 10000) {
        alert('El límite máximo es 10,000 archivos');
        return;
    }

    [...files].forEach(file => {
        if (file.type === "application/pdf" || file.type === "application/xml") {
            filesList.push(file);
            previewFile(file);
        } else {
            Swal.fire({
                icon: "error",
                title: "Error al subir algunos archivos",
                text: "Solo se admiten archivos PDF y XML",
            });
        }
    });
}




function previewFile(file) {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = () => {
        const div = document.createElement('div');
        div.classList.add('preview-item');
        div.innerHTML = `
            <p>${file.name}</p>

        <button class="remove-btn" onclick="removeFile('${file.name}')">X</button>
        `;

        preview.appendChild(div);
    };
}


const uploadForm = document.getElementById('uploadForm');
const uploadButton = document.getElementById('uploadButton');

uploadForm.addEventListener('submit', (event) => {
    event.preventDefault();
    if (filesList.length === 0) {
        alert('Por favor, selecciona al menos un archivo.');
        return;
    }
    var form_data = new FormData();
    $('#uploadButton').prop('disabled', true);
    $('#uploadButton').text('Enviando...');

    filesList.forEach(archivo => {
        var ruta = $('#year').val() + '/' + $('#mes').val() + '/' + $('#pago').val() + '/';
        var nuevoArchivo = new File([archivo], archivo.name, { type: archivo.type });
        form_data.append('ruta_archivo[]', ruta + archivo.name);
        form_data.append('archivos[]', nuevoArchivo);
    });
    $.ajax({
        url: '../php/uploadArchivos.php',
        type: 'POST',
        data: form_data,
        contentType: false,
        processData: false,
        success: (respuesta_ajax) => {
            let json = JSON.parse(respuesta_ajax);
            let icono;
            json.code == 1 ? icono = "success" : icono = "error";
            Swal.fire({
                title: "Carga de archivos",
                html: json.message,
                icon: icono,
                confirmButtonText: "OK",
                didDestroy: () => {
                    if (json.code == 1) {
                        filesList = [];
                        preview.innerHTML = '';
                        $('#uploadButton').prop('disabled', false);
                        $('#uploadButton').text('Enviar Archivos');
                    }
                }
            });
        }
    });
}); 