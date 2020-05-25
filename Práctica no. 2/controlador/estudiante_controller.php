<?php 
    /**REQUERIMOS DEL MODELO ESTUDIANTE PARA QUE PROCESE LOS DATOS, QUE SE ENVIARAN A LAS VISTAS CORRESPONDIENTES AL IGUAL QUE CARRERA*/
    require_once('modelo/estudiante_model.php');
    require_once('modelo/carrera_model.php');

    class estudiante_controller{

        /**creamos variables $model_e y $model_c para instanciar los modelos estudiantes y carrea*/
        private $model_e;
        private $model_c;

        /**instanciamos a los modelos estudiante y carrera */
        function __construct(){
            $this->model_e=new estudiante_model();
            $this->model_c=new carrera_model();
        }

        /**FUNCION ENCARGADA DE DESTRUIR LA VARIBABLE SESSION*/
        static public function salir(){
            include_once('vistas/salir.php');
        }

        /**CONTROLADOR PARA MOSTRAR INICIO SE INCLUYE LAS VISTAS CABECERA, INICIO(QUE ACTUA COMO CONTENIDO) Y PIE DE PAGINA*/
        static public function index(){
            $query = estudiante_model::get();

            include_once('vistas/header.php');
            include_once('vistas/index.php');
            include_once('vistas/footer.php');
        }
        /**CONTROLADOR ESTUDIANTE DONDE MOSTRARA LOS DATOS PARA EDITAR UN ESTUDIANTE*/
        static public function estudiante(){
            $data=NULL;
            if(isset($_REQUEST['id'])){
                /**HACEMOS USO DEL MODELO get_id, LA CUAL PERMITE TRAES LOS DATOS DEL ESTUDIANTE CON EL ID QUE SE ENVIA POR ESTE METODO*/
                $data=estudiante_model::get_id($_REQUEST['id']);    
            }
            /**$carrera mostramos las carreras disponibles*/
            $carrera =carrera_model::mdlget_carrera();
            /**realiza consulta a la tabla estudiantes */
            $query=estudiante_model::get();
            include_once('vistas/header.php');
            include_once('vistas/estudiante.php');
            include_once('vistas/footer.php');
        }


        /**CONTROLADOR get_datosE. PERMITE CREAR UN NUEVO USUARIO A PARTIR DE LOS DATOS DEL FORMULARIO, TAMBIEN REALIZAR LA FUNCION 
         *  UPDATE A LA BASE DE DATOS EN EL CASO DE QUE EL ID TENGA VALOR
        */
        static public function get_datosE(){

            /**CREAMOS UN ARREGLO QUE SE ENIARA AL LAS FUNCIONES CREATE Y UPDATE */
            $data['id']=$_REQUEST['txt_id'];
            $data['cedula']=$_REQUEST['txt_cedula'];
            $data['contrasena']=$_REQUEST['txt_contrasena'];
            $data['nombre']=$_REQUEST['txt_nombre'];
            $data['apellidos']=$_REQUEST['txt_apellidos'];
            $data['promedio']=$_REQUEST['txt_promedio'];
            $data['edad']=$_REQUEST['txt_edad'];
            $data['fecha']=$_REQUEST['txt_fecha'];
            $data['id_carrera']=$_REQUEST['txt_carrera'];

            if ($_REQUEST['id']=="") {
                estudiante_model::create($data);
            }
            
            if($_REQUEST['id']!=""){
                $date=$_REQUEST['id'];
                estudiante_model::update($data,$date);
            }

            /*LO REDIRECCIONAMOS AL INICIO */
            header("Location:index.php?m=index");

        }

        /**FUNCION PARA BORRAR ESTUDIANTE */
        static public function confirmarDelete(){

            $data=NULL;
            
            if ($_REQUEST['id']!=0) {
               $data=estudiante_model::get_id($_REQUEST['id']);
            }

            if ($_REQUEST['id']==0) {
                $date['id']=$_REQUEST['txt_id'];
                estudiante_model::delete($date['id']);
                header("Location:index.php?m=estudiantes");
            }

            include_once('vistas/header.php');
            include_once('vistas/confirm.php');
            include_once('vistas/footer.php');
            


        }


    }
?>