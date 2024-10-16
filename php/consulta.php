<?php
// Buscar usuarios por numero de usuarios y dar numero de empleado, nombre y rfc
 require './conectar.php';
//  Ingresar a alta.php
if (!empty($_POST)) {
    $no_empleado = $_POST['no_empleado'];
    $sqlbusqueda = "SELECT nombre, rfc FROM usuarios_acceso JOIN usuarios_info ON usuarios_info.id_usuario = usuarios_acceso.id_usuario WHERE no_empleado = '$no_empleado'";
    if ($conn->query($sqlbusqueda) == TRUE) {
        $result = $conn->query($sqlbusqueda);
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $rfc = $row['rfc'];
        $respuesta_ajax["code"] = 1;
        $respuesta_ajax["no_empleado"] = $no_empleado;
        $respuesta_ajax["nombre"] = $nombre;
        $respuesta_ajax["rfc"] = $rfc;
    } else {
        $respuesta_ajax["code"] = 0;
    }
    echo json_encode($respuesta_ajax);
    mysqli_close($conn);
}

// Reiniciar el password despues de apretar el boton reiniciar password por el rfc
/* if (!empty($_POST)) {
    $rfc = $_POST['rfc'];
    $sql = "UPDATE usuarios_acceso SET contrasena = '$rfc' WHERE rfc = '$rfc'";
    if ($conn->query($sql) === TRUE) {
        echo "Password reiniciado";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} */