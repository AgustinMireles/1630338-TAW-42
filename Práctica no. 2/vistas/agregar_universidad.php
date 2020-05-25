<div class="container">
    <div class="jumbotron">
        <h2 class="text-center">Nueva Universidad</h2>

    </div>
    <!--FORMULARIO QUE ACTUALIZAR O CREARA UN ESTUDIANTE-->
    <div class="col-md-6 col-md-offset-3">
        <div class="form-horizontal" style="">
            <?php if($data['id']==""){ ?>
            <form action="index.php?mu=get_datosU" method="post">
            <?php } ?>
            <!--SI EL ID TIENE VALOR ENTONCES ACUTLIZAREMOS UN ESTUDIANTE EN ESPECIFICO-->
            <?php if($data['id']!=""){ ?>
            <form action="index.php?mu=get_datosU&id=<?php echo $data['id'];?>" method="post">

            <!--EN CASO DE QUE ACTULIZAREMOS UN ESTUDIANTE MOSTRARA VALORES POR DEFECTO-->    
            <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_id">ID:</label>
                    <div class="col-sm-10">
                <input type="text" disabled class="form-control" name="txt_id" value="<?php echo $data['id']; ?> ">
                    </div>
                    </div>
            <?php } ?>


                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_nombre">NOMBRE:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_nombre" value="<?php echo $data['nombre_universidad']; ?>">
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