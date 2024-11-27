<?php
session_name("ReciboVista");
session_start();
//$_SESSION['inicio'] = $nombre;

// Verificamos si la sesión está activa
if (!isset($_SESSION['inicio'])) {
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
    <!-- Modificar para buscar archivos -->
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
        <button class="boton_buscar" id="boton_listar" type="submit">Buscar</button>
    </div>

    </div>
    </form>

    <table class="datos_arrojados" id="tabla_datos">
        <tr id="q1">
            <td class="datose">Quincena 1</td>
            <td id="pdf"></td>
            <td id="xml"></td>
        </tr>
        <tr id="c1">
            <td class="datose">Complementaria 1</td>
            <td id="pdf"></td>
            <td id="xml"></td>
        </tr>
        <tr id="e1">
            <td class="datose">Extraordinaria 1</td>
            <td id="pdf"></td>
            <td id="xml"></td>
        </tr>
        <tr id="q2">
            <td class="datose">Quincena 2</td>
            <td id="pdf"></td>
            <td id="xml"></td>
        </tr>
        <tr id="c2">
            <td class="datose">Complementaria 2</td>
            <td id="pdf"></td>
            <td id="xml"></td>
        </tr>
        <tr id="e2">
            <td class="datose">Extraordinaria 2</td>
            <td id="pdf"></td>
            <td id="xml"></td>
        </tr>
    </table>

    <footer>
        <p>Av. Paseo de la Reforma 135, esq. Insurgentes Centro, Colonia Tabacalera, Alcaldía Cuauhtémoc, Ciudad de
            México C.P. 06030</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../javascript/jquery-3.7.1.min.js"></script>
    <script src="../javascript/listar-archivos.js"></script>
    <script src="//cdn.datatables.net/2.1.5/js/dataTables.min.js"> </script>
    

</body>

</html>