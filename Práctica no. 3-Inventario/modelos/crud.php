<?php 

    include "conexion.php";

    class Datos extends Conexion{

        public function ingresoUsuarioModel($datosModel,$tabla){
            $stmt = Conexion::conectar()->prepare("SELECT CONCAT(firstname,' ',lastname) AS 'nombre_usuario',
            user_name AS 'usuario', user_password AS 'contrasena', user_id AS 'id' FROM $tabla WHERE user = 
            :usuario");
            $stmt->bindParam(":usuario",$datosModel["user"],PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            $stmt->close();
        }

        public function vistaUsersModel($tabla){
            $stmt = Conexion::conectar()->prepare("SELECT user_id AS 'id', firstname, lastname, user_name,
            user_password, user_email, date_added FROM $tabla");
            return $stmt->fecthAll();
            $stmt->close();
        }

        public function insertarUserModel($datosModel,$tabla){
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (firstname,lastname,user_name,user_password,
            user_email) VALUES (:nusuario,:asuario,:contra,:email)");
            $stmt->bindParam(":nusuario",$datosModel["nusuario"],PDO::PARAM_STR);
            $stmt->bindParam(":ausuario",$datosModel["ausuario"],PDO::PARAM_STR);
            $stmt->bindParam(":usuario",$datosModel["usuario"],PDO::PARAM_STR);
            $stmt->bindParam(":contra",$datosModel["contra"],PDO::PARAM_STR);
            $stmt->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
            if($stmt->exxecute()){
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
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla firstname = :nusuario, lastname = :ausuario,
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








    }




?>