<?php 
  if(!isset($_SESSION['validar'])){
    header("location:index.php?action=ingresar");
    exit();
}

$clientes = Datos::vistaClientesModel("clientes"); 
?>

<div class="meta-row col-sm-12 col-xs-12 col-lg-6 col-md-6">
<div class="card-header bg-gradient-gray">
                <h3 class="card-title">Ventas</h3>
</div>

<select name="" id="cliente" class="form-control">
<?php
foreach ($clientes as $row => $item){



echo '<option value="'.$item["id"].'">'.$item["nombre"].'</option>';
 
} 
 ?> 
</select>   
<!--<button type="button" class="btn btn-default" ng-click="openAddQuickItem()" title="Item">
<i class="fa fa-plus"></i>
<span class="hidden-sm hidden-xs">Item</span>
</button>-->

<div class="box-body">

        <div class="direct-chat-messages" id="cart-table-body" style="padding:0px;">
            <table class="table" style="margin-bottom:0;">
            <thead><tr id="cart-table-notice"><td colspan="4">Listado de Artículos</td></thead>
            <tbody class="product-venta">
            
            

            

            
            </tbody>
            </table>
        </div>


        <table class="table" id="cart-item-table-header">
        <thead>
        <tr class="active">
        <td class="text-left" width="150">Nombre Producto</td>
        <td class="text-center hidden-xs" width="150">Precio * Unidad</td>
        <td class="text-center" width="100">Cantidad</td>
        <td class="text-right" width="100">Total</td>
        </tr>
        </thead>

        <tbody>

        <tr>
        
            <th class="cantidad d-flex flex-column flex-wrap">
                <div class="d-flex">
                <label for="count" class="form-control form-control-sm">Conunt</label>
                <input type="text" id="count" class="form-control form-control-sm count" value="" readonly>
                </div>
                <div class="d-flex">
                <label for="efectivo" class="form-control form-control-sm">Pago</label>
                <input type="number" id="efectivo" class="form-control form-control-sm efectivo" value="" min="1">
                </div>
                <div class="d-flex">
                <label for="cambio" class="form-control form-control-sm">Cambio</label>
                <input type="text" id="cambio" class="form-control form-control-sm cambio" value="" readonly>
                </div>
            </th>
            <th>
           
            </th>
            <th>
            <label for="" class="form-control form-control-sm">Sub Total</label>
            <label for="" class="form-control form-control-sm">Iva</label>
            <label for="" class="form-control form-control-sm">Descuento-%</label>
            <label for="" class="form-control form-control-sm">Total</label>
            </th>
            <th class="totales">
                <input type="text" id="sub-total" class="form-control  form-control-sm sub-total mb-2" value="" readonly>
                <input type="text" class="form-control  form-control-sm total-iva mb-2" value="" readonly>
                <input type="number"  class="form-control form-control-sm descuento mb-2" min="0" value="" >
                <input type="text" class="form-control  form-control-sm total" value="" readonly>
            </th>
        </tr>


        </tbody>
        </table>

        


      
<div class="d-flex justify-content-around botones">  
<button type="button"  class="btn btn-outline-success px-5 venta" data-toggle="modal"><i class="far fa-money-bill-alt"></i>PAGAR</button>
<button class="btn btn-outline-danger px-5 cancelar" data-toggle="modal"><i class="fas fa-ban"></i>CANCELAR</button>
</div>
</div><!--FIN BOX-BODY-->

</div>
<div class="meta-row col-sm-12 col-xs-12 col-lg-6 col-md-6 mt-lg-0 mt-sm-4">
<div class="card-header bg-gray">
                <h3 class="card-title">Buscar Productos</h3>

</div>
<div class="box mb-0 box-primary direct-chat direct-chat-primary" id="product-list-wrapper" style="visibility: visible;">
<div class="box-header with-border search-field-wrapper">
<div  id="search-item-form" class="ng-pristine ng-valid">
<div class="input-group">
<div class="input-group-btn">

<button type="button" class="enable_barcode_search btn btn-large btn-default"><i class="fa fa-barcode"></i></button>
</div>
<input autocomplete="off" type="text" id="buscar" name="buscar" placeholder="Código de Barras, Nombre Producto..." class="form-control">
<button type="button"  class="boton-buscador btn btn-large btn-default"><i class="fa fa-search"></i></button>
</div>
</div>
</div>
</div>

<?php
$ventas = new MvcController();
?>
<div class="box-body" style="visibility: visible;">
    <div class="direct-chat-messages item-list-container mt-4" style="padding:0px;">
        <div class="row d-flex " id="filter-list" style="padding-left: 0px; padding-right: 0px; margin-left: 0px; margin-right: 0px; padding-bottom: 0px; display: block;">
    <!--php $ventas->buscarProductosController();-->
        </div>   
    </div>
</div>


</div><!--FIN DEL META-ROW-->



<!-- Modal VENTA-->
<div class="modal fade" id="modal-venta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Realizar Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">
       
        <input type="hidden" name="cliente" id="id_cliente">
        <input type="hidden" name="total" id="total_venta">
        <input type="hidden" name="cantidad" id="cantidad_productos">
        <input type="hidden" name="productos" id="id_productos">
        <!--<input type="submit" value="Realizar Venta">-->
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <?php $ventas->realizarVentaController();  ?>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal CANCELAR VENTA-->
<div class="modal fade" id="modal-cancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal">CONTRASEÑA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="usuario_admin" class="form-control form-control-sm mb-2" placeholder="usuario">
        <input type="password" id="contra_admin" class="form-control form-control-sm" placeholder="contraseña">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary enviar-contra" data-dismiss="modal">Enviar</button>
      </div>
    </div>
  </div>
</div>














<script type="text/javascript" src="https://checkout.stripe.com/checkout.js"></script>



<style type="text/css">
.slick-item {
    padding:0px 20px;
    font-size:20px;
    line-height:40px;
    border-right:solid 1px #EEE;
    margin-right:-1px;
}
.expandable {
	width: 19%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    transition-property: width;
	transition-duration: 2s;
}
.item-grid-title {
	width: 19%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    transition-property: width;
	transition-duration: 2s;
}
.item-grid-price {
	width: 19%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    transition-property: width;
	transition-duration: 2s;
}
.expandable:hover{
	overflow: visible;
    white-space: normal;
    width: auto;
}
.shop-items:hover {
	background:#FFF;
	cursor:pointer;
	box-shadow:inset 5px 5px 100px #EEE;
}
.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
  -webkit-user-select: none;   /* Chrome/Safari/Opera */
  -khtml-user-select: none;    /* Konqueror */
  -moz-user-select: none;      /* Firefox */
  -ms-user-select: none;       /* Internet Explorer/Edge */
  user-select: none;           /* Non-prefixed version, currently
                                  not supported by any browser */
}
.img-responsive {
    margin: 0 auto;
}
.modal-dialog {
	margin: 10px auto !important;
}

/**
 NexoPOS 2.7.1
**/

#cart-table-body .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    border-bottom: 1px solid #f4f4f4;
	margin-bottom:-1px;
}
.box {
	border-top: 0px solid #d2d6de;
}
</style>
</div>