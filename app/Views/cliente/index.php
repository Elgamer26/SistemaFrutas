<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cliente | Dashboard</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/fontawesome-free/css/all.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/adminlte.min.css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/logos/load.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/DataTables/datatables.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?php echo base_url(); ?>public/img/logos/load.png" style="border-radius: 100px;" alt="AdminLTELogo" height="350" width="350">
    </div>

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url(); ?>public/img/cliente.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $user; ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>home/Perfil" class="nav-link">
                                <i class="nav-icon fa fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>home/DatosCliente/data');" class="nav-link">
                                <i class="nav-icon fa fa-user"></i>
                                <p>
                                    Perfil
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>home/Credenciales/data');" class="nav-link">
                                <i class="nav-icon fa fa-key"></i>
                                <p>
                                    Cambiar password
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>home/ListaCompras/tienda');" class="nav-link">
                                <i class="nav-icon fa fa-shopping-cart"></i>
                                <p>
                                    Compras
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>home/ListaCompras/web');" class="nav-link">
                                <i class="nav-icon fa fa-shopping-cart"></i>
                                <p>
                                    Compras Web
                                </p>
                            </a>
                        </li>

                        <li class="nav-item" style="background: green; color: white;">
                            <a href="<?php echo base_url(); ?>home" class="nav-link">
                                <i class="nav-icon fa fa-home"></i>
                                <p>
                                    Tienda
                                </p>
                            </a>
                        </li>

                        <li class="nav-item" style="background: red; color: white;">
                            <a onclick="CerraSesion();" class="nav-link">
                                <i class="nav-icon fa fa-times"></i>
                                <p>
                                    Cerra sesión
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>

        </aside>

        <div class="content-wrapper" id="contenido_principal">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><b>Bienvenid@ </b></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <img style="width: 100%; height: 410px; object-fit: cover;" src="<?php echo base_url(); ?>public/img/tienda/tienda1.jpg" alt="Imagen de tienda" />
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2023</strong>Todos los derechos reservados, JR.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    <script src="<?php echo base_url(); ?>public/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>public/dist/js/adminlte.js"></script>

    <!-- //// agregados por mi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

</body>

</html>

<div class="modal fade" id="ModalDataUsuario" tabindex="-1" role="dialog" aria-labelledby="ModalDataUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #007bff;">
                <h5 class="modal-title" id="ModalDataUsuarioLabel" style="color: white;"><b>Datos del usuario</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">

                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-tabs">

                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Datos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Foto</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Password</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">

                                    <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombresData">Nombres</label> <span id="nombresData_olbligg" style="color: red;"></span>
                                                    <input onkeypress="return soloLetras(event)" autocomplete="off" value="" type="text" name="nombresData" class="form-control" id="nombresData" placeholder="Ingrese nombres" maxlength="80">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="apellidosData">Apellidos</label> <span id="apellidosData_olbligg" style="color: red;"></span>
                                                    <input onkeypress="return soloLetras(event)" autocomplete="off" value="" type="text" name="apellidosData" class="form-control" id="apellidosData" placeholder="Ingrese apellidos" maxlength="80">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="correoData">Correo</label> <span id="correoData_olbligg" style="color: red;"></span>
                                                    <input autocomplete="off" value="" type="text" name="correoData" class="form-control" id="correoData" placeholder="Ingrese correo" maxlength="80">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="usuarioData">Usuario</label> <span id="usuarioData_olbligg" style="color: red;"></span>
                                                    <input autocomplete="off" value="" type="text" name="usuarioData" class="form-control" id="usuarioData" placeholder="Ingrese usuarioData" maxlength="50">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button class="btn btn-primary" onclick="GuardarDatoPerfilUser();"><i class="fa fa-save"></i> Guardar</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="card card-primary card-outline">
                                                    <div class="card-body box-profile">
                                                        <div class="text-center">
                                                            <img style="width: 35%;" class="profile-user-img img-fluid img-circle" id="FotoPerfilUser" alt="User foto">
                                                            <input onchange="mostrar_imagenData(this);" type="file" class="form-control" id="foto_new">
                                                        </div>
                                                        <br>
                                                        <a href="#" class="btn btn-primary btn-block" onclick="UpdatePhotoUser();"><b><i class="fa fa-image"></i> Cambiar foto</b></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password_actu">Password actual</label> <span id="password_actu_olbligg" style="color: red;"></span>
                                                    <input autocomplete="off" value="" type="password" name="password" class="form-control" id="password_actu" placeholder="Ingrese password actual" maxlength="20">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="nuevo_password">Nuevo Password</label> <span id="nuevo_password_olbligg" style="color: red;"></span>
                                                    <input autocomplete="off" value="" type="password" name="nuevo_password" class="form-control" id="nuevo_password" placeholder="Nuevo Password" maxlength="20">
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label>Ver</label>
                                                    <button onclick="mostrar_usu_data();" class="btn btn-warning"><i class="fa fa-eye"></i> </button>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button class="btn btn-primary" onclick="CambiarPasswordUser();"><i class="fa fa-key"></i> Cambiar</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Guardar</button> -->
            </div>
        </div>
    </div>
</div>

<script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";

    function cargar_contenido(contenedor, contenido) {
        $("#" + contenedor).load(contenido);
    }

    /////////////////
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-39-46";
        tecla_especial = false;
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return swal.fire(
                "No se permiten números!!",
                "Solo se permiten letras",
                "warning"
            );
        }
    }

    function soloNumeros(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            return swal.fire(
                "No se permiten letras!!",
                "Solo se permiten números",
                "warning"
            );
        }
    }

    function filterfloat(evt, input) {
        var key = window.Event ? evt.which : evt.keyCode;
        var chark = String.fromCharCode(key);
        var tempvalue = input.value + chark;
        if (key >= 48 && key <= 57) {
            if (filter(tempvalue) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            if (key == 8 || key == 13 || key == 0) {
                return false;
            } else if (key === 46) {
                if (filter(tempvalue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return swal.fire(
                    "No se permiten letras!!",
                    "Solo se permiten números decimales",
                    "warning"
                );
            }
        }
    }

    function filter(__val__) {
        var preg = /^([0-9]+\.?[0-9]{0,2})$/;
        if (preg.test(__val__) === true) {
            return true;
        } else {
            return false;
        }
    }

    //////////////////
    function CerraSesion() {
        Swal.fire({
            title: 'Cerrar Sesión?',
            text: "Desea cerra sesión!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, cerrar!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = BaseUrl + "cliente/CerraSesionCliente";
            }
        })
    }
</script>