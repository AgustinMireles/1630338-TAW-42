<?php
class Conexion

{

     
    /*FUNCION PARA REALIZAR CONEXION, QUE SE UTILIZA PARA REALIZAR LAS CRUDS CORRESPONDIENTES */
    public static function conectar()
    {
      $link = new PDO ("mysql:host=localhost;dbname=ejercicio", "root", "");
      return $link;
    }
     
}
?>