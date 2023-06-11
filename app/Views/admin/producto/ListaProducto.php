<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de productos <i class="fa fa-cubes"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado producto</li>
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
                        <h3 class="card-title"><b>Listado productos</b>
                            - <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Producto/create/0');">
                                Nuevo producto <i class="fa fa-plus"></i></a></h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"> 
                            <div class="row">
                                <div class="col-sm-12 text-center table-responsive">

                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Código</th>
                                                <th>Nombre</th>
                                                <th>Tipo producto</th>
                                                <th>Precio venta</th>
                                                <th>Foto</th>
                                                <th>Cantidad</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListarProducto) && is_array($ListarProducto)) {
                                                foreach ($ListarProducto as $ListarProducto_item) { ?>

                                                    <tr class="odd">
                                                        <td>
                                                            <?php if ($ListarProducto_item["estado"] == "1") {     ?>
                                                                <a onclick="EstadoProducto(<?php echo $ListarProducto_item['id']; ?>, '0');" class='btn btn-danger btn-sm' title='Inactivar el producto'><i class='fa fa-times'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Producto/edit/<?php echo $ListarProducto_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el producto'><i class='fa fa-edit'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="EstadoProducto(<?php echo $ListarProducto_item['id']; ?>, '1');" class='btn btn-success btn-sm' title='Activar el producto'><i class='fa fa-check'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Producto/edit/<?php echo $ListarProducto_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el producto'><i class='fa fa-edit'></i></button>
                                                                <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListarProducto_item["codigo"]); ?></td>
                                                        <td><?= esc($ListarProducto_item["nombre"]); ?></td>
                                                        <td> <span class="badge badge-warning"><?= esc($ListarProducto_item["tipo"]); ?></span> </td>
                                                        <td>$ <?= esc($ListarProducto_item["precio"]); ?></td>
                                                        <td><a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Producto/foto/<?php echo $ListarProducto_item['id']; ?>');" style="border: none; border-radius: 50px;" title="Ver Imagen"><img style='border-radius: 50px;' src='<?php echo base_url(); ?>public/img/producto/<?= esc($ListarProducto_item["imagen"]); ?>' width='45px' /></a></td>
                                                        <td><?= esc($ListarProducto_item["cantidad"]); ?></td>
                                                        <td><?= esc($ListarProducto_item["descripcion"]); ?></td>

                                                        <td>
                                                            <?php if ($ListarProducto_item["estado"] == "1") {     ?>
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
                                                <th>Tipo producto</th>
                                                <th>Precio venta</th>
                                                <th>Foto</th>
                                                <th>Cantidad</th>
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

<script src="<?php echo base_url(); ?>public/js/producto.js"></script>

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