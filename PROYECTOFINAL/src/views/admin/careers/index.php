<?php 
include_once __DIR__.'/../../layouts/header.php';
require_once __DIR__ . '/../../../helpers/auth.php';
require __DIR__.'/../../../controllers/careerController.php';
$careers = index();
?>

<div class="table-container">
        <div class="table-container-header">
            <h1 class="h1-table">Listado de Carreras</h1>
            <a href="<?=BASE_URL?>/careers/form" class="add-button">Añadir Carrera</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Abreviatura</th>
                    <th>Descripción</th>
                    <th>Año del plan</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($careers as $career): ?>
                <tr>
                    <td><?=$career['name']?></td>
                    <td><?=$career['abbreviation']?></td>
                    <td><?=$career['description']?></td>
                    <td><?=$career['year']?></td>
                    <td class="actions">
                        <a href="#">Ver</a>
                        <a href="<?=BASE_URL?>/careers/form?career_id=<?=$career['id']?>">Editar</a>
                        <a href="#">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>     
            </tbody>
        </table>
    </div>
    <?php include_once __DIR__.'/../../layouts/footer.php'; ?>
