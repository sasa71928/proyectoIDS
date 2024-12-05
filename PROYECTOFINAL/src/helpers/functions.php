<?php 

require __DIR__.'/../config/database.php';

$config = require __DIR__.'/../config/config.php';

define('BASE_URL', $config['base_url']);

define('ASSETS_URL', $config['assets_url']);

define('SRC_URL', $config['src_url']);

define('CAREERS_CACHE_FILE',  __DIR__ .'/../cache/careers.json');

function is_logged_in() {
    return isset($_SESSION['user']); // Devuelve true si hay un usuario autenticado
}

function is_admin() {
    return isset($_SESSION['user']) && $_SESSION['user']['es_admin']; // Devuelve true si es administrador
}

function require_admin() {
    if (!is_admin()) {
        // Redirigir si no es administrador
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}

function require_login() {
    if (!is_logged_in()) {
        // Redirigir si no está autenticado
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
