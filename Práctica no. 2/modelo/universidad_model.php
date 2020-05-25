<?php
    
    /**NOMBRAMOS A LA CLASE universidad_model */
    class universidad_model{
        private $DB;
        private $universidades;

        /**INSTANCIAMOS A LA BASE DE DATOS */
        function __construct(){
            $this->DB=Database::connect();
        }

        /**CRUD PARA VER LAS UNIVERSIDADES*/
        static public function get(){
            $sql= 'SELECT id, nombre_universidad FROM universidad';
            $fila=Database::connect()->prepare($sql);
            $fila->execute();
            return  $fila->fetchAll();
            $fila->close();
            $fila=null;
        }

        
        /**CRUD PARA TRAER DATOS DE UNA UNIVERSIDAD EN ESPECIFICO */
        static public function get_id($id){
            //$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM universidad where id = ?";
            $q = Database::connect()->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch();
            return $data;
        }

        /**CRUD PARA CREAR UNA NUEVA UNIVERSIDAD */
        static public function create($data){

           // $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="INSERT INTO universidad(nombre_universidad)VALUES (?)";
            $query = Database::connect()->prepare($sql);
            $query->execute(array($data['nombre_universidad']));
            Database::disconnect();       

        }

          /**CRUD PARA PARA REALIZAR UNA ACTUALIZACION A LA TABLA UNIVERSIDAD */
          static public function update($data,$date){
            //$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE universidad  set  nombre_universidad =? WHERE id = ? ";
            $q = Database::connect()->prepare($sql);
            $q->execute(array($data['nombre_universidad'], $date));
            Database::disconnect();

        }

        /**CRUD PARA BORRAR A UNA UNIVERSIDAD EN ESPECIFICO */
        static public function delete($date){
            //$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="DELETE FROM universidad where id=?";
            $q=Database::connect()->prepare($sql);
            $q->execute(array($date));
            Database::disconnect();
        
        }

        



        
    }
?>

