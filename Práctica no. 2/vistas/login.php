<!--<form method="post">
<label for="cedula"></label>
<input type="text" id="cedula" placeholder="Cedula.." name="cedula">
<label for="contrasena"></label>
<input type="password" id="contrasena" placeholder="Contraseña.." name="contrasena">
<input type="submit" value="Iniciar" >
</form>-->

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicair Session</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-3">
		<div class="row ">
        <div class="col-lg-4"></div>
        
			<div class="col-lg-8" style="margin-top:12px;">
				<form method="post" >
					<div class="form-group row">
						<div class="col-12 col-md-6 mb-3">
							<label for="cedula">CEDULA</label>
							<input type="text" class="form-control" placeholder="Cedula" name="cedula" id="cedula">
						</div>
					</div>

                    <div class="form-group row">
                    <div class="col-12 col-md-6 mb-3">
							<label for="pass">Contraseña</label>
							<input type="password" class="form-control" placeholder="Contraseña" name="contrasena" id="pass">
						</div>
                    </div>

					<div class="form-group row">
								<div class="col-12 col-sm-9 col-md-4">
									<button class="btn btn-primary btn-block" type="submit">Iniciar Session</button>
								</div>
						
					</div>
                        <?php
                        $iniciar = new login_controller();
                        $iniciar->valida();
                        ?>
				</form>
			</div>

           
		</div>
	</div>
	
	<script src="style/js/jquery-3.2.1.min.js"></script>
	<script src="style/js/popper.min.js"></script>
	<script src="style/js/bootstrap.min.js"></script>
</body>
</html>