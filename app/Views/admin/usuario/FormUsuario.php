<style>
  .select2-selection {
    height: 37px !important;
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

                        <input type="hidden" id="usuaruiID" value="<?php echo $editar[0]; ?>">

                        <div class="row">

                            <?php if ($image) { ?>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombres">Nombres</label> <span id="nombres_olbligg" style="color: red;"></span>
                                        <input onkeypress="return soloLetras(event)" autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="nombres" class="form-control" id="nombres" placeholder="Ingrese nombres" maxlength="80">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label> <span id="apellidos_olbligg" style="color: red;"></span>
                                        <input onkeypress="return soloLetras(event)" autocomplete="off" value="<?php echo $editar[2]; ?>" type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Ingrese apellidos" maxlength="80">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="correo">Correo</label> <span id="correo_olbligg" style="color: red;"></span>
                                        <input autocomplete="off" value="<?php echo $editar[3]; ?>" type="text" name="correo" class="form-control" id="correo" placeholder="Ingrese correo" maxlength="80">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cedula">Cedula</label> <span id="cedula_olbligg" style="color: red;"></span>
                                        <input onkeypress="return soloNumeros(event)" autocomplete="off" value="<?php echo $editar[4]; ?>" type="text" name="cedula" class="form-control" id="cedula" placeholder="Ingrese cedula" maxlength="10">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo_rol">Tipo rol</label> <span id="rol_olbligg" style="color: red;"></span>
                                        <select name="tipo_rol" id="tipo_rol" class="form-control" style="width: 100%;">

                                            <?php if (!empty($rol) && is_array($rol)) {
                                                foreach ($rol as $rol_item) { ?>
                                                    <option value="<?= esc($rol_item["id"]); ?>" <?php if ($rol_item['id'] == $editar[5]) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= esc($rol_item["rol"]); ?></option>
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
                                        <input autocomplete="off" value="<?php echo $editar[7]; ?>" type="text" name="usuario" class="form-control" id="usuario" placeholder="Ingrese usuario" maxlength="50">
                                    </div>
                                </div>

                            <?php } ?>

                            <?php if ($plus) { ?>

                                <?php if ($image) { ?>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="password">Password</label> <span id="password_olbligg" style="color: red;"></span>
                                        <input autocomplete="off" value="<?php echo $editar[1]; ?>" type="password" name="password" class="form-control" id="password" placeholder="Ingrese password" maxlength="20">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="confirm_password">Confirmar Password</label> <span id="confirm_password_olbligg" style="color: red;"></span>
                                        <input autocomplete="off" value="<?php echo $editar[1]; ?>" type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirmar Password" maxlength="20">
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Ver</label>
                                        <button onclick="mostrar_usu();" class="btn btn-warning"><i class="fa fa-eye"></i> Ver</button>
                                    </div>
                                </div>

                                <?php } ?>
                                
                                <div class="col-lg-12">
                                    <div class="form-group text-center">
                                        <label>Foto del usuario</label> <span style="color: orange;"> - La foto del usuario es opcional</span>
                                        <img id="img_usuario" height="250" width="300" class="border rounded mx-auto d-block img-fluid"

                                        <?php if ($image) { ?> 
                                        src="<?php echo base_url(); ?>public/img/admin.jpg" />
                                        <?php }else{ ?>
                                        src="<?php echo base_url(); ?>public/img/usuario/<?php echo $editar[9]; ?>" />
                                        <?php } ?>
                                        <input type="file" class="form-control" id="foto" onchange="mostrar_imagen(this)" />
                                    </div>
                                </div>

                                <input type="hidden" value="<?php echo $editar[9]; ?>" id="foto_actu">

                            <?php } ?>

                        </div>

                    </div>
                    <div class="card-footer">
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/UsuariosAccion/list');" class='btn btn-danger'>Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/usuario.js"></script>

<script>
    $("#tipo_rol").select2();
    var cedula_v = true;
    var correo_usus = true;

    function mostrar_usu() {
        var ver = document.getElementById("password");
        var con = document.getElementById("confirm_password");

        if (ver.type == "password") {
            ver.type = "text";
            con.type = "text";
        } else {
            ver.type = "password";
            con.type = "password";
        }
    }

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

    $("#cedula").keyup(function() {
        if (this.value != "") {
            var cad = document.getElementById("cedula").value.trim();
            var total = 0;
            var longitud = cad.length;
            var longcheck = longitud - 1;

            if (cad != "") {
                if (cad !== "" && longitud === 10) {
                    for (i = 0; i < longcheck; i++) {
                        if (i % 2 === 0) {
                            var aux = cad.charAt(i) * 2;
                            if (aux > 9) aux -= 9;
                            total += aux;
                        } else {
                            total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar           
                        }
                    }
                    total = total % 10 ? 10 - total % 10 : 0;
                    if (cad.charAt(longitud - 1) == total) {

                        var digitos = String(cad).split('').map(d => parseInt(d));
                        var digito = digitos[0];
                        var veri = digitos.every((d) => d == digito);

                        if (!veri) {
                            $(this).css("border", "1px solid green");
                            $("#cedula_olbligg").html("");
                            cedula_v = true;
                        } else {
                            document.getElementById("cedula_olbligg").innerHTML = ("cedula Inválida");
                            $(this).css("border", "1px solid red");
                            cedula_v = false;
                        }

                    } else {
                        document.getElementById("cedula_olbligg").innerHTML = ("cedula Inválida");
                        $(this).css("border", "1px solid red");
                        cedula_v = false;
                    }
                } else {
                    document.getElementById("cedula_olbligg").innerHTML = ("La cedula no tiene 10 digitos");
                    $(this).css("border", "1px solid red");
                    cedula_v = false;
                }
            } else {
                document.getElementById("cedula_olbligg").innerHTML = ("Debe ingresra una cedula");
                $(this).css("border", "1px solid red");
                cedula_v = false;
            }
        } else {
            $(this).css("border", "1px solid green");
            $("#cedula_olbligg").html("");
            cedula_v = false;
        }
    });

    $("#correo").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo').addEventListener('input', function() {
                campo = event.target;
                //este codigo me da formato email
                email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                //esto es para validar si es un email valida
                if (email.test(campo.value)) {
                    //estilos para cambiar de color y ocultar el boton
                    $(this).css("border", "1px solid green");
                    $("#correo_olbligg").html("");
                    correo_usus = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#correo_olbligg").html("Email incorrecto");
                    correo_usus = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#correo_olbligg").html("");
            correo_usus = false;
        }
    });
</script>