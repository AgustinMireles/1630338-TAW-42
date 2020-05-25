<?php
    /**nombramos a la clase login_model */
    class login_model{
        private $DB;
        private $data;
        /**instanciamos al la clase conexion*/
        function __construct(){
            $this->DB=Database::connect();
        }

        /**validar: realiza una consulta a la tabla estudiantes donde cedula y contrasena sean iguales a los parametros que le mandamos*/
        static public function validar($cedula,$contrasena){
            $sql= 'SELECT * FROM estudiante WHERE cedula = ? && contrasena = ?';
            $q = Database::connect()->prepare($sql);
            $q->execute(array($cedula,$contrasena));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            return $data;/**regresa la $respuesta */
        }

    }
?>