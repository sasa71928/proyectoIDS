<?php 
    require __DIR__.'/../src/helpers/functions.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Iniciar sesión</h2>
        <?php 
        if (isset($_SESSION['errors'][0]))  
            echo "<p style='color:red;'>".$_SESSION['errors'][0]."</p>";
            unset($_SESSION['errors']);
        ?>
        <form method="POST" action="<?=SRC_URL?>/controllers/LoginController.php">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>