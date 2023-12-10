<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Formulario clientes</li>
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

                        <input type="hidden" id="proveedorID" value="<?php echo $editar[0]; ?>">

                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="ruc">Rúc</label> <span id="ruc_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="ruc" class="form-control" id="ruc" placeholder="Ingrese ruc" maxlength="13">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="razon_social">Razon social</label> <span id="razon_social_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $editar[2]; ?>" type="text" name="razon_social" class="form-control" id="razon_social" placeholder="Ingrese razon social" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="correo">Correo</label> <span id="correo_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $editar[3]; ?>" type="text" name="correo" class="form-control" id="correo" placeholder="Ingrese correo" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direccion">Direccion</label> <span id="direccion_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" value="<?php echo $editar[4]; ?>" type="text" name="direccion" class="form-control" id="direccion" placeholder="Ingrese direccion" maxlength="100">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label> <span id="telefono_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" autocomplete="off" value="<?php echo $editar[5]; ?>" type="text" name="telefono" class="form-control" id="telefono" placeholder="Ingrese telefono" maxlength="11">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="encargado">Nombre del encargado</label> <span id="encargado_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloLetras(event)" autocomplete="off" value="<?php echo $editar[6]; ?>" type="text" name="encargado" class="form-control" id="encargado" placeholder="Ingrese encargado" maxlength="100">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción del proveedor</label> <span id="descripcion_olbligg" style="color: red;"></span>
                                    <textarea class="form-control" id="descripcion" cols="3" rows="3"><?php echo $editar[7]; ?></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/proveedor/list/0');" class='btn btn-danger'>Volver</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/compra.js"></script>

<script>
    var correo_proveedor = true;

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
                    correo_proveedor = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#correo_olbligg").html("Email incorrecto");
                    correo_proveedor = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#correo_olbligg").html("");
            correo_proveedor = false;
        }
    });

    $("#ruc").validarCedulaEC({
        onValid: function() {
            $("#ruc_olbligg").html("");
        },
        onInvalid: function() {
            $("#ruc_olbligg").html(" - Ruc incorrecto");
            $("#ruc").val("");
            $("#ruc").focus();
        }
    });
</script>