<?php 

require_once __DIR__.'/../helpers/functions.php';

function index() {
    $pdo = getPDO(); // Obtiene la conexión PDO.

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
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products; 
    } catch (PDOException $e) {
        error_log("Error al consultar la base de datos: " . $e->getMessage());
        return []; // Devuelve un array vacío en caso de error
    }
}
