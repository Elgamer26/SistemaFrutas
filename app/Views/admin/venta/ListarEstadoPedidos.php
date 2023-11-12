<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Estado pedido <i class="fa fa-truck"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Estado pedido</li>
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
                        <h3 class="card-title"><b>Estado pedido</b>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12 text-center table-responsive">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Opcion</th>
                                                <th>N° venta</th>
                                                <th>N° Servicio</th>
                                                <th>Cliente</th>
                                                <th>fecha</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListEstado) && is_array($ListEstado)) {
                                                foreach ($ListEstado as $ListEstado_item) { ?>

                                                    <tr class="odd">

                                                        <td>
                                                            <?php if ($ListEstado_item["estado"] == 0) {     ?>
                                                                <a onclick="RealizarEntrega(<?php echo $ListEstado_item['id']; ?>);" class='btn btn-warning btn-sm' title='Pasar a entregar'><i class='fa fa-check'></i></a>
                                                            <?php  } else {  ?>
                                                                <a class='btn btn-success btn-sm' title='Entregado'><i class='fa fa-check'></i> Producto entregado</a>
                                                            <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListEstado_item["n_venta"]); ?></td>
                                                        <td><?= esc($ListEstado_item["codigo"]); ?></td>
                                                        <td><?= esc($ListEstado_item["cliente"]); ?></td>
                                                        <td><?= esc($ListEstado_item["fecha"]); ?></td>
                                                        <td>
                                                            <?php if ($ListEstado_item["estado"] == 0) {     ?>
                                                                <span class="badge badge-warning">En proceso</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-success">Entregado</span>
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
                                                <th>Opcion</th>
                                                <th>N° venta</th>
                                                <th>N° Servicio</th>
                                                <th>Cliente</th>
                                                <th>fecha</th>
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

<script src="<?php echo base_url(); ?>public/js/venta.js"></script>

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