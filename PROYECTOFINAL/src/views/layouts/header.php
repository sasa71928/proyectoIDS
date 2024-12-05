<?php 
require __DIR__.'/../../helpers/functions.php';

session_start(); // Asegurar que la sesión está activa
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ASSETS_URL?>/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Strike&display=swap" rel="stylesheet">
    <title>VDC</title>
</head>
<body style="font-family: sans-serif;">
    <header>
        <div class="box logo">
            <img class="imagen" src="<?= ASSETS_URL ?>/img/vinyl.png" alt="Vinyl">
        </div>
        <div class="box vdc">
            V.D.C.
        </div>
        <nav class="box nav">
            <a class="link" href="<?=BASE_URL?>">Inicio</a>
            <a class="link" href="<?=BASE_URL?>/biblioteca">Biblioteca</a>
            <?php if ($user): ?>
                <a class="link" href="<?=BASE_URL?>">Perfil de <?=htmlspecialchars($user['nombre'])?></a>
                <a class="link" href="<?=BASE_URL?>/logout">Cerrar sesión</a>
            <?php else: ?>
                <a class="link" href="<?=BASE_URL?>/login">Iniciar sesión</a>
            <?php endif; ?>
        </nav>
    </header>
</body>
</html>
