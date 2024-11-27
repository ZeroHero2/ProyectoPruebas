<?php
// Mandar a llamar la conexión a la base de datos
require './conectar.php';
//  Ingresar a alta.php
if (!empty($_POST)) {
    $no_empleado = $_POST['no_empleado'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $rfc = $_POST['rfc'];
    //  Insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios_info (rfc, nombre, apellido_paterno, apellido_materno) VALUES ('$rfc', '$nombre', '$apellido_paterno', '$apellido_materno')";
    // Validar si se insertaron correctamente los datos
    if ($conn->query($sql) === TRUE) {
        $sql2 = "SELECT id_usuario FROM usuarios_info WHERE rfc = '$rfc'";
        $result = $conn->query($sql2);
        $row = $result->fetch_assoc();
        $id_usuario = $row['id_usuario'];
        $sql3 = "INSERT INTO usuarios_acceso (id_usuario, no_empleado, contrasena,estado,admi) VALUES ('$id_usuario','$no_empleado','$rfc',0,0)";
        if ($conn->query($sql3) === TRUE) {
            $respuesta_ajax["code"] = 1;
            $respuesta_ajax["message"] = "<h4>Usuario regristrado correctamente</h4>";
        } else {
            $respuesta_ajax["code"] = 0;
            $respuesta_ajax["message"] = "<h4>Error. </h4>";
        }
    }
    echo json_encode($respuesta_ajax);
    mysqli_close($conn);
}