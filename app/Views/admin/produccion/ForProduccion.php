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
                <div class="Formulario card card-<?php echo $color; ?> carro">
                    <div class="card-header">
                        <h3 class="card-title"><b><?php echo $texto; ?></b></h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="nombreproduccion">Nombre de la producción</label> <span id="nombree_olbligg" style="color: red;"></span>
                                    <input type="text" class="form-control" id="nombreproduccion" maxlength="80" placeholder="Ingrese nombre de la producción">
                                </div>
                            </div>

                            <div class="col-md-2" hidden>
                                <div class="form-group">
                                    <label for="fechainicio">Fecha Inicio</label>
                                    <input value="<?php echo date("Y-m-d"); ?>" type="date" name="fechainicio" class="form-control" id="fechainicio">
                                </div>
                            </div>

                            <div class="col-md-2" hidden>
                                <div class="form-group">
                                    <label for="fechaFin">Fecha Fin</label>
                                    <input value="<?php echo date("Y-m-d"); ?>" type="date" name="fechaFin" class="form-control" id="fechaFin">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha registro</label>
                                    <input readonly value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2" hidden>
                                <div class="form-group">
                                    <label for="diasproduccion">Dias producción</label> <span id="dias_olbligg" style="color: red;"></span>
                                    <input readonly value="1" type="text" name="diasproduccion" class="form-control" id="diasproduccion">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="producto">Producto disponible</label> <span id="producto_olbligg" style="color: red;"></span>
                                    <select name="producto" id="producto" class="form-control" style="width: 100%;">
                                        <?php if (!empty($producto) && is_array($producto)) {  ?>
                                            <option value="0"> --Seleccione el producto--</option>
                                            <?php
                                            foreach ($producto as $producto_item) { ?>
                                                <option value="<?= esc($producto_item["id"]); ?>"><?= esc($producto_item["nombre"]); ?> - <?= esc($producto_item["tipo"]); ?></option>
                                            <?php }
                                        } else { ?>
                                            <option value="0">No hay producto</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="cantidadprod">Cantidad</label> <span id="cantidadprod_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event);" value="0" type="text" name="cantidadprod" class="form-control" id="cantidadprod">
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title"><b>Detalle de producción <i class="fa fa-cubes"></i> </b></h3>
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
                                                                                <?php if (!empty($insumo) && is_array($insumo)) { ?>
                                                                                    <option value="0"> --Seleccione el insumo--</option>
                                                                                    <?php
                                                                                    foreach ($insumo as $insumo_item) { ?>
                                                                                        <option value="<?= esc($insumo_item["id"]); ?>"><?= esc($insumo_item["nombre"]); ?> - <?= esc($insumo_item["tipo"]); ?></option>
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
                                                                            <button class="btn btn-success" onclick="AggInsumoDetalle();"><i class="fa fa-plus"></i></button>
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
                                                                                <?php if (!empty($material) && is_array($material)) { ?>
                                                                                    <option value="0"> --Seleccione el material--</option>
                                                                                    <?php
                                                                                    foreach ($material as $material_item) { ?>
                                                                                        <option value="<?= esc($material_item["id"]); ?>"><?= esc($material_item["nombre"]); ?> - <?= esc($material_item["tipo"]); ?></option>
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
                                                                            <button class="btn btn-success" onclick="AggMaterialDetalle();"><i class="fa fa-plus"></i></button>
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
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/list/0');" class='btn btn-danger'>Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/produccion.js"></script>

<script>
    $("#producto").select2();
    $("#insumo").select2();
    $("#material").select2();

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
        var fechaFin = $("#fechaFin").val();

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
            $("#diasproduccion").val("0");
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

        monent(fechainicio, fechaFin);
    });

    $("#fechaFin").change(function() {
        var fechainicio = $("#fechainicio").val();
        var fechaFin = $("#fechaFin").val();

        if (fechainicio > fechaFin) {
            $("#diasproduccion").val("0");
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

        monent(fechainicio, fechaFin);
    });

    // Función para calcular los días transcurridos entre dos fechas
    function monent(fechainicio, fechaFin) {
        var fecha1 = moment(fechainicio);
        var fecha2 = moment(fechaFin);
        $("#diasproduccion").val(fecha2.diff(fecha1, 'days'));

        var dia = $("#diasproduccion").val();

        if (dia > 180) {
            $("#diasproduccion").val("0");
            return Swal.fire(
                "Mensaje de advertencia",
                "Los dias ingresados superan la produccion de 180 dias, una produccion tiene aproximadamente 180 dias",
                "warning"
            );
        }
    }
</script>