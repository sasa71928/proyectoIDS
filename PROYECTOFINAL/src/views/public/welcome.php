<?php 
include_once __DIR__.'/../layouts/header.php';
require_once __DIR__.'/../../controllers/ProductsController.php';

// Obtener productos por formato
$discs = getProductsByFormat(1); // 1: ID de formato "Discos"
$vinyls = getProductsByFormat(2); // 2: ID de formato "Vinilos"
$cassettes = getProductsByFormat(3); // 3: ID de formato "Cassettes"
?>

<main>
    <div class="container">
        <img class="imagen-back" src="<?= ASSETS_URL ?>/img/fende.jpg" alt="Vinyl">
    </div>
    
    <div>
        <h1>Vinilos</h1>
        <div class="product-list">
            <?php foreach ($vinyls as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['src']) ?>" alt="<?= htmlspecialchars($product['titulo']) ?>" width="100">
                    <p><?= htmlspecialchars($product['titulo']) ?></p>
                    <p><?= htmlspecialchars($product['artista']) ?></p>
                    <p><?= htmlspecialchars($product['precio']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <button onclick="window.location.href='<?= BASE_URL ?>/products?format=2'">Más</button>
    </div>
    
    <div>
        <h1>Discos</h1>
        <div class="product-list">
            <?php foreach ($discs as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['src']) ?>" alt="<?= htmlspecialchars($product['titulo']) ?>" width="100">
                    <p><?= htmlspecialchars($product['titulo']) ?></p>
                    <p><?= htmlspecialchars($product['artista']) ?></p>
                    <p><?= htmlspecialchars($product['precio']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <button onclick="window.location.href='<?= BASE_URL ?>/products?format=1'">Más</button>
    </div>

    <div>
        <h1>Cassettes</h1>
        <div class="product-list">
            <?php foreach ($cassettes as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['src']) ?>" alt="<?= htmlspecialchars($product['titulo']) ?>" width="100">
                    <p><?= htmlspecialchars($product['titulo']) ?></p>
                    <p><?= htmlspecialchars($product['artista']) ?></p>
                    <p><?= htmlspecialchars($product['precio']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <button onclick="window.location.href='<?= BASE_URL ?>/products?format=3'">Más</button>
    </div>
</main>

<style>
        .product-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .product-card {
        background-color: var(--colorsecundario);
        padding: 10px;
        border: 1px solid var(--colorterc);
        border-radius: 5px;
        text-align: center;
        width: 150px;
    }

    .product-card img {
        width: 100%;
        height: auto;
        border-radius: 5px;
    }

</style>
<?php include __DIR__.'/../layouts/footer.php'; ?>
