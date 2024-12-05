<?php 
include_once __DIR__.'/../../layouts/header.php';
require_once __DIR__.'/../../../controllers/ProductsController.php';

// Obtener los productos del controlador
$products = index();
?>

<style>
.table-container {
    padding: 20px;
    background-color: var(--colorprimario);
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Tabla estilizada */
.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;
    border-radius: 8px;
    overflow: hidden;
}

.styled-table thead tr {
    background-color: var(--colornegro);
    color: var(--colorblanco);
    font-weight: bold;
}

.styled-table th, .styled-table td {
    padding: 12px 15px;
    border: 1px solid var(--colornegro);
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: var(--colorsecundario);
}

.styled-table tbody tr:nth-of-type(odd) {
    background-color: var(--colorsegund);
}

.styled-table tbody tr:hover {
    background-color: var(--colorterc);
    cursor: pointer;
}

/* Botones de acción */
.btn {
    display: inline-block;
    padding: 8px 12px;
    font-size: 14px;
    border-radius: 4px;
    text-decoration: none;
    text-align: center;
}

.btn-view {
    background-color: var(--color4t);
    color: var(--colorblanco);
}

.btn-edit {
    background-color: var(--color5t);
    color: var(--colorblanco);
}

.btn-delete {
    background-color: var(--color6t);
    color: var(--colorblanco);
}

.btn:hover {
    opacity: 0.9;
}

</style>

<div class="table-container">
    <div class="table-container-header">
        <h1 class="h1-table">Listado de Productos</h1>
        <a href="<?=BASE_URL?>/products/form" class="add-button">Añadir Producto</a>
    </div>
    <table class="styled-table">
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
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?=htmlspecialchars($product['id'])?></td>
                        <td><?=htmlspecialchars($product['titulo'])?></td>
                        <td><?=htmlspecialchars($product['artista'])?></td>
                        <td><?=htmlspecialchars($product['anio'])?></td>
                        <td><?=htmlspecialchars($product['duracion'])?></td>
                        <td><?=htmlspecialchars($product['formato_nombre'])?></td>
                        <td><?=htmlspecialchars($product['genero_nombre'])?></td>
                        <td><?=htmlspecialchars($product['stock'])?></td>
                        <td>
                            <img src="<?=htmlspecialchars($product['src'])?>" 
                            alt="<?=htmlspecialchars($product['titulo'])?>" width="80">
                        </td>
                        <td class="actions">
                            <a href="<?=BASE_URL?>/products/view?id=<?=htmlspecialchars($product['id'])?>" class="btn btn-view">Ver</a>
                            <a href="<?=BASE_URL?>/products/form?id=<?=htmlspecialchars($product['id'])?>" class="btn btn-edit">Editar</a>
                            <a href="<?=BASE_URL?>/products/delete?id=<?=htmlspecialchars($product['id'])?>" 
                               class="btn btn-delete" 
                               onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
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
