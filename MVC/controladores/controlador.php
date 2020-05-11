<?php
    class MvcControlador{

        #llamada a la plantilla
        public function ctrpagina(){
            include"views/template.php";
        }

        //Enlaces
        public function ctrEnlacesPaginasControlador(){
            if(isset($_GET['action'])){
                $enlaces = $_GET['action'];
            }
            else{
                $enlaces = 'index';
            }

            //Es el momento enque el controlador invoca al modelo enlacesPaginaModelo para que muestre el listado de paginas
            $respuesta = Paginas::mdlEnlacesPaginasModel($enlaces);
            include $respuesta;
        }

        //Registro de Usuarios
        public function ctrregistroUsuarioControlador(){
            if(isset($_POST["usuarioRegistro"])){

                //RECIBE A TRAVES DEL METODO POST EL NAME (HTML) DE USUARIO, PASSWORD Y EMAIL, SE ALMACENAN LOS DATOS EN UNA VARIABLE O PROPIEDAD DE TIPO ARRAY ASOCIATIVO CON SUS RESPECTIVAS PROPIEDAD(usuario, password, email).
                $datosControlador = array("usuario"=>$_POST["usuarioRegistro"],
                                          "password"=>$_POST["passwordRegistro"],
                                          "email"=>$_POST["emailRegistro"]);
                 
                //Se le dice al modelo modelos/crud.php (Datos::mdlregistroUsuarioModelo), que en modelo Datos el metodo mdlregistroUsuarioModelo en sus parametros los valores $datosControlador y el nombre de la tabla a la cual debe conectarse(usuarios)
                $respuesta = Datos::mdlregistroUsuarioModelo($datosControlador,"usuarios");

                //se imprime la respuesta en la vista
                if($respuesta == "success"){
                    header("location:index.php?action=ok");
                }
                else{
                    header("location:index.php");
                }
           
            }
        }




    }





?>