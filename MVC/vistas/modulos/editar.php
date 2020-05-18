<?php
    session_start();

    if(!$_SESSION["validar"]){
        header("location:index.php?action=ingresar");
        exit();
    }


?>

<h1>Editar Usuarios</h1>
   <form method="post">
    
        <?php
            $editarUsuario = new MvcControlador();
            $editarUsuario -> ctreditarUsuarioControlador();
            $editarUsuario -> ctractualizarUsuarioControlador();
       
        ?>
       
    
    </form>