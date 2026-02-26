<?php
include 'conexion.php';

// 1. Consultar las tareas
$sql = "SELECT * FROM tareas ORDER BY id DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi ToDo App</title>
</head>
<body>
    <h1>Bienvenido a mi App de Tareas</h1>
    <p>Esta es una aplicación simple para gestionar pendientes usando PHP y MySQL.</p>
    <hr>

    <h2>Tareas</h2>
    <a href="agregar.php"><button>Agregar Nueva Tarea</button></a>
    <br><br>

    <?php if ($resultado->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo $fila['titulo']; ?></td>
                        <td><?php echo $fila['completado'] ? '✅ Terminada' : '⏳ Pendiente'; ?></td>
                        <td><?php echo $fila['fecha_creacion']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a>
                            <a href="borrar.php?id=<?php echo $fila['id']; ?>">Borrar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aun no hay tareas creadas. ¡Empieza agregando una!</p>
    <?php endif; ?>

</body>
</html>