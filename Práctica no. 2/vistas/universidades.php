<div class="container" style="margin-top: 80px">
    <div class="jumbotron">
        <h2 class="text-center">Universidades</h2>
        
    </div>
    <div class="container">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($query as $data): ?>
                    <tr>
                        <th><?php echo $data['id']; ?></th>
                        <th><?php echo $data['nombre_universidad']; ?></th>
                        <th>
                            <a href="index.php?mu=agregar_universidad&id=<?php echo $data['id']?>" class="btn btn-primary">Editar</a>
                            <a href="index.php?mu=confirmarDeleteU&idU=<?php echo $data['id']?>" class="btn btn-danger">Eliminar</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>