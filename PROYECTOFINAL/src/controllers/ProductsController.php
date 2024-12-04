<?php 

    require_once __DIR__.'/../helpers/functions.php';

function index()

{
    $pdo = getPDO(); // Obtiene la conexión PDO.

    try {
        $sql = "SELECT id, name, categoria_id, genero_id, price, src FROM productos"; 
        $stmt = $pdo->query($sql);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products; 
    } catch (PDOException $e) {
        error_log("Error al consultar la base de datos". $e->getMessage());
    }
}
