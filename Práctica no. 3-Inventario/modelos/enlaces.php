<?php 

    class EnlacesPaginas{

        public function enlacesPaginasModel ($enlacesModel){
            if($enlacesModel == "categorias" || $enlacesModel == "ingresar" ||
            $enlacesModel == "inventario" || $enlacesModel == "productos" ||
            $enlacesModel == "usuarios" || $enlacesModel == "ventas" || $enlacesModel == "salir"){
                $modulo = "vistas/modulos/".$enlacesModel.".php";
                
            } else if ($enlacesModel == "index"){
                $modulo = "vistas/modulos/tablero.php";
            } else {
                $modulo = "vistas/modulos/tablero.php";
            }
            return $modulo;
        }
    }



?>