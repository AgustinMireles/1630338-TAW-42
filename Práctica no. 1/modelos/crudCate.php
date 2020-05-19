<?php
        
    require_once "conexion.php";
    
    //heredar la clase conexion.php para poder accesar y utilizar la conexion a la base de datos, se extiende cuando se requiere manipular una función o metódo, en este caso manipularemos la función "conectar" de modelo/conexion.php"

    class DatosCate extends Conexion{

        //REGISTRO DE USUARIOS
        //REALIZA UN INSERCION A LA TABLA CATEGORÍAS DONDE AGREGAMOS LA NUEVA CATEGORIA
       static public function mdlregistroCategoria($datos,$tabla){
            //prepare() prepara la sentencia de SQL para que sea ejecutada por el método POSStantement. La sentencia de SQL se puede contener desde 0 para ejecutar mas parámetros.
            
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre) VALUES (:nombre)");

            //bindParam() vincula una variable de PHP a un parámetro de sititución con nombre correspondiente a la sentencia SQL que usada para preparar la sentencia

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        

            //regresar una respuesta satisfactoria o no

            if($stmt->execute()){
                return "success";
            }else{ 
                return "error";
            }

            $stmt->close();

        }


     

        //Modelo Vista CATEGORIAS
        //REALIZA UNA CONSULTA A LA TABLA CATEGORIAS
        static public function mdlverCategorias($tabla){
            $stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla");
            $stmt->execute();

            //fetcAll(): obtiene todas las filas de un conjunto  de resultados  asociado al objeto PDO statment (stmt)
            return $stmt->fetchAll();

            $stmt->close();
        }

        static public function mdlCategoria($tabla,$id){

            if($id != null){
            $stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla WHERE id = $id");
            $stmt->execute();

            //fetcAll(): obtiene todas las filas de un conjunto  de resultados  asociado al objeto PDO statment (stmt)
            return $stmt->fetch();
            }else{
            $stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla");
            $stmt->execute();
    
                //fetcAll(): obtiene todas las filas de un conjunto  de resultados  asociado al objeto PDO statment (stmt)
            return $stmt->fetchAll();
            }

            $stmt->close();
        }

        

        //Modelo editar CATEGORIA
        //REALIZA UNA SIMPLE CONSULTA DEL LA CATEGORIA QUE FUE SELECCIONADO
        
       static public function mdleditarCategoria($datoModelo, $tabla){
            $stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datoModelo, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->close();
        }
        
        //Modelo Actualizar Usuario
        //REALIZA UNA SIMPLE ACTUALIZACION DEL LA CATEGORIA QUE FUE EDITADA
        static public function mdlactualizarCategoria($datosModelo, $tabla){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id = :id");
            $stmt->bindParam(":id", $datosModelo["id"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datosModelo["nombre"], PDO::PARAM_STR);
           
            if($stmt->execute()){
                return "success";
            }else{
                return "error";
            }
            $stmt->close();

        }

        //Modelo Borrar CATEGORIA mdlborrarCategoria
        //BORRA LA CATEGOIA QUE FUE SELECCIONADO
            static public function mdlborrarCategoria($datoModelo, $tabla){
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