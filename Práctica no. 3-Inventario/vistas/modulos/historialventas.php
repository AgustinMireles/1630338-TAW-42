<?php
    if(!isset($_SESSION['validar'])){
        header("location:index.php?action=ingresar");
        exit();
    }

    $historialven =  new MvcController();
    $historialven->eliminarVentaController();
    
 ?> 

 <div class="container-fluid">
    <div class="row mb-3">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Historial Ventas</h3>
            </div>
            <div class="card-body">
            <div class="dataTables_wrapper dt-boostrap4">
                <div class="row">
                    <div class="col-sm-12 ">
                        <table id="example1" class="table table-hover m-0 table-bordered table-striped">
                            <thead class="table-info">
                                <tr>
                                    <th>¿Eliminar?</th>
                                    <th>Total Venta</th>
                                    <th>Total Productos</th>
                                    <th>Productos</th>
                                    <th>Fecha de Insercion</th>
                                    <th>Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php
                                    $historialven->vistaVentaController();
                                ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

