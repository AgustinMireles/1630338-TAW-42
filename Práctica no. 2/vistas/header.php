<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style/css/bootstrap.min.css">
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">HOME</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <!--EN CASO DE QUE EL USUARIO QUIERE REGISTRAR UN ESTUDIANTE, LE DAMOS VALOR A LA VARIABLE M, LO CUAL O MANDARA A LA VISTA ESTUDIANTE-->
            <li class="active"><a href="index.php?m=salir">Salir</a></li>
              <li class="active"><a href="index.php?m=estudiante">Agregar Estudiante</a></li>
              <li class="active"><a href="index.php?mu=agregar_universidad">Agregar Universidad</a></li>
              <li class="active"><a href="index.php?mc=agregar_carrera">Agregar Carrera</a></li>
              <li class="dropdown">
                <a href="index.php?m=estudiantes" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Estudiantes</a>
              </li>
              <li class="dropdown">
              <a href="index.php?mu=universidad" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Universidades</a>
              </li>
              <li class="dropdown">
              <a href="index.php?mc=ver_carreras" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Carreras</a>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
</header>