<?php
//session_start();
require './conectar.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = json_decode(file_get_contents("php://input"));

    $nueva_contrasena = $datos->nueva_contrasena;
    $confirma_contrasena = $datos->confirma_contrasena;
    $no_empleado = $datos->no_empleado;

    if ($nueva_contrasena === $confirma_contrasena) {
        // Hashear la nueva contraseñ
        // Actualizar la contraseña en la base de datos
        $query = "UPDATE usuarios_acceso SET contrasena = '$nueva_contrasena', estado = 1 WHERE no_empleado = '$no_empleado'";
        $result = $conn->query($query);
        if ($result) {
            $sql1 = "SELECT * FROM usuarios_acceso WHERE no_empleado = '$no_empleado' ";
            $result1 = $conn->query($sql1);
            $row1 = $result1->fetch_assoc();
            $id_usuario = $row1['id_usuario'];
            
            $sql2 = "SELECT * FROM usuarios_info WHERE id_usuario = '$id_usuario'";
            $result2 = $conn->query(query: $sql2);
            $row2 = $result2->fetch_assoc();
            session_name("ReciboVista");
            session_start();
            $_SESSION['nombre'] = $row2['nombre'];
            

            if ($conn->affected_rows > 0) {
                $respuesta_ajax["code"] = 1;
                $respuesta_ajax["message"] = "<h4>Contraseña actualizada correctamente</h4>";
            } else {
                $respuesta_ajax["code"] = 0;
                $respuesta_ajax["message"] = "<h4>Error al actualizar contraseña  </h4>";
            }
        } else {
            $respuesta_ajax["code"] = 0;
            $respuesta_ajax["message"] = "<h4>Error al actualizar contraseña  </h4>";
        }
    } else {
        echo "Las contraseñas no coinciden.";
    }
    echo json_encode($respuesta_ajax);
    mysqli_close($conn);
}
?>