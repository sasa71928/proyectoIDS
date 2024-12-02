<?php 
    require __DIR__.'/../src/helpers/functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Iniciar sesión</h2>
        <?php 
        if (isset($_SESSION['errors'][0]))  
            echo "<p style='color:red;'>".$_SESSION['errors'][0]."</p>";
            unset($_SESSION['errors']);
        ?>
        <form method="POST" action="<?=SRC_URL?>/../src/views/public/welcome.php">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>