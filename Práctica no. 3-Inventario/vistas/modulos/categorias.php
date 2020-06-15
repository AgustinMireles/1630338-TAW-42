<?php

if (!isset($_SESSION['validar'])) {
    header("location:index.php?action=ingresar");
    exit();
}

$categorias =  new MvcController();
$categorias->insertarCategoryController();
$categorias->actualizarCategoryController();
$categorias->eliminarCategoryController();


if (isset($_GET['registrar'])) {
    $categorias->registrarCategoryController();
} else if (isset($_GET['idCategoryEditar'])) {
    $categorias->editarCategoryController();
}
?>


<div class="container-fluid">
    <div class="row mb-3"></div>
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Categorías</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <a href="index.php?action=categorias&registrar" class="btn btn-info">Agregar Nuevo Categoría</a>
                </div>
            </div>
            <div id="example2-wrapper" class="dataTables_wrapper dt-boostrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-striped display">
                            <thead class="table-primary">
                                <tr>
                                    <th>¿Editar?</th>
                                    <th>¿Eliminar?</th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Fecha de INsercion</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                /*Se llama al controlador que muestra todas las categorias que existen */
                                $categorias->vistaCategoriesController();
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.container-fluid-->