<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de tipos <i class="fa fa-cube"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado Tipos</li>
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
                        <h3 class="card-title"><b>Listado de tipos</b>
                            - <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/TipoInsumo/create/0');">
                                Nuevo Tipo <i class="fa fa-plus"></i></a></h3>
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
                                                <th>Tipo de insumo</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListadoTipo) && is_array($ListadoTipo)) {
                                                foreach ($ListadoTipo as $ListadoTipo_item) { ?>

                                                    <tr class="odd">
                                                        <td>
                                                            <?php if ($ListadoTipo_item["estado"] == "1") {     ?>
                                                                <a onclick="EstadoTipo(<?php echo $ListadoTipo_item['id']; ?>, '0');" class='btn btn-danger btn-sm' title='Inactivar el tipo'><i class='fa fa-times'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/TipoInsumo/edit/<?php echo $ListadoTipo_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el tipo'><i class='fa fa-edit'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="EstadoTipo(<?php echo $ListadoTipo_item['id']; ?>, '1');" class='btn btn-success btn-sm' title='Activar el tipo'><i class='fa fa-check'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/TipoInsumo/edit/<?php echo $ListadoTipo_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el tipo'><i class='fa fa-edit'></i></button>
                                                                <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListadoTipo_item["tipo"]); ?></td>
                                                        <td>
                                                            <?php if ($ListadoTipo_item["estado"] == "1") {     ?>
                                                                <span class="badge badge-success">Activo</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-danger">Inactivo</span>
                                                            <?php   } ?>
                                                        </td>
                                                    </tr>

                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    No hay tipos disponibles
                                                </tr>

                                            <?php }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Tipo de insumo</th>
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