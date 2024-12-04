<?php

require_once __DIR__.'/../helpers/functions.php';
require_once __DIR__.'/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = getPDO();

    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = :username');
    $stmt->execute(['username' => $username]);

    $user = $stmt->fetch();

    if ($user && $password === $user['password']) {
        $_SESSION['user'] = $username;
        header('Location: '.BASE_URL.'/products');
        exit;
    } else {
        echo '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Página No Encontrada</title>
        </head>
        <body>
            <h1>No entro al Login</h1>
            <button onclick="window.location.href=\'/\'">Ir a Inicio</button>
        </body>
        </html>';
    }
}


?>