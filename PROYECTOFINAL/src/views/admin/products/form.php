<?php 
    include_once __DIR__.'/../../layouts/header.php';
    require_once __DIR__ . '/../../../helpers/auth.php';
    require __DIR__.'/../../../controllers/ProductsController.php';
    
    $title = 'Añadir Producto';
    $product = null;
    $route = SRC_URL.'/controllers/ProductsController.php';

    if (isset($_GET['id'])) {
        $title = 'Editar Producto';
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $product = show($id); // Obtener el producto a editar
        $route .= "?id=$id";
    }
?>

<div class="form-container">
    <h1><?=$title?></h1>
    <form action="<?=$route?>" method="POST" enctype="multipart/form-data">
        <!-- Título -->
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Ingrese el título del producto" value="<?=$product['titulo'] ?? ''?>" required>
        </div>

        <!-- Artista -->
        <div class="form-group">
            <label for="artista">Artista</label>
            <input type="text" id="artista" name="artista" placeholder="Ingrese el nombre del artista" value="<?=$product['artista'] ?? ''?>" required>
        </div>

        <!-- Año -->
        <div class="form-group">
            <label for="anio">Año</label>
            <input type="number" id="anio" name="anio" placeholder="Ingrese el año de lanzamiento" value="<?=$product['anio'] ?? ''?>" required>
        </div>

        <!-- Duración -->
        <div class="form-group">
            <label for="duracion">Duración</label>
            <input type="time" id="duracion" name="duracion" step="60" placeholder="Ingrese la duración (hh:mm)" value="<?=$product['duracion'] ?? ''?>" required>
        </div>

        <!-- Formato -->
        <div class="form-group">
            <label for="formato_id">Formato</label>
            <select id="formato_id" name="formato_id" required>
                <option value="">Seleccione un formato</option>
                <option value="1" <?=isset($product['formato_id']) && $product['formato_id'] == 1 ? 'selected' : ''?>>CD</option>
                <option value="2" <?=isset($product['formato_id']) && $product['formato_id'] == 2 ? 'selected' : ''?>>Vinilo</option>
                <option value="3" <?=isset($product['formato_id']) && $product['formato_id'] == 3 ? 'selected' : ''?>>Cassette</option>
            </select>
        </div>

        <!-- Género -->
        <div class="form-group">
            <label for="genero_id">Género</label>
            <select id="genero_id" name="genero_id" required>
                <option value="">Seleccione un género</option>
                <option value="1" <?=isset($product['genero_id']) && $product['genero_id'] == 1 ? 'selected' : ''?>>Rock</option>
                <option value="2" <?=isset($product['genero_id']) && $product['genero_id'] == 2 ? 'selected' : ''?>>Pop</option>
                <option value="3" <?=isset($product['genero_id']) && $product['genero_id'] == 3 ? 'selected' : ''?>>Jazz</option>
            </select>
        </div>

        <!-- Stock -->
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" placeholder="Ingrese la cantidad en stock" value="<?=$product['stock'] ?? ''?>" required>
        </div>

        <!-- Imagen -->
        <div class="form-group">
            <label for="src">Imagen del Producto (JPG, JPEG, PNG)</label>
            <input type="text" id="src" name="src" placeholder="Ingrese la URL de la imagen" value="<?=$product['src'] ?? ''?>" required pattern=".*\.(jpg|jpeg|png)$" title="La URL debe terminar con .jpg, .jpeg, o .png">
        </div>

        <!-- Botones de acción -->
        <div class="form-group action-buttons">
            <button class="submit-button" type="submit">Guardar</button>
            <a href="<?=BASE_URL?>/products" class="cancel-button">Regresar</a>
        </div>

        <?php 
        // Mostrar mensajes de éxito o error
        if (isset($_SESSION['success'])): 
        ?>
            <p class="success"><?=htmlspecialchars($_SESSION['success'])?></p>
        <?php 
        $_SESSION['success'] = '';
        endif;
        if (isset($_SESSION['errors'])):
        ?>
            <p class="error">
        <?php 
            foreach ($_SESSION['errors'] as $error):     
        ?>
                <?=htmlspecialchars($error);?>
        <?php
            endforeach; 
        ?>
            </p>
        <?php
            $_SESSION['errors'] = [];
        endif; 
        ?>
    </form>
</div>

<?php include_once __DIR__.'/../../layouts/footer.php'; ?>
