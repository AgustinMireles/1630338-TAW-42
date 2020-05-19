<?php
        
    require_once "conexion.php";
    
    //heredar la clase conexion.php para poder accesar y utilizar la conexion a la base de datos, se extiende cuando se requiere manipular una función o metódo, en este caso manipularemos la función "conectar" de modelo/conexion.php"

    class DatosProd extends Conexion{

        //REGISTRO DE PRODUCTOS
       static public function mdlregistroProducto($datos,$tabla){
            //prepare() prepara la sentencia de SQL para que sea ejecutada por el método POSStantement. La sentencia de SQL se puede contener desde 0 para ejecutar mas parámetros.
            
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, descripcion, precio_compra, precio_venta, inventario, id_categoria) 
            VALUES (:nombre, :descripcion, :precio_compra, :precio_venta, :inventario, :id_categoria)");

            //bindParam() vincula una variable de PHP a un parámetro de sititución con nombre correspondiente a la sentencia SQL que usada para preparar la sentencia

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
            $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
            $stmt->bindParam(":inventario", $datos["inventario"], PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
        

            //regresar una respuesta satisfactoria o no

            if($stmt->execute()){
                return "success";
            }else{ 
                return "error";
            }

            $stmt->close();

        }


     

        //Modelo Vista Productos
        //REALIZA UNA CONSULTA A LA TABLA PRODUCTOS QUE MOSTRARA LA VISTA EN UNA TABLA EN HTML
        static public function mdlverProductos($tabla){
            $stmt = Conexion::conectar()->prepare("SELECT id, nombre, descripcion, precio_compra, precio_venta, inventario, id_categoria FROM $tabla");
            $stmt->execute();

            //fetcAll(): obtiene todas las filas de un conjunto  de resultados  asociado al objeto PDO statment (stmt)
            return $stmt->fetchAll();

            $stmt->close();
        }

        //Modelo editar PRODUCTOS
        //REALIZA UNA CONSULTA A LA TABLA PRODUCTOS HA DIFERENCIA DE QUE SOLO A UN PRODUCTO
        static public function mdleditarProducto($datoModelo, $tabla){
            $stmt = Conexion::conectar()->prepare("SELECT id, nombre, descripcion, precio_compra, precio_venta, inventario FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $datoModelo, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->close();
        }
        
        //Modelo Actualizar PRODUCTOS
        /**REALIZA UNA ACTUALIZACION AL PRODUCTO QUE ACTUALIZADO  */
        static public function mdlactualizarProducto($datosModelo, $tabla){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, descripcion = :descripcion,
             precio_compra = :precio_compra, precio_venta = :precio_venta, inventario = :inventario, id_categoria = :id_categoria WHERE id = :id");
            $stmt->bindParam(":id", $datosModelo["id"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datosModelo["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datosModelo["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":precio_compra", $datosModelo["precio_compra"], PDO::PARAM_STR);
            $stmt->bindParam(":precio_venta", $datosModelo["precio_venta"], PDO::PARAM_STR);
            $stmt->bindParam(":inventario", $datosModelo["inventario"], PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria", $datosModelo["id_categoria"], PDO::PARAM_STR);
        

           
            if($stmt->execute()){
                return "success";
            }else{
                return "error";
            }
            $stmt->close();

        }

        //Modelo Borrar PRODUCTOS
        //BORRA EL PRODUCTO SELECCIONADO DE LA TABLA PRODUCTOS
            static public function mdlborrarProducto($datoModelo, $tabla){
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