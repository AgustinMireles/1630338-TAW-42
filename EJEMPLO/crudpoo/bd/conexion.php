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
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    /**FUNCION PARA CERRAR LA CONEXION*/
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>