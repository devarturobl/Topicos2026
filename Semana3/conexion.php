<?php
$server = "localhost";
$username = "root1";
$password = ""; 
$database = "myproject";

#desactivar reporte automatico de errores
mysqli_report(MYSQLI_REPORT_OFF);

#Funcion para conectar a la base de datos
$conexion = mysqli_connect($server, $username, $password, $database);

#Verificar la conexión
if (!$conexion) {
    header("Location: errorconection.php");
    exit(); // Detenemos la ejecución del script
}
?>