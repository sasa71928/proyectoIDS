<?php 
include_once __DIR__.'/../../layouts/header.php';
require_once __DIR__.'/../../../controllers/ProductsController.php';

// Requerir que el usuario inicie sesión
require_login();

// Verificar si el usuario es administrador
require_admin();

// Obtener el ID del producto
$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    echo 'ID de producto no proporcionado.';
    exit;
}

// Obtener los datos del producto
$product = getProductById($product_id);

if (!$product) {
    echo 'Producto no encontrado.';
    exit;
}

// Obtener géneros
$genres = getGenres();
?>

<form action="<?=BASE_URL?>/products/update" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
    
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($product['titulo']) ?>" required>
    
    <label for="artista">Artista:</label>
    <input type="text" id="artista" name="artista" value="<?= htmlspecialchars($product['artista']) ?>" required>
    
    <label for="anio">Año:</label>
    <input type="number" id="anio" name="anio" value="<?= htmlspecialchars($product['anio']) ?>" required>
    
    <label for="duracion">Duración:</label>
    <input type="text" id="duracion" name="duracion" value="<?= htmlspecialchars($product['duracion']) ?>" required>
    
    <label for="formato_id">Formato:</label>
    <select id="formato_id" name="formato_id" required>
        <option value="1" <?= $product['formato_id'] == 1 ? 'selected' : '' ?>>CD</option>
        <option value="2" <?= $product['formato_id'] == 2 ? 'selected' : '' ?>>Vinilo</option>
        <option value="3" <?= $product['formato_id'] == 3 ? 'selected' : '' ?>>Cassette</option>
    </select>
    
    <label for="genero_id">Género:</label>
    <select id="genero_id" name="genero_id" required>
        <?php foreach ($genres as $genre): ?>
            <option value="<?= htmlspecialchars($genre['id']) ?>" <?= $product['genero_id'] == $genre['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($genre['nombre']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="stock" value="<?= htmlspecialchars($product['stock']) ?>" required>
    
    <label for="src">URL de la Imagen:</label>
    <input type="text" id="src" name="src" value="<?= htmlspecialchars($product['src']) ?>" required>
    
    <button type="submit">Actualizar</button>
</form>
