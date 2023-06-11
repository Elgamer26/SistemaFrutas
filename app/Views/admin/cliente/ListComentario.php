<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Comentarios de productos <i class="fa fa-users"></i><i class="fa fa-cubes"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado de comentarios</li>
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
                        <h3 class="card-title"><b>Lista de comentarios</b> </h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="producto">Seleccione el producto</label>
                                        <select class="form-control" id="producto" style="width: 100%;">
                                            <?php if (!empty($producto) && is_array($producto)) { ?>
                                                <option value="0">-- Seleccione el producto--</option>
                                                <?php foreach ($producto as $producto_item) { ?>
                                                    <option value="<?= esc($producto_item["idproducto"]); ?> <?php if ($producto_item['idproducto'] == $id[0]) {
                                                                                                                    echo 'selected';
                                                                                                                } ?>">Código: <?= esc($producto_item["codigo"]); ?> - <?= esc($producto_item["nombre"]); ?> - <?= esc($producto_item["tipo"]); ?></option>
                                                <?php }
                                            } else { ?>
                                                <option value="0">No hay producto</option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 text-center table-responsive">

                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Detalle</th>
                                                <th>Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="DetalleComentario">


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Producto</th>
                                                <th>Fecha</th>
                                                <th>Detalle</th>
                                                <th>Tipo</th>
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

<!-- <script src="<?php echo base_url(); ?>public/js/cliente.js"></script> -->

<script>
    $("#producto").select2();

    $("#producto").change(function() {
        let id = $(this).val();

        $.ajax({
            type: "GET",
            url: '<?php echo base_url(); ?>admin/comentatios/listDetalle/' + id,
            success: function(resp) {

                let repuesta = JSON.parse(resp);
                $("#DetalleComentario").empty();
                let hmtl = "";
                let estado = "";

                repuesta.forEach(row => {

                    if (row["oferta"] == "oferta") {
                        estado = `<span class = "badge badge-success"> Oferta </span>`;
                    } else {
                        estado = `<span class = "badge badge-danger"> No oferta </span>`;
                    }

                    hmtl += `<tr class="odd">
                            <td>${row["cliente"]} </td>
                            <td>${row["producto"]}</td>
                            <td>${row["fecha"]}</td>
                            <td>${row["detalle"]}</td> 
                            <td> ${estado}</td> 
                        </tr>`;
                });

                $("#DetalleComentario").html(hmtl);

                try {

                    // var tabla = $('#example2').DataTable();
                    // tabla.destroy();

                    // $('#example2').DataTable({
                    //     language: {
                    //         rows: "%d fila seleccionada",
                    //         processing: "Tratamiento en curso...",
                    //         search: "Buscar&nbsp;:",
                    //         lengthMenu: "Agrupar en _MENU_ items",
                    //         info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
                    //         infoEmpty: "No existe datos.",
                    //         infoFiltered: "(filtrado de _MAX_ elementos en total)",
                    //         infoPostFix: "",
                    //         loadingRecords: "Cargando...",
                    //         zeroRecords: "No se encontro resultados en tu busqueda",
                    //         emptyTable: "No hay datos disponibles en la tabla",
                    //         paginate: {
                    //             first: "Primero",
                    //             previous: "Anterior",
                    //             next: "Siguiente",
                    //             last: "Ultimo",
                    //         },
                    //         select: {
                    //             rows: "%d fila seleccionada",
                    //         },
                    //         aria: {
                    //             sortAscending: ": active para ordenar la columa en orden ascendente",
                    //             sortDescending: ": active para ordenar la columna en orden descendente",
                    //         },
                    //     },
                    // });

                } catch (error) {

                }
            }
        });
    });
</script>