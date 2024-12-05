<?php 
    include_once __DIR__.'/../../layouts/header.php';
    require __DIR__.'/../src/helpers/functions.php';

    session_start(); // Inicia la sesión para manejar errores y datos de sesión
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?=ASSETS_URL?>/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Iniciar sesión</h2>
        <?php 
        if (!empty($_SESSION['errors'])): // Verificar si hay errores
            foreach ($_SESSION['errors'] as $error): 
        ?>
                <p style="color:red;"><?=htmlspecialchars($error)?></p>
        <?php 
            endforeach; 
            unset($_SESSION['errors']); // Limpiar errores después de mostrarlos
        endif; 
        ?>
        <form method="POST" action="<?=SRC_URL?>/controllers/LoginController.php">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>
