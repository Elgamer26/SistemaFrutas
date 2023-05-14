<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/list/0');">Listado producción</a></li>
                    <li class="breadcrumb-item active">Formulario producción</li>
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombreproduccion">Nombre de la producción</label>
                                    <input type="text" class="form-control" id="nombreproduccion" maxlength="80" placeholder="Ingrese nombre de la producción">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechainicio">Fecha Inicio</label>
                                    <input value="<?php echo date("Y-m-d"); ?>" type="date" name="fechainicio" class="form-control" id="fechainicio">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechaFin">Fecha Fin</label>
                                    <input value="<?php echo date("Y-m-d"); ?>" type="date" name="fechaFin" class="form-control" id="fechaFin">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="diasproduccion">Dias producción</label>
                                    <input readonly value="0" type="text" name="diasproduccion" class="form-control" id="diasproduccion">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="producto">Producto disponible</label> <span id="producto_olbligg" style="color: red;"></span>
                                    <select name="producto" id="producto" class="form-control" style="width: 100%;">
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

                            <div class="col-md-12 text-center">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title"><b>Detalle de producción <i class="fa fa-cubes"></i></h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-12 col-sm-12">
                                                <div class="card card-primary card-tabs">

                                                    <div class="card-header p-0 pt-1">
                                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Insumos</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Materiales</a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="tab-content" id="custom-tabs-one-tabContent">

                                                            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                                <div class="row">

                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label for="insumo">Insumo</label> <span id="insumo_olbligg" style="color: red;"></span>
                                                                            <select name="insumo" id="insumo" class="form-control" style="width: 100%;">
                                                                                <?php if (!empty($proveedor) && is_array($proveedor)) {
                                                                                    foreach ($proveedor as $proveedor_item) { ?>
                                                                                        <option value="<?= esc($proveedor_item["id"]); ?>" <?php if ($proveedor_item['id'] == $editar[3]) {
                                                                                                                                                echo 'selected';
                                                                                                                                            } ?>><?= esc($proveedor_item["razon_social"]); ?></option>
                                                                                    <?php }
                                                                                } else { ?>
                                                                                    <option value="">No hay insumo</option>
                                                                                <?php }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="insumodisponible">Disponible</label> <span id="insumodisponible_olbligg" style="color: red;"></span>
                                                                            <input readonly value="0" type="text" name="insumodisponible" class="form-control" id="insumodisponible">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="cantidadInsumo">Cantidad</label> <span id="cantidadInsumo_olbligg" style="color: red;"></span>
                                                                            <input onkeypress="return soloNumeros(event);" value="0" type="text" name="cantidadInsumo" class="form-control" id="cantidadInsumo" maxlength="7">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-1">
                                                                        <div class="form-group">
                                                                            <label>Agregar</label>
                                                                            <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-12 table-responsive">
                                                                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                                                                        <table id="detalleInsumo" class="table table-striped table-bordered">
                                                                            <thead bgcolor="black" style="color:#fff;">
                                                                                <tr>
                                                                                    <th hidden>Id</th>
                                                                                    <th>Insumo</th>
                                                                                    <th>Cantidad</th>
                                                                                    <th>Accion</th>
                                                                                </tr>
                                                                            </thead>

                                                                            <tbody id="tbody_detalleInsumo">

                                                                            </tbody>

                                                                        </table>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                                                <div class="row">

                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label for="material">Material</label> <span id="material_olbligg" style="color: red;"></span>
                                                                            <select name="material" id="material" class="form-control" style="width: 100%;">
                                                                                <?php if (!empty($proveedor) && is_array($proveedor)) {
                                                                                    foreach ($proveedor as $proveedor_item) { ?>
                                                                                        <option value="<?= esc($proveedor_item["id"]); ?>" <?php if ($proveedor_item['id'] == $editar[3]) {
                                                                                                                                                echo 'selected';
                                                                                                                                            } ?>><?= esc($proveedor_item["razon_social"]); ?></option>
                                                                                    <?php }
                                                                                } else { ?>
                                                                                    <option value="">No hay material</option>
                                                                                <?php }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="materialDisponible">Disponible</label> <span id="materialDisponible_olbligg" style="color: red;"></span>
                                                                            <input readonly value="0" type="text" name="materialDisponible" class="form-control" id="materialDisponible">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="cantidadMaterial">Cantidad</label> <span id="cantidadMaterial_olbligg" style="color: red;"></span>
                                                                            <input onkeypress="return soloNumeros(event);" value="0" type="text" name="cantidadMaterial" class="form-control" id="cantidadMaterial" maxlength="7">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-1">
                                                                        <div class="form-group">
                                                                            <label>Agregar</label>
                                                                            <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-12 table-responsive">
                                                                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                                                                        <table id="detalleMaterial" class="table table-striped table-bordered">
                                                                            <thead bgcolor="black" style="color:#fff;">
                                                                                <tr>
                                                                                    <th hidden>Id</th>
                                                                                    <th>Material</th>
                                                                                    <th>Cantidad</th>
                                                                                    <th>Accion</th>
                                                                                </tr>
                                                                            </thead>

                                                                            <tbody id="tbody_detalleMaterial">

                                                                            </tbody>

                                                                        </table>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
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

<div class="modal fade" id="ModalBuscarInsumo" tabindex="-1" role="dialog" aria-labelledby="ModalBuscarInsumoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #007bff;">
                <h5 class="modal-title" id="ModalBuscarInsumoLabel" style="color: white;"><b>Insumos Disponibles</b></h5>
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
                                        <th>Insumo</th>
                                        <th>Tipo</th>
                                        <th>Precio</th>
                                        <th>Imagen</th>
                                        <th>Cantidad</th>
                                        <th>Enviar</th>
                                    </tr>
                                </thead>

                                <tbody id="DetalleTablaInsumo">

                                    <?php if (!empty($insumo) && is_array($insumo)) {
                                        foreach ($insumo as $insumo_item) { ?>

                                            <tr class="odd">

                                                <td hidden><?= esc($insumo_item["id"]); ?></td>
                                                <td><?= esc($insumo_item["codigo"]); ?></td>
                                                <td><?= esc($insumo_item["nombre"]); ?></td>
                                                <td> <span class="badge badge-warning"><?= esc($insumo_item["tipo"]); ?></span> </td>
                                                <td><?= esc($insumo_item["precio"]); ?></td>
                                                <td><a style="border: none; border-radius: 50px;" title="Ver Imagen"><img style='border-radius: 50px;' src='<?php echo base_url(); ?>public/img/insumo/<?= esc($insumo_item["imagen"]); ?>' width='45px' /></a></td>
                                                <td><?= esc($insumo_item["cantidad"]); ?></td>

                                                <td>
                                                    <a class='Enviar btn btn-success btn-sm' title='Enviar el insumo'><i class='fa fa-plus'></i></a>
                                                </td>
                                            </tr>

                                        <?php }
                                    } else { ?>
                                        <tr class="odd">
                                            No hay insumo disponibles
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th hidden>Id</th>
                                        <th>Código</th>
                                        <th>Insumo</th>
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

<script src="<?php echo base_url(); ?>public/js/produccion.js"></script>

<script>
    $("#producto").select2();
    $("#insumo").select2();
    $("#material").select2();
    

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

    function BuscarInsumo() {
        $("#ModalBuscarInsumo").modal("show");
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
        $("#tbody_detalle_compra_insumo").append(datos_agg);
        $("#ModalBuscarInsumo").modal("hide");
        sumartotalneto();
    });

    function validar_insumos_id(id) {
        let idverificar = document.querySelectorAll(
            "#tbody_detalle_compra_insumo td[for='id']"
        );
        return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
    }

    $("#tbody_detalle_compra_insumo").on("click", ".remover", function() {
        var td = this.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
        sumartotalneto();
    });

    // para la cantidad del producto
    $("#tbody_detalle_compra_insumo").on("keyup", "#cantida_a", function() {
        var cantidad = $(this).parents("tr").find('input[type="number"]').val();
        var descuento = $(this).parents("tr").find('#descuento_a').val();
        var precio = $(this).parents("tr").find("td")[3].innerHTML;
        var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
        $(this).parents("tr").find("td")[5].innerHTML = parseFloat(total).toFixed(2);
        sumartotalneto();
    });

    $("#tbody_detalle_compra_insumo").on("change", "#cantida_a", function() {
        var cantidad = $(this).parents("tr").find('input[type="number"]').val();
        var descuento = $(this).parents("tr").find('#descuento_a').val();
        var precio = $(this).parents("tr").find("td")[3].innerHTML;
        var total = parseFloat(precio).toFixed(2) * parseInt(cantidad) - parseInt(descuento);
        $(this).parents("tr").find("td")[5].innerHTML = parseFloat(total).toFixed(2);
        sumartotalneto();
    });

    //para el descuento del producto
    $("#tbody_detalle_compra_insumo").on("keyup", "#descuento_a", function() {
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

        $("#detalle_compra_insumo tbody#tbody_detalle_compra_insumo tr").each(
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