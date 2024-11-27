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
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">
    <title>Consulta</title>
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
    <h1>Consulta de recibos</h1>
    <p>Bienvenido
        <?php
        echo $_SESSION['inicio']; ?>
    </p>
    <section class="botones">
        <a href="carga.php"> <button> Carga </button></a>
        <a href="consulta.php"><button> Consulta </button></a>
        <a href="alta.php"><button>Alta </button></a>
    </section>

    <form id="consulta" name="consulta" class="filtro" method="get">
        <div class="buscar">
            <p>Buscar por numero de empleado </p>
            <input type="text" name="no_empleado" id="no_empleado" class="filtrar" placeholder="Buscar">
            <button class="boton_buscar" type="submit">Buscar</button>
        </div>
    </form>
    <table class="datos_arrojados" id="tabla_datos">
        <tr>
            <td class="datose">Numero de empleado</td>
            <td class="datose">Nombre</td>
            <td class="datose">RFC</td>
        </tr>
    </table>

    <div class="boton_reinicio">
        <button type="button" name="reiniciar" class="reiniciar" id="reiniciar">Reiniciar password</button>
        <p>Se pondrá el <b>RFC (sin guiones) </b>como predeterminado, al ingresar al sistema solicita un password nuevo
        </p>
    </div>

    <img src="" alt="">
    <footer>
        <p>Av. Paseo de la Reforma 135, esq. Insurgentes Centro, Colonia Tabacalera, Alcaldía Cuauhtémoc, Ciudad de
            México C.P. 06030</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../javascript/jquery-3.7.1.min.js"></script>
    <script src="../javascript/consulta.js"></script>
    <script src="//cdn.datatables.net/2.1.5/js/dataTables.min.js"> </script>
    <script src="../javascript/listar-archivos.js"></script>

</body>

</html>