<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de insumos <i class="fa fa-cubes"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado insumos</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>Listado de insumos</b>
                            - <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Insumos/create/0');">
                                Nuevo Insumo <i class="fa fa-plus"></i></a></h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Tipo Insumo</th>
                                                <th>Precio Compra</th>
                                                <th>Cantidad</th>
                                                <th>Foto</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListaInsumo) && is_array($ListaInsumo)) {
                                                foreach ($ListaInsumo as $ListaInsumo_item) { ?>

                                                    <tr class="odd">
                                                        <td>
                                                            <?php if ($ListaInsumo_item["estado"] == "1") {     ?>
                                                                <a onclick="EstadoInsumo(<?php echo $ListaInsumo_item['id']; ?>, '0');" class='btn btn-danger btn-sm' title='Inactivar el insumo'><i class='fa fa-times'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Insumos/edit/<?php echo $ListaInsumo_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el insumo'><i class='fa fa-edit'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="EstadoInsumo(<?php echo $ListaInsumo_item['id']; ?>, '1');" class='btn btn-success btn-sm' title='Activar el insumo'><i class='fa fa-check'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Insumos/edit/<?php echo $ListaInsumo_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el insumo'><i class='fa fa-edit'></i></button>
                                                                <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListaInsumo_item["codigo"]); ?></td>
                                                        <td><?= esc($ListaInsumo_item["nombre"]); ?></td>
                                                        <td> <span class="badge badge-warning"><?= esc($ListaInsumo_item["tipo"]); ?></span> </td>
                                                        <td>$ <?= esc($ListaInsumo_item["precio"]); ?></td>
                                                        <td> <?= esc($ListaInsumo_item["cantidad"]); ?></td>
                                                        <td><a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Insumos/foto/<?php echo $ListaInsumo_item['id']; ?>');" style="border: none; border-radius: 50px;" title="Ver Imagen"><img style='border-radius: 50px;' src='<?php echo base_url(); ?>public/img/insumo/<?= esc($ListaInsumo_item["imagen"]); ?>' width='45px' /></a></td>
                                                        <td><?= esc($ListaInsumo_item["descripcion"]); ?></td>

                                                        <td>
                                                            <?php if ($ListaInsumo_item["estado"] == "1") {     ?>
                                                                <span class="badge badge-success">Activo</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-danger">Inactivo</span>
                                                            <?php   } ?>
                                                        </td>
                                                    </tr>

                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    No hay Tipos disponibles
                                                </tr>

                                            <?php }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Tipo Insumo</th>
                                                <th>Precio Compra</th>
                                                <th>Cantidad</th>
                                                <th>Foto</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/InsumoMaterial.js"></script>