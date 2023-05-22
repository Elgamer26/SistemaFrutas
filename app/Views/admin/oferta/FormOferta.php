<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Formulario oferta</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-<?php echo $color; ?>">
                    <div class="card-header">
                        <h3 class="card-title"><b><?php echo $texto; ?></b></h3>
                    </div>

                    <div class="card-body">

                        <input type="hidden" id="idoferta" value="<?php echo $editar[0]; ?>">

                        <div class="row">

                            <?php if ($ocultar) { ?>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="producto">Producto</label> <span id="producto_olbligg" style="color: red;"></span>
                                        <select name="producto" id="producto" class="traerCantidadProduction form-control" style="width: 100%;">
                                            <?php if (!empty($producto) && is_array($producto)) { ?>
                                                <option value="0">-- Seleccione la producto--</option>
                                                <?php foreach ($producto as $producto_item) { ?>
                                                    <option value="<?= esc($producto_item["id"]); ?>"><?= esc($producto_item["codigo"]); ?> - <?= esc($producto_item["nombre"]); ?> - <?= esc($producto_item["tipo"]); ?></option>
                                                <?php }
                                            } else { ?>
                                                <option value="0">No hay producto</option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            <?php } ?>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechainicio">Fecha inicio</label> <span id="fechainicio_olbligg" style="color: red;"></span>
                                    <input type="date" name="fechainicio" class="form-control" id="fechainicio" value="<?php echo $editar[2]; ?>">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechafin">Fecha fin</label> <span id="fechafin_olbligg" style="color: red;"></span>
                                    <input type="date" name="fechafin" class="form-control" id="fechafin" value="<?php echo $editar[3]; ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipooferta">Tipo de oferta</label> <span id="tipooferta_olbligg" style="color: red;"></span>
                                    <select name="tipooferta" id="tipooferta" class="traerCantidadProduction form-control" style="width: 100%;">
                                        <?php if (!empty($tipo) && is_array($tipo)) { ?>
                                            <?php foreach ($tipo as $tipo_item) { ?>
                                                <option value="<?= esc($tipo_item); ?>" <?php if ($tipo_item == $editar[4]) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= esc($tipo_item); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="valordescuento">Valor descuento</label> <span id="valordescuento_olbligg" style="color: red;"></span>
                                    <input type="text" maxlength="2" <?php if ($editar[4] != "Descuento %") {
                                                                            echo 'readonly';
                                                                        } ?> name="valordescuento" class="form-control" id="valordescuento" value="<?php echo $editar[5]; ?>" onkeypress="return soloNumeros(event);">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">
                        <?php echo $accion; ?> - <?php echo $volver; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/producto.js"></script>

<script>
    $("#producto").select2();

    $("#tipooferta").change(function() {
        let data = $(this).val();

        if (data == "Descuento %") {
            $("#valordescuento").removeAttr("readonly", "readonly");
        } else {
            $("#valordescuento").attr("readonly", "readonly")
            $("#valordescuento").val("0")
        }
    });

    var n = new Date();
    var y = n.getFullYear();
    var m = n.getMonth() + 1;
    var d = n.getDate();
    if (d < 10) {
        d = '0' + d;
    }
    if (m < 10) {
        m = '0' + m;
    }

    fecha_date = y + "-" + m + "-" + d;

    $("#fechainicio").change(function() {
        var fechainicio = $("#fechainicio").val();
        var fechaFin = $("#fechafin").val();

        if (fechainicio < fecha_date) {
            $("#fechainicio").val(fecha_date);
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fechainicio +
                "', es mejor a la fecha actual '" + fecha_date + "'",
                "warning"
            );
        }

        if (fechainicio > fechaFin) {
            $("#fechainicio").val(fecha_date);
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fechainicio +
                "' es mayor a la fecha final '" +
                fechaFin +
                "'",
                "warning"
            );
        }

    });

    $("#fechafin").change(function() {
        var fechainicio = $("#fechainicio").val();
        var fechaFin = $("#fechafin").val();

        if (fechainicio > fechaFin) {
            $("#fechafin").val(fecha_date);
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fechainicio +
                "' es mayor a la fecha final '" +
                fechaFin +
                "'",
                "warning"
            );
        }

    });
</script>