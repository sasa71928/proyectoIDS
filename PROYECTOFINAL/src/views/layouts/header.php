<?php
require_once __DIR__.'/../../helpers/auth.php'; // Manejo de sesiones y autenticación
require_once __DIR__.'/../../helpers/functions.php'; // Funciones generales

// Obtener información del usuario autenticado
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$is_admin = $user['es_admin'] ?? false; // Determina si el usuario es administrador
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
    <style>
        /* Estilo para eliminar la línea de subrayado */
        .logo a, .vdc a {
            text-decoration: none;
            color: inherit; /* Mantiene el color actual del texto */
            display: inline-block; /* Para que el área clicable abarque el contenido */
        }
        .vdc {
            font-size: 24px;
            font-weight: bold;
        }
        .logo a img {
            display: block; /* Para que el área clicable abarque la imagen */
        }
    </style>
</head>
<body style="font-family: sans-serif;">
    <header>
        <div class="box logo">
            <a href="<?=BASE_URL?>">
                <img class="imagen" src="<?= ASSETS_URL ?>/img/vinyl.png" alt="Vinyl">
            </a>
        </div>
        <div class="box vdc">
            <a href="<?=BASE_URL?>">V.D.C.</a>
        </div>
        <nav class="box nav">
            <a class="link" href="<?=BASE_URL?>">Inicio</a>
            <a class="link" href="<?=BASE_URL?>/biblioteca">Biblioteca</a>

            <?php if ($user): ?>
                <?php if ($is_admin): ?>
                    <a class="link" href="<?=BASE_URL?>/products">Administrar</a>
                <?php else: ?>
                    <a class="link" href="<?=BASE_URL?>/carrito">Carrito</a>
                <?php endif; ?>
                <a class="link" href="<?=BASE_URL?>">Perfil de <?=htmlspecialchars($user['nombre'])?></a>
                <a class="link" href="<?=BASE_URL?>/logout">Cerrar sesión</a>
            <?php else: ?>
                <a class="link" href="<?=BASE_URL?>/login">Iniciar sesión</a>
            <?php endif; ?>
        </nav>
    </header>
</body>
</html>
