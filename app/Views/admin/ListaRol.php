<style>
    input[type="checkbox"] {
        position: relative;
        width: 60px;
        height: 30px;
        -webkit-appearance: none;
        background: rgb(168, 168, 168);
        outline: none;
        border-radius: 15px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, .5);
    }

    input:checked[type="checkbox"] {
        background: #28a745;
    }

    input[type="checkbox"]:before {
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        border-radius: 20px;
        top: 0;
        left: 0;
        background: white;
        transition: 0.5s;

    }

    input:checked[type="checkbox"]:before {
        left: 30px;
    }

    .keyss {
        padding: 5px;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de Roles y Permisos <i class="fa fa-key"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado Roles</li>
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
                        <h3 class="card-title"><b>Listado de Roles y permisos de usuario</b>
                            - <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/rolesuser/create');">
                                Nuevo Rol <i class="fa fa-plus"></i></a></h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Rol</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListadoRoles) && is_array($ListadoRoles)) {
                                                foreach ($ListadoRoles as $ListadoRoles_item) { ?>

                                                    <tr class="odd">
                                                        <td>
                                                            <?php if ($ListadoRoles_item["id"] != 1) {     ?>

                                                                <?php if ($ListadoRoles_item["estado"] == "1") {     ?>
                                                                    <a onclick="EstadoRol(<?php echo $ListadoRoles_item['id']; ?>, '0');" class='btn btn-danger btn-sm' title='Inactivar el rol'><i class='fa fa-times'></i></a>-
                                                                    <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/EditarRol/<?php echo $ListadoRoles_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el rol'><i class='fa fa-edit'></i></a>-
                                                                    <a onclick="EditarPermisosRol(<?= esc($ListadoRoles_item['id']); ?>)" class='editar btn btn-warning btn-sm' title='Editar permisos'><i class='fa fa-key'></i></a>
                                                                <?php   } else {     ?>
                                                                    <a onclick="EstadoRol(<?php echo $ListadoRoles_item['id']; ?>, '1');" class='btn btn-success btn-sm' title='Activar el rol'><i class='fa fa-check'></i></a>-
                                                                    <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/EditarRol/<?php echo $ListadoRoles_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el rol'><i class='fa fa-edit'></i></button>
                                                                    <?php   } ?>

                                                                <?php   } else { ?>
                                                                    <span class="badge badge-success"><?= esc($ListadoRoles_item["rol"]); ?></span>
                                                                <?php   } ?>

                                                        </td>

                                                        <td><?= esc($ListadoRoles_item["rol"]); ?></td>
                                                        <td><?= esc($ListadoRoles_item["fecha"]); ?></td>
                                                        <td>
                                                            <?php if ($ListadoRoles_item["estado"] == "1") {     ?>
                                                                <span class="badge badge-success">Activo</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-danger">Inactivo</span>
                                                            <?php   } ?>
                                                        </td>
                                                    </tr>

                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    No hay roles disponibles
                                                </tr>

                                            <?php }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Rol</th>
                                                <th>Fecha</th>
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

<div class="modal fade" id="modal_editar_usuario" role="dialog" aria-labelledby="modal_eitar_rolLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_eitar_rolLabel"><b>Editar Permisos <i class="fa fa-key"></i></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" id="id_rol" hidden>

                <div class="form-row text-center">

                    <div class='col-md-2 keyss' hidden>
                        <label for='mantenimiento_p'>Mantenimiento</label><br>
                        <input type='checkbox' id='mantenimiento_p'><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='producto_tipo_p'>Producto y Tipo</label><br>
                        <input type='checkbox' id='producto_tipo_p'><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='insumo_tipo_p'>Insumos y tipo</label><br>
                        <input type='checkbox' id='insumo_tipo_p'><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='material_tipo_p'>Material Y tipo</label><br>
                        <input type='checkbox' id='material_tipo_p'><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='ofertas_p'>Ofertas</label><br>
                        <input type='checkbox' id='ofertas_p'><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='proveedor_p'>Proveedor</label><br>
                        <input type='checkbox' id='proveedor_p'><br>
                    </div>

                    <br>

                    <div class='col-md-2 keyss'>
                        <label for='compra_insumo_p'>Compra insumo</label><br>
                        <input type='checkbox' id='compra_insumo_p'><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='compra_material_p'>Compra material</label><br>
                        <input type='checkbox' id='compra_material_p'><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='crear_venta_p'>Crear venta</label><br>
                        <input type='checkbox' id='crear_venta_p'><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='listado_venta_p'>Listado de ventas</label><br>
                        <input type='checkbox' id='listado_venta_p'><br>
                    </div>

                    <div hidden class='col-md-2 keyss'>
                        <label for='fase_produccion_p'>Fase producción</label><br>
                        <input type='checkbox' id='fase_produccion_p' checked><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='produccion_p'>Producción</label><br>
                        <input type='checkbox' id='produccion_p'><br>
                    </div>

                    <br>

                    <div hidden class='col-md-2 keyss'>
                        <label for='produccion_finalizadas_p'>Producción finalizadas</label><br>
                        <input type='checkbox' id='produccion_finalizadas_p' checked><br>
                    </div>

                    <div hidden class='col-md-2 keyss'>
                        <label for='registro_fase_p'>Registro de fases</label><br>
                        <input type='checkbox' id='registro_fase_p' checked><br>
                    </div>

                    <div hidden class='col-md-2 keyss'>
                        <label for='perdidas_produccion_p'>Perdidas de producción</label><br>
                        <input type='checkbox' id='perdidas_produccion_p' checked><br>
                    </div>

                    <div class='col-md-2 keyss'>
                        <label for='reporters_p'>Reportes</label><br>
                        <input type='checkbox' id='reporters_p'><br>
                    </div>

                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Cerrar
                    </button>
                    <button onclick="editar_permisos()" id="btn_editar_p" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>public/js/usuario.js"></script>

<script>
    $(document).ready(function() {
        $('#example2').DataTable({
            language: {
                rows: "%d fila seleccionada",
                processing: "Tratamiento en curso...",
                search: "Buscar&nbsp;:",
                lengthMenu: "Agrupar en _MENU_ items",
                info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
                infoEmpty: "No existe datos.",
                infoFiltered: "(filtrado de _MAX_ elementos en total)",
                infoPostFix: "",
                loadingRecords: "Cargando...",
                zeroRecords: "No se encontro resultados en tu busqueda",
                emptyTable: "No hay datos disponibles en la tabla",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Ultimo",
                },
                select: {
                    rows: "%d fila seleccionada",
                },
                aria: {
                    sortAscending: ": active para ordenar la columa en orden ascendente",
                    sortDescending: ": active para ordenar la columna en orden descendente",
                },
            },
        });
    });
</script>