<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Conexión - TODO App</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 400px;
        }
        h1 { color: #e74c3c; font-size: 48px; margin-bottom: 10px; }
        p { color: #7f8c8d; line-height: 1.6; }
        .btn-retry {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn-retry:hover { background-color: #2980b9; }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>⚠️</h1>
        <h2>¡Ups! Error de conexión</h2>
        <p>No pudimos establecer contacto con la base de datos. Por favor, asegúrate de que el servidor MySQL esté encendido.</p>
        
        <a href="index.php" class="btn-retry">Reintentar conexión</a>
    </div>
</body>
</html>