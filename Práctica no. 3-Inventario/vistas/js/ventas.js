/**GUARDA LOS ID DE LOS PRODUCTOS**/
var a = [];


/**EVENTO ENCARGADO DE HACER LA FUNCION DEL BUSCADOR**/
$("#search-item-form").on("click", "button.boton-buscador", function() {
    /**ACCEDE AL VALOR DEL INPUT BUSCADOR**/
    var buscar = $("input#buscar").val();

    var datos = new FormData();
    /**AGREGAMOS EL VALOR DE LA VARIABLE buscar PARA QUE SE ENVIE POR METODO POST**/
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

            /**SI EXISTEN VALORES EN LA TABLA VAMOS ELIMINANDO PARA QUE NO SE REPITAN**/
            $("#filter-list").empty();
            /**POR CADA PRODUCTO QUE EXISTA EN LA TABAL LE ASIGNAMOS SUS RESPECTIVAS ETIQUETAS CON SUS ATRIBUTOS**/
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

            /**COMPROBAMOS SI EXISTE UN PRODUCTO EN LA TABLA QUE YA HAYA SIDO AGREGADO EN LA LISTA DE VENTAS
             * REMOVIENDO LA CLASE BTN-SUCCES PARA QUE NO SE AGREGADA A LA LISTA DE VENTAS NUEVAMENTE**/
            $.each(a, function(i, item) {
                $("button.agregarProducto[idAgregar='" + a[i].idProducto + "']").removeClass("btn-success agregarProducto");
                $("button.agregarProducto[idAgregar='" + a[i].idProducto + "']").addClass("btn-default");
            });
            //console.log(a);


        }
    })

});



/**EVENTO ENCARAGADO DE AGREGAR PRODUCTOS A LA VENTA */
$("#filter-list").on("click", "button.agregarProducto", function() {
    /**ASGINAMOS EL ID DEL PRODUCTO AÑADIDO**/
    var idProducto = $(this).attr("idAgregar");

    /*REMOVEMOS SU CLASE BTN-SUCCESS PARA QUE NO SEA AGREGADO**/
    $(this).removeClass("btn-success agregarProducto");

    /**Y AGREGAMOS LA CLASE BTN-DEFAULT PARA QUE EL USUARIO NO PUEDA DAR CLICK A ELLA**/
    $(this).addClass("btn-default");

    /**SI EXISTE PRODUCTOS EN LA LISTA DE VENTAS EL USUARIO PUEDE ACCEDER A LOS MODALES DE REALIZAR VENTA Y CANCELA VENTA**/
    $("button.venta").addClass("realizarventa");
    $("button.venta").attr("data-target", "#modal-venta");

    $("button.cancelar").attr("data-target", "#modal-cancelar");

    /**VAMOS HACIENDO UN PUSH AL ARREGLOS QUE DE IDS**/
    a.push({ "idProducto": idProducto });
    //console.log(a[1]);
    var datos = new FormData();
    datos.append("idProducto", idProducto);

    /**HACER PETICION AJAX PARA BUSCAR EL PRODUCTO CON EL ID SELECIONADO EN LA LISTA DE PRODUCTOS*/
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
            /**TREMAOS LOS DATOS DEL PRODUCTO PARA MOSTRALOS EN LA LISTA DE VENTAS**/
            var idProducto = respuesta["id_product"]
            var nombre = respuesta["name_product"];
            var stock = respuesta["stock"];
            var precio = respuesta["price_product"];


            $(".product-venta").append(
                '<tr>' +
                '<td><button class="btn btn-danger quitarProducto" idProducto="' + idProducto + '" ><i class="fa fa-times"></i></button></td>' +
                '<td><input type="text" class="form-control nombre" idProducto="' + idProducto + '" name="agregarProducto" value="' + nombre + '" readonly required></td>' +
                '<td class="precio-producto"><input type="text" class="form-control precio" value=" ' + precio + '" readonly></td>' +
                '<td><input type="number" class="form-control nuevaCantidadProducto" min="1" max="' + stock + '" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" required></td>' +
                '<td class="precio-total"><input type="text" class="form-control precioFin" value="' + precio + '" readonly></input></td>' +
                '</tr>');

            sumarTotal();
            sumarCount();
        }



    }) /**FIN PETICION AJAX*/

});

/***EVENTO PARA QUITAR PRODUCTO DE LA VENTA*/
$(".product-venta").on("click", ".quitarProducto", function() {
    //console.log("hola");
    /**REMUEVE DE LA LISTA DE PRODUCTOS ES DECIR REMOVEMOS EL TR DE LA LISTA**/
    $(this).parent().parent().remove();

    /**LE ASIGNAMOS LOS VALORES QUE TENIA POR DEFAULT ESTO CON EL FIN DE QUE EL USUARIO PODRA HACER CLICK DE NUEVO EN ELLO**/
    var idProducto = $(this).attr("idProducto");
    $("button.recuperarBoton[idagregar='" + idProducto + "']").removeClass("btn-default");
    $("button.recuperarBoton[idagregar='" + idProducto + "']").addClass("btn-success agregarProducto");

    /**SE REALIZA UN DELETE DEL ID QUE FUE REMOVIDO PARA QUE EN LA SIGUIENTE BUSQUEDA PUEDA MOSTRARSE COMO ACTIVO**/
    $.each(a, function(i, item) {
        if (a[i].idProducto == idProducto) {
            delete a[i].idProducto;
        }

    });

    /**SI NO EXISTE HIJOS EL LA LISTA DE VENTAS HACEMOS UN LIMPIA DE LAS VIARIABLES TOTAL,SUB-TOTAL ETC...**/
    if ($(".product-venta").children().length == 0) {

        $(".sub-total").val(0);
        $(".total-iva").val(0);
        $(".count").val(0);
        $(".total").val(0);
        $(".cambio").val(0);
        $(".descuento").val(0);
        $(".efectivo").val(0);

        /** SI NO EXISTE PRODUCTOS EN LISTA DE VENTAS, QUITAMOS LA CLASE VENTA-MODAL QUE ABRE EL FORMULARIO PARA PAGAR**/
        $("button.venta").removeClass("realizarventa");
        $("button.venta").attr("data-target", "");
        $("button.cancelar").attr("data-target", "");

    }




    sumarTotal();
    sumarCount();

});

/**EVENTO ENCARGADO DE REALIZAR LA SUMA DE CANTIDAD DE PRODUCTOS Y LA SUMA TOTAL DE SUS PRECIO COMO TAMBIEN EL IVA ETC...**/
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

/**FUNCION ENCARGADA DE REALIZAR LA SUMA DE PORDUCTOS QUE HAY EL LISTA DE VENTAS**/
function sumarCount() {
    /**TRAER LA CLASE QUE CONTIENE N CANTIDAD DE PRODUCTOS **/
    var cantidad = $(".nuevaCantidadProducto");
    /**ARRAY QUE FUNCIONA COMO ACUMULADOR DE CANTIDADES**/
    var arrayCount = [];

    /**REALIZAMOS UN PUSH AL ARREGLO DE CANTIDADES**/
    for (var i = 0; i < cantidad.length; i++) {
        arrayCount.push(Number($(cantidad[i]).val()));
    }

    /**FUNCION PARA IR SUMANDO LAS CANTIDADES**/
    function sumarArrayCount(tot, num) {

        return tot + num;

    }

    /**DECLARAMOS UNA VARAIBLE QUE CONTENDRA LA SUMA DE LAS CANTIDADES DE LOS PRODUCTOS**/
    var Sumacantidad = arrayCount.reduce(sumarArrayCount);

    /**LE DAMOS VALOR AL INPUT CON LA CLASE COUNT**/
    $(".count").val(Sumacantidad);
    //console.log(Sumacantidad);
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
    //console.log(sub_total.val());
    $(".total").val(total);

}

/**EVENTO ENCARGADO DE APLICAR DESCUENTO**/
$(".totales").on("change", ".descuento", function() {

    sumarTotal();
    /**TRAEMOS EL PORCENTAJE PARA APLICAR EL DESCUENTO**/
    var porcentaje = $(".descuento").val();

    /**CONVERTIMOS EL PORCENTAJE EN DECIMALES 0.1,0.2 ETC..**/
    var descuento = porcentaje / 100;


    var total = $(".total").val();

    /**APLICAMOS EL DESCUENTO MULTIPLICANDO EL TOTAL POR EL PORCENTAJE DEL DESCUENTO**/
    $(".total").val(total * descuento);

    /**si no hay descuento regresamos a los valores normales**/
    if ($(".total").val() == 0) {
        sumarTotal();
    }

    //console.log(total);
});

/**EVENTO ENCARGADO DE VALIDAR CONTRASEÑA PARA CANCELAR LA VENTA
 * SOLO USUARIOS CON TIPO DE USUARIO ADMIN PUEDEN REALIZAR ESTA ACCION DE LO CONTRARIO NO PODRAN CANCELAR LA VENTA**/
$(".modal-footer").on("click", "button.enviar-contra", function() {

    var contrasena = $("input#contra_admin").val();
    var usuario = $("input#usuario_admin").val();

    var datos = new FormData();
    datos.append("contrasena", contrasena);
    datos.append("usuario", usuario);

    $.ajax({

        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta == 'si') {



                /** BUSCA PRODUCTOS DE LA LISTA PARA REMOVER LA CLASE DEFAULT Y AGREGAR LA CLASE agregarProducto(PUDE SELECCIONAR Y AGREGARLO EN LA LISTA) **/
                $.each(a, function(i, item) {
                    $("button.recuperarBoton[idAgregar='" + a[i].idProducto + "']").removeClass("btn-default");
                    $("button.recuperarBoton[idAgregar='" + a[i].idProducto + "']").addClass("btn-success agregarProducto");

                });

                /**LIMPIAMOS EL ARREGLO**/
                a.length = 0;


                /** LIMPIA LA LISTA DE PRODUCTOS, DEJANDO LOS VALORES DE TOTAL,COUNT,SUB-TOTAL,IVA EN 0 **/
                $(".product-venta").empty();
                if ($(".product-venta").children().length == 0) {
                    $(".sub-total").val(0);
                    $(".total-iva").val(0);
                    $(".count").val(0);
                    $(".total").val(0);
                    $(".cambio").val(0);
                    $(".descuento").val(0);
                    $(".efectivo").val(0);
                    /** SI NO EXISTE PRODUCTOS EN LISTA DE VENTAS, QUITAMOS LA CLASE VENTA-MODAL QUE ABRE EL FORMULARIO PARA PAGAR y EL FORMULARIO DE CANCELAR**/
                    $("button.venta").removeClass("realizarventa");
                    $("button.venta").attr("data-target", "");
                    $("button.cancelar").attr("data-target", "");
                    $("input#contra_admin").val("");
                    $("input#usuario_admin").val("");
                }


            } else {
                alert("!No eres adiministrador¡ o esta incorrecta las credenciales");
                $("input#contra_admin").val("");
                $("input#usuario_admin").val("");
            }


        }
    });


});

/**EVENTO PARA REGRESAR CAMBIO**/
$(".efectivo").on("change", function() {
    var total = $(".total").val();
    var pago = $(this).val();
    $(".cambio").val(pago - total);
})

/**EVENTO PARA REALIZAR LA VENTA
 * DENTRO DEL MODAL SE TIENE UN FORMULARIO CON INPUTS OCULTOS, CUANDO EL USUARIO LE DE CLICK A PAGAR RESIVIRA ESOS VALORES**/
$(".botones").on("click", "button.realizarventa", function() {
    //console.log("hola");
    /**ARREGLO PARA GUARDAR LA LISTA DE PRODUCTOS**/
    var listaProductos = [];

    /**LE ASIGNAMOS COMO VALOR  EL CLIENTE QUE ESTE SELECIONADO AL INPUT CON EL id_cliente**/
    var idCliente = $("#cliente").val();
    $("#id_cliente").val(idCliente);

    /**LE ASIGNAMOS COMO VALOR TOTAL AL INPUT CON EL id total**/
    var total = $(".total").val();
    $("#total_venta").val(total);

    /**LE ASIGNAMOS COMO VALOR COUNT AL INPUT CON EL id cantidad_productos**/
    var count = $(".count").val();
    $("#cantidad_productos").val(count);


    /**REALIZAMOS UN PUSH AL ARREGLO QUE CONTIENE LA INFORMACION DE LOS PRODUCTOS Y SE LE ASIGNA EL VALOR AL INPUT con el id id_productos**/
    var idProducto = $(".quitarProducto");
    var cantidad = $(".nuevaCantidadProducto");
    var nombre = $(".nombre");
    for (var i = 0; i < cantidad.length; i++) {
        listaProductos.push({
            "id": $(idProducto[i]).attr("idProducto"),
            "stock": $(cantidad[i]).val(),
            "nombre": $(nombre[i]).val()
        })
    }
    $("#id_productos").val(JSON.stringify(listaProductos));
});