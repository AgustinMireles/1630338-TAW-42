<?php
    session_start();

    if(!$_SESSION["validar"]){
        header("location:index.php?action=ingresar");
        exit();
    }


?>

<h1>Usuarios</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Uusario</th>
                <th>Password</th>
                <th>Email</th>
                <th>¿Editar?</th>
                <th>¿Eliminar?</th>
            </tr>
        </thead>
        <body>
            <?php
                $visUsuario = new MvcControlador();
                $visUsuario -> ctrvistaUsuarioControlador();
                $visUsuario -> ctrborrarUsuarioControlador();
            ?>
        </body>
    </table>
    <?php
        if(isset($_GET["action"])){
            if ($_GET["action"] == "cambio") {
                echo "Cambio exitoso";
            }
        }
    ?>