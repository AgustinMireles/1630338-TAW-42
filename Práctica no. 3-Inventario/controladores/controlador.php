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
                                                $respuesta_categoria = Datos::obtenerCategoryModel("categorias");
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
                "categoria"=>$_POST["categoria"],"nombre"=>$_POST["nombretxt"]); $respuesta = Datos::insertarProductsModel($datosController,"productos");
                if($respuesta == "success"){
                    $respuesta3 = Datos::ultimoProductsModel("productos");
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
       
        /*Esta funcion permite editar los datos de la tabla productos del producto seleccionado del boton editar abre un formulario 
  llenando la informacion correspondiente y empezando a editar dichos campos a partir de los formularios el array 
  de dato solo guarda el get del boton editar que en este caso es el id del producto y se envia el modelo de edicion
  y se pasa por el metodo form al igual que los demas datos */
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
                            <input type="hidden" name="idProductEditar" class="form-control" value="<?php
                                                                                                    echo $respuesta["id"]; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="codigotxtEditar">Codigo: </label>
                            <input class="form-control" name="codigotxtEditar" id="codigotxtEditar" type="text" value="<?php echo $respuesta["codigo"]; ?>" required placeholder="Codigo de Producto">
                        </div>
                        <div class="form-group">
                            <label for="nombretxteditar">Nombre: </label>
                            <input class="form-control" name="nombretxteditar" id="nombretxteditar" type="text" value="<?php echo $respuesta["nombre"]; ?>" required placeholder="Nombre de Producto">
                        </div>
                        <div class="form-group">
                            <label for="preciotxteditar">Precio: </label>
                            <input class="form-control" name="preciotxteditar" id="preciotxteditar" type="number" min="1" value="<?php echo $respuesta["precio"]; ?>" required placeholder="Precio de Producto">
                        </div>
                        <div class="form-group">
                            <label for="stocktxtEditar">Stock: </label>
                            <input class="form-control" name="stocktxtEditar" id="stocktxtEditar" type="number" min="1" value="<?php echo $respuesta["stock"]; ?>" required placeholder="Cantidad de Stock del Producto">
                        </div>
                        <div class="form-group">
                            <label for="referenciatxteditar">Motivo: </label>
                            <input class="form-control" name="referenciatxteditar" id="referenciatxteditar" type="text" required placeholder="Referencia del Producto">
                        </div>
                        <div class="form-group">
                            <label for="categoriatxteditar">Categoria: </label>
                            <select name="categoriaeditar" id="categoriaeditar" class="form-control">
                                <?php
                                $respuesta_categoria = Datos::obtenerCategoryModel("categorias");
                                foreach ($respuesta_categoria as $row => $item) {
                                ?>
                                    <option value="<?php echo $item["id"]; ?>">?php echo $item["categoria"];?></ option>
                                    <?php
                                }
                                    ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }

/*Esta funcion permite actualizar los datos de la tabla productos a partir del metodo form anterior mandado 
atravez del modelo del crud a traves del arreglo y con la variable respuesta mandamos dichos datos porque se
llama al modelo actualizarproductmodel si en el model se realizo correctamente entonces mandara un alerta
de correcto y pasara a llenar dichos datos en el modelo de insertar historial model en caso contrario no se hara nada
y mostrara mensaje de error */
public function actualizarProductController()
{
    if (isset($_POST["codigotxteditar"])) {
        $datosController = array(
            "id" => $_POST["idProductEditar"], "codigo" => $_POST["codigotxteditar"],
            "precio" => $_POST["preciotxteditar"], "stock" => $_POST["stocktxteditar"], "categoria" => $_POST["categoriaeditar"], "nombre" => $_POST["nombretxteditar"]
        );
        $respuesta = Datos::actualizarPorductsModel($datosController, "productos");
        if ($respuesta == "success") {
            $datosController2 = array(
                "user" => $_SESSION["id"], "cantidad" => $_POST["stocktxteditar"],
                "producto" => $_POST["idProductEditar"], "note" => $_SESSION["nombre de usuario"] . "agrego/compro",
                "refrence" => $_POST["referenciatxteditar"]
            );
            $respuesta2 = Datos::insertarHistorialModel($datosController2, "historial");
            echo '
                 <div class="col-md-6 mt-3">
                 <div class="alert alert-success alert-dismissible">
                     <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x
                     </button>
                     <h5>
                         <i class="icon fas fa-check"></i>
                         ¡Exito!
                     </h5>
                     Producto actualizado con éxito.
                    </div>
                  </div>

                 ';
        } else {
            echo '
                <div class="col-md-6 mt-3">
                    <div class="alert alert-danger alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x
                        </button>
                        <h5>
                            <i class="icon fas fa-ban"></i>
                            ¡Error!
                        </h5>
                        Se ha producido un error al actualizar, intentelo de nuevo.
                       </div>
                     </div>
             ';
        }
    }
}
    
  
/*Esta funcion permite eliminar datos apartir del id seleccionado en la tabla atravez del boton mandando el id
al modelo y la tabla una vez se borra  mostrara un mensaje de error o de correcto dependiendo del caso */
public function eliminarProductController()
{
    if (isset($_GET["idBorrar"])) {
        $datosController = $_GET["idBorrar"];
        $respuesta = Datos::eliminarProductsModel($datosController, "productos");
        if ($respuesta == "success") {
            echo '
                 <div class="col-md-6 mt-3">
                 <div class="alert alert-success alert-dismissible">
                     <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x
                     </button>
                     <h5>
                         <i class="icon fas fa-check"></i>
                         ¡Exito!
                     </h5>
                     Producto eliminado con éxito.
                     </h5>
                     Producto eliminado con éxito.
                    </div>
                  </div>

                 ';
        } else {
            echo '
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


public function addProductController()
{
    $datosController = $_GET["idProductAdd"];
    $respuesta = Datos::editarProductsModel($datosController, "productos");
?>
    <div class="col-md-6 mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h4><b>Agregar</b> Stock al Producto</h4>
            </div>
            <div class="card-body">
                <form method="post" action="index.php?action=inventario">
                    <div class="form-group">
                        <input type="hidden" name="idProductAdd" class="form-control" value="<?php echo $respuesta["id"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="codigotxtEditar">Stock: </label>
                        <input class="form-control" name="addstocktxt" id="addstocktxt" type="number" min="1" value="1" required placeholder="Stock del Producto">
                    </div>
                    <div class="form-group">
                        <label for="referenciatxtadd">Motivo: </label>
                        <input class="form-control" name="referenciatxtadd" id="referenciatxtadd" type="text" require placeholder="Referencia del Producto">
                    </div>
                    <button class="btn btn-primary" type="submit">Realizar Cambio</button>
                </form>
            </div>
        </div>
    </div>
<?php // se abre el php
}

/*Esta funcion actualiza y llama al modelo de la tabla producto a su vez inserta una nueva fila a la tabla
historial, si el update sale correcto y agrega los productos del stock entonces insertara la actualizacion en la 
tabla historial, si todo sale bien mostrara un mensaje de error o de correcto dependiendo de la respuesta */
public function actualizar1StockController()
{
    if (isset($_POST["addstocktxt"])) {
        $datosController = array("id" => $_POST["idProductAdd"], "stock" => $_POST["addstocktxt"]);
        $respuesta = Datos::pushProductsModel($datosController, "productos");
        if ($respuesta == "success") {
            $datosController2 = array("user" => $_SESSION["id"], "cantidad" => $_POST["addstocktxt"], "producto" => $_POST["idProductAdd"], "note" => $_SESSION["nombre_usuario"] . "agrego/compro", "reference" => $_POST["referenciatxtadd"]);
            $respuesta2 = Datos::insertarHistorialModel($datosController2, "historial");
            echo '
       <div class="col-md-6 mt-3">
       <div class="alert alert-success alert-dismissible">
           <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x
           </button>
           <h5>
               <i class="icon fas fa-check"></i>
               ¡Exito!
           </h5>
           Stock Modificado con Exito.
          </div>
        </div>

       ';
        } else {
            echo '
      <div class="col-md-6 mt-3">
          <div class="alert alert-danger alert-dismissible">
              <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x
              </button>
              <h5>
                  <i class="icon fas fa-ban"></i>
                  ¡Error!
              </h5>
              Se ha producido un error al modificar el Stock.
             </div>
           </div>
   ';
        }
    }
}



/*-- Esta funcion actualiza y llama al modelo de latabla producto asu vez inserta una nueva 
fila a la tabla historial, si el update sale correcto y elimina los productos  del stock entonces 
insertara la actualizacion en la tabla historial, si todo sale bien mostrara un mensaje de error o de 
correcto dependiendo de la respuesta --*/
public function actualizar2StockController()
{
    if (isset($_POST["delstocktxt"])) {
        $datosController = array("id" => $_POST["idProductDel"], "stock" => $_POST["delstocktxt"]);
        $respuesta = Datos::pullProductsModel($datosController, "productos");
        if ($respuesta ==  "success") {
            $datosController2 = array("user" => $_SESSION["id"], "cantidad" => $_POST["delstocktxt"], "producto" => $_POST["idProductDel"], "note" => $_SESSION["nombre_usuario"] . "quito", "reference" => $_POST["referenciatxtdel"]);
            $respuesta2 = Datos::insertarHistorialModel($datosController2, "historial");
            echo '
            <div class="col-md-6 mt-3">
                <div class="alert alert-success alert-dismissible">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    <h5>
                        <i class="icon fas fa-check"></i>
                        ¡Éxito!
                    </h5>
                    Stock modificado con éxito.
                </div>
            </div>
        ';
        } else {
            echo '
        <div class="col-md-6 mt-3">
            <div class="alert alert-danger alert-dismissible">
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                <h5>
                    <i class="icon fas fa-ban"></i>
                    ¡Error!
                </h5>
                Se ha producido un error al momento de modificar el stock del producto, trate de nuevo.
            </div>
        </div>
    ';
        }
    }
}

public function delProductController()
{
    $datosController = $_GET["idProductDel"];
    $respuesta = Datos::editarProductsModel($datosController, "productos");
?>
    <div class="col-md-6 mt-3">
        <div class="card card-danger">
            <div class="card-header">
                <h4><b>Eliminar</b> stock al producto</h4>
            </div>
            <div class="card-body">
                <form method="post" action="index.php?action=inventario">
                    <div class="form-group">
                        <input type="hidden" name="idProductDel" class="form-control" value="<?php echo $respuesta["id"]; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="codigotxtEditar">Stock: </label>
                        <input class="form-control" name="delstocktxt" id="delstocktxt" type="number" min="1" max="<?php echo $respuesta["stock"]; ?>" value="<?php echo $respuesta["stock"]; ?>" required placeholder="Stock de Producto">
                    </div>
                    <div class="form-group">
                        <label for="referenciatxtadd">Motivo: </label>
                        <input class="form-control" name="referenciatxtadd" id="referenciatxtadd" type="text" require placeholder="Referencia del producto">
                    </div>
                    <button class="btn btn-primary" type="submit">Realizar Cambio</button>
                </form>
            </div>
        </div>
    </div>
<?php // se abre el php
}

//CONTROLADORES PARA EL HISTORIAL//
/*Este controlador funciona para mostrar los datos de la tabla historial al usuario */
public function vistaHistorialController()
{
    $respuesta = Datos::vistaHistorialModel("historial");
    foreach ($respuesta as $row => $item) {
        echo '
          <tr>
            <td>' . $item["usuario"] . '</td>  
            <td>' . $item["producto"] . '</td> 
            <td>' . $item["nota"] . '</td>  
            <td>' . $item["cantidad"] . '</td> 
            <td>' . $item["referencia"] . '</td>
            <td>' . $item["fecha"] . '</td>
          </tr>
            ';
    }
}

public function vistaCategoriesController(){
    $respuesta = Datos::vistaCategoriesModel("categorias");
    foreach ($respuesta as $key => $item) {
        echo'
            <tr>
                <td>
                    <a href="index.php?action=categorias&idCategoryEditar='.$item["idc"].'" class="btn btn-warning
                    btn-sm btn-icon" title="Editar" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a href="index.php?action=categorias&idCategoryBorrar='.$item["idc"].'" class="btn btn-danger
                    btn-sm btn-icon" title="Eliminar" data-toggle="tooltip"><i class="fa fa-trash"></i></a>    
                </td>
                <td>'.$item["idc"].'</td>
                <td>'.$item["ncategoria"].'</td>
                <td>'.$item["dcategoria"].'</td>
                <td>'.$item["fcategoria"].'</td>
             </tr>   
                ';
    }
}

public function registrarCategoryController(){
    ?>
    <div class="col-md-6 mt-3">
        <div class="card card-primary">
                <div class="card-header">
                    <h4><b> Regitro</b>de categorías</h4>
                </div>

                <div class="card-body">
                    <form action="index.php?action=categorias"  method="post"></form>

                            <div class="form-group">
                                <label for="ncategoriatxt">Nombre de la Categoría</label>
                                <input type="text" name="ncategoriatxt" id="ncategoriatxt" class="form-control"
                                placeholder="Ingresar el nombre de la categoría">
                            </div>

                            <div class="form-group">
                                <label for="dcategoriatxt">Descripcion de la Categoría</label>
                                <input type="text" name="dcategoriatxt" id="dcategoriatxt" class="form-control"
                                placeholder="Ingresar la descipción de la categoría">
                            </div>
                        <button class="btn btn-primary" type="submit">Agregar</button>
                    </form>
                </div>
         </div>
</div>
   <?php 
}


public function insertarCategoryController(){
    if(isset($_POST["ncategoriatxt"]) && isset($_POST["dcategoriatxt"])){
        $datosController = array("nmbre_categoria"=>$_POST["ncategoriatxt"],
        "descripcion_categoria"=>$_POST["dcategoriatxt"]);
        $respuesta = Datos::insertarCategoryModel($datosController,"categorias");
        if($respuesta == "success"){
            echo '
            <div class="col-md-6 mt-3">
                <div class="alert alert-success alert-dismissible">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    <h5>
                        <i class="icon fas fa-check"></i>
                        ¡Exito!
                    </h5>

                    categoria agregada con exito
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
                    Se ha producido un error al crear la categoria.
                </div>
            </div>
        ';
        }
    }
}


public function editarCategoryController(){
    $datosController = $_GET["idCategoryEditar"];
    $respuesta = Datos::editarCategoryModel($datosController,"categorias");
    ?>
    <div class="col-md-6 mt-3">
        <div class="card card-warning">
            <div class="card-header">
                <h4><b>Editor</b> de categorías</h4>
            </div>

            <div class="card-body">
                <form method="post" action="index.php?action=categorias">

                    <div class="form-group">
                        <input type="hidden" name="idCategoryEditar" class="form-control"
                        value="<?php echo $respuesta["id"]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="ncategoriatxt">Nombre de la Categoría:</label>
                        <input class="form-control" type="text" name="ncategoriatxteditar"
                        id="ncategoriatxt" placeholder="Ingresar el nombre de la categoria" value="<?php
                        echo $respuesta["nombre_categoria"]; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="dcategoriatxt">Descripcion de la Categoría:</label>
                        <input class="form-control" type="text" name="dcategoriatxteditar"
                        id="dcategoriatxt" placeholder="Ingresar la descripcion de la categoria" value="<?php
                        echo $respuesta["descripcion_categoria"]; ?>" required>
                    </div>
                    <button class="bnt btn-primary" type="submit">Editar</button>

                </form>
            </div>
        </div>
    </div>
    <?php
}
            
public function actualizarCategoryController(){
    if(isset($_POST["ncategoriatxteditar"]) && isset($_POST["dcategoriatxteditar"])){
        $datosController= array("id"=>$_POST["idCategoryEditar"], "nombre_categoria" =>$_POST["ncategoriatxteditar"],
        "descripcion_categoria"=>$_POST["dcategoriatxteditar"]);
        $respuesta = Datos::actualizarCategoryModel($datosController,"categorias");
        if($respuesta == "success"){
            echo '
            <div class="col-md-6 mt-3">
                <div class="alert alert-success alert-dismissible">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    <h5>
                        <i class="icon fas fa-check"></i>
                        ¡Exito!
                    </h5>

                    categoria editada con exito
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
                    Se ha producido un error al editar la categoría.
                </div>
            </div>
        ';
        }
    }
}

public function eliminarCategoryController(){
    if(isset($_GET["idBorrar"])){
        $datosController = $_GET["idBorrar"];
        $respuesta = Datos::eliminarCategoryModel($datosController,"categorias");
        if($respuesta == "success"){
            echo '
            <div class="col-md-6 mt-3">
                <div class="alert alert-success alert-dismissible">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    <h5>
                        <i class="icon fas fa-check"></i>
                        ¡Exito!
                    </h5>

                    Categoría eliminada con exito
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
                    Se ha producido un error al eliminar la categoría.
                </div>
            </div>
        ';
        }
    }
}
  

    
}
?>