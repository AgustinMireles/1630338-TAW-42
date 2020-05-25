<?php

    //modelo de enlaces.php

        class Paginas{

            public function mdlenlacesPaginasModel($enlaces){
            if ($enlaces == "ingresar" || ($enlaces) == "usuarios"|| ($enlaces) == "productos" || 
                ($enlaces) == "registroProducto" || ($enlaces) == "editar" || ($enlaces) == "editarProducto" || ($enlaces) == "salir"){
                $modulo = "views/modelos/".$enlaces.".php";
            }
            else if($enlaces == "index"){
                $modulo = "views/modelos/registro.php";
            }
            else if($enlaces == "ok"){
                $modulo = "views/modelos/registro.php";
            }
            else if($enlaces == "fallo"){
                $modulo = "views/modelos/ingresar.php";
            }
            else if($enlaces == "cambio"){
                $modulo = "views/modelos/usuarios.php";
            }
            else{
                $modulo = "views/modelos/registro.php";
            }
            return $modulo;
        }

    }


?>