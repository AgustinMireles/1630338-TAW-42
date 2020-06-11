<?php
    ob_start();

    require_once "controladores/controlador.php";
    require_once "modelos/enlaces.php";
    require_once "modelos/crud.php";

    $mvc = new MvcController();
    $mvc -> plantilla();
/**subtotatl
total
desceunto
iva */
?>