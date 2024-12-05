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
?>
