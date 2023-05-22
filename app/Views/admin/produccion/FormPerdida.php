<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/perdida/0');">Listado perdida</a></li>
                    <li class="breadcrumb-item active">Formulario producto</li>
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

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="produccion">Producción</label> <span id="produccion_olbligg" style="color: red;"></span>
                                    <select name="produccion" id="produccion" class="traerCantidadProduction form-control" style="width: 100%;">
                                        <?php if (!empty($produccion) && is_array($produccion)) { ?>
                                            <option value="0">-- Seleccione la producción--</option>
                                            <?php foreach ($produccion as $produccion_item) { ?>
                                                <option value="<?= esc($produccion_item["id"]); ?>">Lote: <?= esc($produccion_item["id"]); ?> - <?= esc($produccion_item["nombre"]); ?> - <?= esc($produccion_item["nombreprod"]); ?></option>
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
                                    <label for="disponibleprod">Disponible</label> <span id="disponibleprod_olbligg" style="color: red;"></span>
                                    <input readonly onkeypress="return soloNumeros(event)" value="0" type="text" name="disponibleprod" class="form-control" id="disponibleprod">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="cantidadperdida">Cantidad</label> <span id="cantidadperdida_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" type="text" name="cantidadperdida" class="form-control" id="cantidadperdida" placeholder="Ingrese cantidad perdida" maxlength="5">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechaperdida">Fecha perdida</label> <span id="fechaperdida_olbligg" style="color: red;"></span>
                                    <input type="date" name="fechaperdida" class="form-control" id="fechaperdida" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detalleperdida">Descripción de la perdida</label> <span id="detalleperdida_olbligg" style="color: red;"></span>
                                    <textarea class="form-control" id="detalleperdida" cols="3" rows="3"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/perdida/0');" class='btn btn-danger'>Volver</a>
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