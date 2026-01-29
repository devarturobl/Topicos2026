<?php
include 'conexion.php';

// Verificamos que el ID exista en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ejecutamos la sentencia para eliminar el registro específico
    $sql = "DELETE FROM tareas WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        // Si se borra con éxito, regresamos al index
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar: " . $conexion->error;
    }
} else {
    // Si alguien entra a borrar.php sin un ID, lo mandamos al inicio
    header("Location: index.php");
    exit();
}
?>