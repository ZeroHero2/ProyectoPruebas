<?php
// Buscar usuarios por numero de usuarios y dar numero de empleado, nombre y rfc
require './conectar.php';
// Reiniciar el password despues de apretar el boton reiniciar password por el rfc
if (!empty($_POST)) {
    $no_empleado = $_POST['no_empleado'];
    $rfc = $_POST['rfc'];
    $sql = "UPDATE usuarios_acceso SET contrasena = '$rfc', estado=0 WHERE no_empleado = '$no_empleado'";
    if ($conn->query($sql) === TRUE) {
        
        $respuesta_ajax["code"] = 1;
        $respuesta_ajax["msj"] = "contrseña modificada exitosamente";
    } else {
        $respuesta_ajax["code"] = 0;
        $respuesta_ajax["msj"] = "error al modificar contraseña";
    }
    echo json_encode($respuesta_ajax);
    mysqli_close($conn);
}
