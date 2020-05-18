<?php

    //modelo de enlaces.php

        class Paginas{

            public function mdlenlacesPaginasModel($enlaces){
            if ($enlaces == "ingresar" || ($enlaces) == "usuarios"|| ($enlaces) == "productos" || 
                ($enlaces) == "registroProducto" || ($enlaces) == "editar" || ($enlaces) == "editarProducto" || ($enlaces) == "salir"){
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