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
                <h1> Reporte material <i class="fa fa-file"></i> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Reporte material</li>
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
                        <h3 class="card-title"><b>Reporte de material</b></h3>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="insumo">Tipo material</label> <span id="insumo_olbligg" style="color: red;"></span>
                                    <select name="insumo" id="insumo" class="form-control" style="width: 100%;">
                                        <?php if (!empty($insumo) && is_array($insumo)) { ?>
                                            <option value=""> --Seleccione el tipo material--</option>
                                            <option value="0"> TODO </option>
                                            <?php
                                            foreach ($insumo as $insumo_item) { ?>
                                                <option value="<?= esc($insumo_item["id"]); ?>"><?= esc($insumo_item["tipo"]); ?> </option>
                                            <?php }
                                        } else { ?>
                                            <option value="0">No hay tipo</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <center>
                                    <iframe width="100%" height="100%" class="contennidor" id="iframeMaterial"></iframe>
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
    $("#insumo").select2();

    $("#insumo").change(function() {
        
        let id = $(this).val();
        let valor = $("#insumo option:selected").text();
        if (id != "") {
            var ifrm = document.getElementById("iframeMaterial");
            ifrm.setAttribute("src", "<?php echo base_url(); ?>Reporte/ReporteMaterial/" + id + "/" + valor + "");
        }

    })
</script>