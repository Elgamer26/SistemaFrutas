<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de material <i class="fa fa-cubes"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado material</li>
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
                        <h3 class="card-title"><b>Listado de material</b>
                            - <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Material/create/0');">
                                Nuevo Material <i class="fa fa-plus"></i></a></h3>
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
                                                <th>Tipo Material</th>
                                                <th>Precio Compra</th>
                                                <th>Cantidad</th>
                                                <th>Foto</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListaMaterial) && is_array($ListaMaterial)) {
                                                foreach ($ListaMaterial as $ListaMaterial_item) { ?>

                                                    <tr class="odd">
                                                        <td>
                                                            <?php if ($ListaMaterial_item["estado"] == "1") {     ?>
                                                                <a onclick="EstadoMaterial(<?php echo $ListaMaterial_item['id']; ?>, '0');" class='btn btn-danger btn-sm' title='Inactivar el material'><i class='fa fa-times'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Material/edit/<?php echo $ListaMaterial_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el material'><i class='fa fa-edit'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="EstadoMaterial(<?php echo $ListaMaterial_item['id']; ?>, '1');" class='btn btn-success btn-sm' title='Activar el material'><i class='fa fa-check'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Material/edit/<?php echo $ListaMaterial_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el material'><i class='fa fa-edit'></i></button>
                                                                <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListaMaterial_item["codigo"]); ?></td>
                                                        <td><?= esc($ListaMaterial_item["nombre"]); ?></td>
                                                        <td> <span class="badge badge-warning"><?= esc($ListaMaterial_item["tipo"]); ?></span> </td>
                                                        <td>$ <?= esc($ListaMaterial_item["precio"]); ?></td>
                                                        <td> <?= esc($ListaMaterial_item["cantidad"]); ?></td>
                                                        <td><a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Material/foto/<?php echo $ListaMaterial_item['id']; ?>');" style="border: none; border-radius: 50px;" title="Ver Imagen"><img style='border-radius: 50px;' src='<?php echo base_url(); ?>public/img/material/<?= esc($ListaMaterial_item["imagen"]); ?>' width='45px' /></a></td>
                                                        <td><?= esc($ListaMaterial_item["descripcion"]); ?></td>

                                                        <td>
                                                            <?php if ($ListaMaterial_item["estado"] == "1") {     ?>
                                                                <span class="badge badge-success">Activo</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-danger">Inactivo</span>
                                                            <?php   } ?>
                                                        </td>
                                                    </tr>

                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    No hay datos disponibles
                                                </tr>

                                            <?php }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Tipo Material</th>
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