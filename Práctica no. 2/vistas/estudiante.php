<div class="container">
    <div class="jumbotron">
    <h2 class="text-center">Nuevo Estudiante</h2>

    </div>
    <!--FORMULARIO QUE ACTUALIZAR O CREARA UN ESTUDIANTE-->
    <div class="col-md-6 col-md-offset-3">
        <div class="form-horizontal" style="">
            <?php if($data['id']==""){ ?>
            <form action="index.php?m=get_datosE" method="post">
            <?php } ?>
            <!--SI EL ID TIENE VALOR ENTONCES ACUTLIZAREMOS UN ESTUDIANTE EN ESPECIFICO-->
            <?php if($data['id']!=""){ ?>
            <form action="index.php?m=get_datosE&id=<?php echo $data['id'];?>" method="post">

            <!--EN CASO DE QUE ACTULIZAREMOS UN ESTUDIANTE MOSTRARA VALORES POR DEFECTO-->    
            <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_id">ID:</label>
                    <div class="col-sm-10">
                <input type="text" disabled class="form-control" name="txt_id" value="<?php echo $data['id']; ?> ">
                    </div>
                    </div>
            <?php } ?>

                
                    
               
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_cedula">CEDULA:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_cedula" value="<?php echo $data['cedula']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_contrasena">CONTRASEÑA:</label>
                    <div class="col-sm-10">
                        <input type="password" class="ml-4 form-control" id="txt_contrasena" name="txt_contrasena" value="<?php echo $data['contrasena']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_nombre">NOMBRE:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_nombre" value="<?php echo $data['nombre']; ?>">
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_apellidos">APELLIDOS:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_apellidos" value="<?php echo $data['apellidos']; ?>">
                    </div>
                    
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txt_carrera">CARRERA:</label>
                    <div class="col-sm-6">
                    <select name="txt_carrera" id="txt_carrera" class="form-control">                            
                    <?php
                            foreach($carrera as $car){
                            //foreach(datos as $key => $item){    
                            echo'<option value="'.$car['id'].'">'.$car['nombre_carrera'].'</option>';
                            }
                    ?>
                     </select> 
                     </div>
                </div>
            
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_promedio">PROMEDIO:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" step="any" name="txt_promedio" value="<?php echo $data['promedio']; ?>">
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_edad">EDAD:</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control" name="txt_edad" value="<?php echo $data['edad']; ?>">
                    </div>
                    
                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_fecha">fecha:</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" name="txt_fecha" value="<?php echo $data['fecha']; ?>">
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class="col-md-12 col-md-off-set-3">
                    <!--DEPENDIENDO DE LA ACCION QUE REALIZE MOSTRARA UN BOTON REGISTRAR O ACTUALIZAR-->
                    <?php if($data['id']==""){ ?>
                        <input type="submit" class="btn btn-primary form-control" name="" value="registrar">
                    <?php }  ?>
                    <?php if($data['id']!=""){ ?>
                    <input type="submit" class="btn btn-primary form-control" name="" value="Actualizar">
                    <?php }  ?>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    
</div>