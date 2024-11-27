<?php 
    require __DIR__.'/../../helpers/functions.php';
    $careers = get_careers_from_cache();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamento Académico de Sistemas Computacionales</title>
    <link rel="stylesheet" href="<?=ASSETS_URL?>/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
    <header>
    <div class="box-ejemplo logo">
        <img class="logo-image" src="<?=ASSETS_URL?>/img/logo.png">
    </div>
    <nav>
        <ul>
            <li><a class="navigation-link" href="<?=BASE_URL?>">Inicio</a></li>
            <li><a class="navigation-link" href="#">Departamento</a></li>
            <li><a class="navigation-link" href="#">Aspirantes</a>
                <ul class="submenu">
                    <?php foreach($careers as $career): ?>
                    <li><a href="<?=BASE_URL?>/carreras?career=<?=$career['abbreviation']?>"><?=$career['name']?></a></li>
                    <?php endforeach; ?>
    
                </ul>
            </li>
            <li><a class="navigation-link" href="#">Estudiantes</a></li>
            <li><a class="navigation-link" href="#">Egresados</a></li>
            <?php 
            if(isset($_SESSION['user'])):
            ?>
                <li><a class="navigation-link" href="<?=BASE_URL?>/logout">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a class="navigation-link" href="<?=BASE_URL?>/login">Iniciar sesión</a></li>
            <?php endif; 
            ?>
        </ul>
    </nav>
</header>
<main>