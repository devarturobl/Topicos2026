<?php
include 'validate.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <p>Hola <?php echo htmlspecialchars($_SESSION['username']); ?>, bienvenido a la página de bienvenida.</p>
    <!-- botón de cierre de sesión -->
    <form action="logout.php" method="post" style="display:inline;">
        <button type="submit">Cerrar sesión</button>
    </form>

</body>
</html>