<?php
$conteo = count($_FILES["archivos"]["name"]);
$rutasArchivos = $_POST['ruta_archivo'];
for ($i = 0; $i < $conteo; $i++) {
    $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
    $rutaCompleta =  '/ruta/xampp'  . $rutasArchivos[$i];

    $rutaCarpeta = dirname($rutaCompleta);
    if (!is_dir($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0777, true);
    }
    $nombreArchivo = $_FILES["archivos"]["name"][$i];
    move_uploaded_file($ubicacionTemporal, $rutaCompleta);
}
$respuesta_ajax["code"] = 1;
$respuesta_ajax["message"] = "<h4>Archivos Cargados Correctamente</h4>";
echo json_encode($respuesta_ajax);
