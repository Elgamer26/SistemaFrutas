<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Calificación de clientes <i class="fa fa-users"></i><i class="fa fa-cubes"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado de calificación</li>
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
                        <h3 class="card-title"><b>Lista de calificación</b> </h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">

                                <div class="col-sm-12 text-center table-responsive ">

                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Oferta</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php if (!empty($califica) && is_array($califica)) {
                                                foreach ($califica as $califica_item) { ?>

                                                    <tr class="odd">

                                                        <td><?= esc($califica_item["nombre"]); ?> - <?= esc($califica_item["apellidos"]); ?></td>
                                                        <td><?= esc($califica_item["producto"]); ?></td>
                                                        <td><?= esc($califica_item["fecha"]); ?> </td>

                                                        <td>
                                                            <?php if ($califica_item["estado"] == "Megusta") { ?>
                                                                <span class="badge badge-success">Me gusta</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-danger">No me gusta</span>
                                                            <?php   } ?>
                                                        </td>

                                                        <td>
                                                            <?php if ($califica_item["oferta"] == "Sin oferta") { ?>
                                                                <span class="badge badge-primary"><?= esc($califica_item["oferta"]); ?></span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-warning"><?= esc($califica_item["oferta"]); ?></span>
                                                            <?php   } ?>
                                                        </td>

                                                    </tr>

                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    No hay calificación
                                                </tr>

                                            <?php }
                                            ?>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th>Oferta</th>
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