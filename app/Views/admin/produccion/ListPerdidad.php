<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de perdida <i class="fa fa-list"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Lista perdida</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">

                <div class="col-6 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
                    <div class="col-12 col-sm-6 col-md-8 d-flex align-items-stretch flex-column">
                        <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/newperdida/0');">
                            Nueva perdida <i class="fa fa-plus"></i></a>
                    </div>
                </div>


                <br><br>

                <div class="col-sm-12 text-center">

                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                        <thead>
                            <tr>
                                <th>Opción</th>
                                <th>Producción</th>
                                <th>Fecha</th>
                                <th>Cantidad perdida</th>
                                <th>Usuario</th>
                                <th>Descripción</th>
                                <th>Estado producción</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (!empty($perdida) && is_array($perdida)) {
                                foreach ($perdida as $perdida_item) { ?>

                                    <tr class="odd">
                                        <td>
                                            <?php if ($perdida_item["estadoproduccion"] == "1") { ?>
                                                <a onclick="EliminarLaPerdida('<?php echo $perdida_item['id']; ?>', '<?php echo $perdida_item['cantidad']; ?>', '<?php echo $perdida_item['idproduccion']; ?>')" class='editar btn btn-danger btn-sm' title='Eliminar la perdida'><i class='fa fa-trash'></i></a>
                                            <?php   } else {     ?>
                                                <a disabled class='editar btn btn-default btn-sm' title='Produccion finalizada no se puede eliminar'><i class='fa fa-ban'></i></a>
                                            <?php   } ?>

                                        </td>
                                        <td><?= esc($perdida_item["lote"]); ?> - <?= esc($perdida_item["nombre"]); ?></td>
                                        <td><?= esc($perdida_item["fecha"]); ?></td>
                                        <td><?= esc($perdida_item["cantidad"]); ?> </td>
                                        <td><?= esc($perdida_item["nombres"]); ?></td>
                                        <td><?= esc($perdida_item["detalle"]); ?></td>

                                        <td>
                                            <?php if ($perdida_item["estadoproduccion"] == "1") { ?>
                                                <span class="badge badge-success">Iniciado</span>
                                            <?php   } else {     ?>
                                                <span class="badge badge-danger">Finalizado</span>
                                            <?php   } ?>
                                        </td>

                                    </tr>

                                <?php }
                            } else { ?>
                                <tr class="odd">
                                    No hay perdida disponibles
                                </tr>

                            <?php }
                            ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Opción</th>
                                <th>Producción</th>
                                <th>Fecha</th>
                                <th>Cantidad perdida</th>
                                <th>Usuario</th>
                                <th>Descripción</th>
                                <th>Estado producción</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>


    </div>

</section>

<script src="<?php echo base_url(); ?>public/js/produccion.js"></script>