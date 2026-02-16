<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar Sesión</title>
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
.error {
    color:red;
}
</style>
</head>
<body>

<div class="form-container">
    <h2>Iniciar Sesión</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>

    <p>¿No tienes cuenta? <a href="registro.php">Registrarse</a></p>
</div>

</body>
</html>
