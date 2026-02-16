<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$database = "unidad1";

#desactivar reporte automatico de errores
mysqli_report(MYSQLI_REPORT_OFF);

$conn = mysqli_connect($servidor, $usuario, $password, $database);

if (!$conn) {
    header("Location: errorconn.php");
    exit(); // Detenemos la ejecución del script
}   
?>