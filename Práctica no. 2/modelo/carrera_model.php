<?php
    
    /**NOMBRAMOS A LA CLASE carrera_model */
    class carrera_model{
        private $DB;
        private $carreras;

        /**INSTANCIAMOS  A LA CONEXION DE LA BASE DE DATOS */
        function __construct(){
            $this->DB=Database::connect();
        }

        /**CRUD PARA VER TODOS LOS CARRERAS DISPONIBLES QUE SE UTILIZAR EN EL CONTROLLADOR ESTUDIANTES*/
        static public function mdlget_carrera(){
            $sql= 'SELECT * FROM carrera ORDER BY id DESC';
            $fila=Database::connect()->prepare($sql);
            $fila->execute();
            $data = $fila->fetchAll();
            return $data;
            //$this->carreras=$fila;
            $fila -> close();
            $fila = null;
        }

        /**CRUD PARA VER CARRERAS CON SU UNIVERSIDAD */
        static public function get(){
            $sql= 'SELECT c.id, c.nombre_carrera,u.nombre_universidad FROM carrera as c INNER JOIN universidad as u WHERE c.id_universidad = u.id';
            $fila=Database::connect()->prepare($sql);
            $fila->execute();
            $carreras = $fila->fetchAll();
            return  $carreras;
            $fila -> close();
            $fila = null;
        }

        
        /**CRUD PARA TRAER DATOS DE UNA CARRERA EN ESPECIFICO */
        static public function get_id($id){
           // $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM carrera where id = ?";
            $q = Database::connect()->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch();
            return $data;
        }

        /**CRUD PARA CREAR UNA UEVA CARRERA */
       static public function create($data){

            //$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="INSERT INTO carrera(nombre_carrera,id_universidad)VALUES (?,?)";
            $query = Database::connect()->prepare($sql);
            $query->execute(array($data['nombre_carrera'],$data['id_universidad'],));
            Database::disconnect();       

        }

          /**CRUD PARA PARA REALIZAR UNA ACTUALIZAR UNA CARRERA */
          static public function update($data,$date){
           // $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE carrera  set  nombre_carrera = ?, id_universidad = ? WHERE id = ? ";
            $q = Database::connect()->prepare($sql);
            $q->execute(array($data['nombre_carrera'],$data['id_universidad'], $date));
            Database::disconnect();

        }

        /**CRUD PARA BORRAR A UNA UNIVERSIDAD EN ESPECIFICO */
        static public function delete($date){
           // $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="DELETE FROM carrera where id=?";
            $q=Database::connect()->prepare($sql);
            $q->execute(array($date));
            Database::disconnect();
        }

        



        
    }
        
    
?>

