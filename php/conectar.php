<?php
// Visualizar error 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Configuración de la base de datos
$servername = 'localhost'; // Cambia esto si tu servidor no es local
$username = 'root'; // Usuario de la base de datos
$password =  ''; //   // Contraseña del usuario
$database = ''; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 

// Aquí puedes agregar tu lógica para interactuar con la base de datos

// Cerrar conexión
 // $conn->close();

