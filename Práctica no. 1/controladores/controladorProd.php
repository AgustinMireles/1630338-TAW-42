<?php

    /**DEFINIMOS EL NOMBRE DEL CONTROLADOR PRODUCTOS */
    class MvcControladorProd{
        
        
        //Registro de Productos
        static public function ctrregistroProducto(){
            if(isset($_POST["newProducto"])){

                //RECIBE A TRAVES DEL METODO POST EL NAME (HTML) DE NOMBRE, DESCRIPCION, PRECIO_COMPRA, PRCIO_VENTA, INVENTARIO
                // SE ALMACENAN LOS DATOS EN UNA VARIABLE O PROPIEDAD DE TIPO ARRAY ASOCIATIVO 
                //CON SUS RESPECTIVAS PROPIEDAD(usuario, password, email).
                $datosControlador = array("nombre"=>$_POST["newProducto"],
                                          "descripcion"=>$_POST["newDescripcion"],
                                          "precio_compra"=>$_POST["new_precio_compra"],
                                          "precio_venta"=>$_POST["new_precio_venta"],
                                          "inventario"=>$_POST["new_inventario"],
                                          "id_categoria"=>$_POST["newCategoria"]);
                 
                //Se le dice al modelo modelos/crudProd.php (Datos::mdlregistroProducto), 
                //que en modelo Datos el metodo mdlregistroUsuarioModelo en sus parametros los valores 
                //$datosControlador y el nombre de la tabla a la cual debe conectarse(productos)
                $respuesta = DatosProd::mdlregistroProducto($datosControlador,"productos");

                //se imprime la respuesta en la vista
                if($respuesta == "success"){
                    echo '<script>

								window.location = "index.php?action=productos";

							</script>';
                }
                else{
                    echo '<script>

								window.location = "index.php";

							</script>';
                }
           
            }
        }

        
    
        //VISTA DE PRODUCTOS
        
        static public function ctrverProductos(){
            $respuesta = DatosProd::mdlverProductos("productos");
            
            //Utilizar un foreach para iterar un array e imprimir la consulta del modelo
            //mostramos todos los campos de la tabla productos en una tabla
            foreach($respuesta as $row => $item){
            $productcate = DatosCate::mdlCategoria("categorias", $item["id_categoria"]);
                echo'<tr>
                        <td>'.$item["nombre"].'</td>
                        <td>'.$item["descripcion"].'</td>
                        <td>'.$item["precio_compra"].'</td>
                        <td>'.$item["precio_venta"].'</td>
                        <td>'.$item["inventario"].'</td>
                        <td>'.$productcate["nombre"].'</td>
                        <td><a href="index.php?action=editarProd&idEditar='.$item["id"].'&idCategoria='.$item["id_categoria"].'" class="btn btn-warning btn-circle"><i class="fas fa-exclamation-triangle"></i></a></td>
                        <td><a href="index.php?action=productos&idBorrar='.$item["id"].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a></td>
                    </tr>';
            }
        }

        //EDITAR PRODUCTO
        static public function ctreditarProducto(){
            $datosControlador = $_GET["idEditar"];
            $respuesta = DatosProd::mdleditarProducto($datosControlador,"productos");
            $categorias = MvcControladorCate::ctrCategorias();
            //Diseñar la estructura de un formulario que se muestren los datos de la consulta generada en el Modelo
            //damos estilos a el formulario editar producto con boostrap
            echo '
    
                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="hidden" class="form-control form-control-user" value="'.$respuesta["id"].'" name="idEditar">
                </div>
                </div>

                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" value="'.$respuesta["nombre"].'" name="nombreEditar" required>
                </div>
                </div>

                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user" value="'.$respuesta["descripcion"].'" name="descripcionEditar" required>
                </div>
                </div>

                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="number" class="form-control form-control-user" min="1" step="any" value="'.$respuesta["precio_compra"].'" name="precio_compraEditar" placeholder="Precio Compra" required>
                </div>
                </div>

                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="number" class="form-control form-control-user" min="1" step="any" value="'.$respuesta["precio_venta"].'" name="precio_ventaEditar" placeholder="Precio Venta" required>
                </div>
                </div>

                <div class="form-group row">
                <div class="col mb-3 mb-sm-0">
                <input type="number" class="form-control form-control-user" min="1" value="'.$respuesta["inventario"].'" name="inventarioEditar" required>
                </div>
                </div>

               
                <select class="form-control input-lg" id="nuevaCategoria" name="categoriaEditar" required>
                  
                    <option value="">Selecionar categoría</option>';

                
                      foreach ($categorias as $key => $value) {
                        
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }

                      
                    echo'
                    </select>

                <div class="d-flex float-right">
                <button type="submit" class="btn btn-success btn-circle"><i class="fas fa-check"></i></button>
                </div>';
             
        }
        
        //ACTUALIZAR PRODUCTO
        /**CONFIRMAMOS SI SE HIZO UNA PETICION POST DEL FORMULARIO DONDE EDITAMOS EL PRODUCTO SELECCIONADO*/
        static public function ctractualizarProducto(){
            if(isset($_POST["nombreEditar"])){
                $datosControlador = array("id"=>$_POST["idEditar"],
                                        "nombre"=>$_POST["nombreEditar"],
                                        "descripcion"=>$_POST["descripcionEditar"],
                                        "precio_venta"=>$_POST["precio_ventaEditar"],
                                        "precio_compra"=>$_POST["precio_compraEditar"],
                                        "inventario"=>$_POST["inventarioEditar"],
                                        "id_categoria"=>$_POST["categoriaEditar"]);
                $respuesta = DatosProd::mdlactualizarProducto($datosControlador,"productos");    
                
                if($respuesta == "success"){
                    echo '<script>

								window.location = "index.php?action=productos";

							</script>';
                }             
                else{
                    echo "error";
                }           
            }

        }

        //BORRAR PRODUCTO 
        static public function ctrborrarProducto(){
            if(isset($_GET["idBorrar"])){
                $datosControlador = $_GET["idBorrar"];
                $respuesta = DatosProd::mdlborrarProducto($datosControlador,"productos");
                
                if($respuesta == "success"){
                    echo '<script>

								window.location = "index.php?action=productos";

							</script>';
                }
            }
        }




    }





?>