<?php
include_once __DIR__.'/../layouts/header.php';
require_once __DIR__.'/../../controllers/ProductsController.php';

// Definir parámetros de paginación
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1; // Página actual
$limit = 10; // Productos por página
$offset = ($page - 1) * $limit; // Calcular el desplazamiento

// Obtener productos y total de productos
$products = index($limit, $offset);
$totalProducts = getTotalProducts();
$totalPages = ceil($totalProducts / $limit); // Calcular total de páginas
?>

<div class="library-container">
    <h1>Biblioteca</h1>
    <div class="product-list">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['src']) ?>" alt="<?= htmlspecialchars($product['titulo']) ?>">
                    <p class="product-title"><?= htmlspecialchars($product['titulo']) ?></p>
                    <p class="product-artist"><?= htmlspecialchars($product['artista']) ?></p>
                    <p class="product-price">$<?= htmlspecialchars($product['precio']) ?></p>
                    <button onclick="window.location.href='<?= BASE_URL ?>/details?id=<?= $product['id'] ?>'">Más</button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
    </div>

    <!-- Controles de paginación -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="btn">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="btn <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>" class="btn">Siguiente</a>
        <?php endif; ?>
    </div>
</div>

<style>
    .library-container {
        padding: 20px;
        background-color: var(--colorprimario);
    }

    .product-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        justify-items: center;
    }

    .product-card {
        background-color: var(--colorblanco);
        border: 1px solid var(--colorterc);
        border-radius: 5px;
        padding: 15px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
        max-width: 200px;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .product-card img {
        width: 100%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .product-title {
        font-size: 1.2rem;
        color: var(--colornegro);
    }

    .product-artist {
        font-size: 1rem;
        color: var(--colorgris);
    }

    .product-price {
        font-size: 1.2rem;
        color: var(--color5t);
        font-weight: bold;
    }

    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .btn {
        padding: 10px 20px;
        text-decoration: none;
        background-color: var(--color6t);
        color: var(--colorblanco);
        border-radius: 5px;
    }

    .btn.active {
        background-color: var(--color5t);
        pointer-events: none;
    }

    .btn:hover {
        background-color: var(--color4t);
    }
</style>

<?php include_once __DIR__.'/../layouts/footer.php'; ?>
