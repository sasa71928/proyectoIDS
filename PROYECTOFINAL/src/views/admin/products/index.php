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
                <th>Título</th>
                <th>Artista</th>
                <th>Año</th>
                <th>Duración</th>
                <th>Formato</th>
                <th>Género</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach($products as $product): ?>
                    <tr>
                        <td><?=$product['id']?></td>
                        <td><?=$product['titulo']?></td>
                        <td><?=$product['artista']?></td>
                        <td><?=$product['anio']?></td>
                        <td><?=$product['duracion']?></td>
                        <td><?=$product['formato_id']?></td>
                        <td><?=$product['genero_id']?></td>
                        <td><?=$product['stock']?></td>
                        <td>
                            <img src="<?=htmlspecialchars($product['src'])?>" 
                            alt="<?=htmlspecialchars($product['titulo'])?>" width="100">
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
                    <td colspan="10">No hay productos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include_once __DIR__.'/../../layouts/footer.php'; ?>
