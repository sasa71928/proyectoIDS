<?php

require_once __DIR__.'/../helpers/functions.php';

function index() {
    $pdo = getPDO();

    try {
        $sql = "
            SELECT 
                Producto.id, 
                Producto.titulo, 
                Producto.artista, 
                Producto.anio, 
                Producto.duracion, 
                Producto.stock, 
                Producto.src, 
                Formato.nombre AS formato_nombre, 
                Genero.nombre AS genero_nombre
            FROM Producto
            LEFT JOIN Formato ON Producto.formato_id = Formato.id
            LEFT JOIN Genero ON Producto.genero_id = Genero.id;
        ";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al consultar la base de datos: " . $e->getMessage());
        return [];
    }
}

function addProductHandler() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'titulo' => $_POST['titulo'],
            'artista' => $_POST['artista'],
            'anio' => $_POST['anio'],
            'duracion' => $_POST['duracion'],
            'formato_id' => $_POST['formato_id'],
            'genero_id' => $_POST['genero_id'],
            'stock' => $_POST['stock'],
            'src' => $_POST['src']
        ];

        if (addProduct($data)) {
            header('Location: /products');
            exit;
        } else {
            echo '<script>alert("Error al añadir el producto.");</script>';
        }
    } else {
        header('Location: /products');
    }
}


function getGenres() {
    $pdo = getPDO();

    try {
        $sql = "SELECT id, nombre FROM Genero";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al consultar géneros: " . $e->getMessage());
        return [];
    }
}

function getProductById($id) {
    $pdo = getPDO();

    try {
        $sql = "SELECT * FROM Producto WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener producto: " . $e->getMessage());
        return null;
    }
}

function updateProductHandler() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'id' => $_POST['id'],
            'titulo' => $_POST['titulo'],
            'artista' => $_POST['artista'],
            'anio' => $_POST['anio'],
            'duracion' => $_POST['duracion'],
            'formato_id' => $_POST['formato_id'],
            'genero_id' => $_POST['genero_id'],
            'stock' => $_POST['stock'],
            'src' => $_POST['src']
        ];

        if (updateProduct($data)) {
            header('Location: /products'); // Redirige a la lista de productos
            exit;
        } else {
            echo '<script>alert("Error al actualizar el producto. Por favor, inténtalo de nuevo.");</script>';
        }
    }
}

