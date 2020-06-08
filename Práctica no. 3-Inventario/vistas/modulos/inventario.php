<?php

if(!isset($_SESSION["validar"])){
    header("Location:index.php?action=ingresar");
    exit();
}

/**Llamada a los conotroladores para insertar/modificar/eliminar productos y su stock */

$inventario = new MvcController();
$inventario->insertarProductController();
$inventario->actualizarProductController();
$inventario->actualizar1StockController();
$inventario->actualizar2StockController();
$inventario->eliminarProductController();

/**Se verifica que el usuario haya pulsado sobre el boton de registrar o editar para mostrarle su 
 * respectivo formulario
 */

 if(isset($_GET['registrar'])){
     
     $inventario->registrarProductController();

 }else if(isset($_GET['idProductEditar'])){
     $inventario->editarProductController();
 } else if(isset($_GET['idProductAdd'])){
     $inventario->addProductController();
 }
 else if(isset($_GET['idProductDel'])){
     $inventario->delProductController();
 }

 ?>
 <div class="container-fluid">
    <div class="row mb-3">

    </div>
    <div class="card card-secondary">
      <div class="card-header">  
        <h3 class="card-title">Inventario</h3>
      </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <a href="index.php?action=inventario&registrar" class="btn btn-info">Agregar Nuevo Producto</a>
                </div>
            </div>
            <div class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th>¿Editar?</th>
                                    <th>¿Eliminar?</th>
                                    <th>ID</th>
                                    <th>Código del Producto</th>
                                    <th>Nombre del Producto</th>
                                    <th>Fecha de Inserción</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Categoría</th>
                                    <th>¿Añadir Stock?</th>
                                    <th>¿Eliminar Stock?</th>
                                </tr>
                            </thead>
                        <tbody>
                        
                            <?php
                            $inventario->vistaProductsController();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
     </div>
</div>
 </div><!--/.container-fluid-->

<?php $historial = new MvcController(); ?>

    <div class="container-fluid">
                    <div class="row mb-3"></div>
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Historial</h3>
                        </div>
                        <div class="card-body">
                            <div id="example2-wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-striped">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Usuario</th>
                                                    <th>Producto</th>
                                                    <th>Nota</th>
                                                    <th>Cantidad</th>
                                                    <th>Referencia</th>
                                                    <th>Fecha de Insercion</th>
                                                </tr>
                                            </thead>
                                        
                                        <tbody>
                                            <?php $historial->vistaHistorialController(); ?>
                                        </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cold-md-12 text-center">
                        <ul class="pagination pagination-sm pager" id="historial_page"></ul>
                    </div>
    </div><!--/.container-fluid-->
