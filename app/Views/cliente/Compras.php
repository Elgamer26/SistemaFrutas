<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <?php echo $title; ?>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>home/Perfil">Inicio</a></li>
                    <?php echo $item; ?>
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
                        <?php echo $item2; ?>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12 text-center table-responsive">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" style="width: 100%;">

                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Cliente</th>
                                                <th>N° venta</th>
                                                <th>fecha venta</th>
                                                <th>Pago</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php if (!empty($ListVenta) && is_array($ListVenta)) {
                                                foreach ($ListVenta as $ListVenta_item) { ?>

                                                    <tr class="odd">

                                                        <td>
                                                            <?php if ($token) {   ?>
                                                                <a target="_blank" href="<?php echo base_url(); ?>Reporte/ReporteVentaWeb/<?php echo $ListVenta_item['id']; ?>" class='btn btn-primary btn-sm' title='Ver compra'><i class='fa fa-file'></i></a>
                                                            <?php   } else {     ?>
                                                                <a target="_blank" href="<?php echo base_url(); ?>Reporte/ReporteVenta/<?php echo $ListVenta_item['id']; ?>" class='btn btn-primary btn-sm' title='Ver compra'><i class='fa fa-file'></i></a>
                                                            <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListVenta_item["cliente"]); ?></td>
                                                        <td><?= esc($ListVenta_item["n_venta"]); ?></td>
                                                        <td><?= esc($ListVenta_item["fecharegistro"]); ?></td>

                                                        <td>
                                                            <?php if ($ListVenta_item["comprobante"] == "PayPal") {     ?>
                                                                <span class="badge badge-primary"><?= esc($ListVenta_item["comprobante"]); ?></span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-warning"><?= esc($ListVenta_item["comprobante"]); ?></span>
                                                            <?php   } ?>
                                                        </td>

                                                        <td>$ <?= esc($ListVenta_item["total"]); ?></td>

                                                        <td>
                                                            <?php if ($ListVenta_item["estado"] == "1") {     ?>
                                                                <span class="badge badge-success">Activo</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-danger">Anulado</span>
                                                            <?php   } ?>
                                                        </td>

                                                    </tr>

                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    No hay compras
                                                </tr>

                                            <?php }
                                            ?>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Cliente</th>
                                                <th>N° venta</th>
                                                <th>fecha venta</th>
                                                <th>Pago</th>
                                                <th>Total</th>
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