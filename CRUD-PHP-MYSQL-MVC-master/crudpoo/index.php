<?php

    /*REQUERIMOS USO DEL MODELO Y CONTROLADOR */
    require_once('bd/conexion.php');
    require_once('controlador/estudiante_controller.php');

    $controller= new estudiante_controller(); /*Hacemos una nueva instancia del controlador estudiante */
    
    if(!empty($_REQUEST['m'])){
        $metodo=$_REQUEST['m'];
        if (method_exists($controller, $metodo)) {
            $controller->$metodo();//llama a la vista 
        }else{
            $controller->index();/*Si la variable $_REQUEST['m'] esta vacia lleva a la vista de incicio*/
        }
    }else{
        $controller->index();
    }




?>