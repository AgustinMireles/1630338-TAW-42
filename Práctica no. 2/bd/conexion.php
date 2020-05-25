<?php
class Database

{
    /**DECLARACION DE VARIABLES PARA CONEXION A A BASE DE DATOS */  
    private static $dbName = 'ejercicio' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    /*FUNCION PARA REALIZAR CONEXION, QUE SE UTILIZA PARA REALIZAR LAS CRUDS CORRESPONDIENTES */
    public static function connect()
    {
      $link = new PDO ("mysql:host=localhost;dbname=ejercicio", "root", "");
      return $link;
    }
     
    /**FUNCION PARA CERRAR LA CONEXION*/
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>