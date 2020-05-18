<?php

//Invocacion a los metódos
require_once "modelos/enlaces.php";
require_once "modelos/crud.php";
require_once "modelos/crudProd.php";

//Controladores
//Creación de los objetos, que es la lógica del negocio
require_once "controladores/controlador.php";

//
$mvc= new MvcControlador();
$mvc->ctrpagina();

?>