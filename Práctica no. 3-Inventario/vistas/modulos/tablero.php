<?php 

  if(!isset($_SESSION['validar'])){
    header("location:index.php?action=ingresar");
    exit();
  }

  $tablero = new MvcController();
  $tablero->contarFilas();

?>