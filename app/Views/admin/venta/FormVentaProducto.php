<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/ventas/list/0');">Listado venta</a></li>
                    <li class="breadcrumb-item active">Formulario venta</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-<?php echo $color; ?> carro">
                    <div class="card-header">
                        <h3 class="card-title"><b><?php echo $texto; ?></b></h3>
                    </div>

                    <div class="card-body">
                        <input type="hidden" id="VentaId" value="<?php echo $editar[0]; ?>">
                        <div class="row">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label> <span id="cliente_olbligg" style="color: red;"></span>
                                    <select name="cliente" id="cliente" class="form-control" style="width: 100%;">
                                        <?php if (!empty($cliente) && is_array($cliente)) { ?>

                                            <option value="0">--Seleccione el cliente--</option>

                                            <?php foreach ($cliente as $cliente_item) { ?>
                                                <option value="<?= esc($cliente_item["id"]); ?>" <?php if ($cliente_item['id'] == $editar[3]) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= esc($cliente_item["cedula"]); ?> - <?= esc($cliente_item["nombre"]); ?></option>
                                            <?php }
                                        } else { ?>
                                            <option value="0">No hay Cliente</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechacompra">Fecha venta</label>
                                    <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" name="fechacompra" class="form-control" id="fechacompra">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tipo_comprobante">Tipo comprobante</label>
                                    <select name="tipo_comprobante" id="tipo_comprobante" class="form-control" style="width: 100%;">

                                        <?php if (!empty($comprobante) && is_array($comprobante)) {
                                            foreach ($comprobante as $comprobante_item) { ?>
                                                <option value="<?= esc($comprobante_item); ?>"> <?= esc($comprobante_item); ?></option>
                                            <?php }
                                        } else { ?>
                                            <option value="">No hay comprobante</option>
                                        <?php }
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="iva">Iva%</label> <span id="iva_olbligg" style="color: red;"></span>
                                    <input readonly onkeypress="return filterfloat(event, this);" value="0" type="text" class="form-control" id="iva" placeholder="Ingrese Iva" maxlength="5">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="numeroventa">N° venta</label> <span id="numeroventa_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" value="<?php echo $editar[1]; ?>" type="text" class="form-control" id="numeroventa" placeholder="Ingrese numero de compra" maxlength="15">
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title"><b>Detalle del producto </b> <i class="fa fa-cubes"></i></h3>
                                        <button onclick="BuscarProducto();" class="btn btn-danger btn-sm float-right"> <b>Buscar producto <i class="fa fa-search"></i></b> </button>
                                        <span class="float-right">-</span>
                                        <button onclick="BuscarOferta();" class="btn btn-primary btn-sm float-right"> <b>Buscar oferta <i class="fa fa-search"></i></b> </button>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <div class="col-lg-12 table-responsive">
                                                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                                                        <table id="detalle_venta_producto" class="table table-striped table-bordered">
                                                            <thead bgcolor="black" style="color:#fff;">
                                                                <tr>
                                                                    <th hidden>Id</th>
                                                                    <th>Producto</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Sale</th>
                                                                    <th>Precio</th>
                                                                    <th>Desc. moneda - dolar</th>
                                                                    <th>Tipo oferta</th>
                                                                    <th>Descuento %</th>
                                                                    <th>Subtotal</th>
                                                                    <th>Accion</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="tbody_detalle_venta_producto">

                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-10">
                                            </div>

                                            <div class="col-md-2 col-2 text-center float-right">
                                                <div class="row float-right" style="border: solid 1px; border-radius: 10px;">

                                                    <div class="form-group col-lg-12 col-6">
                                                        <label for="subtotal">Subtotal:</label>
                                                        <input readonly type="number" class="form-control" value="0.00" id="subtotal" />
                                                    </div>

                                                    <div class="form-group col-lg-12 col-6">
                                                        <label for="impuesto_sub">Impuesto:</label>
                                                        <input readonly type="number" class="form-control" value="0.00" id="impuesto_sub" />
                                                    </div>

                                                    <div class="form-group col-lg-12 col-6">
                                                        <label for="total_pagar">Total a pagar:</label>
                                                        <input readonly type="number" class="form-control" value="0.00" id="total_pagar" />
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/ventas/new/0');" class='btn btn-danger'>Limpiar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="ModalBuscarProducto" tabindex="-1" role="dialog" aria-labelledby="ModalBuscarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #28a745;">
                <h5 class="modal-title" id="ModalBuscarProductoLabel" style="color: white;"><b>Productos Disponibles</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 text-center">
                        <div class="card card-primary">
                            <table id="TablaProducto" class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th hidden>Id</th>
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                        <th>Cantidad</th>
                                        <th>Enviar</th>
                                    </tr>
                                </thead>

                                <tbody id="DetalleTablaProducto">

                                    <?php if (!empty($producto) && is_array($producto)) {
                                        foreach ($producto as $producto_item) { ?>

                                            <tr class="odd">

                                                <td hidden><?= esc($producto_item["id"]); ?></td>
                                                <td><?= esc($producto_item["codigo"]); ?></td>
                                                <td><?= esc($producto_item["nombre"]); ?></td>
                                                <td> <span class="badge badge-warning"><?= esc($producto_item["tipo"]); ?></span> </td>
                                                <td><?= esc($producto_item["precio"]); ?></td>
                                                <td><a style="border: none; border-radius: 50px;" title="Ver Imagen"><img style='border-radius: 50px;' src='<?php echo base_url(); ?>public/img/producto/<?= esc($producto_item["imagen"]); ?>' width='45px' /></a></td>
                                                <td><?= esc($producto_item["cantidad"]); ?></td>

                                                <td>
                                                    <a class='Enviar btn btn-success btn-sm' title='Enviar el producto'><i class='fa fa-plus'></i></a>
                                                </td>
                                            </tr>

                                        <?php }
                                    } else { ?>
                                        <tr class="odd">
                                            No hay producto disponibles
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th hidden>Id</th>
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                        <th>Cantidad</th>
                                        <th>Enviar</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalBuscarOferta" tabindex="-1" role="dialog" aria-labelledby="ModalBuscarOfertaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #28a745;">
                <h5 class="modal-title" id="ModalBuscarOfertaLabel" style="color: white;"><b>Ofertas Disponibles</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 text-center">
                        <div class="card card-primary">
                            <table id="TablaOfertas" class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th hidden>Id</th>
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                        <th>Fecha fin</th>
                                        <th>Oferta</th>
                                        <th>Descuento %</th>
                                        <th>Cantidad</th>
                                        <th>Enviar</th>
                                    </tr>
                                </thead>

                                <tbody id="DetalleTablaOfertas">

                                    <?php if (!empty($ofertas) && is_array($ofertas)) {
                                        foreach ($ofertas as $ofertas_item) { ?>

                                            <tr class="odd">

                                                <td hidden><?= esc($ofertas_item["id"]); ?></td>
                                                <td><?= esc($ofertas_item["codigo"]); ?></td>
                                                <td><?= esc($ofertas_item["nombre"]); ?></td>
                                                <td> <span class="badge badge-warning"><?= esc($ofertas_item["tipo"]); ?></span> </td>
                                                <td><?= esc($ofertas_item["precio"]); ?></td>
                                                <td><a style="border: none; border-radius: 50px;" title="Ver Imagen"><img style='border-radius: 50px;' src='<?php echo base_url(); ?>public/img/producto/<?= esc($ofertas_item["imagen"]); ?>' width='45px' /></a></td>

                                                <td><span class="badge badge-primary"><?= esc($ofertas_item["fecha_fin"]); ?></span> </td>
                                                <td><?= esc($ofertas_item["tipo_oferta"]); ?></td>
                                                <td><?= esc($ofertas_item["valor_descuento"]); ?></td>

                                                <td><?= esc($ofertas_item["cantidad"]); ?></td>

                                                <td>
                                                    <a class='Enviar_oferta btn btn-success btn-sm' title='Enviar el ofertas'><i class='fa fa-plus'></i></a>
                                                </td>
                                            </tr>

                                        <?php }
                                    } else { ?>
                                        <tr class="odd">
                                            No hay ofertas disponibles
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th hidden>Id</th>
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                        <th>Fecha fin</th>
                                        <th>Oferta</th>
                                        <th>Descuento %</th>
                                        <th>Cantidad</th>
                                        <th>Enviar</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/js/venta.js"></script>

<script>
    $("#cliente").select2();

    $("#tipo_comprobante").change(function() {
        let data = $(this).val();

        if (data == "Factura") {
            $("#iva").removeAttr("readonly", "readonly");
            $("#iva").val("12");
        } else {
            $("#iva").attr("readonly", "readonly");
            $("#iva").val("0");
        }

    });

    function BuscarProducto() {
        $("#ModalBuscarProducto").modal("show");
    }

    function BuscarOferta() {
        $("#ModalBuscarOferta").modal("show");
    }

    $(".Enviar").on("click", function() {
        var iva = $("#iva").val();
        var id = $(this).parents("tr").find("td")[0].innerHTML;
        var alimento = $(this).parents("tr").find("td")[2].innerHTML;
        var precio = $(this).parents("tr").find("td")[4].innerHTML;

        if (iva.trim() == "" || iva.length == 0) {
            $("#iva_olbligg").html("Ingrese iva");
            $("#ModalBuscarProducto").modal("hide");
            return Swal.fire(
                "Campo vacío",
                "Ingrese un valor en el campos iva",
                "warning"
            );
        } else {
            $("#iva_olbligg").html("");
        }

        if (validarproducto(id)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El producto: '" +
                alimento +
                "' , ya fue agregado al detalle",
                "warning"
            );
        }

        var datos_agg = "<tr>";
        datos_agg += "<td hidden for='id'>" + id + "</td>";
        datos_agg += "<td>" + alimento + "</td>";
        datos_agg += "<td><input id='cantida_a' style='width: 100px;' type='number' min='1' class='form-control' value='1' placeholder='cantidad' /></td>";
        datos_agg += "<td>1</td>";
        datos_agg += "<td><input id='precio_a' style='width: 100px;' type='text' class='form-control' value='" + precio + "' placeholder='precio' onkeypress='return filterfloat(event, this);' /></td>";

        // datos_agg += "<td>" + precio + "</td>";
        datos_agg += "<td><input id='descuento_a' style='width: 100px;' type='text' class='form-control' value='0' placeholder='descuento' onkeypress='return soloNumeros(event);' /></td>";
        datos_agg += "<td>No oferta</td>";
        datos_agg += "<td>0</td>";
        datos_agg += "<td>" + precio + "</td>";
        datos_agg +=
            "<td> <button class='remover btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_venta_producto").append(datos_agg);
        $("#ModalBuscarProducto").modal("hide");
        sumartotalneto();
    });

    $(".Enviar_oferta").on("click", function() {
        var iva = $("#iva").val();
        var id = $(this).parents("tr").find("td")[0].innerHTML;
        var alimento = $(this).parents("tr").find("td")[2].innerHTML;
        var precio = $(this).parents("tr").find("td")[4].innerHTML;

        var oferta = $(this).parents("tr").find("td")[7].innerHTML;
        var descuento_oferta = $(this).parents("tr").find("td")[8].innerHTML;

        if (iva.trim() == "" || iva.length == 0) {
            $("#iva_olbligg").html("Ingrese iva");
            $("#ModalBuscarOferta").modal("hide");
            return Swal.fire(
                "Campo vacío",
                "Ingrese un valor en el campos iva",
                "warning"
            );
        } else {
            $("#iva_olbligg").html("");
        }

        if (validarproducto(id)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El producto: '" +
                alimento +
                "' , ya fue agregado al detalle",
                "warning"
            );
        }

        let sale = 0;
        let descoferta = 0;
        if (oferta == "3x1") {
            sale = 3;
        } else if (oferta == "2x1") {
            sale = 2;
        } else if (oferta == "Descuento %") {
            sale = 1;
            descoferta = parseFloat(precio * descuento_oferta / 100).toFixed(2);
        }

        var datos_agg = "<tr>";
        datos_agg += "<td hidden for='id'>" + id + "</td>";
        datos_agg += "<td>" + alimento + "</td>";
        datos_agg += "<td><input id='cantida_a' style='width: 100px;' type='number' min='1' class='form-control' value='1' placeholder='cantidad' /></td>";
        datos_agg += "<td>" + sale + "</td>";
        datos_agg += "<td><input id='precio_a' style='width: 100px;' type='text' class='form-control' value='" + precio + "' placeholder='precio' onkeypress='return filterfloat(event, this);' /></td>";
        datos_agg += "<td><input id='descuento_a' style='width: 100px;' type='text' class='form-control' value='0' placeholder='descuento' onkeypress='return soloNumeros(event);' /></td>";
        datos_agg += "<td>" + oferta.toString() + "</td>";
        datos_agg += "<td>" + descuento_oferta + "</td>";
        datos_agg += "<td>" + parseFloat(precio - descoferta).toFixed(2) + "</td>";
        datos_agg += "<td> <button class='remover btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_venta_producto").append(datos_agg);
        $("#ModalBuscarOferta").modal("hide");
        sumartotalneto();
    });

    function validarproducto(id) {
        let idverificar = document.querySelectorAll(
            "#tbody_detalle_venta_producto td[for='id']"
        );
        return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
    }

    $("#tbody_detalle_venta_producto").on("click", ".remover", function() {
        var td = this.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
        sumartotalneto();
    });

    // para la cantidad del producto
    $("#tbody_detalle_venta_producto").on("keyup", "#cantida_a", function() {
        var cantidad = $(this).parents("tr").find('input[type="number"]').val();
        var descuento = $(this).parents("tr").find('#descuento_a').val();
        var precio = $(this).parents("tr").find('#precio_a').val();

        var oferta = $(this).parents("tr").find("td")[6].innerHTML;
        var descuento_oferta = $(this).parents("tr").find("td")[7].innerHTML;

        if (oferta == "3x1") {

            $(this).parents("tr").find("td")[3].innerHTML = parseInt(cantidad) * parseInt(3);
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        } else if (oferta == "2x1") {

            $(this).parents("tr").find("td")[3].innerHTML = parseInt(cantidad) * parseInt(2);
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        } else if (oferta == "Descuento %") {

            $(this).parents("tr").find("td")[3].innerHTML = cantidad;
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total - descuento_oferta).toFixed(2);
            return sumartotalneto();

        } else {

            $(this).parents("tr").find("td")[3].innerHTML = cantidad;
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        }

        // var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
        // $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
        // sumartotalneto();
    });

    $("#tbody_detalle_venta_producto").on("change", "#cantida_a", function() {
        var cantidad = $(this).parents("tr").find('input[type="number"]').val();
        var descuento = $(this).parents("tr").find('#descuento_a').val();
        var precio = $(this).parents("tr").find('#precio_a').val();

        var oferta = $(this).parents("tr").find("td")[6].innerHTML;
        var descuento_oferta = $(this).parents("tr").find("td")[7].innerHTML;

        if (oferta == "3x1") {

            $(this).parents("tr").find("td")[3].innerHTML = parseInt(cantidad) * parseInt(3);
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        } else if (oferta == "2x1") {

            $(this).parents("tr").find("td")[3].innerHTML = parseInt(cantidad) * parseInt(2);
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        } else if (oferta == "Descuento %") {

            $(this).parents("tr").find("td")[3].innerHTML = cantidad;
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total - descuento_oferta).toFixed(2);
            return sumartotalneto();

        } else {

            $(this).parents("tr").find("td")[3].innerHTML = cantidad;
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        }

    });

    //para el descuento del producto
    $("#tbody_detalle_venta_producto").on("keyup", "#descuento_a", function() {
        var cantidad = $(this).parents("tr").find('#cantida_a').val();
        var descuento = $(this).parents("tr").find('#descuento_a').val();
        //var precio = $(this).parents("tr").find("td")[4].innerHTML;
        var precio = $(this).parents("tr").find('#precio_a').val();

        var oferta = $(this).parents("tr").find("td")[6].innerHTML;
        var descuento_oferta = $(this).parents("tr").find("td")[7].innerHTML;

        if (oferta == "3x1") {

            $(this).parents("tr").find("td")[3].innerHTML = parseInt(cantidad) * parseInt(3);
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        } else if (oferta == "2x1") {

            $(this).parents("tr").find("td")[3].innerHTML = parseInt(cantidad) * parseInt(2);
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        } else if (oferta == "Descuento %") {

            $(this).parents("tr").find("td")[3].innerHTML = cantidad;
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total - descuento_oferta).toFixed(2);
            return sumartotalneto();

        } else {

            $(this).parents("tr").find("td")[3].innerHTML = cantidad;
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        }

    });

    //para el PRECIO del producto
    $("#tbody_detalle_venta_producto").on("keyup", "#precio_a", function() {
        var cantidad = $(this).parents("tr").find('#cantida_a').val();
        var descuento = $(this).parents("tr").find('#descuento_a').val();
        //var precio = $(this).parents("tr").find("td")[4].innerHTML;
        var precio = $(this).parents("tr").find('#precio_a').val();

        var oferta = $(this).parents("tr").find("td")[6].innerHTML;
        var descuento_oferta = $(this).parents("tr").find("td")[7].innerHTML;

        if (oferta == "3x1") {

            $(this).parents("tr").find("td")[3].innerHTML = parseInt(cantidad) * parseInt(3);
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        } else if (oferta == "2x1") {

            $(this).parents("tr").find("td")[3].innerHTML = parseInt(cantidad) * parseInt(2);
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        } else if (oferta == "Descuento %") {

            $(this).parents("tr").find("td")[3].innerHTML = cantidad;
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total - descuento_oferta).toFixed(2);
            return sumartotalneto();

        } else {

            $(this).parents("tr").find("td")[3].innerHTML = cantidad;
            var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
            $(this).parents("tr").find("td")[8].innerHTML = parseFloat(total).toFixed(2);
            return sumartotalneto();

        }

    });

    function sumartotalneto() {
        let arreglo_total = new Array();
        let count = 0;
        let total = 0;
        let impuestototal = 0;
        let subtotal = 0;
        let impuesto = document.getElementById("iva").value;

        $("#detalle_venta_producto tbody#tbody_detalle_venta_producto tr").each(
            function() {
                arreglo_total.push($(this).find("td").eq(8).text());
                count++;
            }
        );

        for (var i = 0; i < count; i++) {
            var suma = arreglo_total[i];
            subtotal = (parseFloat(subtotal) + parseFloat(suma)).toFixed(2);
            impuestototal = parseFloat(subtotal * impuesto / 100).toFixed(2);
        }
        total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

        $("#subtotal").val(subtotal);
        $("#impuesto_sub").val(impuestototal);
        $("#total_pagar").val(total);

    }
</script>