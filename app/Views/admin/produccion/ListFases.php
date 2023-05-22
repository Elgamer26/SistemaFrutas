<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de fase <i class="fa fa-list"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Lista fase</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">

                <!-- <div class="col-6 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
                    <div class="col-12 col-sm-6 col-md-8 d-flex align-items-stretch flex-column">
                        <a class="btn btn-success btn-sm" onclick="ModalNewFase();">
                            Nueva fase <i class="fa fa-plus"></i></a>
                    </div>
                </div> -->

                <br><br>

                <div class="col-sm-12 text-center">

                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                        <thead>
                            <tr>
                                <th>Opción</th>
                                <th>N° fase</th>
                                <th>Fase de producción</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (!empty($fase) && is_array($fase)) {
                                foreach ($fase as $fase_item) { ?>

                                    <tr class="odd">
                                        <td>
                                            <a onclick="EditarFase('<?php echo $fase_item['id']; ?>', '<?= esc($fase_item['fase']); ?>')" class='btn btn-primary btn-sm' title='Editar la fase'><i class='fa fa-edit'></i></a>
                                        </td>
                                        <td><?= esc($fase_item["id"]); ?> </td>
                                        <td><?= esc($fase_item["fase"]); ?> </td>
                                    </tr>

                                <?php }
                            } else { ?>
                                <tr class="odd">
                                    No hay fases disponibles
                                </tr>

                            <?php }
                            ?>

                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Opción</th>
                                <th>N° fase</th>
                                <th>Fase de producción</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>
        </div>


    </div>

</section>

<script src="<?php echo base_url(); ?>public/js/produccion.js"></script>

<div class="modal fade" id="ModalEditFase" tabindex="-1" role="dialog" aria-labelledby="ModalEditFaseLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #007bff;">
                <h5 class="modal-title" id="ModalEditFaseLabel" style="color: white;"><b>Editar Fase</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="idfase">
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label for="nombrefalse">Fase de producción</label> <span id="nombrefalse_olbligg" style="color: red;"></span>
                            <textarea  class="form-control" id="nombrefalse" cols="3" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="EditarFaseTipo();" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function EditarFase(id, fase) {
        $("#idfase").val(id);
        $("#nombrefalse").val(fase);

        $("#ModalEditFase").modal("show");
    }
</script>