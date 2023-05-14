<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de compra insumos <i class="fa fa-shopping-cart"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado compra insumos</li>
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
                        <h3 class="card-title"><b>Lista compra de insumos</b>
                            - <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/CompraInsumos/create/0');">
                                Nueva Compra <i class="fa fa-plus"> </i></a></h3>
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
                                                                <a onclick="AnularFactura(<?php echo $ListaCompra_item['id']; ?>);" class='btn btn-danger btn-sm' title='Anular la factura'><i class='fa fa-times'></i></a>-
                                                                <a onclick="VerFacturaCompraInsumo('<?php echo $ListaCompra_item['id']; ?>')" class='btn btn-primary btn-sm' title='Ver reporte'><i class='fa fa-file'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="VerFacturaCompraInsumo('<?php echo $ListaCompra_item['id']; ?>')" class='btn btn-primary btn-sm' title='Ver reporte'><i class='fa fa-file'></i></a>
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