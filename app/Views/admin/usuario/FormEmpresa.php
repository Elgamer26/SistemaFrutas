<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Formulario Empresa</li>
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

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre empresa</label> <span id="nombre_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $ListEmpresa[1]; ?>" type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingres nombre de la empresa" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label> <span id="direccion_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $ListEmpresa[2]; ?>" type="text" name="direccion" class="form-control" id="direccion" placeholder="Ingrese dirección" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="correo_e">Correo</label> <span id="correo_e_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $ListEmpresa[3]; ?>" type="text" name="correo_e" class="form-control" id="correo_e" placeholder="Ingrese correo" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ruc">Rúc</label> <span id="ruc_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" autocomplete="off" value="<?php echo $ListEmpresa[4]; ?>" type="text" name="ruc" class="form-control" id="ruc" placeholder="Ingrese Rúc" maxlength="13">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label> <span id="telefono_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" autocomplete="off" value="<?php echo $ListEmpresa[5]; ?>" type="text" name="telefono" class="form-control" id="telefono" placeholder="Ingrese telefono" maxlength="11">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="actividad">Actividad de la empresa</label> <span id="actividad_olbligg" style="color: red;"></span>
                                    <textarea class="form-control" id="actividad" rows="3" cols="3"><?php echo $ListEmpresa[6]; ?></textarea>
                                </div>
                            </div>

                            <input type="hidden" id="foto_actual" value="<?php echo $ListEmpresa[7]; ?>">

                            <div class="col-lg-12">
                                <div class="form-group text-center">
                                    <label>Foto de empresa</label> <span style="color: orange;"> </span>
                                    <img id="img_empresa" height="250" width="300" class="border rounded mx-auto d-block img-fluid" src="<?php echo base_url(); ?>public/img/empresa/<?php echo $ListEmpresa[7]; ?>" />
                                    <input type="file" class="form-control" id="fotoe" onchange="mostrar_imagen_empresa(this)" />
                                    <button class="btn btn-warning" onclick="UpdateImageEmpresa();"><i class="fa fa-image"></i> <b>Editar foto</b></button>
                                </div>
                            </div> 

                        </div>

                    </div>
                    <div class="card-footer">
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/EmpresaView');" class='btn btn-danger'>Recargar</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/usuario.js"></script>

<script>
    var correo_empresa = true;

    function mostrar_imagen_empresa(input) {
        var filename = document.getElementById("fotoe").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img_empresa").attr("src", e.target.result).height(250).width(300);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            return document.getElementById("fotoe").value = "";
        }

    }

    $("#correo_e").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo_e').addEventListener('input', function() {
                campo = event.target;
                //este codigo me da formato email
                email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                //esto es para validar si es un email valida
                if (email.test(campo.value)) {
                    //estilos para cambiar de color y ocultar el boton
                    $(this).css("border", "1px solid green");
                    $("#correo_e_olbligg").html("");
                    correo_empresa = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#correo_e_olbligg").html("Email incorrecto");
                    correo_empresa = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#correo_e_olbligg").html("");
            correo_empresa = false;
        }
    });
</script>