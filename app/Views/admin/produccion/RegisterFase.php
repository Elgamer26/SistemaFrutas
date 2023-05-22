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
                    <li class="breadcrumb-item active">Formulario fase</li>
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

                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="produccion">Producción disponible</label> <span id="produccion_olbligg" style="color: red;"></span>
                                    <select name="produccion" id="produccion" class="form-control" style="width: 100%;">
                                        <?php if (!empty($produccion) && is_array($produccion)) {  ?>
                                            <option value="0"> --Seleccione el producción--</option>
                                            <?php
                                            foreach ($produccion as $produccion_item) { ?>
                                                <option value="<?= esc($produccion_item["id"]); ?>">Lote: <?= esc($produccion_item["id"]); ?> - <?= esc($produccion_item["nombre"]); ?> - <?= esc($produccion_item["nombreprod"]); ?> - <?= esc($produccion_item["cantidad"]); ?></option>
                                            <?php }
                                        } else { ?>
                                            <option value="0">No hay producción</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fecharegistro">Fecha registro</label>
                                    <input value="<?php echo date("Y-m-d"); ?>" type="date" name="fecharegistro" class="form-control" id="fecharegistro">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="diasproduccion">Fase de producción</label> <span id="dias_olbligg" style="color: red;"></span>
                                    <input readonly value="0" type="text" name="diasproduccion" class="form-control" id="diasproduccion">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="diasproduccion">Registrar</label>
                                    <button class="btn btn-danger" onclick="RegistrarFaseProduccion();"><i class="fa fa-save"></i></button>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detallefase">Detalle de fase</label><span id="detallefase_olbligg" style="color: red;"></span>
                                    <textarea class="form-control" id="detallefase" cols="3" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="card card-warning">
                                    <div class="card-header">
                                        <h3 class="card-title"><b>Detalle de fase producción <i class="fa fa-cubes"></i> </b></h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-lg-12 table-responsive">
                                                &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                                                <table id="detalleInsumo" class="table table-striped table-bordered">
                                                    <thead bgcolor="black" style="color:#fff;">
                                                        <tr>
                                                            <th hidden>Id</th>
                                                            <th>N° fase</th>
                                                            <th>Fase</th>
                                                            <th>Fecha</th>
                                                            <th>Detalle</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="tbody_detalleInsumo">

                                                    </tbody>

                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/registerFase/0');" class='btn btn-danger'>Recargar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/produccion.js"></script>

<script>
    $("#produccion").select2();
</script>