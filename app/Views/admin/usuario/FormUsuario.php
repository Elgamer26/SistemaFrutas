<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/UsuariosAccion/list');">Listado usuarios</a></li>
                    <li class="breadcrumb-item active">Formulario usuario</li>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombres">Nombres</label> <span id="nombres_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloLetras(event)" autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="nombres" class="form-control" id="nombres" placeholder="Ingres nombres" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label> <span id="apellidos_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloLetras(event)" autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Ingrese apellidos" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="correo">Correo</label> <span id="correo_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="correo" class="form-control" id="correo" placeholder="Ingrese correo" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cedula">Cedula</label> <span id="cedula_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="cedula" class="form-control" id="cedula" placeholder="Ingrese cedula" maxlength="10">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tipo_rol">Tipo rol</label> <span id="rol_olbligg" style="color: red;"></span>
                                    <select name="tipo_rol" id="tipo_rol" class="form-control" style="width: 100%;">

                                        <?php if (!empty($rol) && is_array($rol)) {
                                            foreach ($rol as $rol_item) { ?>
                                                <option value="<?= esc($rol_item["id"]); ?>"><?= esc($rol_item["rol"]); ?></option>
                                            <?php }
                                        } else { ?>
                                            <option value="">No hay rol</option>
                                        <?php }
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label> <span id="usuario_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="usuario" class="form-control" id="usuario" placeholder="Ingrese usuario" maxlength="50">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password</label> <span id="password_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="password" class="form-control" id="password" placeholder="Ingrese password" maxlength="20">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="confirm_password">Confirmar Password</label> <span id="confirm_password_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirmar Password" maxlength="20">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Ver</label>
                                    <button class="btn btn-warning"><i class="fa fa-eye"></i> Ver</button>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group text-center">
                                    <label>Foto del usuario</label> <span id="confirm_password_olbligg" style="color: orange;"> - La foto del usuario es opcional</span>
                                    <img id="img_usuario" height="250" width="300" class="border rounded mx-auto d-block img-fluid" src="<?php echo base_url(); ?>public/img/admin.jpg" />
                                    <input type="file" class="form-control" id="foto" onchange="mostrar_imagen(this)" />
                                </div>
                            </div>

                        </div>

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
<script>
    $("#tipo_rol").select2();

    function mostrar_imagen(input) {
        var filename = document.getElementById("foto").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#img_usuario").attr("src", e.target.result).height(250).width(300);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            $("#img_usuario").attr("src", "<?php echo base_url(); ?>public/img/admin.jpg").height(200).width(250);
            return document.getElementById("foto").value = "";
        }

    }
</script>