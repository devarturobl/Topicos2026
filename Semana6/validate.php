<?php

// validate.php: este archivo se incluirá en todas las páginas que requieran autenticación
// Verificar si el usuario ha iniciado sesión, de lo contrario redirigir al login

session_start();

// comprobar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // no hay sesión activa, redirigir al inicio de sesión
    header('Location: index.php');
    exit;
}
?>