<?php 

    class MvcController{

        public function plantilla(){
            include "vistas/template.php";
        }

        public function enlacesPaginasController(){
            if(isset($_GET['action'])){
                $enlacesController = $_GET['action'];
            } else {
                $enlacesController = "index";
            }
            $respuesta = EnlacesPaginas::enlacesPaginasModel($enlacesController);
            include $respuesta;
        }

        public function ingresaUsuarioController(){
            if(isset($_POST["txtUser"]) && isset($_POST["txtPassword"])){
                $datosController = array("user"=>$_POST["txtUser"],"password"=>$_POST["txtPassword"]);
                $respuesta = Datos::ingresoUsuarioModel($datosController,"users");

                if($respuesta["usuario"] == $_POST["txtUser"] && password_verify($_POST["txtPassword"],
                $respuesta["contraseña"])){
                    session_start();
                    $_SESSION["validar"] = true;
                    $_SESSION["nombre_usuario"] = $respuesta["id"];
                    header("Location:index.php?action=tablero");

                }else{
                    header("Location:index.php?action=fallo&res=fallo");
                }
            }
        }

        public function vistaUserController(){
            $respuesta = Datos::vistaUserModel("usuarios");
                foreach ($respuesta as $row => $item){
                    echo'
                        <tr>
                            <td>
                                <a href="index.php?action=usuarios&idUserEditar='.$item["id"].'" class="btn
                                btn-warning btn-sm btn-icon" title="Editar" data-toggle="tooltip"><i class="fa
                                fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="index.php?action=usuarios&idBorrar?'.$item["id"].'" class="btn btn-danger
                                btn-sm btn-icon" title="Eliminar" data-toggle="tooltip"<i class="fa fa-trash"></
                                i></a>
                            </td>
                            <td>'.$item["nombre"].'</td>  
                            <td>'.$item["apellido"].'</td> 
                            <td>'.$item["nombre_usuario"].'</td>  
                            <td>'.$item["correo_usuario"].'</td> 
                            <td>'.$item["fecha"].'</td>
                        </tr>
                        ';
                }
            }
        

        public function registrarUserController(){
            ?>
            <div class="col-m6 mt-3">
                <div class="card card-primary">
                    <h4><b>Registro</b>de Usuarios</h4>
                    </div>
                    <div class="card-body">
                        <form action="post" action="index.php?action=usuarios">
                            <div class="form-group">
                                <label for="nusauriotxt">Nombre: </label>
                                <input class="form-control" type="text" name="nusuariotxt" id="nusuariotxt"
                                placeholder="Ingrese el nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="ausuariotxt">Apellido: </label>
                                <input class="form-control" type="text" name="ausuariotxt" id="ausuariotxt"
                                placeholder="Ingrese el nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="usuariotxt">Usuario: </label>
                                <input class="form-control" type="text" name="usuariotxt" id="usuariotxt"
                                placeholder="Ingrese el nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="ucontratxt">Contraseña: </label>
                                <input class="form-control" type="text" name="ucontratxt" id="ucontratxt"
                                placeholder="Ingrese el nombre" required>
                            </div>
                            <button class="btn btn-primary" type="submit">Agregar</button>
                        </form>
                        </div>
                        </div>
                        </div>
                        <?php
                            } 
        


         public function insertarUserController(){
             if(isset($_POST["nusuariotxt"])){

                $_POST["ucontratxt"] = password_hash($_POST["ucontratxt"],PASSWORD_DEFAULT);

                $datosController = array ("nusuario"=>$_POST["nusuariotxt"],"ausuario"=>$_POST["ausuario.txt"],
                "usuario"=>$_POST["usuariotxt"],"contra"=>$_POST["ucontratxt"],"email"=>$_POST["uemailtxt"]);

                $respuesta = Datos::insertarUserModel($datosController,"usuarios");
                
                if($respuesta == "success"){
                    echo '
                        <div class="col-md-6 mt-3
                            <div class="alert alert-success alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                <i class="icon fas fa-check"></i>
                                !Exito
                                </h5>
                                Usuario agergaado con éxito,
                            </div>
                        </div>                        
                    ';
                } else{
                    echo '
                    <div class="col-md-6 mt-3
                        <div class=" alert alert-danger alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                            <h5>
                            <i class="icon fas fa-ban"></i>
                            !Error
                            </h5>
                            Se ha producido un error al momento de agregar el usuario, trate de nuevo,
                        </div>
                    </div>                        
                ';
                }
             }
         }      
         
         

         public function editarUserController(){

            $datosController = $_GET["idUserEditar"];
            $respuesta = Datos::editarUserModel($datosController,"usuarios");

             ?>
             <div class="col-md-6 mt-3">
                <div class="card card-warning">
                    <div class="card-header">
                    
                        <h4><b>Editor</b> de Usuarios</h4>
                        </div>
                     <div class="card-body">
                        <form method="post" action="index.php?action=usuarios">

                        <div class="form-group">
                                
                            <input type="hidden" name="idUserEditar" class="form-control" value="<?php 
                            echo $respuesta["id"]; ?>" required>
                            </div>

                         <div class="form-group">
                            <label for="nusuariotxtEditar">Nombre: </label>
                            <input type="form-control" type="text" name="nusuariotxtEditar"
                            id="nusuariotxtEditar" placeholder="Ingrese el nuevo nombre" value="<?php echo
                            $respuesta["nusuario"]; ?>" required>
                         </div>
                        <div class="form-group">
                            <label for="ausuariotxtEditar">Apellido: </label>
                            <input type="form-control" type="text" name="ausuariotxtEditar"
                            id="ausuariotxtEditar" placeholder="Ingrese el nuevo usuario" value="<?php echo 
                            $respuesta["ausuario"]; ?>" required>
                        </div> 
                        <div class="form-group">
                            <label for="contratxtEditar">Contraseña: </label>
                            <input type="form-control" type="text" name="contratxtEditar"
                            id="contratxtEditar" placeholder="Ingrese la nueva cotraseña" required>
                        </div> 
                        <div class="form-group">
                            <label for="uemailtxtEditar">Correo Electrónico: </label>
                            <input type="form-control" type="text" name="uemailtxtEditar"
                            id="uemailtxtEditar" placeholder="Ingrese el nuevo correo electrónico"
                            value="<?php echo $respuesta["email"];?>" required>
                        </div> 
                        <button class="btn btn-primary" type="submit">Editar</button>
                       </form>
                       </div>   
                       </div>   
                       </div>   
         <?php
         }      


                        


         public function actualizarUserController(){
             if(isset($_POST["nusuariotxtEditar"])){
                 $_POST["contratxtEditar"] = password_hash($_POST["contratxtEditar"],PASSWORD_DEFAULT);

                 $datosController = array("id"=>$_POST["idUserEditar"],"nusuario"=>$_POST["nusuariotxtEditar"],
                 "ausario"=>$_POST["ausuariotxtEditar"],"usaurio"=>$_POST["usuariotxt"],"contra"=>$_POST["contratxtEditar"],
                 "email"=>$_POST["uemailtxtEditar"]);

                 $respuesta = Datos::actualizarUserModel($datosController,"usuarios");
                 if($respuesta == "success"){
                     echo'
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-success alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x
                                </button>
                                <h5>
                                    <i class="icon fas fa-check"></i>
                                    ¡Exito!
                                </h5>
                                Usuario editado con écito.
                               </div>
                             </div>
                     ';
                 }else{
                    echo'
                    <div class="col-md-6 mt-3">
                        <div class="alert alert-danger alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x
                            </button>
                            <h5>
                                <i class="icon fas fa-ban"></i>
                                ¡Error!
                            </h5>
                            Se ha producido un error al editar.
                           </div>
                         </div>
                 ';
                 }
             }
         }









    }


?>