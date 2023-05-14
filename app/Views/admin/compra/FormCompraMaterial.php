<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/CompraMaterial/list/0');">Listado compra</a></li>
                    <li class="breadcrumb-item active">Formulario material</li>
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
                        <input type="hidden" id="CompraInsumoID" value="<?php echo $editar[0]; ?>">
                        <div class="row">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="proveedor">Proveedor</label> <span id="proveedor_olbligg" style="color: red;"></span>
                                    <select name="proveedor" id="proveedor" class="form-control" style="width: 100%;">
                                        <?php if (!empty($proveedor) && is_array($proveedor)) {
                                            foreach ($proveedor as $proveedor_item) { ?>
                                                <option value="<?= esc($proveedor_item["id"]); ?>" <?php if ($proveedor_item['id'] == $editar[3]) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= esc($proveedor_item["razon_social"]); ?></option>
                                            <?php }
                                        } else { ?>
                                            <option value="">No hay proveedor</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechacompra">Fecha Compra</label>
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
                                    <label for="numerocompra">N° compra</label> <span id="numerocompra_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" value="<?php echo $editar[1]; ?>" type="text" class="form-control" id="numerocompra" placeholder="Ingrese numero de compra" maxlength="15">
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title"><b>Detalle del material <i class="fa fa-cubes"></i></h3>
                                        <button onclick="BuscarMaterial();" class="btn btn-danger btn-sm float-right"> <b>Buscar Material <i class="fa fa-search"></i></b> </button>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <div class="col-lg-12 table-responsive">
                                                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                                                        <table id="detalle_compra_material" class="table table-striped table-bordered">
                                                            <thead bgcolor="black" style="color:#fff;">
                                                                <tr>
                                                                    <th hidden>Id</th>
                                                                    <th>Material</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Precio</th>
                                                                    <th>Desc. moneda - dolar</th>
                                                                    <th>Subtotal</th>
                                                                    <th>Accion</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="tbody_detalle_compra_material">

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
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/CompraInsumos/list/0');" class='btn btn-danger'>Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="ModalBuscarMaterial" tabindex="-1" role="dialog" aria-labelledby="ModalBuscarMaterialLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #007bff;">
                <h5 class="modal-title" id="ModalBuscarMaterialLabel" style="color: white;"><b>Insumos Disponibles</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-12 text-center">
                        <div class="card card-primary">
                            <table id="TablaInsumo" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th hidden>Id</th>
                                        <th>Código</th>
                                        <th>Material</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                        <th>Cantidad</th>
                                        <th>Enviar</th>
                                    </tr>
                                </thead>

                                <tbody id="DetalleTablaMaterial">

                                    <?php if (!empty($material) && is_array($material)) {
                                        foreach ($material as $material_item) { ?>

                                            <tr class="odd">

                                                <td hidden><?= esc($material_item["id"]); ?></td>
                                                <td><?= esc($material_item["codigo"]); ?></td>
                                                <td><?= esc($material_item["nombre"]); ?></td>
                                                <td> <span class="badge badge-warning"><?= esc($material_item["tipo"]); ?></span> </td>
                                                <td><?= esc($material_item["precio"]); ?></td>
                                                <td><a style="border: none; border-radius: 50px;" title="Ver Imagen"><img style='border-radius: 50px;' src='<?php echo base_url(); ?>public/img/material/<?= esc($material_item["imagen"]); ?>' width='45px' /></a></td>
                                                <td><?= esc($material_item["cantidad"]); ?></td>

                                                <td>
                                                    <a class='Enviar btn btn-success btn-sm' title='Enviar el material'><i class='fa fa-plus'></i></a>
                                                </td>
                                            </tr>

                                        <?php }
                                    } else { ?>
                                        <tr class="odd">
                                            No hay material disponibles
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th hidden>Id</th>
                                        <th>Código</th>
                                        <th>Material</th>
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

<script src="<?php echo base_url(); ?>public/js/compra.js"></script>

<script>
    $("#proveedor").select2();

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

    function BuscarMaterial() {
        $("#ModalBuscarMaterial").modal("show");
    }

    $(".Enviar").on("click", function() {
        var iva = $("#iva").val();
        var id = $(this).parents("tr").find("td")[0].innerHTML;
        var alimento = $(this).parents("tr").find("td")[2].innerHTML + " - " + $(this).parents("tr").find("td")[3].innerHTML;
        var precio = $(this).parents("tr").find("td")[4].innerHTML;

        if (iva.trim() == "" || iva.length == 0) {
            $("#iva_olbligg").html("Ingrese iva");
            $("#modal_insumo_compra").modal("hide");
            return Swal.fire(
                "Campo vacío",
                "Ingrese un valor en el campos iva",
                "warning"
            );
        } else {
            $("#iva_olbligg").html("");
        }

        if (validar_insumos_id(id)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El insumo: '" +
                alimento +
                "' , ya fue agregado al detalle",
                "warning"
            );
        }

        var datos_agg = "<tr>";
        datos_agg += "<td hidden for='id'>" + id + "</td>";
        datos_agg += "<td>" + alimento + "</td>";
        datos_agg += "<td><input id='cantida_a' style='width: 100px;' type='number' min='1' class='form-control' value='1' placeholder='cantidad' /></td>";
        datos_agg += "<td>" + precio + "</td>";
        datos_agg += "<td><input id='descuento_a' style='width: 100px;' type='text' class='form-control' value='0' placeholder='descuento' onkeypress='return soloNumeros(event);' /></td>";
        datos_agg += "<td>" + precio + "</td>";
        datos_agg +=
            "<td> <button class='remover btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_compra_material").append(datos_agg);
        $("#ModalBuscarMaterial").modal("hide");
        sumartotalneto();
    });

    function validar_insumos_id(id) {
        let idverificar = document.querySelectorAll(
            "#tbody_detalle_compra_material td[for='id']"
        );
        return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
    }

    $("#tbody_detalle_compra_material").on("click", ".remover", function() {
        var td = this.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
        sumartotalneto();
    });

    // para la cantidad del producto
    $("#tbody_detalle_compra_material").on("keyup", "#cantida_a", function() {
        var cantidad = $(this).parents("tr").find('input[type="number"]').val();
        var descuento = $(this).parents("tr").find('#descuento_a').val();
        var precio = $(this).parents("tr").find("td")[3].innerHTML;
        var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
        $(this).parents("tr").find("td")[5].innerHTML = parseFloat(total).toFixed(2);
        sumartotalneto();
    });

    $("#tbody_detalle_compra_material").on("change", "#cantida_a", function() {
        var cantidad = $(this).parents("tr").find('input[type="number"]').val();
        var descuento = $(this).parents("tr").find('#descuento_a').val();
        var precio = $(this).parents("tr").find("td")[3].innerHTML;
        var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
        $(this).parents("tr").find("td")[5].innerHTML = parseFloat(total).toFixed(2);
        sumartotalneto();
    });

    //para el descuento del producto
    $("#tbody_detalle_compra_material").on("keyup", "#descuento_a", function() {
        var cantidad = $(this).parents("tr").find('#cantida_a').val();
        var descuento = $(this).parents("tr").find('#descuento_a').val();
        var precio = $(this).parents("tr").find("td")[3].innerHTML;
        var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
        $(this).parents("tr").find("td")[5].innerHTML = parseFloat(total).toFixed(2);
        sumartotalneto();
    });

    function sumartotalneto() {
        let arreglo_total = new Array();
        let count = 0;
        let total = 0;
        let impuestototal = 0;
        let subtotal = 0;
        let impuesto = document.getElementById("iva").value;

        $("#detalle_compra_material tbody#tbody_detalle_compra_material tr").each(
            function() {
                arreglo_total.push($(this).find("td").eq(5).text());
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