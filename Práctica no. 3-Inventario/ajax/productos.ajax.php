<?php 
/**REQUERIMOS DE LOS CONTROLADORES PARA ENVIARLES LOS DATOS Y MODELOS PARA RECIBIRLOS**/
require_once "../controladores/controlador.php";
require_once "../modelos/crud.php";


/** NOMBRAMOS A LA CLASE**/
class AjaxProductos{

/**FUNCION PARA MOSTRAR PRODUCTOS**/   
public $idProducto;

public function verProducto(){
   
      $valor = $this->idProducto;

      $respuesta = MvcController::mostrarProductoController($valor);

      echo json_encode($respuesta);

    

  }

  /** FUNCION PARA BUSCADOR**/
public $buscar; 
public function buscarProductos(){

   $valor = $this->buscar;

   $respuesta = MvcController::buscarProductosController($valor);

   echo json_encode($respuesta);

}

/**FUNCION PARA VALIDAR CREDENCIALES, PARA CANCELAR LA VENTA**/
public $contrasena; 
public $usuario;
public function validarContra(){

   $valor = $this->contrasena;
   $valor2 = $this->usuario;

   $respuesta = MvcController::validarContraController($valor,$valor2);

   echo json_encode($respuesta);

}

}



/**SI ESTA POSTEADO idProducto HACEMOS USO DE LA FUNCION verProductos**/
if(isset($_POST["idProducto"])){

   $Producto = new AjaxProductos();
   $Producto -> idProducto = $_POST["idProducto"];
   $Producto -> verProducto();

}

/**SI ESTA POSTEADO buscar HACEMOS USO DE LA FUNCION buscarProductos**/
if(isset($_POST["buscar"])){

   $Productobuscar = new AjaxProductos();
   $Productobuscar -> buscar = $_POST["buscar"];
   $Productobuscar -> buscarProductos();

}

/**SI ESTA POSTEADO usuario HACEMOS USO DE LA FUNCION validarContra**/
if(isset($_POST["usuario"])){

   $Productobuscar = new AjaxProductos();
   $Productobuscar -> contrasena = $_POST["contrasena"];
   $Productobuscar -> usuario = $_POST["usuario"];

   $Productobuscar -> validarContra();

}

/*
if(isset($_POST["idCliente"])){
   //$arr = json_decode($_POST['ids']);

   var_dump(json_encode($_POST["ids"], true));
   //var_dump ($_POST["ids"]);
}*/

?>