<?php

define('URL', '');

$request = $_SERVER['REQUEST_URI'];

$request = strtok($request, '?');

switch($request){
    case URL.'/':
        require_once __DIR__.'/../src/views/public/welcome.php';
        break;
    case URL.'/carreras':
        require_once __DIR__.'/../src/views/public/careers/details.php';
        break;
    case URL.'/careers':
        require_once __DIR__.'/../src/views/admin/careers/index.php';
        break;
    case URL.'/careers/form':
        require_once __DIR__.'/../src/views/admin/careers/form.php';
        break;
    case URL.'/login':
        require_once __DIR__.'/login.php';
        break;
    case URL.'/logout':
        require_once __DIR__.'/../src/controllers/logoutController.php';
        break;
    default:
        http_response_code(404);
        echo '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Página No Encontrada</title>
        </head>
        <body>
            <h1>Error 404: Página No Encontrada</h1>
            <p>Lo sentimos, pero la página que estás buscando no existe.</p>
        </body>
        </html>';
        break;
}
