<?php
include 'conexion.php';

// 1. Obtener la tarea actual para mostrarla en el formulario
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tareas WHERE id = $id";
    $resultado = $conexion->query($sql);
    $tarea = $resultado->fetch_assoc();
}

// 2. Procesar la actualización cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $completado = isset($_POST['completado']) ? 1 : 0;

    $sql = "UPDATE tareas SET titulo = '$titulo', completado = $completado WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error actualizando: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
</head>
<body>
    <h1>Editar Tarea</h1>
    <form method="POST" action="editar.php">
        <input type="hidden" name="id" value="<?php echo $tarea['id']; ?>">
        
        <label>Descripción:</label><br>
        <input type="text" name="titulo" value="<?php echo $tarea['titulo']; ?>" required>
        <br><br>
        
        <label>
            <input type="checkbox" name="completado" <?php echo $tarea['completado'] ? 'checked' : ''; ?>>
            ¿Tarea completada?
        </label>
        <br><br>
        
        <button type="submit">Actualizar Tarea</button>
    </form>
    <br>
    <a href="index.php">Cancelar</a>
</body>
</html>