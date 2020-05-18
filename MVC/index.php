<?php

//Invocacion a los metódos
require_once "modelos/enlaces.php";
require_once "modelos/crud.php";
require_once "modelos/crudProd.php";
require_once "modelos/crudCate.php";

//Controladores
//Creación de los objetos, que es la lógica del negocio
require_once "controladores/controlador.php";
require_once "controladores/controladorProd.php";
require_once "controladores/controladorCate.php";

//
$mvc= new MvcControlador();
$mvc->ctrpagina();



/*Productos
id
nombre 
descripción
precio de compra
precio de venta
inventario

categorias
id
nombre

alojamiento en server vps
repositorio acutlizado
*/
?>

 