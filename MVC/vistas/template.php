<!DOCTYPE html>
<html lang="en">


<!--Inlcuimos las carpetas css y js del template para que funcionen los estilos-->
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vistas/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="vistas/css/sb-admin-2.min.css" rel="stylesheet"><!--*******-->

  <!-- Custom styles for this page -->
  <link href="vistas/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>


<body id="page-top">

    <?php
    

      /*Validamos sessiones para incluir lss siguientes complementos*/    
      if(isset($_SESSION["validar"]) && $_SESSION["validar"] == true ){

        //<!-- Page Wrapper -->
        echo '<div id="wrapper">';

        //<!--SIDEBAR-->
            
            
             /*1- El menu lateral */       
            include "modulos/navegacion.php";
                    
            

            //<!-- Content Wrapper -->
            echo '<div id="content-wrapper" class="d-flex flex-column">';

            //<!-- Main Content -->
            echo '<div id="content">';

                //<!-- Topbar -->
                 
                /**2 - Cabecera */
                include "modulos/header.php";
                
                
                //<!-- End of Topbar -->

                //<!-- Begin Page Content -->
                echo '<div class="container-fluid">';

                /**3 - Controlador de enlaces para saber lo que el ussario esta seleccionando */
                $mvc = new MvcControlador();
                $mvc -> ctrenlacesPaginasControlador();
                
                echo '</div>';
                //<!-- /.container-fluid -->

            echo '</div>';
            //<!-- End of Main Content -->

            //<!-- Footer -->
             
                /*Pie de pagina */
                include "modulos/footer.php";
                
            
            //<!-- End of Footer -->

            echo '</div>';
            //<!-- End of Content Wrapper -->

        echo '</div>';
        //<!-- End of Page Wrapper -->

      }
      
      



    ?>
  

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!--Modal para cerrar la session-->
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="index.php?action=salir">Salir</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vistas/vendor/jquery/jquery.min.js"></script>
  <script src="vistas/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vistas/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="vistas/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vistas/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="vistas/js/demo/chart-area-demo.js"></script>
  <script src="vistas/js/demo/chart-pie-demo.js"></script>

  <!-- Page level plugins -->
  <script src="vistas/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vistas/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="vistas/js/demo/datatables-demo.js"></script>

</body>

</html>