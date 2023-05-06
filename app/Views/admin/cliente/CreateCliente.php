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

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombres">Nombres</label> <span id="nombres_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloLetras(event)" autocomplete="off" type="text" name="nombres" class="form-control" id="nombres" placeholder="Ingrese nombres" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label> <span id="apellidos_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloLetras(event)" autocomplete="off" type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Ingrese apellidos" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo">Correo</label> <span id="correo_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" type="text" name="correo" class="form-control" id="correo" placeholder="Ingrese correo" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cedula">Cedula</label> <span id="cedula_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" autocomplete="off" type="text" name="cedula" class="form-control" id="cedula" placeholder="Ingrese cedula" maxlength="10">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sexo">Sexo</label> <span id="sexo_olbligg" style="color: red;"></span>
                                    <select name="sexo" id="sexo" class="form-control" style="width: 100%;">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direccion">Direccion</label> <span id="direccion_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" type="text" name="direccion" class="form-control" id="direccion" placeholder="Ingrese direccion" maxlength="100">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label> <span id="telefono_olbligg" style="color: red;"></span>
                                    <input onkeypress="return soloNumeros(event)" autocomplete="off" type="text" name="telefono" class="form-control" id="telefono" placeholder="Ingrese telefono" maxlength="10">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">

                        <?php echo $accion; ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/cliente.js"></script>

<script>
    var cedula_cliente = true;
    var correo_cliente = true;

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
                            cedula_cliente = true;
                        } else {
                            document.getElementById("cedula_olbligg").innerHTML = ("cedula Inválida");
                            $(this).css("border", "1px solid red");
                            cedula_cliente = false;
                        }

                    } else {
                        document.getElementById("cedula_olbligg").innerHTML = ("cedula Inválida");
                        $(this).css("border", "1px solid red");
                        cedula_cliente = false;
                    }
                } else {
                    document.getElementById("cedula_olbligg").innerHTML = ("La cedula no tiene 10 digitos");
                    $(this).css("border", "1px solid red");
                    cedula_cliente = false;
                }
            } else {
                document.getElementById("cedula_olbligg").innerHTML = ("Debe ingresra una cedula");
                $(this).css("border", "1px solid red");
                cedula_cliente = false;
            }
        } else {
            $(this).css("border", "1px solid green");
            $("#cedula_olbligg").html("");
            cedula_cliente = false;
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
                    correo_cliente = true;
                } else {
                    $(this).css("border", "1px solid red");
                    $("#correo_olbligg").html("Email incorrecto");
                    correo_cliente = false;
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#correo_olbligg").html("");
            correo_cliente = false;
        }
    });
</script>