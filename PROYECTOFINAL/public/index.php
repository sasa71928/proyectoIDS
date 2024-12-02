<?php

$request = $_SERVER['REQUEST_URI'];
$request = strtok($request, '?');

switch($request){
    case '/':
        require_once __DIR__.'/../src/views/public/welcome.php';
        break;
    default:
        echo '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Página No Encontrada</title>
        </head>
        <body>
            <h1>Error 404: Página No Encontrada</h1>
            <button onclick="window.location.href=\'/\'">Ir a Inicio</button>
        </body>
        </html>';
        break;
}

