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
                <h1> Reporte ofertas <i class="fa fa-file"></i> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Reporte ofertas</li>
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
                        <h3 class="card-title"><b>Reporte de ofertas</b></h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha inicio</label>
                                    <input type="date" value="<?php echo $fecha; ?>" class="form-control" id="fecha_cli_ini">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha fin</label>
                                    <input type="date" value="<?php echo $fecha; ?>" class="form-control" id="fecha_cli_fin">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Buscar</label>
                                    <button class="btn btn-danger" onclick="VerReporteVneta();"> <i class="fa fa-eye"></i> Ver</button>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <center>
                                    <iframe width="100%" height="100%" class="contennidor" id="iframeoferta"></iframe>
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
    function VerReporteVneta() {

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

        var ifrm = document.getElementById("iframeoferta");
        ifrm.setAttribute("src", "<?php echo base_url(); ?>Reporte/ReporteOferta/" + fecha_inicio + "/" + fecha_fin + "");

    }
</script>