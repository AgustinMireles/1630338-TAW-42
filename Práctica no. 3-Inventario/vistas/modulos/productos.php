<div class="row">
<div class="container">
<div class="col-lg-3">    
<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Danger alert preview. This alert is dismissable. 
              </div>
</div>

<div class="col-lg-3">    
<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Success alert preview. This alert is dismissable.
</div>
</div>

</div>
</div>
<div class="col-xs-12">

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Productos</li>
    
    </ol>

  </section>

<section class="content">
<div class="box">
            <div class="box-header with-border">
            
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
                
                Agregar Producto

            </button>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            <th>Categoria</th>
            <th>¿Editar?</th>
            <th>¿Eliminar?</th>
          </tr> 
 
         </thead>
 
         <tbody>
             <tr>
 
                     <td>id</td>
 
                     <td class="text-uppercase">Categoria</td>
 
                     <td>
 
                       <div class="btn-group">
                           
                         <button class="btn btn-warning btnEditarCategoria" idCategoria="" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>

                       </div>  
 
                     </td>

                     <td>
                         <div class="btn-group">
                         <button class="btn btn-danger btnEliminarCategoria" idCategoria=""><i class="fa fa-times"></i></button>
                         </div>
                     </td>
 
                   </tr>
         </tbody>
 
        </table>
            </div>
            <!-- /.box-body -->

        </div>
        
        
        <div class="box">
            <div class="box-header with-border">
            
            <!--<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
                
                Agregar Producto

            </button>-->

            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            <th>Categoria</th>
            <th>¿Editar?</th>
            <th>¿Eliminar?</th>
          </tr> 
 
         </thead>
 
         <tbody>
             <tr>
 
                     <td>id</td>
 
                     <td class="text-uppercase">Categoria</td>
 
                     <td>
 
                       <div class="btn-group">
                           
                         <button class="btn btn-warning btnEditarCategoria" idCategoria="" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>

                       </div>  
 
                     </td>

                     <td>
                         <div class="btn-group">
                         <button class="btn btn-danger btnEliminarCategoria" idCategoria=""><i class="fa fa-times"></i></button>
                         </div>
                     </td>
 
                   </tr>
                   <tr>
 
 <td>id</td>

 <td class="text-uppercase">jugos</td>

 <td>

   <div class="btn-group">
       
     <button class="btn btn-warning btnEditarCategoria" idCategoria="" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>

   </div>  

 </td>

 <td>
     <div class="btn-group">
     <button class="btn btn-danger btnEliminarCategoria" idCategoria=""><i class="fa fa-times"></i></button>
     </div>
 </td>

</tr>     
         </tbody>
 
        </table>
            </div>
            <!-- /.box-body -->
</div>  








</section>
</div>


</div>


<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="txtproducto" placeholder="Ingresar Producto" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Producto</button>

        </div>

        
<!--
          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria(); -->

        

      </form>

    </div>

  </div>

</div>