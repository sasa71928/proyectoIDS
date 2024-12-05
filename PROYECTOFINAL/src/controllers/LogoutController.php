<?php
session_start();
session_destroy(); // Eliminar la sesión
header('Location: /'); // Redirigir 
exit;
?>
