<?php
        
    require_once "conexion.php";
    
    //heredar la clase conexion.php para poder accesar y utilizar la conexion a la base de datos, se extiende cuando se requiere manipular una función o metódo, en este caso manipularemos la función "conectar" de modelo/conexion.php"

    class Datos extends Conexion{

        //REGISTRO DE USUARIOS
        public function mdlregistroUsuarioModelo($datos,$tabla){
            //prepare() prepara la sentencia de SQL para que sea ejecutada por el método POSStantement. La sentencia de SQL se puede contener desde 0 para ejecutar mas parámetros.
            
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, password, email) 
            VALUES (:usuario, :password, :email)");

            //bindParam() vincula una variable de PHP a un parámetro de sititución con nombre correspondiente a la sentencia SQL que usada para preparar la sentencia

            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        

            //regresar una respuesta satisfactoria o no

            if($stmt->execute()){
                return "success";
            }else{ 
                return "error";
            }

            $stmt->close();

        }

    }



?>