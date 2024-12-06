<?php

require_once __DIR__.'/../helpers/functions.php';

function index($limit, $offset) {
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
                Producto.precio, 
                Producto.src, 
                Formato.nombre AS formato_nombre, 
                Genero.nombre AS genero_nombre
            FROM Producto
            LEFT JOIN Formato ON Producto.formato_id = Formato.id
            LEFT JOIN Genero ON Producto.genero_id = Genero.id
            LIMIT :limit OFFSET :offset;
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al consultar la base de datos: " . $e->getMessage());
        return [];
    }
}

function getTotalProducts() {
    $pdo = getPDO();

    try {
        $sql = "SELECT COUNT(*) as total FROM Producto";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    } catch (PDOException $e) {
        error_log("Error al contar productos: " . $e->getMessage());
        return 0;
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
            'precio' => $_POST['precio'],
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
        $sql = "
            SELECT 
                Producto.*, 
                Formato.nombre AS formato_nombre, 
                Genero.nombre AS genero_nombre
            FROM Producto
            LEFT JOIN Formato ON Producto.formato_id = Formato.id
            LEFT JOIN Genero ON Producto.genero_id = Genero.id
            WHERE Producto.id = :id
        ";
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
            'precio' => $_POST['precio'],
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

function deleteProductById($id) {
    $pdo = getPDO();

    try {
        $sql = "DELETE FROM Producto WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        error_log("Error al eliminar producto: " . $e->getMessage());
        return false;
    }
}

function deleteProductHandler() {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if (deleteProductById($id)) {
            header('Location: /products'); // Redirige al listado después de eliminar
            exit;
        } else {
            echo '<script>alert("Error al eliminar el producto.");</script>';
        }
    } else {
        echo '<script>alert("ID de producto no especificado.");</script>';
    }
}

function addGenreHandler() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombreGenero = trim($_POST['nombreGenero']);

        // Validar que solo contenga letras y espacios
        if (!preg_match('/^[a-zA-Z\s]+$/', $nombreGenero)) {
            echo "<script>
                    alert('El nombre del género solo puede contener letras y espacios.');
                    window.location.href = '/products';
                  </script>";
            exit;
        }

        $pdo = getPDO();

        try {
            // Verificar si ya existe
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM Genero WHERE nombre = :nombre");
            $stmt->execute([':nombre' => $nombreGenero]);
            if ($stmt->fetchColumn() > 0) {
                echo "<script>
                        alert('El género ya existe. Por favor, introduce un género diferente.');
                        window.location.href = '/products';
                      </script>";
                exit;
            }

            // Insertar género
            $stmt = $pdo->prepare("INSERT INTO Genero (nombre) VALUES (:nombre)");
            $stmt->execute([':nombre' => $nombreGenero]);

            echo "<script>
                    alert('Género añadido con éxito.');
                    window.location.href = '/products';
                  </script>";
            exit;
        } catch (PDOException $e) {
            error_log("Error al añadir género: " . $e->getMessage());
            echo "<script>
                    alert('Ocurrió un error al añadir el género.');
                    window.location.href = '/products';
                  </script>";
            exit;
        }
    }
}

function isGenreDuplicate($nombreGenero) {
    $pdo = getPDO();
    try {
        $sql = "SELECT COUNT(*) FROM Genero WHERE nombre = :nombre";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nombre' => $nombreGenero]);
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        error_log("Error al comprobar género duplicado: " . $e->getMessage());
        return false;
    }
}

function addGenre($nombreGenero) {
    $pdo = getPDO();
    try {
        $sql = "INSERT INTO Genero (nombre) VALUES (:nombre)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':nombre' => $nombreGenero]);
        return true;
    } catch (PDOException $e) {
        error_log("Error al añadir género: " . $e->getMessage());
        return false;
    }
}

function getProductsByFormat($formatId, $limit = 5) {
    $pdo = getPDO();

    try {
        $sql = "
            SELECT 
                Producto.id, 
                Producto.titulo, 
                Producto.artista, 
                Producto.src, 
                Producto.precio, 
                Formato.nombre AS formato_nombre
            FROM Producto
            LEFT JOIN Formato ON Producto.formato_id = Formato.id
            WHERE Producto.formato_id = :formatId
            LIMIT :limit
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':formatId', $formatId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener productos por formato: " . $e->getMessage());
        return [];
    }
}
