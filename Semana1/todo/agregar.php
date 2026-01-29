<?php
include 'conexion.php';

// Verificamos si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];

    if (!empty($titulo)) {
        // Preparamos la consulta SQL
        $sql = "INSERT INTO tareas (titulo) VALUES ('$titulo')";

        if ($conexion->query($sql) === TRUE) {
            // Si se guarda con éxito, regresamos al inicio
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Tarea</title>
</head>
<body>
    <h1>Nueva Tarea</h1>
    <form method="POST" action="agregar.php">
        <input type="text" name="titulo" placeholder="Escribe tu tarea aquí..." required>
        <button type="submit">Guardar Tarea</button>
    </form>
    <br>
    <a href="index.php">Volver al listado</a>
</body>
</html>