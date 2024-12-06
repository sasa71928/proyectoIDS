<?php

require __DIR__.'/../config/database.php';

// Configuración general
$config = require __DIR__.'/../config/config.php';

define('BASE_URL', $config['base_url']);
define('ASSETS_URL', $config['assets_url']);
define('SRC_URL', $config['src_url']);
define('CAREERS_CACHE_FILE', __DIR__.'/../cache/careers.json');

// Función para manejar errores personalizados
function set_error_message($message) {
    if (!isset($_SESSION['errors'])) {
        $_SESSION['errors'] = [];
    }
    $_SESSION['errors'][] = $message;
}

// Función para manejar mensajes de éxito
function set_success_message($message) {
    $_SESSION['success'] = $message;
}

// Redirigir a la página anterior
function redirect_back() {
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: ' . BASE_URL);
    }
    exit;
}

// Función para limpiar entradas del formulario
function clean_post_inputs() {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = trim($value);
        $_POST[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
    }
}

// Cachear datos (ejemplo de carreras)
function cache_data($filename, $data) {
    if (!is_dir(__DIR__.'/../cache')) {
        mkdir(__DIR__.'/../cache', 0755, true);
    }
    file_put_contents($filename, json_encode($data));
}

// Obtener datos desde el caché
function get_cached_data($filename) {
    if (file_exists($filename)) {
        return json_decode(file_get_contents($filename), true);
    }
    return [];
}

function get_authenticated_user() {
    if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
        return null;
    }
    return $_SESSION['user'];
}

function is_user_admin($user) {
    return isset($user['es_admin']) && $user['es_admin'];
}


function addProduct($data) {
    $pdo = getPDO();

    try {
        $sql = "INSERT INTO Producto (titulo, artista, anio, duracion, formato_id, genero_id, stock, precio, src)
                VALUES (:titulo, :artista, :anio, :duracion, :formato_id, :genero_id, :stock, :precio, :src)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':titulo' => $data['titulo'],
            ':artista' => $data['artista'],
            ':anio' => $data['anio'],
            ':duracion' => $data['duracion'],
            ':formato_id' => $data['formato_id'],
            ':genero_id' => $data['genero_id'],
            ':stock' => $data['stock'],
            ':precio' => $data['precio'],
            ':src' => $data['src']
        ]);

        return true;
    } catch (PDOException $e) {
        error_log("Error al insertar el producto: " . $e->getMessage());
        return false;
    }
}

function updateProduct($data) {
    $pdo = getPDO();

    try {
        $sql = "
            UPDATE Producto
            SET titulo = :titulo,
                artista = :artista,
                anio = :anio,
                duracion = :duracion,
                formato_id = :formato_id,
                genero_id = :genero_id,
                stock = :stock,
                precio = :precio,
                src = :src
            WHERE id = :id
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $data['id'],
            ':titulo' => $data['titulo'],
            ':artista' => $data['artista'],
            ':anio' => $data['anio'],
            ':duracion' => $data['duracion'],
            ':formato_id' => $data['formato_id'],
            ':genero_id' => $data['genero_id'],
            ':stock' => $data['stock'],
            ':precio' => $data['precio'],
            ':src' => $data['src']
        ]);

        return true;
    } catch (PDOException $e) {
        error_log("Error al actualizar producto: " . $e->getMessage());
        return false;
    }
}