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


        public function vistaUserController(){
            $respuesta = Datos::vistaUserModel("usuarios"){
                foreach ($respuesta as $row => $item){

                }
            }
        }

        public function registrarController(){
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

    }


?>