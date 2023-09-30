<style>
    input[type="checkbox"] {
        position: relative;
        width: 60px;
        height: 30px;
        -webkit-appearance: none;
        background: rgb(168, 168, 168);
        outline: none;
        border-radius: 15px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, .5);
    }

    input:checked[type="checkbox"] {
        background: rgb(0, 123, 255);
    }

    input[type="checkbox"]:before {
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        border-radius: 20px;
        top: 0;
        left: 0;
        background: white;
        transition: 0.5s;

    }

    input:checked[type="checkbox"]:before {
        left: 30px;
    }

    .keyss {
        padding: 5px;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/rolesuser/list');">Listado Rol</a></li>
                    <li class="breadcrumb-item active">Formulario Rol</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-<?php echo $color; ?>">
                    <div class="card-header">
                        <h3 class="card-title"><b><?php echo $texto; ?></b></h3>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="nombrerol">Nombre del rol</label> <span id="rol_olbligg" style="color: red;"></span>
                            <input onkeypress="return soloLetras(event)" autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="nombrerol" class="form-control" id="nombrerol" placeholder="Nombre del rol" maxlength="50">
                        </div>

                        <?php if ($color != "primary") {?>

                        <div class="col-md-12 p-3">
                            <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding: -30px;">
                                <b>
                                    <h4 class="box-title"><i class="fa fa-key"></i> <b>Permisos del rol</b></h4>
                                </b>
                            </div>
                        </div>

                        <div class='col-md-12' style="text-align:center;">

                            <div class="row">

                                <div class='col-md-2 keyss'>
                                    <label for='mantenimiento_p'>Mantenimiento</label><br>
                                    <input type='checkbox' id='mantenimiento_p'><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='producto_tipo_p'>Producto y Tipo</label><br>
                                    <input type='checkbox' id='producto_tipo_p'><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='insumo_tipo_p'>Insumos y tipo</label><br>
                                    <input type='checkbox' id='insumo_tipo_p'><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='material_tipo_p'>Material Y tipo</label><br>
                                    <input type='checkbox' id='material_tipo_p'><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='ofertas_p'>Ofertas</label><br>
                                    <input type='checkbox' id='ofertas_p'><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='proveedor_p'>Proveedor</label><br>
                                    <input type='checkbox' id='proveedor_p'><br>
                                </div>

                                <br>

                                <div class='col-md-2 keyss'>
                                    <label for='compra_insumo_p'>Compra insumo</label><br>
                                    <input type='checkbox' id='compra_insumo_p'><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='compra_material_p'>Compra material</label><br>
                                    <input type='checkbox' id='compra_material_p'><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='crear_venta_p'>Crear venta</label><br>
                                    <input type='checkbox' id='crear_venta_p'><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='listado_venta_p'>Listado de ventas</label><br>
                                    <input type='checkbox' id='listado_venta_p'><br>
                                </div>

                                <div hidden class='col-md-2 keyss'>
                                    <label for='fase_produccion_p'>Fase producción</label><br>
                                    <input type='checkbox' id='fase_produccion_p' checked><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='produccion_p'>Producción</label><br>
                                    <input type='checkbox' id='produccion_p'><br>
                                </div>

                                <br>

                                <div hidden class='col-md-2 keyss'>
                                    <label for='produccion_finalizadas_p'>Producción finalizadas</label><br>
                                    <input type='checkbox' id='produccion_finalizadas_p' checked><br>
                                </div>

                                <div hidden class='col-md-2 keyss'>
                                    <label for='registro_fase_p'>Registro de fases</label><br>
                                    <input type='checkbox' id='registro_fase_p' checked><br>
                                </div>

                                <div hidden class='col-md-2 keyss'>
                                    <label for='perdidas_produccion_p'>Perdidas de producción</label><br>
                                    <input type='checkbox' id='perdidas_produccion_p' checked><br>
                                </div>

                                <div class='col-md-2 keyss'>
                                    <label for='reporters_p'>Reportes</label><br>
                                    <input type='checkbox' id='reporters_p'><br>
                                </div>

                                <br>
                            </div>

                        </div>

                        <?php } ?>
                    </div>
                    <div class="card-footer">
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/rolesuser/list');" class='btn btn-danger'>Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/usuario.js"></script>