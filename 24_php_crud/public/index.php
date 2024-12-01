<?php

$request = $_SERVER['REQUEST_URI'];

$request = strtok($request, '?');

switch($request){
    case '/':
        require_once __DIR__.'/../src/views/public/welcome.php';
        break;
    case '/carreras':
        require_once __DIR__.'/../src/views/public/careers/details.php';
        break;
    case '/careers':
        require_once __DIR__.'/../src/views/admin/careers/index.php';
        break;
    case '/careers/form':
        require_once __DIR__.'/../src/views/admin/careers/form.php';
        break;
    case '/login':
        require_once __DIR__.'/login.php';
        break;
    case '/logout':
        require_once __DIR__.'/../src/controllers/LogoutController.php';
        break;
    default:
        http_response_code(404);
        //Hacer una vista de 404
        break;

}

