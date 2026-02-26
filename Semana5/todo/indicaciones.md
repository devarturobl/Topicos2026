# Primera Semana conectando Servidores

## Proyecto TODO

## Paso1 La base de datos
En MySQL, una tabla es como una hoja de cálculo con columnas específicas. Para nuestro ToDo, necesitamos al menos estas cuatro columnas:

ID: Un número único para identificar cada tarea (clave primaria).

Tarea: El texto o descripción de lo que hay que hacer.

Estado: Para saber si la tarea está pendiente o terminada.

Fecha: Para saber cuándo se creó.

Para crear esto, usamos el lenguaje SQL (Structured Query Language). Aquí tienes un ejemplo del comando que define esa estructura:


SQL
CREATE TABLE tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    completado TINYINT(1) DEFAULT 0,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


## Conexion PHP a MySQL
### codigo con MySQLi archivo conexion.php

<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "tu_base_de_datos";

// Creamos la conexión
$conexion = new mysqli($host, $user, $password, $db_name);

// Verificamos si hubo algún error
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

echo "Conectado exitosamente con MySQLi 🐘";
?>

## Interface index.php
### Detalles

Incluir la conexión: Usaremos el archivo conexion.php que creamos antes.

Consultar la base de datos: Pediremos a MySQL todas las filas de la tabla tareas.

Lógica condicional: Usaremos un if de PHP para decidir si mostramos el mensaje de "Aun no hay tareas" o la tabla con los datos.

### Código
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
        <table border="1">
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

## Archivos CRUD
### Agregar.php
Este archivo cumplirá dos funciones: mostrar el formulario al usuario y, una vez que se envíe, procesar la información para guardarla en la base de datos. 📥

Usaremos el método POST, que es el estándar para enviar datos de forma segura desde un formulario hacia el servidor.

### Código
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

## Archivo de edicion 
Cargar los datos actuales: Primero debe buscar en la base de datos la información de la tarea específica (usando el id que pasamos por la URL) para que el usuario vea qué es lo que va a modificar.

Actualizar la información: Una vez que el usuario modifica el texto y presiona "Guardar", debe enviar esos cambios a la base de datos.

### Código
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

## Archivo eliminar.php
El archivo borrar.php es el más sencillo, pero también el más "peligroso", ya que realiza una acción irreversible en la base de datos. 🗑️

A diferencia de los otros archivos, este no suele necesitar una interfaz visual (HTML), sino que procesa la instrucción y redirige inmediatamente al usuario de vuelta al inicio.

¿Cómo funciona el flujo de borrado?
Recepción del ID: El archivo captura el ID mediante $_GET['id'] (que viene del enlace "Borrar" que pusimos en la tabla del index.php).

Ejecución: Se envía la instrucción DELETE a MySQL. Es vital incluir el WHERE id = $id, porque de lo contrario, ¡borrarías todas las tareas de la tabla! ⚠️

Redirección: Al terminar, el usuario ni siquiera nota que pasó por este archivo; simplemente ve que la tarea desapareció de su lista.

### Código
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