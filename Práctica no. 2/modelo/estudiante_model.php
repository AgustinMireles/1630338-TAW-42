<?php
    
    /**NOMBRAMOS A LA CLASE estudiante_model */
    class estudiante_model{
        private $DB;
        private $estudiantes;

        /**INSTANCIAMOS AL CLASE Database para realizar las crud*/
        function __construct(){
            $this->DB=Database::connect();
        }

        /**CRUD PARA VER TODOS LOS ESTUDIANTES DE LA TABLA */
        static public function get(){            
            $sql= 'SELECT e.id, e.cedula, e.contrasena, e.nombre, e.apellidos, e.promedio, e.edad, e.fecha, c.nombre_carrera FROM estudiante as e INNER JOIN carrera c WHERE e.id_carrera = c.id';
            $fila=Database::connect()->prepare($sql);
            $fila->execute();
            //$this->estudiantes=$fila;
            return $fila -> fetchAll();
            $fila -> close();
		    $fila = null;

        }

        /**CRUD PARA CREAR UN NUEVO ESTUDIANTE RECIBIENDO COMO PARAMETROS EL ARREGLO DATA */
        static public function create($data){

           // $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="INSERT INTO estudiante(cedula,contrasena,nombre,apellidos,id_carrera,promedio,edad,fecha)VALUES (?,?,?,?,?,?,?,?)";
            $query = Database::connect()->prepare($sql);
            $query->execute(array($data['cedula'],$data['contrasena'],$data['nombre'],$data['apellidos'],$data['id_carrera'],$data['promedio'],$data['edad'],$data['fecha']));
            Database::disconnect();  
              

        }

        /**CRUD PARA TRAER DATOS DE UN ESTUDIANTE EN ESPECIFICO */
        static public function get_id($id){
            //$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM estudiante where id = ?";
            $q = Database::connect()->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch();
            return $data;
            //$q -> close();
           // $q = null;
        }

        /**CRUD PARA PARA REALIZAR UNA ACTUALIZACION A LA TABLA ESTUDIANTE */
        static public function update($data,$date){
            //$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE estudiante  set  cedula=?, contrasena=?,nombre =?, apellidos=?, id_carrera = ? ,promedio=?, edad=?, fecha=? WHERE id = ? ";
            $q = Database::connect()->prepare($sql);
            $q->execute(array($data['cedula'],$data['contrasena'],$data['nombre'],$data['apellidos'],$data['id_carrera'],$data['promedio'],$data['edad'],$data['fecha'], $date));
            Database::disconnect();
            //$q -> close();
            //$q = null;

        }

        /**CRUD PARA BORRAR A UN ESTUDIANTE EN ESPECIFICO */
        static public function delete($date){
           // $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="DELETE FROM estudiante where id=?";
            $q=Database::connect()->prepare($sql);
            $q->execute(array($date));
            Database::disconnect();
            //$q -> close();
            //$q = null;
        }

        
    }
?>

