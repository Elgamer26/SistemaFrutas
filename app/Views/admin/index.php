<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrador | Dashboard</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/logos/load.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/DataTables/datatables.min.css">

</head>

<style>
  .select2-selection {
    height: 37px !important;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo base_url(); ?>public/img/logos/load.png" style="border-radius: 100px;" alt="AdminLTELogo" height="350" width="350">
  </div>

  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

        <li class="nav-item dropdown" style="background-color: #007bff; border-radius: 50px; color: white;">
          <a href="<?php echo base_url(); ?>" target="_blank" class="nav-link">
            <i class="fa fa-shopping-cart" style="color: white;"></i>
          </a>
        </li>

        <li class="nav-item dropdown" style="background-color: green; border-radius: 50px; color: white;">
          <a onclick="ModalDatoUsuario();" class="nav-link" data-toggle="dropdown">
            <i class="far fa-user" style="color: white;"></i>
          </a>
        </li>

        <li hidden style="background-color: red; border-radius: 50px;" class="nav-item dropdown">
          <a class="nav-link" style="color: white;" onclick="CerraSesion();">
            <i class="fa fa-times"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img id="ImagenUserDash" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block" id="NombresUserPefill"></a>
            <span style="color: white;" id="UserRol"></span>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="<?php echo base_url(); ?>admin/" class="nav-link">
                <i class="nav-icon fa fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item Mantenimiento">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Mantenimiento
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/rolesuser/list');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Roles y permisos</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/UsuariosAccion/list');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Usuarios</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/EmpresaView');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Información del vivero</p>
                  </a>
                </li>

                <hr>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/ListadoCliente/tienda');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clientes</p>
                  </a>
                </li>

                <li hidden class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/ListadoCliente/empresa');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clientes Empresa</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/cliente/new/0/valor');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Nuevo cliente</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/comentatios/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Comentarios de clientes</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/comentatios/califica/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p> Calificación de clientes</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item ModuloProducto">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Productos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item producto_tipo_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/tipoProducto/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipo</p>
                  </a>
                </li>
                <li class="nav-item producto_tipo_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Producto/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Producto</p>
                  </a>
                </li>

                <hr>

                <li class="nav-item insumo_tipo_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/TipoInsumo/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipo insumo</p>
                  </a>
                </li>
                <li class="nav-item insumo_tipo_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Insumos/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Insumo</p>
                  </a>
                </li>

                <hr>

                <li class="nav-item material_tipo_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/TipoMaterial/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipo de material</p>
                  </a>
                </li>
                <li class="nav-item material_tipo_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Material/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Material</p>
                  </a>
                </li>

                <hr>

                <li class="nav-item ofertas_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/oferta/registro/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registro de ofertas</p>
                  </a>
                </li>

                <li class="nav-item ofertas_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/oferta/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de ofertas</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item ModuloCompraVenta">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Compras y ventas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item proveedor_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/proveedor/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proveedor</p>
                  </a>
                </li>
                <li class="nav-item compra_insumo_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/CompraInsumos/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compra insumos</p>
                  </a>
                </li>
                <li class="nav-item compra_material_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/CompraMaterial/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compra material</p>
                  </a>
                </li>

                <hr>

                <li class="nav-item crear_venta_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/ventas/new/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nueva venta</p>
                  </a>
                </li>
                <li class="nav-item listado_venta_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/ventas/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Listado de ventas</p>
                  </a>
                </li>
                <li class="nav-item listado_venta_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/ventas/web/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ventas tienda Web</p>
                  </a>
                </li>

                <li class="nav-item listado_venta_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Estado/pedidos/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Estado de pedido</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item ModuloProduccion">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hammer"></i>
                <p>
                  Producción
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item fase_produccion_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/fases/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Fases de producción</p>
                  </a>
                </li>

                <li class="nav-item produccion_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de producción</p>
                  </a>
                </li>

                <li class="nav-item produccion_finalizadas_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/finalizado/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Producción finalizadas</p>
                  </a>
                </li>

                <li class="nav-item registro_fase_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/registerFase/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Registrar fase producción</p>
                  </a>
                </li>

                <li class="nav-item perdidas_produccion_p">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/perdida/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Perdidas</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item reporters_p">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-file"></i>
                <p>
                  Reportes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/reporte/venta_tienda/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte venta</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/reporte/compra/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte compra insumo</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/reporte/compramaterial/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte compra material</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/reporte/reporteinsumos/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de insumos</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/reporte/reportematerial/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de material</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/reporte/ReportePlantas/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de plantas</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/reporte/ReporteCliente/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de clientes</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/reporte/ReporteOfertas/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de ofertas</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/reporte/ReporteProduccion/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reporte de producción</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item reporters_p" style="background: red; color: white;">
              <a onclick="CerraSesion();" class="nav-link">
                <i class="nav-icon fa fa-circle" style="color: white"></i>
                <p style="color: white">
                  SALIR
                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>

    </aside>

    <div class="content-wrapper" id="contenido_principal">

      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><b>Principal</b></h1>
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
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo $data[0]; ?></h3>
                  <p>Productos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $data[1]; ?></h3>
                  <p>Ofertas</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $data[2]; ?></h3>
                  <p>Clientes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo $data[3]; ?></h3>
                  <p>Producción</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div>
          </div>

          <hr>

          <div class="row">

            <div class="col-lg-6">
              <div class="ibox">
                <div class="ibox-body">
                  <div class="flexbox mb-4">
                    <div>
                      <h4 style="text-align: center;"><b>10 productos mas vendidos</b></h4>
                    </div>
                  </div>
                  <div>
                    <div class="chart_p">
                      <canvas id="char_producto"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="ibox">
                <div class="ibox-body">
                  <div class="flexbox mb-4">
                    <div>
                      <h4 style="text-align: center;"><b>10 productos mas vendidos en la tienda web</b></h4>
                    </div>
                  </div>
                  <div>
                    <div class="chart_o">
                      <canvas id="char_oferta"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <hr>

          <div class="row">
            <div class="col-lg-6">
              <div class="ibox">
                <div class="ibox-body">
                  <div class="flexbox mb-4">
                    <div>
                      <h4 style="text-align: center;"><b>10 Clientes con mas compras</b></h4>
                    </div>
                  </div>
                  <div>
                    <div class="chart_cli">
                      <canvas id="char_clients"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="ibox">
                <div class="ibox-body">
                  <div class="flexbox mb-4">
                    <div>
                      <h4 style="text-align: center;"><b>10 productos mas comprados</b></h4>
                    </div>
                  </div>
                  <div>
                    <div class="chart_compra">
                      <canvas id="char_comprados"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-lg-6">
              <div class="ibox">
                <div class="ibox-body">
                  <div class="flexbox mb-4">
                    <div>
                      <h4 style="text-align: center;"><b>Ganancias de ventas por meses</b></h4>
                    </div>
                  </div>
                  <div>
                    <div class="chard_meses">
                      <canvas id="charc_meses"></canvas>
                    </div>
                  </div>
                </div>
              </div>
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

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>public/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>public/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="<?php echo base_url(); ?>public/dist/js/adminlte.js"></script>


  <!-- //// agregados por mi -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="<?php echo base_url(); ?>public/js/usuario.js"></script>
  <script src="<?php echo base_url(); ?>public/js/graficos.js"></script>
  <script src="<?php echo base_url(); ?>public/js/numero.min.js"></script>
  <script src="<?php echo base_url(); ?>public/DataTables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>public/Chart/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>public/Chart/moment.min.js"></script>

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
  var correo_usuData = true;
  var fotoActual = "";
  var PasswordUser = "";

  var BaseUrl;
  BaseUrl = "<?php echo base_url(); ?>";

  TraerDatosUsuario();
  TraerGraficoProductosMasVendidos();
  TraerGraficoProductosMasVendidosOferta();
  TraerGraficoClientesMasCompras();
  TraerGraficoProductosMasComprados();

  TraerGraficoGananciasPormeses();

  TraerPermisosDeUsuario();

  function mostrar_imagenData(input) {
    var filename = document.getElementById("foto_new").value;
    var idxdot = filename.lastIndexOf(".") + 1;
    var extfile = filename.substr(idxdot, filename.length).toLowerCase();
    if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {
      if (input.files) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $("#FotoPerfilUser").attr("src", e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    } else {
      swal.fire(
        "Mensaje de alerta",
        "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
        "warning"
      );
    }

  }

  function mostrar_usu_data() {
    var ver = document.getElementById("password_actu");
    var newa = document.getElementById("nuevo_password");

    if (ver.type == "password") {
      ver.type = "text";
      newa.type = "text";
    } else {
      ver.type = "password";
      newa.type = "password";
    }
  }

  function TraerDatosUsuario() {
    $.ajax({
      type: "Get",
      url: BaseUrl + "usuario/TraerDatosUsuario",
      success: function(response) {
        let data = JSON.parse(response);
        $("#nombresData").val(data[0][1]);
        $("#apellidosData").val(data[0][2]);
        $("#correoData").val(data[0][3]);
        $("#usuarioData").val(data[0][6]);
        $("#FotoPerfilUser").attr("src", BaseUrl + "public/img/usuario/" + data[0][8])
        $("#ImagenUserDash").attr("src", BaseUrl + "public/img/usuario/" + data[0][8])
        $("#NombresUserPefill").html(data[0][1]);
        $("#UserRol").html(data[0][5]);
        fotoActual = data[0][8];
        PasswordUser = data[0][7];
      }
    });
  }

  async function TraerPermisosDeUsuario() {
    $.ajax({
      type: "Get",
      url: BaseUrl + "usuario/TraerPermisosDeUsuario",
      async: true,
      success: function(response) {
        var data = JSON.parse(response);

        data['mantenimiento_p'].toString() == "true" ?
          ($(".Mantenimiento").show()) :
          ($(".Mantenimiento").hide());

        //////
        // modulo producto inicio
        data['producto_tipo_p'].toString() == "true" ?
          ($(".producto_tipo_p").show()) :
          ($(".producto_tipo_p").hide());

        data['insumo_tipo_p'].toString() == "true" ?
          ($(".insumo_tipo_p").show()) :
          ($(".insumo_tipo_p").hide());

        data['material_tipo_p'].toString() == "true" ?
          ($(".material_tipo_p").show()) :
          ($(".material_tipo_p").hide());
        data['ofertas_p'].toString() == "true" ?
          ($(".ofertas_p").show()) :
          ($(".ofertas_p").hide());
        if (
          data['producto_tipo_p'].toString() == "true" ||
          data['insumo_tipo_p'].toString() == "true" ||
          data['material_tipo_p'].toString() == "true" ||
          data['ofertas_p'].toString() == "true"
        ) {
          $(".ModuloProducto").show();
        } else {
          $(".ModuloProducto").hide();
        }
        // modulo producto fin
        ////// 


        //////
        // modulo venta compra inicio
        data['proveedor_p'].toString() == "true" ?
          ($(".proveedor_p").show()) :
          ($(".proveedor_p").hide());

        data['compra_insumo_p'].toString() == "true" ?
          ($(".compra_insumo_p").show()) :
          ($(".compra_insumo_p").hide());

        data['compra_material_p'].toString() == "true" ?
          ($(".compra_material_p").show()) :
          ($(".compra_material_p").hide());

        data['crear_venta_p'].toString() == "true" ?
          ($(".crear_venta_p").show()) :
          ($(".crear_venta_p").hide());

        data['listado_venta_p'].toString() == "true" ?
          ($(".listado_venta_p").show()) :
          ($(".listado_venta_p").hide());

        if (
          data['proveedor_p'].toString() == "true" ||
          data['compra_insumo_p'].toString() == "true" ||
          data['compra_material_p'].toString() == "true" ||
          data['crear_venta_p'].toString() == "true" ||
          data['listado_venta_p'].toString() == "true"
        ) {
          $(".ModuloCompraVenta").show();
        } else {
          $(".ModuloCompraVenta").hide();
        }
        // modulo venta compra fin
        ////// ModuloProduccion


        //////
        // modulo produccion inicio
        data['fase_produccion_p'].toString() == "true" ?
          ($(".fase_produccion_p").hide()) :
          ($(".fase_produccion_p").hide());

        data['produccion_p'].toString() == "true" ?
          ($(".produccion_p").show()) :
          ($(".produccion_p").hide());

        data['produccion_finalizadas_p'].toString() == "true" ?
          ($(".produccion_finalizadas_p").hide()) :
          ($(".produccion_finalizadas_p").hide());

        data['registro_fase_p'].toString() == "true" ?
          ($(".registro_fase_p").hide()) :
          ($(".registro_fase_p").hide());

        data['perdidas_produccion_p'].toString() == "true" ?
          ($(".perdidas_produccion_p").hide()) :
          ($(".perdidas_produccion_p").hide());
        if (
          data['fase_produccion_p'].toString() == "true" ||
          data['produccion_p'].toString() == "true" ||
          data['produccion_finalizadas_p'].toString() == "true" ||
          data['registro_fase_p'].toString() == "true" ||
          data['perdidas_produccion_p'].toString() == "true"
        ) {
          $(".ModuloProduccion").show();
        } else {
          $(".ModuloProduccion").hide();
        }
        // modulo produccion fin
        ////// 

        data['reporters_p'].toString() == "true" ?
          ($(".reporters_p").show()) :
          ($(".reporters_p").hide());

      }
    });
  }

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
        location.href = BaseUrl + "Usuario/CerraSesion";
      }
    })
  }

  $("#correoData").keyup(function() {
    if (this.value != "") {
      document.getElementById('correoData').addEventListener('input', function() {
        campo = event.target;
        //este codigo me da formato email
        email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        //esto es para validar si es un email valida
        if (email.test(campo.value)) {
          //estilos para cambiar de color y ocultar el boton
          $(this).css("border", "1px solid green");
          $("#correoData_olbligg").html("");
          correo_usuData = true;
        } else {
          $(this).css("border", "1px solid red");
          $("#correoData_olbligg").html("Email incorrecto");
          correo_usuData = false;
        }
      });
    } else {
      $(this).css("border", "1px solid green");
      $("#correoData_olbligg").html("");
      correo_usuData = false;
    }
  });
</script>