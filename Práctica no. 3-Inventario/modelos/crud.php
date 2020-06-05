<?php 

    include "conexion.php";

    class Datos extends Conexion{

        public function ingresoUsuarioModel($datosModel,$tabla){
            $stmt = Conexion::conectar()->prepare("SELECT CONCAT(firstname,' ',lastname) AS nombre_usuario,
            user_name AS usuario, user_password AS contrasena, user_id AS id FROM $tabla WHERE user_name = 
            :usuario");
            $stmt->bindParam(":usuario",$datosModel["user"],PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->close();
        }

        public function vistaUsersModel($tabla){
            $stmt = Conexion::conectar()->prepare("SELECT user_id AS 'id', firstname, lastname, user_name,
            user_password, user_email, date_added FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->close();
        }

        public function insertarUserModel($datosModel,$tabla){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (firstname,lastname,user_name,user_password,
            user_email) VALUES (:nusuario,:ausuario,:usuario,:contra,:email)");
            $stmt->bindParam(":nusuario",$datosModel["nusuario"],PDO::PARAM_STR);
            $stmt->bindParam(":ausuario",$datosModel["ausuario"],PDO::PARAM_STR);
            $stmt->bindParam(":usuario",$datosModel["usuario"],PDO::PARAM_STR);
            $stmt->bindParam(":contra",$datosModel["contra"],PDO::PARAM_STR);
            $stmt->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
            if($stmt->execute()){
                return "success";
            } else {
                return "error";
            }
            $stmt->close();
        }

        /**Este modelo sirve para cargar la información del usuario para su posterior modificaión */
        public function editarUserModel($datosModel,$tabla){
            $stmt = Conexion::conectar()->prepare("SELECT user_id AS 'id', firstname AS 'nusuario', lastname AS
            'ausuario', user_name AS 'usuario', user_password AS 'contra', user_email AS 'email' FROM $tabla WHERE
            user_id=:id");

            $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->close();
        }

        public function actualizarUserModel($datosModel,$tabla){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET firstname = :nusuario, lastname = :ausuario, 
            user_name = :usuario, user_password = :contra, user_email = :email WHERE user_id = :id");

            $stmt->bindParam(":nusuario",$datosModel["nusuario"],PDO::PARAM_STR);
            $stmt->bindParam(":ausuario",$datosModel["ausuario"],PDO::PARAM_STR);
            $stmt->bindParam(":usuario",$datosModel["usuario"],PDO::PARAM_STR);
            $stmt->bindParam(":contra",$datosModel["contra"],PDO::PARAM_STR);
            $stmt->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
            $stmt->bindParam(":id",$datosModel["id"],PDO::PARAM_INT);

            if($stmt->execute()){
                return "success";
            } else {
                return "error";
            }
            $stmt->close();
        }

        public function eliminarUserModel($datosModel,$tabla){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE user_id = :id");
            $stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
            if($stmt->execute()){
                return "success";
            } else {
                return "error";
            }
            $stmt->close();
        }

        public function contarFilasModel($tabla) {
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) AS 'filas' FROM $tabla");
            $stmt->execute();
            return $stmt->fetch();
            $stmt->close();
        }

        public function vistaCategoriesModel($tabla){
            $stmt = Conexion::conectar()->prepare("SELECT id_category AS 'idc', name_category AS 'ncategoria',
            description_category AS 'dcategoria', date_added AS 'fcategoria' FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->close();
        }

        public function insertarCategoryModel($datosModel, $tabla){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (name_category, description_category)
            VALUES (:ncategoria, :dcategoria)");
            $stmt->bindParam(":ncategoria", $datosModel["nombre_categoria"],PDO::PARAM_STR);
            $stmt->bindParam(":dcategoria", $datosModel["descripcion_categoria"],PDO::PARAM_STR);
            
            if($stmt->execute()){
                return "success";
            } else {
                return "error";
            }
            $stmt->close();
        }


        public function editarCategoryModel($datosModel, $tabla){
            $stmt = Conexion::conectar()->prepare("SELECT id_category AS 'id', name_category AS
            'nombre_categoria', description_category AS 'descripcion_categoria' FROM $tabla WHERE
            id_category = :id");
            $stmt->bindParam(":id", $datosModel,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->close();
        }

        public function actualizarCategoryModel($datosModel, $tabla){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET name_category = :nombre_categoria, 
            description_category = :descripcion_categoria WHERE id_category = :id");
            $stmt->bindParam(":nombre_categoria", $datosModel["nombre_categoria"],PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_categoria", $datosModel["descripcion_categoria"],PDO::PARAM_STR);
            $stmt->bindParam(":ncategoria", $datosModel["nombre_categoria"],PDO::PARAM_STR);
            $stmt->bindParam(":id", $datosModel["id"],PDO::PARAM_INT);
            if($stmt->execute()){
                return "success";
            } else {
                return "error";
            }
            $stmt->close();
        }

        public function eliminarCategoryModel($datosModel, $tabla){
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_category = :id");
            $stmt->bindParam(":id",$datosModel,PDO::PARAM_INT);
            if($stmt->execute()){
                return "success";
            } else {
                return "error";
            }
            $stmt->close();
        }




    }




?>