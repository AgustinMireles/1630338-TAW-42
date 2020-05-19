<?php
    /**Definimos el nombre del controlador categorias */
    class MvcControladorCate{
        
        
        //Registro de Categorias
        static public function ctrregistroCategoria(){
            /*Si El formulario fue enviado recibimos respuesta mediante el metodo post */
            if(isset($_POST["newCategoria"])){

                //RECIBE A TRAVES DEL METODO POST EL NAME (HTML) DE CATEGORÍA, SE ALMACENAN LOS DATOS EN UNA VARIABLE O PROPIEDAD 
                //DE TIPO ARRAY ASOCIATIVO CON SUS RESPECTIVAS PROPIEDAD(nombre).
                $datosControlador = array("nombre"=>$_POST["newCategoria"]);
                 
                //Se le dice al modelo modelo/crudCate.php (Datos::mdlregistroCategoria),
                // que en modelo Datos el metodo mdlregistroCategoria 
                //en sus parametros los valores $datosControlador y el nombre de la tabla a la cual debe conectarse(categoria)
                $respuesta = DatosCate::mdlregistroCategoria($datosControlador,"categorias");

                //se imprime la respuesta en la vista en este caso se manda a la vista categorias
                //donde se visualiza las categorias existentes
                if($respuesta == "success"){
                    echo '<script>

								window.location = "index.php?action=categorias";

							</script>';
                }
                else{
                    echo '<script>

								window.location = "index.php";

							</script>';
                }
           
            }
        }

    

        //VISTA DE Categorias
        //en este metodo se hace una peticion al modelo DatosCate a la funcion mdlverCategorias, muestra las categorias existentes
        static public function ctrverCategorias(){
            $respuesta = DatosCate::mdlverCategorias("categorias");
            //Utilizar un foreach para iterar un array e imprimir la consulta del modelo

            foreach($respuesta as $row => $item){
                echo'<tr>
                        <td>'.$item["nombre"].'</td>
                        <td><a href="index.php?action=editarCate&idEditar='.$item["id"].'" class="btn btn-warning btn-circle"><i class="fas fa-exclamation-triangle"></i></a></td>
                        <td><a href="index.php?action=categorias&idBorrar='.$item["id"].'" class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></a></td>
                    </tr>';
            }
        }

        static public function ctrCategorias(){
            $id = null;
            $respuesta = DatosCate::mdlCategoria("categorias",$id);
            //Utilizar un foreach para iterar un array e imprimir la consulta del modelo
            return $respuesta;

        }

        //EDITAR CATEGORIAS
        static public function ctreditarCategoria(){
            $datosControlador = $_GET["idEditar"];
            $respuesta = DatosCate::mdleditarCategoria($datosControlador,"categorias");
            
            //Diseñar la estructura de un formulario que se muestren los datos de la consulta generada en el Modelo
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

                <div class="d-flex float-right">
                <button type="submit" class="btn btn-success btn-circle"><i class="fas fa-check"></i></button>
                </div>
            ';
        }
        
        //ACTUALIZAR CATEGORIA
        /**EN ESTE METODO CONFIRMAMOS SI LA CATEGORIA SELECCIONADA FUE EDITADA */
        static public function ctractualizarCategoria(){
            if(isset($_POST["nombreEditar"])){
                $datosControlador = array("id"=>$_POST["idEditar"],
                                            "nombre"=>$_POST["nombreEditar"]);
                $respuesta = DatosCate::mdlactualizarCategoria($datosControlador,"categorias");    
                
                if($respuesta == "success"){
                    echo '<script>

								window.location = "index.php?action=categorias";

							</script>';
                }             
                else{
                    echo "error";
                }           
            }

        }

        //BORRAR CATEGORIA
        /**BORRAMOS LA CATEGORIA CON EL ID SELECCIONADO */
        static public function ctrborrarCategoria(){
            if(isset($_GET["idBorrar"])){
                $datosControlador = $_GET["idBorrar"];
                $respuesta = DatosCate::mdlborrarCategoria($datosControlador,"categorias");
                
                if($respuesta == "success"){
                    echo '<script>

								window.location = "index.php?action=categorias";

							</script>';
                }
            }
        }

    

    }





?>