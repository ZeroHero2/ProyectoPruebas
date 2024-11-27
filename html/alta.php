<?php
session_name("ReciboVista");
session_start();
//$_SESSION['inicio'] = $nombre;

// Verificamos si la sesión está activa
if (!isset($_SESSION['inicio']) || $_SESSION['isAdmin'] != 1) {
    // Si no hay sesión, redirigimos al login
    header("Location: ../index.html");
} else {
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/medias.css">
    <title>Alta</title>
</head>

<body>
    <header>

    </header>
    <div class="salir">
        <img src="../Imagenes/Salir.png" alt="">
        <a href="../php/salir.php">
            <p>Salir</p>
        </a>
    </div>
    <h1>Alta de usuario</h1>
    <p>Bienvenido
        <?php
        echo $_SESSION['inicio']; ?>
    </p>


    <section class="botones">
        <a href="carga.php"> <button> Carga </button></a>
        <a href="consulta.php"><button> Consulta </button></a>
        <a href="alta.php"><button>Alta </button></a>
    </section>
    <form id="alta_usuario" class="alta">
        <div class="division-padre">
            <div class="division">
                <label for="no_empleado">Numero de empleado</label>
                <input id="no_empleado" type="text" name="no_empleado" required>
            </div>
            <div class="division">
                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" name="nombre" required>
            </div>
        </div>

        <div class="division-padre">
            <div class="division">
                <label for="apellido_paterno">Apellido paterno</label>
                <input id="apellido_paterno" type="text" name="apellido_paterno" required>
            </div>
            <div class="division">
                <label for="apellido_materno">Apellido materno</label>
                <input id="apellido_materno" type="text" name="apellido_materno" required>
            </div>
        </div>

        <div class="division-padre ">
            <div class="division">
                <label for="rfc">RFC</label>
                <input id="rfc" type="text" name="rfc" required maxlength="13">
            </div>
        </div>

        <!-- <button class="enviar-info" name="registrar" type="submit">Registrar Usuario</button> -->
        <input type="submit" value="Registrar Usuario" class="enviar-info" name="registrar">
    </form>
    <footer>
        <p>Av. Paseo de la Reforma 135, esq. Insurgentes Centro, Colonia Tabacalera, Alcaldía Cuauhtémoc, Ciudad de
            México C.P. 06030</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../javascript/jquery-3.7.1.min.js"></script>
    <script src="../javascript/registrar-usuarios.js"></script>
</body>

</html>