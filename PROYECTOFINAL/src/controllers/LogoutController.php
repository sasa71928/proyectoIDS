<?php
require __DIR__.'/../helpers/functions.php';
session_start();
session_destroy();
header('Location: '.BASE_URL.'/login');
exit;
?>