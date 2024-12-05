<?php

require_once __DIR__.'/../helpers/functions.php';
require_once __DIR__.'/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = getPDO();

    $stmt = $pdo->prepare('SELECT * FROM Usuario WHERE usuario = :username');
    $stmt->execute(['username' => $username]);

    $user = $stmt->fetch();

    if ($user && $password === $user['contrasena']) {
        // Guardar los datos del usuario en la sesión
        $_SESSION['user'] = [
            'id' => $user['id'],
            'nombre' => $user['nombre'],
            'es_admin' => $user['es_admin']
        ];

        // Redirigir según el rol del usuario
        if ($user['es_admin']) {
            header('Location: '.BASE_URL.'/products'); // Administrador
        } else {
            header('Location: '.BASE_URL.'/welcome.php'); // Usuario normal
        }
        exit;
    } else {
        // Mensaje de error si las credenciales no son válidas
        echo '<script>
            alert("Usuario o contraseña incorrectos.");
            window.location.href = "/login";
        </script>';
    }
}
?>
