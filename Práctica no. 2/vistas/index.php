<div class="container" style="margin-top: 80px">
    <div class="jumbotron">
    <h2 class="text-center">Estudiantes</h2>

    </div>
    <div class="container">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>id</th>
                    <th>cedula</th>
                    <th>contraseña</th>
                    <th>nombre</th>
                    <th>apellidos</th>
                    <th>promedio</th>
                    <th>carrera</th>
                    <th>edad</th>
                    <th>fecha</th>
                    <th>acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($query as $data): ?>
                    <tr>
                        <th><?php echo $data['id']; ?></th>
                        <th><?php echo $data['cedula']; ?></th>
                        <th><?php echo $data['contrasena']; ?></th>
                        <th><?php echo $data['nombre']; ?></th>
                        <th><?php echo $data['apellidos']; ?></th>
                        <th><?php echo $data['promedio']; ?></th>
                        <th><?php echo $data['nombre_carrera']; ?></th>
                        <th><?php echo $data['edad']; ?></th>
                        <th><?php echo $data['fecha']; ?></th>
                        <th>
                            <a href="index.php?m=estudiante&id=<?php echo $data['id']?>" class="btn btn-primary">Editar</a>
                            <a href="index.php?m=confirmarDelete&id=<?php echo $data['id']?>" class="btn btn-danger">Eliminar</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>