<?php

if (!empty($_POST)) {
    $rfc = $_POST['rfc']; 
    $anio = $_POST['anio'];
    $mes = $_POST['mes'];
    $rutaCompleta = '/recibos/documentos/'.$anio.'/'.$mes.'/';
    
    $respuesta_ajax = array();

    if (is_dir($rutaCompleta)) {
        $carpetas = scandir($rutaCompleta);
        foreach ($carpetas as $carpeta) {
            if ($carpeta != '.' && $carpeta != '..' && is_dir($rutaCompleta.$carpeta)) {
                $archivos = scandir($rutaCompleta.$carpeta);
                $archivos_rfc = array();

                foreach ($archivos as $archivo) {
                    if ((strpos($archivo, $rfc) !== false) && (strpos($archivo, '.pdf') !== false || strpos($archivo, '.xml') !== false)) {
                        $archivos_rfc[] = $archivo; 
                    }
                }
                if (!empty($archivos_rfc)) {
                    $respuesta_ajax[$carpeta] = $archivos_rfc;
                }
            }
        }
    }

    echo json_encode($respuesta_ajax);
}
?>
