<?php 
require_once "../controladores/controlador.php";
require_once "../modelos/crud.php";

class AjaxProductos{

public $idProducto;

public function editarProducto(){
   
      $valor = $this->idProducto;

      $respuesta = MvcController::mostrarProductoController($valor);

      echo json_encode($respuesta);

    

  }

public $buscar; 
public function verProductos(){

   $valor = $this->buscar;

   $respuesta = MvcController::buscarProductosController($valor);

   echo json_encode($respuesta);

}

}




if(isset($_POST["idProducto"])){

   $Producto = new AjaxProductos();
   $Producto -> idProducto = $_POST["idProducto"];
   $Producto -> editarProducto();

}


if(isset($_POST["buscar"])){

   $Productobuscar = new AjaxProductos();
   $Productobuscar -> buscar = $_POST["buscar"];
   $Productobuscar -> verProductos();

}

?>