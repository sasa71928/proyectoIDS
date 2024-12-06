<?php
include_once __DIR__.'/../../layouts/header.php';
require_once __DIR__.'/../../../controllers/ProductsController.php';

// Obtener el ID del producto desde la URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$product_id) {
    echo "<h2>Error: ID de producto no proporcionado.</h2>";
    exit;
}

// Obtener los datos del producto
$product = getProductById($product_id);

if (!$product) {
    header('Location: /public/errores.php'); // Reemplaza con la URL de tu página de destino.
    exit;
}

// Obtener géneros y formatos (opcional si se requiere más detalle)
$genres = getGenres();
?>

<div class="details-container">
    <div class="details-card">
        <img src="<?= htmlspecialchars($product['src']) ?>" alt="<?= htmlspecialchars($product['titulo']) ?>" class="product-image">
        <h1 class="product-title"><?= htmlspecialchars($product['titulo']) ?></h1>
        <p class="product-id">ID: <?= htmlspecialchars($product['id']) ?></p>
        <p class="product-artist">Artista: <?= htmlspecialchars($product['artista']) ?></p>
        <p class="product-year">Año: <?= htmlspecialchars($product['anio']) ?></p>
        <p class="product-duration">Duración: <?= htmlspecialchars($product['duracion']) ?></p>
        <p class="product-format">Formato: <?= htmlspecialchars($product['formato_nombre']) ?></p>
        <p class="product-genre">Género: <?= htmlspecialchars($product['genero_nombre']) ?></p>
        <p class="product-stock">Stock: <?= htmlspecialchars($product['stock']) ?></p>
        <p class="product-price">Precio: $<?= htmlspecialchars($product['precio']) ?></p>
        <button onclick="window.history.back();" class="back-btn">Volver</button>
    </div>
</div>

<?php include_once __DIR__.'/../../layouts/footer.php'; ?>