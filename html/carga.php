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
    <title>Carga de archivos</title>
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
    <h1>Carga de archivos</h1>
    <p>Bienvenido
        <?php
        echo $_SESSION['inicio']; ?>
    </p>
    <section class="botones">
        <a href="carga.php"> <button> Carga </button></a>
        <a href="consulta.php"><button> Consulta </button></a>
        <a href="alta.php"><button>Alta </button></a>
    </section>

    <div class="fecha">
        <label for="year"> Año </label>
        <select name="Año" id="year">
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
            <option value="2017">2017</option>
            <option value="2016">2016</option>
        </select>

        <label for="mes">Mes</label>
        <select name="mes" id="mes">
            <option value="Enero">Enero</option>
            <option value="Febrero">Febrero</option>
            <option value="Marzo">Marzo</option>
            <option value="Abril">Abril</option>
            <option value="Mayo">Mayo</option>
            <option value="Junio">Junio</option>
            <option value="Julio">Julio</option>
            <option value="Agosto">Agosto</option>
            <option value="Septiembre">Septiembre</option>
            <option value="Octubre">Octubre</option>
            <option value="Noviembre">Noviembre</option>
            <option value="Diciembre">Diciembre</option>
        </select>

        <label for="pago">Pago</label>
        <select name="pago" id="pago">
            <option value="Quincena1">Quincena 1</option>
            <option value="Complementaria1">Complementaria 1</option>
            <option value="Extraordinaria1">Extraordinaria 1</option>
            <option value="Quincena2">Quincena 2</option>
            <option value="Complementaria2">Complementaria 2</option>
            <option value="Extraordinaria2">Extraordinaria 2</option>
        </select>
    </div>

    <div class="upload-container">
        <!-- Formulario para subir archivos -->
        <form id="uploadForm">
            <div id="drop-area">
                <h2>Arrastra tus archivos aquí</h2>
                <p>O</p>
                <input type="file" id="fileElem" name="files[]" multiple accept=".pdf, .xml" hidden>
                <button type="button" id="fileSelect">Selecciona tus archivos</button>
            </div>
            <button type="submit" id="uploadButton">Enviar Archivos</button>

        </form>
        <!-- Modal de espera -->
        <div id="modalEspera">
            <div class="modal-contenido">
                <p>Subiendo el archivo... Por favor, espera.</p>
            </div>
        </div>
        <!-- Área de previsualización de archivos -->
        <div id="preview-container">
            <div id="preview"></div>
        </div>
        <!-- Botón de subir archivos -->
    </div>


    <footer>
        <p>Av. Paseo de la Reforma 135, esq. Insurgentes Centro, Colonia Tabacalera, Alcaldía Cuauhtémoc, Ciudad de
            México C.P. 06030</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../javascript/jquery-3.7.1.min.js"></script>
    <script src="../javascript/carga.js"></script>

</body>

</html>