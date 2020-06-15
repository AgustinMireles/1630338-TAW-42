<?php
    if(!isset($_SESSION['validar'])){
        header("location:index.php?action=ingresar");
        exit();
    }

    $clientes =  new MvcController();
    $clientes->insertarClienteController();
    $clientes->actualizarClienteController();
    $clientes->eliminarClienteController();
    
    if(isset($_GET['registrar'])){
        $clientes->registrarClienteController();
    } else if(isset($_GET['idClienteEditar'])) {
        $clientes->editarClienteController();
    }
 ?> 

 <div class="container-fluid">
    <div class="row mb-3">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Clientes</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <a href="index.php?action=clientes&registrar" class="btn btn-info">Agregar Nuevo Cliente</a>
                    </div>
                </div>
            <div class="dataTables_wrapper dt-boostrap4">
                <div class="row">
                    <div class="col-sm-12 ">
                        <table id="example1" class="table table-hover m-0 table-bordered table-striped">
                            <thead class="table-info">
                                <tr>
                                    <th>¿Editar?</th>
                                    <th>¿Eliminar?</th>
                                    <th>Nombre</th>
                                    <th>RFC</th>
                                    <th>Fecha de Insercion</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php
                                    $clientes->vistaClientesController();
                                ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

