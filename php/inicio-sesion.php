<?php
require './conectar.php';
    if (!empty($_POST['no_empleado']) && !empty($_POST['password'])) {
        $no_empleado = $_POST['no_empleado'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM usuarios_acceso WHERE no_empleado = '$no_empleado' AND contrasena = '$password'";
        $result = $conn->query($sql);
        session_name("LOGIN");
        session_start();
        if ($result->num_rows > 0) {
            $sql2 = "SELECT estado FROM usuarios_acceso WHERE no_empleado = '$no_empleado'";
            $result2 = $conn->query($sql);
            $row = $result2->fetch_assoc();
            $estado = $row['estado'];
            $respuesta_ajax["code"] = $estado;

        } else {
            $respuesta_ajax["code"] = 2;
            $respuesta_ajax["message"] = "<h4>Usuario y/o contraseña equivocada</h4>";
        }
        echo json_encode($respuesta_ajax);
        mysqli_close($conn);
        }


        