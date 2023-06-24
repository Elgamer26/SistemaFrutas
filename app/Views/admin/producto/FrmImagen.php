<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php

                        use function PHPUnit\Framework\lessThan;

                        echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Producto/list/0');">Listado producto</a></li>
                    <li class="breadcrumb-item active">Formulario producto</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css">

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-<?php echo $color; ?>">
                    <div class="card-header">
                        <h3 class="card-title"><b><?php echo $texto; ?></b></h3>
                    </div>

                    <div class="card-body">
                        <input type="hidden" id="productoID" value="<?php echo $editar[0]; ?>">
                        <div class="row">

                            <?php if ($image) { ?>

                            <?php } ?>

                            <?php if ($plus) { ?>

                                <!-- <div class="col-lg-12">
                                    <div class="form-group text-center">
                                        <label>Foto del producto</label> <span style="color: orange;"> - La foto del producto es opcional</span>
                                        <img id="img_producto" height="250" width="300" class="border rounded mx-auto d-block img-fluid" <?php if ($image) { ?> src="<?php echo base_url(); ?>public/img/producto/producto.jpg" />
                                    <?php } else { ?>
                                        src="<?php echo base_url(); ?>public/img/producto/<?php echo $editar[7]; ?>" />
                                    <?php } ?>
                                    <input type="file" class="form-control" id="foto" onchange="mostrar_producto(this)" />
                                    </div>
                                </div> -->

                                <div class="col-md-12">
                                    <h3 style="padding: 20px 0; text-align: center;"> <b> Imágenes del producto </b></h3>

                                    <div class="row">

                                        <?php
                                        if (count($imagenes) != 0) {

                                            foreach ($imagenes as $imagenes_item) { ?>

                                                <div class="col-md-3 text-center">
                                                    <div style="padding: 0px 0px 25px 0px">
                                                        <img class="user-img" id="foto_perfil" width="200" height="200" src="<?= base_url() . "public/img/producto/" . esc($imagenes_item["foto"]); ?>">

                                                        <a style="color: white; margin: 10px;" onclick="QuitarImagenProyect(<?= esc($imagenes_item['id']); ?>, <?= esc($imagenes_item['id_producto']); ?>, '<?= esc($imagenes_item['foto']); ?>');" class="btn btn-danger"><i class="fa fa-trash"></i> Quitar imagen</a>
                                                    </div>
                                                </div>

                                            <?php  }
                                        } else { ?>

                                    </div>
                                    <h3 style="padding: 20px 0; text-align: center;"> <b> No hay imagenes de producto </b></h3>
                                <?php } ?>
                                </div>

                                <input type="hidden" value="<?php echo $editar[7]; ?>" id="foto_actu">

                                <div class="col-md-12">

                                    <hr>

                                    <div id="wrapper">
                                        <h3 style="padding: 20px 0; text-align: center;"> <b> Cargar Imágenes </b></h3>
                                        <div id="container-input">
                                            <div class="wrap-file">
                                                <div class="content-icon-camera">
                                                    <input type="file" id="file" name="file[]" accept="image/*" multiple />
                                                    <div class="icon-camera"></div>
                                                </div>
                                                <div id="preview-images">
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div><br>
                                </div>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="card-footer">
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Producto/list/0');" class='btn btn-danger'>Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/producto.js"></script>

<script>
    //esto muestra la imagen de forma previsualizada
    (function() {
        var file = document.getElementById("file");
        var preload = document.querySelector(".preload");
        var publish = document.getElementById("publish");
        var formData = new FormData();

        file.addEventListener("change", function(e) {
            for (var i = 0; i < file.files.length; i++) {
                var thumbnail_id = Math.floor(Math.random() * 30000) + "_" + Date.now();
                createThumbnail(file, i, thumbnail_id);
                formData.append(thumbnail_id, file.files[i]);
            }
        });

        var createThumbnail = function(file, iterator, thumbnail_id) {
            var thumbnail = document.createElement("div");
            thumbnail.classList.add("thumbnail", thumbnail_id);
            thumbnail.dataset.id = thumbnail_id;

            thumbnail.setAttribute(
                "style",
                `background-image: url(${URL.createObjectURL(file.files[iterator])})`
            );

            var nombre = file.files[iterator].name;
            var ext = nombre.substring(nombre.lastIndexOf("."));
            if (ext != ".png" && ext != ".jpg" && ext != ".jpeg") {
                var valida = false;
            } else {
                var valida = true;
            }

            if (!valida) {
                //en caso de que no sean validos las extensiones manda alert y limpio el file
                return alert(
                    "este archivo: " +
                    nombre +
                    " no es valido o no se ha seleccionado archvio"
                );
            }

            document.getElementById("preview-images").appendChild(thumbnail);
            createCloseButton(thumbnail_id);
        };

        var createCloseButton = function(thumbnail_id) {
            var closeButton = document.createElement("div");
            closeButton.classList.add("close-button");
            closeButton.innerText = "x";
            document.getElementsByClassName(thumbnail_id)[0].appendChild(closeButton);
        };

        document.body.addEventListener("click", function(e) {
            if (e.target.classList.contains("close-button")) {
                e.target.parentNode.remove();
                formData.delete(e.target.parentNode.dataset.id);
            }
        });
    })();
</script>