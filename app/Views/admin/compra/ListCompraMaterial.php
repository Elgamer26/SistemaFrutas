<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de compra material <i class="fa fa-shopping-cart"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado compra material</li>
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
                        <h3 class="card-title"><b>Lista compra de material</b>
                            - <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/CompraMaterial/create/0');">
                                Nueva Compra <i class="fa fa-plus"> </i></a></h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12 text-center table-responsive">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Proveedor</th>
                                                <th>N° compra</th>
                                                <th>fecha compra</th>
                                                <th>Tipo comprobante</th>
                                                <th>Total</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListaCompra) && is_array($ListaCompra)) {
                                                foreach ($ListaCompra as $ListaCompra_item) { ?>

                                                    <tr class="odd">
                                                        <td>
                                                            <?php if ($ListaCompra_item["estado"] == "1") {     ?>
                                                                <a onclick="AnularFacturaMaterial(<?php echo $ListaCompra_item['id']; ?>);" class='btn btn-danger btn-sm' title='Anular la factura'><i class='fa fa-times'></i></a>-
                                                                <a onclick="VerFacturaCompraMaterial('<?php echo $ListaCompra_item['id']; ?>')" class='btn btn-primary btn-sm' title='Ver reporte'><i class='fa fa-file'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="VerFacturaCompraMaterial('<?php echo $ListaCompra_item['id']; ?>')" class='btn btn-primary btn-sm' title='Ver reporte'><i class='fa fa-file'></i></a>
                                                            <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListaCompra_item["razon_social"]); ?></td>
                                                        <td><?= esc($ListaCompra_item["n_compra"]); ?></td>
                                                        <td><?= esc($ListaCompra_item["fechac"]); ?></td>
                                                        <td> <span class="badge badge-primary"><?= esc($ListaCompra_item["comprobante"]); ?></span> </td>
                                                        <td>$ <?= esc($ListaCompra_item["total"]); ?></td>

                                                        <td>
                                                            <?php if ($ListaCompra_item["estado"] == "1") {     ?>
                                                                <span class="badge badge-success">Activo</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-danger">Anulado</span>
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
                                                <th>Proveedor</th>
                                                <th>N° compra</th>
                                                <th>fecha compra</th>
                                                <th>Tipo comprobante</th>
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