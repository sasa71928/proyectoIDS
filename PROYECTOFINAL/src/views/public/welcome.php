<?php 
include_once __DIR__.'/../layouts/header.php';
require_once __DIR__.'/../../controllers/ProductsController.php';

// Obtener productos por formato
$discs = getProductsByFormat(3); // 1: ID de formato "Discos"
$vinyls = getProductsByFormat(2); // 2: ID de formato "Vinilos"
$cassettes = getProductsByFormat(1); // 3: ID de formato "Cassettes"
?>

<main>
    <div class="container">
        <img class="imagen-back" src="<?= ASSETS_URL ?>/img/fende.jpg" alt="Vinyl">
    </div>

    <div class="section">
        <h1>Vinilos</h1>
        <div class="product-list">
            <?php foreach ($vinyls as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['src']) ?>" alt="<?= htmlspecialchars($product['titulo']) ?>">
                    <p class="product-title"><?= htmlspecialchars($product['titulo']) ?></p>
                    <p class="product-artist"><?= htmlspecialchars($product['artista']) ?></p>
                    <p class="product-price">$<?= htmlspecialchars($product['precio']) ?></p>
                    <button class="more-btn" onclick="window.location.href='<?= BASE_URL ?>/details?id=<?= htmlspecialchars($product['id']) ?>'">Más</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h1>Discos</h1>
        <div class="product-list">
            <?php foreach ($discs as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['src']) ?>" alt="<?= htmlspecialchars($product['titulo']) ?>">
                    <p class="product-title"><?= htmlspecialchars($product['titulo']) ?></p>
                    <p class="product-artist"><?= htmlspecialchars($product['artista']) ?></p>
                    <p class="product-price">$<?= htmlspecialchars($product['precio']) ?></p>
                    <button class="more-btn" onclick="window.location.href='<?= BASE_URL ?>/details?id=<?= htmlspecialchars($product['id']) ?>'">Más</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h1>Cassettes</h1>
        <div class="product-list">
            <?php foreach ($cassettes as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['src']) ?>" alt="<?= htmlspecialchars($product['titulo']) ?>">
                    <p class="product-title"><?= htmlspecialchars($product['titulo']) ?></p>
                    <p class="product-artist"><?= htmlspecialchars($product['artista']) ?></p>
                    <p class="product-price">$<?= htmlspecialchars($product['precio']) ?></p>
                    <button class="more-btn" onclick="window.location.href='<?= BASE_URL ?>/details?id=<?= htmlspecialchars($product['id']) ?>'">Más</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: var(--colorprimario);
    }

    .container {
        text-align: center;
        margin-bottom: 20px;
    }

    .section {
        text-align: center;
        margin: 40px 0;
    }

    h1 {
        font-size: 2rem;
        color: var(--colornegro);
        margin-bottom: 20px;
    }

    .product-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        padding: 0 20px;
        justify-items: center;
    }

    .product-card {
        background-color: var(--colorblanco);
        border: 1px solid var(--colorterc);
        border-radius: 10px;
        padding: 20px;
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
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .product-title {
        font-size: 1.1rem;
        color: var(--colornegro);
        margin: 5px 0;
    }

    .product-artist {
        font-size: 1rem;
        color: var(--colorgris);
        margin: 5px 0;
    }

    .product-price {
        font-size: 1.2rem;
        color: var(--color5t);
        font-weight: bold;
        margin: 10px 0;
    }

    .more-btn {
        background-color: var(--color6t);
        color: var(--colorblanco);
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .more-btn:hover {
        background-color: var(--color4t);
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 1.5rem;
        }

        .product-card {
            padding: 10px;
        }

        .product-title, .product-artist, .product-price {
            font-size: 0.9rem;
        }

        .more-btn {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
    }
</style>
<?php include __DIR__.'/../layouts/footer.php'; ?>

