<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/loginCli/fonts/icomoon/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/loginCli/css/owl.carousel.min.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/tienda.jpg" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/loginCli/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/loginCli/css/style.css">

    <title>Login cliente</title>
</head>

<body>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="<?php echo base_url(); ?>public/loginCli/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
                    <a href="<?php echo base_url(); ?>admin">Admin</a>
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4" style="text-align: center;">
                                <h3><b>Iniciar sesión</b></h3>
                            </div>

                            <div style="text-align: center;
                                background: #ff000094;
                                padding: 10px;
                                color: white;
                                display: none; " id="none_usu">
                                <span><b> Ingrese un correo para continuar</b></span>
                            </div>

                            <div style="text-align: center;
                                background: #ff000094;
                                padding: 10px;
                                color: white;
                                display: none;" id="none_pass">
                                <span><b> Ingrese un password para continuar</b></span>
                            </div>

                            <p></p>

                            <div class="form-group first">
                                <label for="cedula">Correo</label>
                                <input type="text" class="form-control" id="cedula" autocomplete="off">
                            </div>

                            <div class="form-group last mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" autocomplete="off">
                            </div>

                            <div class="alert alert-danger text-center" id="error_logeo" style="color: white; display:none; text-align: center; background: red; border-radius: 15px; padding: 10px;  text-align: center;">
                                <span> Usuario o contraseña incorrectos</span>
                            </div>

                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Acuérdate de mí</span>
                                    <input type="checkbox" checked="checked" />
                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="<?php echo base_url(); ?>home/Recuperar" class="forgot-pass">Has olvidado tu contraseña?</a></span>
                            </div>

                            <input type="button" id="btn_aceptar" value="Iniciar sesión" class="btn text-white btn-block btn-primary">
                            <input type="button" id="btn_registrase" value="Crear usuario" class="btn text-white btn-block btn-warning" style="background: #1288e5 !important;">
                            <input type="button" id="btn_atras" value="Tienda" class="btn text-white btn-block btn-danger">

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>public/loginCli/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>public/loginCli/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>public/loginCli/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/loginCli/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo base_url(); ?>public/js/cliente.js"></script>

</body>

</html>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";
</script>