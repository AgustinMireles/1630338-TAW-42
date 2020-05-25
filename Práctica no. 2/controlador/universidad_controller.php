<?php 
    /**REQUERIMOS DEL MODELO UNIVERSIDAD PARA QUE PROCESE LOS DATOS, QUE SE ENVIARAN A LAS VISTAS CORRESPONDIENTES*/
    require_once('modelo/universidad_model.php');


    /**NOMBRAMOS A LA CLASE universidad_controller */
    class universidad_controller{

        /**VAARIABLE $model_u PARA INSTANCIAR AL MODELO universidad_model */
       private $model_u;

       /**INSTANCIAMOS AL MODELO universdad_model */
       function __construct(){
            $this->model_u=new universidad_model();
       }

        /**CONTROLADOR PARA MOSTRAR INICIO UNIVERSIDAD SE INCLUYE LAS VISTAS CABECERA, INICIO(QUE ACTUA COMO CONTENIDO) Y PIE DE PAGINA*/
        static public function universidad(){
            $query =universidad_model::get();

            include_once('vistas/header.php');
            include_once('vistas/universidades.php');
            include_once('vistas/footer.php');
        }
     
           /**CONTROLADOR PARA AGREGAR UNIVERSDIAD DONDE MUESTRA EL FORMUALRIO*/
           static public function agregar_universidad(){
            $data=NULL;
            if(isset($_REQUEST['id'])){
                /**HACEMOS USO DEL MODELO get_id, LA CUAL PERMITE TRAES LOS DATOS DEL LA CARRERA CON EL ID QUE SE ENVIA POR ESTE METODO*/
                $data=universidad_model::get_id($_REQUEST['id']);    
            }
            $query=universidad_model::get();
            include_once('vistas/header.php');
            include_once('vistas/agregar_universidad.php');
            include_once('vistas/footer.php');
        }

        /**FUNCION ENCARGADA DE CREAR Y ACTUALIZAR UNIVERSIDAD */
        static public function get_datosU(){

            /**DECLARACION DE ARREGLO $data DONDE CONTENDRA LOS DATOS DEL FORMULARIO AGREGAR UNIVERSDIAD O EDITAR */
            $data['id']=$_REQUEST['txt_id'];
            $data['nombre_universidad']=$_REQUEST['txt_nombre'];

            if ($_REQUEST['id']=="") {
                universidad_model::create($data);
            }
            
            if($_REQUEST['id']!=""){
                $date=$_REQUEST['id'];
                universidad_model::update($data,$date);
            }

            /*LO REDIRECCIONAMOS AL INICIO */
            header("Location:index.php?mu=universidad");

        }

            /**FUNCION PARA BORRAR UNIVERSIDAD */
            static public function confirmarDeleteU(){

                $data=NULL;
                
                if ($_REQUEST['idU']!=0) {
                   $data=universidad_model::get_id($_REQUEST['idU']);
                }
    
                if ($_REQUEST['idU']==0) {
                    $date['id']=$_REQUEST['txt_id'];
                    universidad_model::delete($date['id']);
                    header("Location:index.php?mu=universidad");
                }
    
                include_once('vistas/header.php');
                include_once('vistas/confirmu.php');
                include_once('vistas/footer.php');
                
    
    
            }




    }
?>