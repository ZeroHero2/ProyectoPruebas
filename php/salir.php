<?php
session_name("ReciboVista");
session_start();
session_destroy(); // Destruye la sesión
header("Location: ../index.html"); // Redirige al login
exit();

