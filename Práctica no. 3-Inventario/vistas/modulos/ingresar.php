<div class="login-box">
    <div class="login-logo">
        <a href="index.php"><b>Sistema de </b>Inventarios</a>
    </div>

    <!--/.login-->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Login</p>
            <form method="post">
                <div class="input-group mb-3">
                    <input type="text" name="txtUser" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="txtPassword" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col-->
                    <div class="col-12">
                        <button class="btn btn-primary btn-block btn-flat" type="submit">Iniciar Sesion</button>
                    </div>
                    <!-- /.col-->
                </div>
            </form>
        </div>
        <!-- /.login-card-body-->
    </div>
</div>
<!-- /.login-box-->

<?php
/*Llamada al controlador que verifica el inicio de session */
$ingreso = new MvcController();
$ingreso->ingresaUsuarioController();

/*se verifica si existe algun fallo al iniciar sesion y se le notifica al usuario*/
if (isset($_GET["res"])) {
    if ($_GET["res"] == "fallo") {
        echo "fallo al ingresar";
    }
}
/*Se verifica que se haya cerrado la sesion actual */
if (isset($_GET["salir"])) {
    if ($_GET["salir"] == "1") {
        echo "Ha cerrado sesion exitosamente";
    }
}


?>