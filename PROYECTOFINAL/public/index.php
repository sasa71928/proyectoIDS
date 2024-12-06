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
    case '/products/add': // Ruta para añadir un producto
        require_once __DIR__.'/../src/controllers/ProductsController.php';
        addProductHandler(); // Llama a una función para manejar la lógica de añadir
        break;
    case '/products/edit':
        require_once __DIR__.'/../src/views/admin/products/edit.php';
        break;
    case '/products/update':
        require_once __DIR__.'/../src/controllers/ProductsController.php';
        updateProductHandler();
        break;                
    default:
    require_once __DIR__.'/errores.php';
        break;
}