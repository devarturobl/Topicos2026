<?php
require 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $conn->real_escape_string($_POST['nombre']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (username, email, password) 
            VALUES ('$nombre', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
    } else {
        $mensaje = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<style>
body {
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#000;
    font-family:Arial;
    color:#fff;
}
.form-container {
    background:#111;
    padding:40px;
    border:2px solid #fff;
    width:300px;
    text-align:center;
}
input {
    width:100%;
    padding:10px;
    margin:10px 0;
    background:#000;
    border:1px solid #fff;
    color:#fff;
}
button {
    width:100%;
    padding:10px;
    background:#fff;
    border:none;
    color:#000;
    font-weight:bold;
    cursor:pointer;
}
a {
    color:#ccc;
    text-decoration:none;
}
a:hover {
    color:#fff;
}
.mensaje {
    margin-top:10px;
    color:#0f0;
}
</style>
</head>
<body>

<div class="form-container">
    <h2>Registrarse</h2>

    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre completo" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Crear cuenta</button>
    </form>

    <p><?php echo $mensaje; ?></p>
    <p><a href="login.php">Volver al login</a></p>
</div>

</body>
</html>
