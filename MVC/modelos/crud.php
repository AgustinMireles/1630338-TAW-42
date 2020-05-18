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


        //Modelo ingresoUsuarioModelo
        public function mdlingresoUsuarioModelo($datoModelo, $tabla){
            $stmt = Conexion::conectar()->prepare("SELECT usuario, password FROM $tabla WHERE usuario = :usuario");
            $stmt->bindParam(":usuario", $datoModelo["usuario"],PDO::PARAM_STR);
            $stmt->execute();
            //fecth() obtiene una fila de un conjunto de resultado asociado al objeto $stmt
            return $stmt->fetch();

            $stmt->close();
        }

        //Modelo Vista Usuarios

        public function mdlvistaUsuarioModelo($tabla){
            $stmt = Conexion::conectar()->prepare("SELECT id, usuario,password,email FROM $tabla");
            $stmt->execute();

            //fetcAll(): obtiene todas las filas de un conjunto  de resultados  asociado al objeto PDO statment (stmt)
            return $stmt->fetchAll();

            $stmt->close();
        }

        //Modelo editar usuario
        
        public function mdleditarUsuarioModelo($datoModelo, $tabla){
            $stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datoModelo, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->close();
        }

        //Modelo Actualizar Usuario
        public function mdlactualizarUsuarioModelo($datoModelo, $tabla){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE id = :id");

            $stmt->bindParam(":usuario", $datoModelo["usuario"], PDO::PARAM_INT);
            $stmt->bindParam(":password", $datoModelo["password"], PDO::PARAM_INT);
            $stmt->bindParam(":email", $datoModelo["email"], PDO::PARAM_INT);
            $stmt->bindParam(":id", $datoModelo["id"], PDO::PARAM_INT);

           
            if($stmt->execute()){
                return "success";
            }else{
                return "error";
            }
            $stmt->close();

        }

        //Modelo Borrar Usuario
        public function mdlborrarUsuarioModelo($datoModelo, $tabla){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datoModelo, PDO::PARAM_INT);

            if($stmt->execute()){
                return "success";
            }else{
                return "error";
            }
            $stmt->close();
        }


    }



?>