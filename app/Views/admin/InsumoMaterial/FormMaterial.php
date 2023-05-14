<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Material/list/0');">Listado material</a></li>
                    <li class="breadcrumb-item active">Formulario material</li>
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
                        <input type="hidden" id="materialID" value="<?php echo $editar[0]; ?>">
                        <div class="row">

                            <?php if ($image) { ?>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="codigo">Código</label> <span id="codigo_olbligg" style="color: red;"></span>
                                        <input onkeypress="return soloNumeros(event)" autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="codigo" class="form-control" id="codigo" placeholder="Ingrese codigo" maxlength="15">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombres">Nombre</label> <span id="nombres_olbligg" style="color: red;"></span>
                                        <input onkeypress="return soloLetras(event)" autocomplete="off" value="<?php echo $editar[2]; ?>" type="text" name="nombres" class="form-control" id="nombres" placeholder="Ingrese nombre del material" maxlength="100">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_material">Tipo material</label> <span id="tipo_material_olbligg" style="color: red;"></span>
                                        <select name="tipo_material" id="tipo_material" class="form-control" style="width: 100%;">

                                            <?php if (!empty($tipo) && is_array($tipo)) {
                                                foreach ($tipo as $tipo_item) { ?>
                                                    <option value="<?= esc($tipo_item["id"]); ?>" <?php if ($tipo_item['id'] == $editar[3]) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= esc($tipo_item["tipo"]); ?></option>
                                                <?php }
                                            } else { ?>
                                                <option value="">No hay tipo</option>
                                            <?php }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="precio_venta">Precio de compra</label> <span id="precio_venta_olbligg" style="color: red;"></span>
                                        <input onkeypress="return filterfloat(event, this);" autocomplete="off" value="<?php echo $editar[5]; ?>" type="text" name="precio_venta" class="form-control" id="precio_venta" placeholder="Ingrese precio compra" maxlength="10">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción del material</label> <span id="descripcion_olbligg" style="color: red;"></span>
                                        <textarea class="form-control" id="descripcion" cols="3" rows="3"><?php echo $editar[6]; ?></textarea>
                                    </div>
                                </div>

                            <?php } ?>

                            <?php if ($plus) { ?>

                                <div class="col-lg-12">
                                    <div class="form-group text-center">
                                        <label>Foto del material</label> <span style="color: orange;"> - La foto del material es opcional</span>
                                        <img id="img_material" height="250" width="300" class="border rounded mx-auto d-block img-fluid" <?php if ($image) { ?> src="<?php echo base_url(); ?>public/img/material/material.jpg" />
                                    <?php } else { ?>
                                        src="<?php echo base_url(); ?>public/img/material/<?php echo $editar[7]; ?>" />
                                    <?php } ?>
                                    <input type="file" class="form-control" id="foto" onchange="mostrar_material(this)" />
                                    </div>
                                </div>

                                <input type="hidden" value="<?php echo $editar[7]; ?>" id="foto_actu">

                            <?php } ?>

                        </div>

                    </div>

                    <div class="card-footer">
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Material/list/0');" class='btn btn-danger'>Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/materialMaterial.js"></script>

<script>
    $("#tipo_material").select2();

    function mostrar_material(input) {
        var filename = document.getElementById("foto").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img_material").attr("src", e.target.result).height(250).width(300);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            $("#img_material").attr("src", "<?php echo base_url(); ?>public/img/material/material.jpg").height(200).width(250);
            return document.getElementById("foto").value = "";
        }

    }
</script>