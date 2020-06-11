//Guarda los id de los productos que vamos agegando a la lista de venta
var a = [];

$("#search-item-form").on("click", "button.boton-buscador", function() {

    //acedo al valor que tiene el input del buscador
    var buscar = $("input#buscar").val();
    var datos = new FormData();
    datos.append("buscar", buscar);

    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            //console.log("respuesta", respuesta);

            //borramos el contenido de la lista para que no se vayan repitiendo
            $("#filter-list").empty();
            $.each(respuesta, function(i, item) {
                //console.log(item["id"]);


                $("#filter-list").append(
                    '<div class="col-lg-2 col-md-3 col-xs-4  shop-items filter-add-product noselect text-center" data-order="null" data-codebar="3293947878994" style="padding: 5px; border-right: 1px solid rgb(222, 222, 222); border-bottom: 1px solid rgb(222, 222, 222); ">' +
                    '<p>' + item["nombre_producto"] + '<p/>' +
                    '<i class="fas fa-box-open"></i>' +
                    '<button  idAgregar=' + item["id"] + ' class="btn btn-success agregarProducto recuperarBoton btn-sm btn-icon" title="Eliminar" data-toggle="tooltip">AGREGAR</button>' +
                    '</div>'
                );




            });

            $.each(a, function(i, item) {
                $("button.agregarProducto[idAgregar='" + a[i].idProducto + "']").removeClass("btn-success agregarProducto");
                $("button.agregarProducto[idAgregar='" + a[i].idProducto + "']").addClass("btn-default");


            });
            //console.log(a);


        }
    })

});



/**AGREGAR PRODUCTOS A LA VENTA */
$("#filter-list").on("click", "button.agregarProducto", function() {
    var idProducto = $(this).attr("idAgregar");

    $(this).removeClass("btn-success agregarProducto");

    $(this).addClass("btn-default");

    $("button.venta").attr("data-target", "#modal-venta");

    $("button.cancelar").attr("data-target", "#modal-cancelar");

    a.push({ "idProducto": idProducto });
    //console.log(a[1]);
    var datos = new FormData();
    datos.append("idProducto", idProducto);

    /**HACER PETICION AJAX */


    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            // console.log("respuesta", respuesta);
            var idProducto = respuesta["id_product"]
            var nombre = respuesta["name_product"];
            var stock = respuesta["stock"];
            var precio = respuesta["price_product"];


            $(".product-venta").append(
                '<tr>' +
                '<td><button class="btn btn-danger quitarProducto" idProducto="' + idProducto + '" ><i class="fa fa-times"></i></button></td>' +
                '<td><input type="text" class="form-control " idProducto="' + idProducto + '" name="agregarProducto" value="' + nombre + '" readonly required></td>' +
                '<td class="precio-producto"><input type="text" class="form-control precio" value=" ' + precio + '" readonly></td>' +
                '<td><input type="number" class="form-control nuevaCantidadProducto" min="1" max="' + stock + '" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" required></td>' +
                '<td class="precio-total"><input type="text" class="form-control precioFin" value="" readonly></input></td>' +
                '</tr>');

            sumarTotal();
            sumarCount();
        }



    })

});

/***QUITAR PRODUCTO DE LA VENTA*/
$(".product-venta").on("click", ".quitarProducto", function() {
    //console.log("hola");
    $(this).parent().parent().remove();

    var idProducto = $(this).attr("idProducto");
    $("button.recuperarBoton[idagregar='" + idProducto + "']").removeClass("btn-default");
    $("button.recuperarBoton[idagregar='" + idProducto + "']").addClass("btn-success agregarProducto");

    $.each(a, function(i, item) {
        if (a[i].idProducto == idProducto) {
            delete a[i].idProducto;
        }

    });

    if ($(".product-venta").children().length == 0) {

        $(".sub-total").val(0);
        $(".total-iva").val(0);
        $(".count").val(0);
        $(".total").val(0);

        /** SI NO EXISTE PRODUCTOS EN LISTA DE VENTAS, QUITAMOS LA CLASE VENTA-MODAL QUE ABRE EL FORMULARIO PARA PAGAR**/
        $("button.venta").attr("data-target", "");
        $("button.cancelar").attr("data-target", "");

    }




    sumarTotal();
    sumarCount();

});

$(".product-venta").on("change", "input.nuevaCantidadProducto", function() {
    var precio = $(this).parent().parent().children('.precio-producto').children('.precio');
    var precionuevo = $(this).parent().parent().children('.precio-total').children('.precioFin');
    var precioFinal = $(this).val() * precio.val();


    precionuevo.attr("value", precioFinal);
    //var precioFinal = precio * cantidad;
    //$(".precioFin").attr("value", precioFinal);
    //console.log(precioFinal);
    sumarTotal();
    sumarCount();
});

function sumarCount() {
    var cantidad = $(".nuevaCantidadProducto");
    var arrayCount = [];

    for (var i = 0; i < cantidad.length; i++) {
        arrayCount.push(Number($(cantidad[i]).val()));
    }

    function sumarArrayCount(tot, num) {

        return tot + num;

    }

    var Sumacantidad = arrayCount.reduce(sumarArrayCount);

    $(".count").val(Sumacantidad);
    console.log(Sumacantidad);
}

function sumarTotal() {
    var precioProductos = $(".precioFin");
    var arrySumatotal = [];
    //console.log(precioProductos);
    for (var i = 0; i < precioProductos.length; i++) {
        arrySumatotal.push(Number($(precioProductos[i]).val()));
    }

    function sumarArrayPrecios(total, numero) {

        return total + numero;

    }

    var Sumatotal = arrySumatotal.reduce(sumarArrayPrecios);
    //console.log("Sumatotal", Sumatotal);
    var iva = $(".total-iva").val((Sumatotal * 16) / 100);
    var sub_total = $(".sub-total").val(Sumatotal);

    var total = Number(parseFloat(sub_total.val()) + parseFloat(iva.val()));
    console.log(sub_total.val());
    $(".total").val(total);

}

$(".modal-footer").on("click", "button.enviar-contra", function() {


    var idProducto = $(".quitarProducto").attr("idProducto");
    console.log(idProducto, "id");
    /*$.each(a, function(i, item) {
        $("button.agregarProducto[idAgregar='" + a[i].idProducto + "']").removeClass("btn-default");
        $("button.agregarProducto[idAgregar='" + a[i].idProducto + "']").addClass("btn-success agregarProducto");
    });*/

    $.each(a, function(i, item) {
        if (a[i].idProducto == idProducto) {
            delete a[i].idProducto;
        }

    });

    //sumarTotal();
    //sumarCount();
    $(".product-venta").empty();
});