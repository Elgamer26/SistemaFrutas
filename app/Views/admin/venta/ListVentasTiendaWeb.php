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
                                                            <?php if ($ListVenta_item["estado"] == "1") {     ?>
                                                                <a onclick="AnularFacturaVentaWeb(<?php echo $ListVenta_item['id']; ?>);" class='btn btn-danger btn-sm' title='Anular la factura'><i class='fa fa-times'></i></a>-
                                                                <a onclick="VerFacturaVentaWeb('<?php echo $ListVenta_item['id']; ?>')" class='btn btn-primary btn-sm' title='Ver reporte'><i class='fa fa-file'></i></a>

                                                                <?php if (strtoupper($ListVenta_item["tipopago"]) == "EFECTIVO") {  ?>

                                                                    <?php if ($ListVenta_item["servientrega"] == 1) { ?>
                                                                        - <a onclick="DescargarArchivo('<?php echo $ListVenta_item['id']; ?>')" class='btn btn-warning btn-sm' title='ver foto'><i class='fa fa-eye'></i></a>
                                                                    <?php  } else { ?>
                                                                        - <a onclick="CargarFotoServientrega('<?php echo $ListVenta_item['id']; ?>')" class='btn btn-success btn-sm' title='Subir foto'><i class='fa fa-image'></i></a>
                                                                    <?php  }  ?>

                                                                <?php  } ?>

                                                            <?php   } else {     ?>

                                                                <a onclick="VerFacturaVentaWeb('<?php echo $ListVenta_item['id']; ?>')" class='btn btn-primary btn-sm' title='Ver reporte'><i class='fa fa-file'></i></a>
                                                           
                                                            <?php   } ?>

                                                        </td> 

                                                        <td><?= esc($ListVenta_item["cliente"]); ?></td>
                                                        <td><?= esc($ListVenta_item["n_venta"]); ?></td>
                                                        <td><?= esc($ListVenta_item["fecharegistro"]); ?></td>

                                                        <?php if ($ListVenta_item["tipopago"] != "efectivo") {     ?>
                                                            <td> <span class="badge badge-primary"><?= esc(strtoupper($ListVenta_item["tipopago"])); ?></span> </td>
                                                        <?php   } else {     ?>
                                                            <td> <span class="badge badge-success"><?= esc(strtoupper($ListVenta_item["tipopago"])); ?></span> </td>
                                                        <?php   } ?>


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

<div class="modal fade" id="ModalSubirComprobante" tabindex="-1" role="dialog" aria-labelledby="ModalSubirComprobanteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #28a745;">
                <h5 class="modal-title" id="ModalSubirComprobanteLabel" style="color: white;"><b>Cargar imagen</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <input type="number" id="codigo_servi" hidden>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="codigo">Código:</label> <span id="codigo_olbligg" style="color: red;"></span>
                            <input onkeypress="return soloNumeros(event)" type="text" name="codigo" class="form-control" id="codigo">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="imagen_s">Imagen</label> <span id="imagen_s_olbligg" style="color: red;"></span>
                            <input onchange="mostrar_imagenData(this);" type="file" id="file" name="file[]" class="form-control" accept="image/*" multiple />
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="RegistrarComprobanteServientrega();" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>

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

    function mostrar_imagenData(input) {
        var filename = document.getElementById("file").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {
            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    //   $("#FotoPerfilUser").attr("src", e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        } else {
            $("#file").val("");
            return swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
        }

    }
</script>