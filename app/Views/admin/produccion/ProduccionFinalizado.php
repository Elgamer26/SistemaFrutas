<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de producción finalizado <i class="fa fa-list"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Lista producción finalizado</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">

                <div class="col-6 col-sm-6 col-md-6">
                    <input autocomplete="off" value="" type="text" class="form-control" id="buscarproduccionFIN" placeholder="Buscar producción..." maxlength="35">
                </div>

                <br><br>

                <div class="row" id="unir_listado_ofertas">
                </div>
            </div>
        </div>


        <div class="card-footer">
            <nav aria-label="Contacts Page Navigation">
                <ul class="pagination justify-content-center m-0" id="unir_paguinador">
                </ul>
            </nav>
        </div>

    </div>

</section>

<script src="<?php echo base_url(); ?>public/js/produccion.js"></script>

<div class="modal fade" id="ModalFaseProduccion" tabindex="-1" role="dialog" aria-labelledby="ModalFaseProduccionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #ffc107;">
                <h5 class="modal-title" id="ModalFaseProduccionLabel" style="color: white;"><b>Fase de producción</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                        <table id="TableFase" class="table table-striped table-bordered">
                            <thead bgcolor="black" style="color:#fff;">
                                <tr>
                                    <th>N° Fase</th>
                                    <th>Fase</th>
                                    <th>Fecha</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_TableFase">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" onclick="RegistrarFase();" class="btn btn-success">Guardar</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalPerdidaProduccion" tabindex="-1" role="dialog" aria-labelledby="ModalPerdidaProduccionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #007bff;">
                <h5 class="modal-title" id="ModalPerdidaProduccionLabel" style="color: white;"><b>Cantidad perdida de producción</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        &nbsp;&nbsp;
                        <table id="TablaPerdida" class="table table-striped table-bordered">
                            <thead bgcolor="black" style="color:#fff;">
                                <tr>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_TablaPerdida">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" onclick="RegistrarFase();" class="btn btn-success">Guardar</button> -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        paginationFinalizado(1);
    });
</script>