<?php

$request = $_SERVER['REQUEST_URI'];
$request = strtok($request, '?');

switch($request){
    case '/':
        require_once __DIR__.'/../src/views/public/welcome.php';
        break;
    case '/login':
        require_once __DIR__.'/login.php';
        break;
    case '/products':
        require_once __DIR__.'/../src/views/admin/products/index.php';
        break;
    case '/products/form':
        require_once __DIR__.'/../src/views/admin/products/form.php';
        break;
    case '/logout':
        require_once __DIR__.'/../src/controllers/LogoutController.php';
        break;
    default:
    require_once __DIR__.'/errores.php';
        break;
}