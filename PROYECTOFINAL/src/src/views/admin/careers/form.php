<?php 
    include_once __DIR__.'/../../layouts/header.php';
    require_once __DIR__ . '/../../../helpers/auth.php';
    require __DIR__.'/../../../controllers/careerController.php';
    
    $title = 'Añadir';
    $career = null;
    $route = SRC_URL.'/controllers/careerController.php';

    if(isset($_GET['career_id'])){
        $title = 'Editar';
        $id = filter_input(INPUT_GET, 'career_id', FILTER_SANITIZE_STRING);
        $career = show($id);
        $route.="?career_id=$id";
    }
?>

<div class="form-container">
        <h1><?=$title?> carrera</h1>
        <form action="<?=$route?>" method="POST" enctype="multipart/form-data">
            <!-- Name -->
            <div class="form-group">
                <label for="name">Nombre de la Carrera</label>
                <input type="text" id="name" name="name" placeholder="Ingrese el nombre de la carrera" value="<?=$career['name'] ?? ''?>" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea id="description" name="description" placeholder="Ingrese una descripción de la carrera"><?php echo htmlspecialchars($career['description'] ?? '')?></textarea>
            </div>

            <!-- Abbreviation -->
            <div class="form-group">
                <label for="abbreviation">Abreviatura</label>
                <input type="text" id="abbreviation" name="abbreviation" placeholder="Ingrese la abreviatura" value="<?=$career['abbreviation'] ?? ''?>" required>
            </div>

            <!-- Mission -->
            <div class="form-group">
                <label for="mission">Misión</label>
<textarea id="mission" name="mission" placeholder="Ingrese la misión de la carrera" required>
<?php echo htmlspecialchars($career['mission'] ?? '')?>
</textarea>
            </div>

            <!-- Vision -->
            <div class="form-group">
                <label for="vision">Visión</label>
<textarea id="vision" name="vision" placeholder="Ingrese la visión de la carrera" required>
<?php echo htmlspecialchars($career['vision'] ?? '')?>
</textarea>
            </div>

            <!-- Year -->
            <div class="form-group">
                <label for="year">Año del Plan</label>
                <input type="number" id="year" name="year" placeholder="Ingrese el año de inicio" value="<?=$career['year'] ?? ''?>" required>
            </div>

            <!-- Thumbnail Image -->
            <div class="form-group">
                <label for="thumbnail_image">Imagen de Miniatura</label>
                <input type="file" id="image" name="image" accept="image/*" >
            </div>

            <!-- Submit Button -->
            <div class="form-group action-buttons">
                <button class="submit-button" type="submit">Guardar</button>
                <a href="index.php" type="submit">Regresar</a>
            </div>
            <?php 
            if(isset($_SESSION['success'])): 
            ?>
            
                <p class="success"><?php echo htmlspecialchars($_SESSION['success'])?></p>
            <?php 
            $_SESSION['success'] = '';
            endif;
            if(isset($_SESSION['errors'])):
            ?>
                <p class="error">
            <?php 
                foreach($_SESSION['errors'] as $error):     
            ?>
                    <?php echo htmlspecialchars($error);?>
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