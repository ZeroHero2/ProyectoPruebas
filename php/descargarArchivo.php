<?php
if (isset($_GET['archivo'])) {
    $archivo = $_GET['archivo'];
    $rutaArchivo = '/recibos/documentos/' . $archivo;

    // Verificamos si el archivo existe
    if (file_exists($rutaArchivo)) {
        // Establecemos el tipo de contenido según la extensión
        $ext = pathinfo($archivo, PATHINFO_EXTENSION);
        if ($ext == 'pdf') {
            header('Content-Type: application/pdf');
        } elseif ($ext == 'xml') {
            header('Content-Type: application/xml');
        }
        
        // Enviar el archivo al navegador
        readfile($rutaArchivo);
    } else {
        echo "Archivo no encontrado.";
    }
} else {
    echo "No se ha especificado el archivo.";
}
?>
