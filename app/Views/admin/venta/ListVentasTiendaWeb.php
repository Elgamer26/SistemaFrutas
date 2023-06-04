<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de ventas tienda web <i class="fa fa-shopping-cart"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado venta web</li>
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
                        <h3 class="card-title"><b>Lista de ventas web</b>
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
                                                            <?php if ($ListVenta_item["estado"] == "1") {     ?>
                                                                <a onclick="AnularFacturaVentaWeb(<?php echo $ListVenta_item['id']; ?>);" class='btn btn-danger btn-sm' title='Anular la factura'><i class='fa fa-times'></i></a>-
                                                                <a onclick="VerFacturaVentaWeb('<?php echo $ListVenta_item['id']; ?>')" class='btn btn-primary btn-sm' title='Ver reporte'><i class='fa fa-file'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="VerFacturaVentaWeb('<?php echo $ListVenta_item['id']; ?>')" class='btn btn-primary btn-sm' title='Ver reporte'><i class='fa fa-file'></i></a>
                                                            <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListVenta_item["cliente"]); ?></td>
                                                        <td><?= esc($ListVenta_item["n_venta"]); ?></td>
                                                        <td><?= esc($ListVenta_item["fecharegistro"]); ?></td>
                                                        <td> <span class="badge badge-primary"><?= esc($ListVenta_item["comprobante"]); ?></span> </td>
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
                                                    No hay datos disponibles
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

<script src="<?php echo base_url(); ?>public/js/tienda.js"></script>