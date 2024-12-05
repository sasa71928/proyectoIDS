<?php 
include_once __DIR__.'/../src/views/layouts/header.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada</title>
    <link rel="stylesheet" href="<?=ASSETS_URL?>/css/style.css">
    <style>
        .error-container {
            text-align: center;
            margin-top: 100px;
        }
        .error-container h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .error-container p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .error-container a {
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .error-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>¡Oops! Página no encontrada</h1>
        <p>Parece que te has perdido un poco. La página que buscas no existe.</p>
        <a href="<?=BASE_URL?>">Volver al inicio</a>
    </div>
</body>
</html>
