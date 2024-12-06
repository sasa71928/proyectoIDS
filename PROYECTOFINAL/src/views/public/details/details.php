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
    echo "<h2>Error: Producto no encontrado.</h2>";
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

<style>
    .details-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: var(--colorprimario);
        padding: 20px;
    }

    .details-card {
        background-color: var(--colorblanco);
        border: 1px solid var(--colorterc);
        border-radius: 10px;
        padding: 20px;
        max-width: 600px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .product-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .product-title {
        font-size: 2rem;
        color: var(--colornegro);
        margin-bottom: 10px;
    }

    .product-artist,
    .product-genre,
    .product-year,
    .product-duration,
    .product-format,
    .product-stock,
    .product-price {
        font-size: 1.2rem;
        color: var(--colorgris);
        margin: 5px 0;
    }

    .product-price {
        color: var(--color5t);
        font-weight: bold;
    }

    .back-btn {
        background-color: var(--color6t);
        color: var(--colorblanco);
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .back-btn:hover {
        background-color: var(--color4t);
    }
</style>

<?php include_once __DIR__.'/../../layouts/footer.php'; ?>