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
    <style>
        body {
            font-family: 'Fira Sans', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #007BFF, #0056B3);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff;
            color: #333;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 1.5rem;
            color: #007BFF;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        input[type="text"],
        input[type="password"] {
            font-family: 'Fira Sans', 'Arial', sans-serif;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            width: calc(100%-0.8rem);
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button {
            font-family: 'Fira Sans', 'Arial', sans-serif;
            padding: 0.8rem;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056B3;
        }

        p {
            font-size: 0.9rem;
            color: #555;
        }

        p.error {
            color: red;
            font-size: 0.9rem;
        }
    
    </style>
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