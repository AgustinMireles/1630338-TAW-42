<?php
      @session_start();

    if(!$_SESSION["validar"]){
        header("location:index.php?action=ingresar");
        exit();
    }


?>

<!--Tabla Usuarios-->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tabla Productos</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Inventario</th>
                        <th>¿Editar?</th>
                        <th>¿Eliminar?</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Inventario</th>
                        <th>¿Editar?</th>
                        <th>¿Eliminar?</th>
                    </tr>
                  </tfoot>
                  <tbody>
                        <?php
                            $visUsuario = new MvcControladorProd();
                            $visUsuario -> ctrverProductos();
                            $visUsuario -> ctrborrarProducto();
                        ?>
                  </tbody>
            </table>
        </div>
    </div>


</div>
<!--Fin de la Tabla-->

    <?php
        if(isset($_GET["action"])){
            if ($_GET["action"] == "cambio") {
                echo "Cambio exitoso";
            }
        }
    ?>