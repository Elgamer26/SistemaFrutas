<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrador | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/summernote/summernote-bs4.min.css">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/logos/load.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Crear Usuario <i class='fa fa-user-plus'></i> </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Formulario cliente</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title"><b> Registro de usuario <i class='fa fa-user'></i> </b></h3>
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
                            <button onclick='RegistraCliente();' class='btn btn-success'>Registrar <i class="fa fa-edit"></i></button>   <a href="<?php echo base_url(); ?>home/login" class='btn btn-danger'>Volver </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script src="<?php echo base_url(); ?>public/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/sparklines/sparkline.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="<?php echo base_url(); ?>public/dist/js/adminlte.js"></script>
    <script src="<?php echo base_url(); ?>public/dist/js/pages/dashboard.js"></script>

    <!-- //// agregados por mi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>