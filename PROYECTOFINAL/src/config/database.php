<?php

function getPDO(): PDO {

    static $pdo = null;

    if ($pdo === null) {
        $config = require __DIR__ . '/config.php';
        $db = $config['db'];

        try {
            $pdo = new PDO("mysql:host={$db['host']};dbname={$db['name']};charset=utf8", $db['user'], $db['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Página No Encontrada</title>
            </head>
            <body>
                <h1>No se conecto a la BD</h1>
                <button onclick="window.location.href=\'/\'">Ir a Inicio</button>
            </body>
            </html>';
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
    return $pdo;

}