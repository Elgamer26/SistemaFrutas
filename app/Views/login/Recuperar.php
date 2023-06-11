<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/adminlte.min.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/tienda.jpg" type="image/x-icon">
</head>

<body class="login-page" style="min-height: 331.956px;">
    <div class="login-box">
        <div class="login-logo">
            <a href="javascript:;"><b>Recuperar </b>Password</a> <i class="fa fa-key"></i>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">¿Olvidaste tu contraseña? Aquí puede recuperar fácilmente una nueva contraseña.</p>

                <div style="text-align: center;
                                background: #ff000094;
                                padding: 10px;
                                color: white; 
                                display: none;" id="none_usu">
                    <span><b> Ingrese un correo para continuar</b></span>
                </div>

                <div style="text-align: center;
                                background: #ff000094;
                                padding: 10px;
                                color: white;
                                display: none;" id="none_pass">
                    <span><b> Correo invalido / no puedo enviar el correo</b></span>
                </div>

                <div style="text-align: center;
                                background: green;
                                padding: 10px;
                                color: white;
                                display: none;" id="correo_enviado">
                    <span><b> Password enviado al correo ingresado</b></span>
                </div>

                <br>

                <div class="input-group mb-3">
                    <input type="email" id="email_correo" class="form-control" placeholder="Correo electronico">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" id="btn_recuperarPassAdmin" class="btn btn-primary btn-block">Recuperar password</button>
                    </div>
                    <!-- /.col -->
                </div>

                <p class="mt-3 mb-1">
                    <a href="<?php echo base_url(); ?>admin">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <script src="<?php echo base_url(); ?>public/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>public/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

    <script src="<?php echo base_url(); ?>public/js/usuario.js"></script>

</body>

</html>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";
</script>