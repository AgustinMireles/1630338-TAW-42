<h1>Ingresar</h1>

    <form method="post">
    
        <input type="text" placeholder="Usuario" name="usuarioIngreso" required>

        <input type="password" placeholder="Password" name="passwordIngreso" required>

        <input type="submit" value="Enviar">
    
    </form>

    <?php 
        $ingreso = new MvcControlador();
        
        $ingreso -> ctringresoUsuarioControlador();

        if(isset($_GET["action"])){
            if($_GET["action"] == "fallo"){
                echo "Fallo al ingresar";
            }
        }
    ?>