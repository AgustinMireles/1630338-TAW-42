<?php
/**Incluimos el modelo login*/
include_once('modelo/login_model.php');

/**Nombramos nuestra clase cntrolador login */
class login_controller{

    /**variable $model_l para instanciar de la clase login modelo */
    private $model_l;

    /**contrucor por defecto instancia a la clase login_model */
 

    /**funcion que llama a la vista login */
    static public function iniciar(){
        include_once('vistas/login.php');
    }

    /**funcion para validar usuario que ingreso*/
    static public function valida(){
        /**si cedula se envio por post quiere decir que ingresaron*/
        if(isset($_POST["cedula"])){
            /**$cedula y $contraseña para validar en el modelo */
            $cedula = $_POST["cedula"];
            $contrasena = $_POST["contrasena"];
            /**model_l llama a la funcion validar para verficar hacer una consulta donde del estudiante donde tenga los mismos datos */
            $respuesta = login_model::validar($cedula,$contrasena);
            /**validamos si la $respuesta que trajo en nuestra base de datos es igual a la variable $cedula y a la variable $contrasena. si es diferente de vacio, 
             * al igual que la $contrasena se diferente de vacio
            */
            if($respuesta["cedula"] == $cedula && !empty($respuesta) && !empty($cedula) &&
                $respuesta["contrasena"] == $contrasena && !empty($contrasena)){
                /**si todo es correcto declaramos una variable session para entrar al menu principal */
                    @session_start();
                            $_SESSION["validar"] = "ok";
                            /**redireccionandolo al index donde mostrara los el menu principal */
                            echo "<script>location.href='index.php?m=estudiante'</script>";
                            die();
            }
    }

}

}

?>