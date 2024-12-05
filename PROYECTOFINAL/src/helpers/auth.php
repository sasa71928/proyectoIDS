<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está autenticado
function is_logged_in() {
    return isset($_SESSION['user']);
}

// Verifica si el usuario es administrador
function is_admin() {
    return isset($_SESSION['user']) && $_SESSION['user']['es_admin'];
}

// Redirige al login si el usuario no está autenticado
function require_login() {
    if (!is_logged_in()) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}

// Redirige al login si el usuario no es administrador
function require_admin() {
    if (!is_admin()) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
?>
