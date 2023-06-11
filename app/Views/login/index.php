<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/login/fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/login/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/login/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/login/css/style.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/logos/login_icono.jpg " type="image/x-icon">
    <title>Login del sistema</title>
</head>

<body style="background-image: url('');">

    <div class="content" style="padding: 100px 0 0 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo base_url(); ?>public/login/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4 text-center">
                                <h3>Login</h3>
                            </div>

                            <div style="text-align: center;
                                background: #ff000094;
                                padding: 10px;
                                color: white;
                                display: none; " id="none_usu">
                                <span><b> Ingrese un usuario para continuar</b></span>
                            </div>

                            <div style="text-align: center;
                                background: #ff000094;
                                padding: 10px;
                                color: white;
                                display: none;" id="none_pass">
                                <span><b> Ingrese un password para continuar</b></span>
                            </div>

                            <p></p>
                            <label for="username"><b>Usuario</b></label>
                            <div class="form-group first">
                                <input type="text" class="form-control" id="username">
                            </div>

                            <label for="password"><b>Password</b></label>
                            <div class="form-group last mb-4">
                                <input type="password" class="form-control" id="password">
                            </div>

                            <div class="alert alert-danger text-center" id="error_logeo" style="color: white; display:none; text-align: center; background: red; border-radius: 15px; padding: 10px;  text-align: center;">
                                <span> Usuario o contraseña incorrectos</span>
                            </div>

                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Acuérdate de mí</span>
                                    <input type="checkbox" id="recordar" checked="checked" />
                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="<?php echo base_url(); ?>admin/Recuperar" class="forgot-pass">Has olvidado tu contraseña</a></span>
                            </div>

                            <input type="button" id="btn_aceptar" value="Acceso" class="btn btn-block btn-primary">
                            <input type="button" id="btn_tienda" value="Tienda" class="btn btn-block btn-danger">

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>public/login/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>public/login/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>public/login/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/login/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?php echo base_url(); ?>public/js/usuario.js"></script>

</body>

</html>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";

    function RecordaPasswordAdmin() {

        const rmcheck = document.getElementById("recordar");
        const password = document.getElementById("password");
        const usuario = document.getElementById("username");

        if (rmcheck.checked == true) {
            if (rmcheck.checked || usuario.value != "" || password.value != "") {

                localStorage.usuario = usuario.value;
                localStorage.password = password.value;
                localStorage.checkbox = rmcheck.checked;
            } else {
                localStorage.usuario = "";
                localStorage.password = "";
                localStorage.checkbox = "";
            }
        } else {
            localStorage.clear();
        }
    }

    $(document).ready(function() {

        const rmcheck = document.getElementById("recordar");
        const password = document.getElementById("password");
        const usuario = document.getElementById("username");

        if (localStorage.checkbox && localStorage.checkbox != "") {
            rmcheck.setAttribute("checked", "checked");
            password.value = localStorage.password;
            usuario.value = localStorage.usuario;
        } else {
            rmcheck.removeAttribute("checked");
            password.value = "";
            usuario.value = "";
        }

    })
</script>