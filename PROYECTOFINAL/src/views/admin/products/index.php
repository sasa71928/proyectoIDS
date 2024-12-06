<?php
include_once __DIR__.'/../../layouts/header.php';
require_once __DIR__.'/../../../controllers/ProductsController.php';

// Requerir que el usuario inicie sesión
require_login();

// Verificar si el usuario es administrador
require_admin();

// Parámetros para paginación
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Obtener productos y total de páginas
$products = index($limit, $offset);
$totalProducts = getTotalProducts();
$totalPages = ceil($totalProducts / $limit);

$genres = getGenres();
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

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        border-radius: 8px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

        /* Controles de paginación */
        .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination .btn {
        margin: 0 5px;
        padding: 8px 12px;
        text-decoration: none;
        color: var(--colorblanco);
        background-color: var(--color6t);
        border-radius: 4px;
    }

    .pagination .btn.active {
        background-color: var(--color4t);
        pointer-events: none;
    }

    .pagination .btn:hover {
        opacity: 0.8;
    }
</style>

<div class="table-container">
    <div class="table-container-header">
        <h1 class="h1-table">Listado de Productos</h1>
        <button class="add-button" onclick="openModal()">Añadir Producto</button>

        <!-- Botón para añadir género -->
        <button class="add-button" onclick="openGenreModal()">Añadir Género</button>

        <!-- Modal para añadir género -->
        <div id="addGenreModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeGenreModal()">&times;</span>
                <h2>Añadir Género</h2>
                <form action="<?=BASE_URL?>/genres/add" method="POST" onsubmit="return validateGenreForm();">
                    <label for="nombreGenero">Nombre del Género:</label>
                    <input type="text" id="nombreGenero" name="nombreGenero" required>
                    <button type="submit">Guardar</button>
                </form>
            </div>
        </div>


    <!-- Modal -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Añadir Producto</h2>
            <form action="<?=BASE_URL?>/products/add" method="POST" onsubmit="return validateForm();">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                
                <label for="artista">Artista:</label>
                <input type="text" id="artista" name="artista" required>
                
                <label for="anio">Año:</label>
                <input type="number" id="anio" name="anio" required>
                
                <label for="duracion">Duración:</label>
                <input type="text" id="duracion" name="duracion" placeholder="hh:mm:ss" required>
                
                <label for="formato_id">Formato:</label>
                <select id="formato_id" name="formato_id" required>
                    <option value="1">CD</option>
                    <option value="2">Vinilo</option>
                    <option value="3">Cassette</option>
                </select>
                
                <label for="genero_id">Género:</label>
                <select id="genero_id" name="genero_id" required>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= htmlspecialchars($genre['id']) ?>">
                            <?= htmlspecialchars($genre['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" required>
                
                <label for="src">URL de la Imagen:</label>
                <input type="text" id="src" name="src" placeholder="https://example.com/imagen.jpg" required>

                <button type="submit">Guardar</button>
            </form>
        </div>
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
                            <a href="<?=BASE_URL?>/products/edit?id=<?=htmlspecialchars($product['id'])?>" class="btn btn-edit">Editar</a>

                            <a href="<?=BASE_URL?>/products/delete?id=<?=htmlspecialchars($product['id'])?>" 
                            class="btn btn-delete" 
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                            Eliminar
                            </a>
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

<script>
        function openModal() {
            document.getElementById('addProductModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('addProductModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('addProductModal');
            if (event.target === modal) {
                closeModal();
            }
        };

        function validateForm() {
        const srcInput = document.getElementById('src');
        const stockInput = document.getElementById('stock');

        // Validar URL de imagen
        const url = srcInput.value;
        const validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        const extension = url.split('.').pop().toLowerCase();

        if (!validExtensions.includes(extension)) {
            alert('Por favor, ingrese un enlace a una imagen válida (jpg, jpeg, png, gif).');
            return false;
        }

        // Validar stock
        const stock = parseInt(stockInput.value, 10);
        if (stock <= 0) {
            alert('El stock debe ser un número mayor a 0.');
            return false;
        }

        return true; // Permitir el envío del formulario si todo es válido
    }

    function openGenreModal() {
    document.getElementById('addGenreModal').style.display = 'block';
        }

    function closeGenreModal() {
        document.getElementById('addGenreModal').style.display = 'none';
      }

    function validateGenreForm() {
        const genreInput = document.getElementById('nombreGenero').value.trim();

        if (genreInput === '') {
            alert('El nombre del género no puede estar vacío.');
            return false;
        }
        return true;
    }


</script>

<?php include_once __DIR__.'/../../layouts/footer.php'; ?>
