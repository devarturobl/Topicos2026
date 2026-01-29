<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "ejem";

// Creamos la conexión
$conexion = new mysqli($host, $user, $password, $db_name);

// Verificamos si hubo algún error
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

echo "Conectado exitosamente con MySQLi 🐘";
?>