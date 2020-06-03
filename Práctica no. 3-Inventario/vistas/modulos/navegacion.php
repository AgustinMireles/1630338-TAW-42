<?php 
    if ($_GET['action'] == 'salir'){
        header('location:index.php?action=ingresar');
    }
?>

<!--Navbar-->
<nav clas="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="index.php?action=tablero" data-widget="pushmenu">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
</nav>
<!--/Navbar-->

<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!--Brand Logo-->
    <a href="index.php?action=tablero" class="brand-link nav-success">
        <img src="vistas/assets/dist/img/AdminLTELogo.png" alt="Inventarios | TAW | UPV"
        class="brand-image img-square" style="opacity: .8">
        <span class="brand-text font-weight-light">Inventarios 2020</span>
    </a>


<!--Sidebar-->
<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="views/assets/dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="index.php?action=tablero" class="d-block"><?php
                if(isset($_SESSION['nombre_usuario'])){echo $_SESSION['nombre_usuario'];}
            ?>
            </a>
        </div>
    </div>

    <!--Sidebar Menu-->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">

            <li class="nav-item">
                <a href="index.php?action=tablero" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Tablero</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="index.php?action=usuarios" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Usuarios</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="index.php?action=categorias" class="nav-link">
                    <i class="nav-icon fas fa-tag"></i>
                    <p>Categorias</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="index.php?action=productos" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>Productos</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="index.php?action=salir" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Salir</p>
                </a>
            </li>

        </ul>
    </nav>
</div>
</aside>