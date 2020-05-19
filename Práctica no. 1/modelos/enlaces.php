<?php

    //modelo de enlaces.php

        class Paginas{

            static public function mdlenlacesPaginasModel($enlaces){
            if ($enlaces == "ingresar" || ($enlaces) == "usuarios"|| ($enlaces) == "productos" || ($enlaces) == "registro" || ($enlaces) == "categorias" ||
                ($enlaces) == "registroProducto" || ($enlaces) == "add_productos" || ($enlaces) == "add_categorias" || ($enlaces) == "editar" || ($enlaces) == "editarProd" || ($enlaces) == "editarCate"  || ($enlaces) == "salir"){
                $modulo = "vistas/modulos/".$enlaces.".php";
            }
            else if($enlaces == "index"){
                $modulo = "vistas/modulos/registro.php";
            }
            else if($enlaces == "ok"){
                $modulo = "vistas/modulos/ingresar.php";
            }
            else if($enlaces == "fallo"){
                $modulo = "vistas/modulos/ingresar.php";
            }
            else if($enlaces == "cambio"){
                $modulo = "vistas/modulos/usuarios.php";
            }
            else{
                $modulo = "vistas/modulos/registro.php";
            }
            return $modulo;
        }

    }


?>