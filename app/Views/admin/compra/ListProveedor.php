<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de proveedor <i class="fa fa-truck"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado proveedor</li>
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
                        <h3 class="card-title"><b>Listado de proveedores</b>
                            - <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/proveedor/create/0');">
                                Nuevo Proveedor <i class="fa fa-plus"> </i></a></h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
 
                            <div class="row">
                                <div class="col-sm-12 text-center table-responsive">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Rúc</th>
                                                <th>Razon social</th>
                                                <th>Correo</th>
                                                <th>Dirección</th>
                                                <th>Telefono</th>
                                                <th>Encargado</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListaProveddor) && is_array($ListaProveddor)) {
                                                foreach ($ListaProveddor as $ListaProveddor_item) { ?>

                                                    <tr class="odd">
                                                        <td>
                                                            <?php if ($ListaProveddor_item["estado"] == "1") {     ?>
                                                                <a onclick="EstadoProveedor(<?php echo $ListaProveddor_item['id']; ?>, '0');" class='btn btn-danger btn-sm' title='Inactivar el proveedor'><i class='fa fa-times'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/proveedor/edit/<?php echo $ListaProveddor_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el proveedor'><i class='fa fa-edit'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="EstadoProveedor(<?php echo $ListaProveddor_item['id']; ?>, '1');" class='btn btn-success btn-sm' title='Activar el proveedor'><i class='fa fa-check'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/proveedor/edit/<?php echo $ListaProveddor_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el proveedor'><i class='fa fa-edit'></i></button>
                                                                <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListaProveddor_item["ruc"]); ?></td>
                                                        <td><?= esc($ListaProveddor_item["razon_social"]); ?></td>
                                                        <td><?= esc($ListaProveddor_item["correo"]); ?></td>
                                                        <td> <?= esc($ListaProveddor_item["direccion"]); ?></td>
                                                        <td> <?= esc($ListaProveddor_item["telefono"]); ?></td>
                                                        <td><?= esc($ListaProveddor_item["encargado"]); ?></td>
                                                        <td><?= esc($ListaProveddor_item["descripcion"]); ?></td>

                                                        <td>
                                                            <?php if ($ListaProveddor_item["estado"] == "1") {     ?>
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
                                                <th>Rúc</th>
                                                <th>Razon social</th>
                                                <th>Correo</th>
                                                <th>Dirección</th>
                                                <th>Telefono</th>
                                                <th>Encargado</th>
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

<script src="<?php echo base_url(); ?>public/js/compra.js"></script>

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