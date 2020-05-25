<?php 
    /**REQUERIMOS DEL MODELO CARRERA Y UNIVERSIDAD*/
    require_once('modelo/carrera_model.php');
    require_once('modelo/universidad_model.php');

    class carrera_controller{

        /**DECLARAMOS $model_c, $model_u PARA INSANCIAR AL MODELO carrera_model y universidad_model */
       private $model_c;
       private $model_u;


       /**INSTANCIAMOS A LOS MODELOS */
       function __construct(){
            $this->model_c=new carrera_model();
            $this->model_u=new universidad_model();
       }

        /**CONTROLADOR PARA MOSTRAR INICIO CARRERAS SE INCLUYE LAS VISTAS CABECERA, INICIO(QUE ACTUA COMO CONTENIDO) Y PIE DE PAGINA*/
        static public function carrera(){
            $query =carrera_model::get();

            include_once('vistas/header.php');
            include_once('vistas/ver_carreras.php');
            include_once('vistas/footer.php');
        }
        
           /**CONTROLADOR agregar_carrera DONDE MOSTRARA EL FORMULARIO PARA AGREGAR O EDITAR CARRERA*/
           static public function agregar_carrera(){
            $data=NULL;
            if(isset($_REQUEST['id'])){
                /**HACEMOS USO DEL MODELO get_id, LA CUAL PERMITE TRAES LOS DATOS DE LA CARRERA CON EL ID QUE SE ENVIA POR ESTE METODO*/
                $data=carrera_model::get_id($_REQUEST['id']);    
            }
            /**TRAEMOS LAS UNIVERSIDADES DISPONIBLES*/
            $universidad =universidad_model::get();
            $query=carrera_model::get();
            include_once('vistas/header.php');
            include_once('vistas/carreras.php');
            include_once('vistas/footer.php');
        }

        /**CONTROLADOR ENCARGADO DE CREAR Y ACUALIZAR LA CARRERA */
        static public function get_datosC(){
            /**CREACION DEL ARREGLO $data QUE GUARDA LOS DATOS DEL FORMULARIO PARA  CREAR O EDITAR UNA CARRERA PARA
             * DESPUES SER ENVIADOS COMO PARAMETROS AL LAS FUNCIONES create y update
             */
            $data['id']=$_REQUEST['txt_id'];
            $data['nombre_carrera']=$_REQUEST['txt_nombre'];
            $data['id_universidad']=$_REQUEST['txt_universidad'];

            if ($_REQUEST['id']=="") {
                carrera_model::create($data);
            }
            
            if($_REQUEST['id']!=""){
                $date=$_REQUEST['id'];
                carrera_model::update($data,$date);
            }

            /*LO REDIRECCIONAMOS AL INICIO CARRERA */
            header("Location:index.php?mc=carrera");

        }

            /**FUNCION PARA BORRAR CARRERA */
            static public function confirmarDeleteC(){

                $data=NULL;
                
                if ($_REQUEST['idC']!=0) {
                    $data=carrera_model::get_id($_REQUEST['idC']);
                
                }
    
                if ($_REQUEST['idC']==0) {
                    $date['id']=$_REQUEST['txt_id'];
                    carrera_model::delete($date['id']);
                    header("Location:index.php?mc=carrera");
                }
    
                include_once('vistas/header.php');
                include_once('vistas/confirmc.php');
                include_once('vistas/footer.php');
                
    
    
            }




    }
?>