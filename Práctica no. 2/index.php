<?php

    ob_start();
    /*REQUERIMOS USO DEL LOS CONTROLADORES */
    require_once('bd/conexion.php');
    require_once('controlador/estudiante_controller.php');
    require_once('controlador/universidad_controller.php');
    require_once('controlador/carrera_controller.php');
    require_once('controlador/login_controller.php');

    $controller= new estudiante_controller(); /*Hacemos una nueva instancia del controlador estudiante */
    $controlleruni= new universidad_controller();
    $controllercar= new carrera_controller();
    $login= new login_controller();
    /**VERFICAMOS SI HAY UNA SESSION ACTIVA PARA MOSTRAR EL CONTRNIDO PRINCIPAL */
    @session_start();
    if(isset($_SESSION["validar"]) && $_SESSION["validar"] == "ok"){
        if(!empty($_REQUEST['m'])){
            $metodo=$_REQUEST['m'];
            if (method_exists($controller, $metodo)) {
                $controller->$metodo();//llama a la vista 
            }
            else{
                $controller->index();/*Si la variable $_REQUEST['m'] esta vacia lleva a la vista de incicio*/
            }
            /**MISMO PROCESO PARA EL CONTROLADOR UNIVERSIDAD Y CARRERA */
            }elseif(!empty($_REQUEST['mu'])){
                $metodo=$_REQUEST['mu'];
                if (method_exists($controlleruni, $metodo)) {
                    $controlleruni->$metodo();//llama a la vista 
                }
                else{
                    $controlleruni->universidad();/*Si la variable $_REQUEST['mu'] esta vacia lleva a la vista de incicio*/
                }
            }elseif(!empty($_REQUEST['mc'])){
                $metodo=$_REQUEST['mc'];
                if (method_exists($controllercar, $metodo)) {
                    $controllercar->$metodo();//llama a la vista 
                }
                else{
                    $controllercar->carrera();/*Si la variable $_REQUEST['mc'] esta vacia lleva a la vista de incicio*/
                }
            }   
            else{
                $controller->index();
            }
        }   
        /**EN EL CASO DE QUE NO SE CUMPLA LO ENVIARMOS SIEMPRE AL LOGIN  */
        else{
        
            $login->iniciar();
        }



ob_end_flush();
?>