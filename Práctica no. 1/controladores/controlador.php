<?php
    class MvcControlador{

        #llamada a la plantilla
        static public function ctrpagina(){
            
            /**COMPROBAMOS SI EXISTE SESSION PARA INCLUIR EL TEMPLATE, DE OTRA FORMA SOLO MOSTRARA LA VISTA INICIAR SESION O REGISTRO*/
            @session_start();

		    if(isset($_SESSION['validar'])){
                include "vistas/template.php";
    
                    }elseif(isset($_GET['action']) && $_GET['action'] == "registro"){
                        include "vistas/modulos/registro.php";  
             }else
                 include "vistas/modulos/ingresar.php";  
        }
    

        //Enlaces
        static public function ctrenlacesPaginasControlador(){
            if(isset($_GET['action'])){
                $enlaces = $_GET['action'];
            }
            else{
                $enlaces = 'index';
            }

            //Es el momento enque el controlador invoca al modelo enlacesPaginaModelo para que muestre el listado de paginas
            $respuesta = Paginas::mdlenlacesPaginasModel($enlaces);
            include $respuesta;
        }

        //Registro de Usuarios usuarioRegistro passwordRegistro emailRegistro
        static public function ctrregistroUsuarioControlador(){
            if(isset($_POST["usuarioRegistro"])){

                //RECIBE A TRAVES DEL METODO POST EL NAME (HTML) DE USUARIO, PASSWORD Y EMAIL, SE ALMACENAN LOS DATOS EN UNA VARIABLE O PROPIEDAD DE TIPO ARRAY ASOCIATIVO CON SUS RESPECTIVAS PROPIEDAD(usuario, password, email).
                $datosControlador = array("usuario"=>$_POST["usuarioRegistro"],
                                          "password"=>$_POST["passwordRegistro"],
                                          "email"=>$_POST["emailRegistro"]);
                 
                //Se le dice al modelo modelos/crud.php (Datos::mdlregistroUsuarioModelo), que en modelo Datos el metodo mdlregistroUsuarioModelo en sus parametros los valores $datosControlador y el nombre de la tabla a la cual debe conectarse(usuarios)
                $respuesta = Datos::mdlregistroUsuarioModelo($datosControlador,"usuarios");

                //se imprime la respuesta en la vista
                if($respuesta == "success"){
                    echo '<script>

								window.location = "index.php?action=ok";

							</script>';
                }
                else{
                    echo '<script>

								window.location = "index.php";

							</script>';
                }
           
            }
        }

        /*INGRESO USUARIO*/ 
        
        static public function ctringresoUsuarioControlador(){
            if(isset($_POST["usuarioIngreso"])){
                $datosControlador = array("usuario" => $_POST["usuarioIngreso"],
                                         "password" => $_POST["passwordIngreso"]);
                $respuesta = Datos::mdlingresoUsuarioModelo($datosControlador,"usuarios");

                //Validar la repuesta de modelo para ver si es un usuario correcto.

                if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){
                    session_start();
                    $_SESSION["validar"] = true;
                    $_SESSION["nombre"] = $respuesta["usuario"];
                    echo '<script>

								window.location = "index.php?action=usuarios";

							</script>';
                }
                else{
                    echo '<script>

								window.location = "index.php?action=fallo";

							</script>';
                }
                                                    }
        }

        //VISTA DE USUARIOS
        
        static public function ctrvistaUsuarioControlador(){
            $respuesta = Datos::mdlvistaUsuarioModelo("usuarios");
            //Utilizar un foreach para iterar un array e imprimir la consulta del modelo

            foreach($respuesta as $row => $item){
                echo'<tr>
                        <td>'.$item["usuario"].'</td>
                        <td>'.$item["password"].'</td>
                        <td>'.$item["email"].'</td>
                
                        <td><a href="index.php?action=editar&idEditar='.$item["id"].'" class="btn btn-warning btn-circle"><i class="fas fa-exclamation-triangle"></i></a></td>
                        <td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a></td>
                    </tr>';
            }
        }

        //EDITAR USUARIO
        static public function ctreditarUsuarioControlador(){
            $datosControlador = $_GET["idEditar"];
            $respuesta = Datos::mdleditarUsuarioModelo($datosControlador,"usuarios");
            
            //Diseñar la estructura de un formulario que se muestren los datos de la consulta generada en el Modelo
            echo '
    
                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="hidden" class="form-control form-control-user" value="'.$respuesta["id"].'" name="idEditar">
                </div>
                </div>

                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>
                </div>
                </div>

                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user" value="'.$respuesta["password"].'" name="passwordEditar" required>
                </div>
                </div>

                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="email" class="form-control form-control-user" value="'.$respuesta["email"].'" name="emailEditar" required>
                </div>
                </div>

                <div class="d-flex float-right">
                <button type="submit" class="btn btn-success btn-circle"><i class="fas fa-check"></i></button>
                </div>
            ';
        }

        //ACTUALIZAR USUARIO
        static public function ctractualizarUsuarioControlador(){
            if(isset($_POST["usuarioEditar"])){
                $datosControlador = array("id"=>$_POST["idEditar"],
                                        "usuario"=>$_POST["usuarioEditar"],
                                        "password"=>$_POST["passwordEditar"],
                                        "email"=>$_POST["emailEditar"]);
                $respuesta = Datos::mdlactualizarUsuarioModelo($datosControlador,"usuarios");    
                
                if($respuesta == "success"){
                    echo '<script>

								window.location = "index.php?action=usuarios";

							</script>';
                }             
                else{
                    echo "error";
                }           
            }

        }

        //BORRAR USUARIO
        static public function ctrborrarUsuarioControlador(){
            if(isset($_GET["idBorrar"])){
                $datosControlador = $_GET["idBorrar"];
                $respuesta = Datos::mdlborrarUsuarioModelo($datosControlador,"usuarios");
                
                if($respuesta == "success"){
                    echo '<script>

								window.location = "index.php?action=usuarios";

							</script>';
                }
            }
        }

        //LISTA DE MODELOS POR DESARROLLAR:
        /*
        1. mdlregistroUsuarioModelo-ok
        2. mdlingresoUsuarioModelo-ok
        3. mdlvistaUsuarioModelo-ok
        4. mdleditarUsuarioModelo-ok
        5. mdlactualizarUsuarioModelo-ok
        6. mdlborrarUsuarioModelo-ok
        */ 




    }





?>