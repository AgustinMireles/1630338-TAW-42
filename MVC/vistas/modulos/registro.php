<h1>Registrar</h1>

    <form method="post">
    
        <input type="text" placeholder="Usuario" name="usuarioRegistro" required>

        <input type="password" placeholder="Password" name="passwordRegistro" required>

        <input type="email" placeholder="Email" name="emailRegistro" required>

        <input type="submit" value="Sumbit">
    
    </form>

    <?php 
        $registro = new MvcControlador();
        
        $registro -> ctrregistroUsuarioControlador();

        if(isset($_GET["action"])){
            if($_GET["action"] == "fallo"){
                echo "Fallo al ingresar";
            }
        }
    ?>