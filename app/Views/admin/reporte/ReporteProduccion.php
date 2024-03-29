<style>
    .contennidor {
        background: gray;
        min-height: 90vh;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Reporte producción <i class="fa fa-file"></i> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Reporte producción</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Reporte de producción</b></h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha inicio</label>
                                    <input type="date" value="<?php echo $fecha; ?>" class="form-control" id="fecha_cli_ini">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha fin</label>
                                    <input type="date" value="<?php echo $fecha; ?>" class="form-control" id="fecha_cli_fin">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Buscar</label>
                                    <button class="btn btn-danger" onclick="VerReporteProduccion();"> <i class="fa fa-eye"></i> Ver</button>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="producto">Producto</label>
                                    <select name="producto" id="producto" class="form-control" style="width: 100%;">
                                        <?php if (!empty($producto) && is_array($producto)) { ?>
                                            <option value=""> --Seleccione el producto --</option>
                                            <option value="0"> TODO </option>
                                            <?php
                                            foreach ($producto as $producto_item) { ?>
                                                <option value="<?= esc($producto_item["id"]); ?>"><?= esc($producto_item["nombre"]); ?> </option>
                                            <?php }
                                        } else { ?>
                                            <option value="0">No hay producto</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Saldo</label>
                                    <input type="number" value="0" min="0" max="999" class="form-control" id="saldo_prodcuto">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Buscar</label>
                                    <button class="btn btn-success" onclick="VerReporteProduccion_Producto();"> <i class="fa fa-eye"></i> Ver</button>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <center>
                                    <iframe width="100%" height="100%" class="contennidor" id="iframe_produccion"></iframe>
                                </center>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function VerReporteProduccion() {

        var fecha_inicio = $("#fecha_cli_ini").val();
        var fecha_fin = $("#fecha_cli_fin").val();

        if (fecha_inicio > fecha_fin) {
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fecha_inicio +
                "' es mayor a la fecha final '" +
                fecha_fin +
                "'",
                "warning"
            );
        }

        var ifrm = document.getElementById("iframe_produccion");
        ifrm.setAttribute("src", "<?php echo base_url(); ?>Reporte/ReporteProuccionModulo/" + fecha_inicio + "/" + fecha_fin + "");

    }

    function VerReporteProduccion_Producto() {

        var producto = $("#producto").val();
        var saldo_prodcuto = $("#saldo_prodcuto").val();
        var saldo = 0

        if (producto == "") {
            return Swal.fire(
                "Mensaje de advertencia",
                "Seleccione un producto",
                "warning"
            );
        }

        if (saldo_prodcuto == ""){
            saldo = 0
        }else{
            saldo = saldo_prodcuto
        }

        console.log(saldo);
        console.log(producto);

        var ifrm = document.getElementById("iframe_produccion");
        ifrm.setAttribute("src", "<?php echo base_url(); ?>Reporte/ReporteProduccionModulo_Producto/" + producto + "/" + saldo + "");

    }
</script>