<?php
require './conectar.php';
if (!empty($_POST['no_empleado']) && !empty($_POST['password'])) {
    $no_empleado = $_POST['no_empleado'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM usuarios_acceso WHERE no_empleado = '$no_empleado' AND contrasena = '$password'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_usuario = $row['id_usuario'];

        $sql2 = "SELECT * FROM usuarios_info WHERE id_usuario = '$id_usuario'";
        $result2 = $conn->query(query: $sql2);
        $row1 = $result2->fetch_assoc();
        
        $sql3 = "SELECT estado, admi FROM usuarios_acceso WHERE no_empleado = '$no_empleado'";
        $result3 = $conn->query($sql3);
        $row3 = $result3->fetch_assoc();
        $isAdmi = $row3['admi'];
        $estado = $row3['estado'];
        $respuesta_ajax["code"] = $estado;
        $respuesta_ajax["isAdmin"] = $isAdmi;

        // --------- Inicio de sesion y guardar nombre  ------------
        if ($estado == 1) {
            session_name("ReciboVista");
            session_start();
            $_SESSION['inicio'] = $row1['nombre'];
            $_SESSION['isAdmin'] = $isAdmi;
        }

    } else {
        $respuesta_ajax["code"] = 2;
        $respuesta_ajax["message"] = "<h4>Usuario y/o contraseña equivocada</h4>";
    }
    echo json_encode($respuesta_ajax);
    mysqli_close($conn);
}
