<?php 
include_once __DIR__.'/../../layouts/header.php';
require __DIR__.'/../../../controllers/ProductsController.php';

// Obtener los productos del controlador
$products = index();
?>

<div class="table-container">
    <div class="table-container-header">
        <h1 class="h1-table">Listado de Productos</h1>
        <a href="<?=BASE_URL?>/products/form" class="add-button">Añadir Producto</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Género</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach($products as $product): ?>
                    <tr>
                        <td><?=$product['id']?></td>
                        <td><?=$product['name']?></td>
                        <td><?=$product['categoria_id']?></td>
                        <td><?=$product['genero_id']?></td>
                        <td><?=$product['price']?></td>
                        <td>
                            <img src="<?=htmlspecialchars($product['src'])?>" alt="<?=htmlspecialchars($product['name'])?>" width="100">
                        </td>
                        <td class="actions">
                            <a href="#">Ver</a>
                            <a href="<?=BASE_URL?>/products/form?id=<?=htmlspecialchars($product['id'])?>">Editar</a>
                            <a href="#">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No hay productos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include_once __DIR__.'/../../layouts/footer.php'; ?>
