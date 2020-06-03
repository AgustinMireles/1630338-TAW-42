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
                $respuesta = Datos::ingresoUsuarioModel($datosController,"usuarios");
                $has= $respuesta["contrasena"];
                echo $has;
                if($respuesta["usuario"] == $_POST["txtUser"] && password_verify($_POST["txtPassword"],$has))
                {
                    session_start();
                    $_SESSION["validar"] = true;
                    $_SESSION["nombre_usuario"] = $respuesta["nombre_usuario"];
                    $_SESSION["id"] = $respuesta["id"];
                    header("Location:index.php?action=tablero");

                }else{
                    header("Location:index.php?action=fallo&res=fallo");
                    
                }
            }
        }

        public function vistaUserController(){
            $respuesta = Datos::vistaUsersModel("usuarios");
                foreach ($respuesta as $row => $item){
                    echo'
                        <tr>
                            <td>
                                <a href="index.php?action=usuarios&idUserEditar='.$item["id"].'" class="btn
                                btn-warning btn-sm btn-icon" title="Editar" data-toggle="tooltip"><i class="fa
                                fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="index.php?action=usuarios&idBorrar='.$item["id"].'" class="btn btn-danger
                                btn-sm btn-icon" title="Eliminar" data-toggle="tooltip"<i class="fa fa-trash"></
                                i></a>
                            </td>
                            <td>'.$item["firstname"].'</td>  
                            <td>'.$item["lastname"].'</td> 
                            <td>'.$item["user_name"].'</td>  
                            <td>'.$item["user_email"].'</td> 
                            <td>'.$item["date_added"].'</td>
                        </tr>
                        ';
                }
            }
        

        public function registrarUserController(){
            ?>
            <div class="col-md-6 mt-3">
                <div class="card card-primary">
                    <div class="card-header">
                    <h4><b>Registro</b>de Usuarios</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="index.php?action=usuarios">
                            <div class="form-group">
                                <label for="nusuariotxt">Nombre: </label>
                                <input class="form-control" type="text" name="nusuariotxt" id="nusuariotxt"
                                placeholder="Ingrese el nombre" required>
                            </div>

                            <div class="form-group">
                                <label for="ausuariotxt">Apellido: </label>
                                <input class="form-control" type="text" name="ausuariotxt" id="ausuariotxt"
                                placeholder="Ingrese Apellidos" required>
                            </div>

                            <div class="form-group">
                                <label for="usuariotxt">Usuario: </label>
                                <input class="form-control" type="text" name="usuariotxt" id="usuariotxt"
                                placeholder="Ingrese el Usuario" required>
                            </div>

                            <div class="form-group">
                                <label for="ucontratxt">Contraseña: </label>
                                <input class="form-control" type="password" name="ucontratxt" id="ucontratxt"
                                placeholder="Ingrese Contraseña" required>
                            </div>

                            <div class="form-group">
                                <label for="uemailtxt">Correo: </label>
                                <input class="form-control" type="text" name="uemailtxt" id="uemailtxt"
                                placeholder="Ingrese Correo" required>
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

                $datosController = array ("nusuario"=>$_POST["nusuariotxt"],"ausuario"=>$_POST["ausuariotxt"],
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
                            <input class="form-control" type="text" name="nusuariotxtEditar"
                            id="nusuariotxtEditar" placeholder="Ingrese el nuevo nombre" value="<?php echo
                            $respuesta["nusuario"]; ?>" required>
                         </div>
                        <div class="form-group">
                            <label for="ausuariotxtEditar">Apellido: </label>
                            <input class="form-control" type="text" name="ausuariotxtEditar"
                            id="ausuariotxtEditar" placeholder="Ingrese el nuevo usuario" value="<?php echo 
                            $respuesta["ausuario"]; ?>" required>
                        </div> 
                        <div class="form-group">
                            <label for="usuariotxt">Usuario: </label>
                            <input class="form-control" type="text" name="usuariotxt"
                            id="usuariotxt" placeholder="Ingrese el nuevo usuario" value="<?php echo 
                            $respuesta["usuario"]; ?>" required>
                        </div> 
                        
                        <div class="form-group">
                            <label for="contratxtEditar">Contraseña: </label>
                            <input class="form-control" type="password" name="contratxtEditar"
                            id="contratxtEditar" placeholder="Ingrese la nueva cotraseña" value="<?php echo $respuesta["contra"];?>" required>
                        </div> 
                        <div class="form-group">
                            <label for="uemailtxtEditar">Correo Electrónico: </label>
                            <input class="form-control" type="email" name="uemailtxtEditar"
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
                 "ausuario"=>$_POST["ausuariotxtEditar"],"usuario"=>$_POST["usuariotxt"],"contra"=>$_POST["contratxtEditar"],
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
                                Usuario editado con éxito.
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



         public function eliminarUserController(){
             if(isset($_GET["idBorrar"])){
                 $datosController = $_GET["idBorrar"];
                 $respuesta = Datos::eliminarUserModel($datosController,"usuarios");
                
                 if ($respuesta == "success"){
                     echo'
                     <div class="col-md-6 mt-3">
                     <div class="alert alert-success alert-dismissible">
                         <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x
                         </button>
                         <h5>
                             <i class="icon fas fa-check"></i>
                             ¡Exito!
                         </h5>
                         Usuario eliminado con éxito.
                        </div>
                      </div>

                     ';
                 } else {
                    echo'
                    <div class="col-md-6 mt-3">
                        <div class="alert alert-danger alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x
                            </button>
                            <h5>
                                <i class="icon fas fa-ban"></i>
                                ¡Error!
                            </h5>
                            Se ha producido un error al eliminar.
                           </div>
                         </div>
                 ';

                 }
                }
         }

         public function contarFilas(){
             $respuesta_users = Datos::contarFilasModel("usuarios");
             echo '
                             <div class="col-lg-3 col-6">
                                 <div class="small-box bg-info">
                                     <div class="inner">
                                         <h3>'.$respuesta_users["filas"].'</h3>
                                         <p>Total de Usuarios</p>
                                     </div>
                                     <div class="icon">
                                         <i class="far fa-address-card"></i>
                                     </div>
                                     <a class="small-box-footer" href="index.php?action=usuarios">Más <i class="fas fa-arrow-circle-right"></i></a>
                                 </div>
              ';
                     }

         
        public function vistaProductsController(){
            $respuesta = Datos::vistasProductsModel("productos");
            foreach ($respuesta as $row => $item){
                echo'
                    <tr>
                        <td>
                            <a href="index.php?action=inventario&idProductEditar='.$item["id"].'"
                            class = "btn btn-warning btn-sm btn-icon" title="Editar"
                            data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                        </td>
                        
                        <td>
                            <a href="index.php?action=inventario&idBorrar='.$item["id"].'"
                            class = "btn btn-danger btn-sm btn-icon" title="Eliminar"
                            data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                        </td>  
                
                        <td>'.$item["id"].'</td>
                        <td>'.$item["codigo"].'</td>
                        <td>'.$item["producto"].'</td>
                        <td>'.$item["fecha"].'</td>
                        <td>'.$item["precio"].'</td>
                        <td>'.$item["stock"].'</td>
                        <td>'.$item["categoria"].'</td>
                        <td><a href="index.php?action=inventario$idProductAdd='.$item["id"].'"
                        class="btn btn-warning btn-sm btn-icon" title="Agregar Stock"
                        data-toggle="tooltip"><i class="fa fa-edit"></i></a></td>
                        <td><a href="index.php?action=inventario$idProductDel='.$item["id"].'"
                        class="btn btn-warning btn-sm btn-icon" title="Quitar Stock"
                        data-toggle="tooltip"><i class="fa fa-edit"></i></a></td>

                ';
            }
        }


        public function registrarProductController(){
            ?>
            <div class="col-md-6 mt-3">
                <div class="card card-primary">
                        <div class="card-header">
                            <h4><b>Registro</b> de Produtos</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="index.php?action=inventario">
                                <div class="form-group">
                                    <label for="codigotxt">Código:</label>
                                    <input class="form-control" name="codigotxt" id="codigotxt" type="text" required placeholder="Código del producto">
                                </div>

                                <div class="form-group">
                                    <label for="nombretxt">Nombre:</label>
                                    <input class="form-control" name="nombretxt" id="nombretxt" type="text" required placeholder="Nombre del producto">
                                </div>

                                <div class="form-group">
                                    <label for="preciotxt">Precio:</label>
                                    <input class="form-control" name="preciotxt" id="preciotxt" type="number" min="1" required placeholder="Precio del producto">
                                </div>

                                <div class="form-group">
                                    <label for="ucontratxt">Stock:</label>
                                    <input class="form-control" name="stocktxt" id="stocktxt" type="number" min="1" required placeholder="Cantidad de stock del producto">
                                </div>

                                <div class="form-group">
                                    <label for="referenciatxt">Motivo:</label>
                                    <input class="form-control" name="referenciatxt" id="referenciatxt" type="text" required placeholder="Referencia del producto">
                                </div>

                                <div class="form-group">
                                    <label for="uemailtxt">Categoría:</label>
                                    <select class="form-control" id="categoria">
                                            <?php
                                                $respuesta_categoria = Datos::obtenerCategoryModel("categories");
                                                foreach ($respuesta_categoria as $row => $item){
                                            ?>
                                                <option value="<?php echo $item["id"]; ?>"><?php echo $item["categoria"]; ?> </option>
                                            <?php
                                              }
                                            ?> 
                                    </select>             
                                </div>
                                <button class="btn btn-primary" type="submit">Agregar</button>                                
                            </form>
                        </div>
                </div>
            </div>
            <?php //se abre el php
        }

        public function insertarProductController(){
            if(isset($_POST["codigotxt"])){
                $datosController = array("codigo"=>$_POST["codigotxt"],"precio"=>$_POST["preciotxt"],"stock"=>$_POST["stocktxt"],
                "categoria"=>$_POST["categoria"],"nombre"=>$_POST["nombretxt"]); $respuesta = Datos::insertarProductsController($datosController,"productos");
                if($respuesta == "success"){
                    $respuesta3 = Datos::ultimoProductsModel("products");
                    $datosController2 = array("user"=>$_SESSION["id"],"cantidad"=>$_POST["stocktxt"],"producto"=>$respuesta3["id"],
                    "note"=>$_SESSION["nombre_usuario"]."agrego/compro","reference"=>$_POST["referenciatxt"]);
                    $respuesta2 = Datos::insertarHitorialModel($datosController2,"historial");
                    echo'
                      <div class="col-md-6 mt-3">
                        <div class="alert alert-success alert-dismissible">
                            <button class="close" type="button" data-dismiss="alert"  artia-hidden="true"></button>
                            <h5>
                                <i class="icon fas fa-check"></i>
                                ¡Éxito!
                            </h5>
                            Producto agregado con éxito.
                        </div>
                       </div>
                       ';
                }else{
                echo '
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger alert-dismissible">
                                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                                <h5>
                                    <i class="icon fas fa-ban"></i>
                                    ¡Error!
                                </h5>
                                Se ha producido un error al momento de agregar el producto, trate de nuevo.
                            </div>
                        </div>
                    ';
                
                }
            }
        }
        /**ME FALTO AGREGAR */
        public function editarProductController()
        {
            $datosController = $_GET["idProductEditar"];
            $respuesta = Datos::editarProductsModel($datosController, "productos");
            ?>

            <div class="col-md-6 mt-3">
                <div class="card card-warning">
                    <div class="card-header">
                    <h4><b>Editor</b> de Productos</h4>
                    </div>
                <div class="card-body">
                    <form method="post" action="index.php?action=inventario">
                        <div class="form-group">
                            <input type="hidden" name="idProductEditar" class="form-control" value="<?php echo
                            $respuesta["id"]; ?>" required>
                        </div>

                        <div class="form-group">
                        <label for="codigotxtEditar">Código:</label>
                            <input type="hidden" name="codigotxtEditar" id="" class="form-control" value="<?php echo
                            $respuesta["codigo"]; ?>" required>
                        </div>

                        <div class="form-group">
                        <label for="codigotxtEditar">Código:</label>
                            <input type="hidden" name="codigotxtEditar" id="" class="form-control" value="<?php echo
                            $respuesta["codigo"]; ?>" required>
                        </div>

                        <div class="form-group">
                        <label for="codigotxtEditar">Código:</label>
                            <input type="hidden" name="codigotxtEditar" id="" class="form-control" value="<?php echo
                            $respuesta["codigo"]; ?>" required>
                        </div>

                        <div class="form-group">
                        <label for="referenciatxtEditar">Motivo:</label>
                            <input type="text" name="referenciatxtEditar" id="" class="form-control"  required placeholder="Referencia del producto">
                        </div>

                        <div class="form-group">
                        <label for="categoriaeditar">Categoria:</label>
                            <?php
                                $respuesta_categoria = Datos::obtenerCategoryModel("categorias");
                                foreach($respuesta_categoria as $row => $item){
                            ?>
                            <option value="<?php echo $item["id"]; ?>"><? echo $item["categoria"]; php?></option>
                        </div>
                        <button class="btn btn-primary" type="submit" >Realizar Cambio</button>
                    </form>

                </div>

                </div>
            </div>

           <?php                         
        }


        public function actualizarProductController(){
            if(isset($_POST["codigotxteditar"])){
                $datosController = array("id"=>$_POST["idProductEditar"],"codigo"=>$_POST["codigotxteditar"],
                "precio"=>$_POST["preciotxteditar"],"stock"=>$_POST["stocktxteditar"],"categoria"=>$_POST["categoriaeditar"],
                "nombre"=>$_POST["nombretxteditar"]);
                $respuesta Datos::actualizarProductsModel($datosController,"historial");
                echo'
                    <div class="col-md-6 mt-3">
                    <div class="alert alert-success alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert"  artia-hidden="true"></button>
                        <h5>
                            <i class="icon fas fa-check"></i>
                            ¡ éxito!
                        </h5>
                        Producto actualizado con éxito.
                    </div>
                </div>
               ';
            }else{
                echo '
                    <div class="col-md-6 mt-3">
                    <div class="alert alert-danger alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert"  artia-hidden="true"></button>
                        <h5>
                            <i class="icon fas fa-ban"></i>
                            ¡Error!
                        </h5>
                        Pro.
                    </div>
                </div>
                ';
            }
        }
    
        /**me falto agregar los demas form-control */
       public function addProductController(){
           $datosController = $_GET["idProductAdd"];
           $respuesta = Datos::editarProductsModel($datosController,"productos");
           ?> 

            <div class="col-md-6 mt-3">
                <div class="card card-warning">
                    <h4><b>Agregar</b>Stock al producto</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="index.php?action=inventario">
                        <div class="form-group">
                            <input type="hidden" name="idProductAdd" class="form-control" value="<?php echo $respuesta["id"]; ?>" required>

                        </div>

                        <div class="form-gorup">
                            <label for=""></label>
                        </div>
                    </form>
                </div>
            </div>
       
        } 
            
         
         
    
}
?>