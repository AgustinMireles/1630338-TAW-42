<?php
    
    class carrera_model{
        private $DB;
        private $estudiantes;

        function __construct(){
            $this->DB=Database::connect();
        }

        /**CRUD PARA VER TODOS LOS ESTUDIANTES DE LA TABLA */
        function get(){
            $sql= 'SELECT * FROM estudiante ORDER BY id DESC';
            $fila=$this->DB->query($sql);
            $this->estudiantes=$fila;
            return  $this->estudiantes;
        }
        
    }
?>

