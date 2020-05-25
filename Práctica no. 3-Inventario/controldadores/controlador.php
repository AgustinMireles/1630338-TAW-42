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

        /*INGRESO USUARIO*/ 
        public function ctringresoUsuarioControlador(){
            if(isset($_POST["usuarioIngreso"])){
                $datosControlador = array("usuario" => $_POST["usuarioIngreso"],
                                                        $_POST["password"] => $_POST["passwordIngreso"]);
                $respuesta = Datos::mdlingresoUsuarioModelo($datosControlador,"usuarios");

                //Validar la repuesta de modelo para ver si es un usuario correcto.

                if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){
                    session_start();
                    $_SESSION["validar"] = true;
                    header("location:index.php?action=usuarios");
                }
                else{
                    header("location:index.php?action=fallo");
                }
                                                    }
        }

        //VISTA DE USUARIOS
        public function ctrvistaUsuarioController(){
            $respuesta = Datos::mdlvistaUsuarioModelo("usuarios");
            //Utilizar un foreach para iterar un array e imprimir la consulta del modelo

            foreach($respuesta as $row => $item){
                echo'<tr>
                        <td>'.$item["usuario"].'</td>
                        <td>'.$item["password"].'</td>
                        <td>'.$item["email"].'</td>
                        <td><a href="index.php?action=usuarios&idEditar='.$item["id"].'"><button>Editar</button></a></td>
                        <td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
                    </tr>';
            }
        }

        //EDITAR USUARIO
        public function ctreditarUsuarioControlador(){
            $datosControlador = $_GET["id"];
            $respuesta=Datos::mdleditarUsuarioModelo($datosControlador,"usuarios");
            
            //Diseñar la estructura de un formulario que se muestren los datos de la consulta generada en el Modelo
            echo '<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">
                <iput type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>
                <iput type="text" value="'.$respuesta["password"].'" name="passwordEditar" required>
                <iput type="text" value="'.$respuesta["email"].'" name="emailEditar" required>
            ';
        }

        //ACTUALIZAR USUARIO
        public function ctractualizarUsuarioControlador(){
            if(isset($_POST["usuarioEditar"])){
                $datosControlador = array("id"=>$_POST["idEditar"],
                                        "usuario"=>$_POST["usuarioEditar"],
                                        "password"=>$_POST["usuarioPassword"],
                                        "email"=>$_POST["emailEditar"]);
                $respuesta = Datos::mdlactualizarUsuarioModelo($datosControlador,"usuarios");    
                
                if($respuesta == "success"){
                    header("location:index.php?action=cambio");
                }             
                else{
                    echo "error";
                }           
            }

        }

        //BORRAR USUARIO
        public function borrarUusarioControlador(){
            if(isset($_GET["idBorrar"])){
                $datosControlador = $_GET["idBorrar"];
                $respuesta = Datos::mdlborrarUsuarioModelo($datosControlador,"usuarios");
                
                if($respuesta == "success"){
                    header("location:index.php?action=usuarios");
                }
            }
        }

        //LISTA DE MODELOS POR DESARROLLAR:
        /*
        1. mdlregistroUsuarioModelo
        2. mdlingresoUsuarioModelo
        3. mdlvistaUsuarioModelo
        4. mdleditarUsuarioModelo
        5. mdlactualizarUsuarioModelo
        6. mdlborrarUsuarioModelo
        */ 




    }





?>