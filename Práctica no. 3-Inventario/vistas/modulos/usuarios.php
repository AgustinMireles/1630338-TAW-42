<?php
    if(!isset($_SESSION['validar'])){
        header("location:index.php?action=ingresar");
        exit();
    }

    $usuarios =  new MvcController();
    $usuarios->insertarUserController();
    $usuarios->actualizarUserController();
    $usuarios->eliminarUserController();
    
    if(isset($_GET['registrar'])){
        $usuarios->registrarUserController();
    } else if(isset($_GET['idUserEditar'])) {
        $usuarios->editarUserController();
    }
 ?> 

 <div class="container-fluid">
    <div class="row mb-3">
        <div class="card card-secondary">
            <div class="car-header">
                <h3 class="card-title">Usuarios</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <a href="index.php?action=usuarios&registrar" class="btn btn-info">Agregar Nuevo Usuario</a>
                    </div>
                </div>
            <div class="dataTables_wrapper dt-boostrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-hover m-0 table-bordered table-striped">
                            <thead class="table-info">
                                <tr>
                                    <th>¿Editar?</th>
                                    <th>¿Eliminar?</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Usuario</th>
                                    <th>Correo Electrónico</th>
                                    <th>Fecha de Inserción</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php
                                    $usuarios->vistaUserController();
                                ?>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
