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

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url(); ?>public/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url(); ?>public/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?php echo base_url(); ?>public/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

        <li class="nav-item dropdown" style="background-color: green; border-radius: 50px; color: white;">
          <a onclick="ModalDatoUsuario();" class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user" style="color: white;"></i>
          </a>
        </li>

        <li style="background-color: red; border-radius: 50px;" class="nav-item dropdown">
          <a class="nav-link" style="color: white;" href="#" onclick="CerraSesion();">
            <i class="fa fa-times"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">


      <!-- Sidebar -->
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
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Usuarios
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
                    <p> Empresa</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Clientes
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/ListadoCliente/tienda');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Clientes Tienda</p>
                  </a>
                </li>
                <li class="nav-item">
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

              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Productos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/tipoProducto/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Producto/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Producto</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cube"></i>
                <p>
                  Insumos y materiales
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/TipoInsumo/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipo insumo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Insumos/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Insumo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/TipoMaterial/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tipo de material</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/Material/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Material</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Compras
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/proveedor/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Proveedor</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/CompraInsumos/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compra insumos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/CompraMaterial/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Compra material</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-hammer"></i>
                <p>
                  Producción
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/produccion/list/0');" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lista de producción</p>
                  </a>
                </li>
              </ul>
            </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="contenido_principal">
      <!-- Content Header (Page header) -->

      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>

                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>

                  <p>Bounce Rate</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>

                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>

                  <p>Unique Visitors</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Sales
                  </h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                      </li>
                    </ul>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                      <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                  </div>
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- DIRECT CHAT -->
              <div class="card direct-chat direct-chat-primary">
                <div class="card-header">
                  <h3 class="card-title">Direct Chat</h3>

                  <div class="card-tools">
                    <span title="3 New Messages" class="badge badge-primary">3</span>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                      <i class="fas fa-comments"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="<?php echo base_url(); ?>public/dist/img/user1-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        Is this template really for free? That's unbelievable!
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">Sarah Bullock</span>
                        <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="<?php echo base_url(); ?>public/dist/img/user3-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        You better believe it!
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="<?php echo base_url(); ?>public/dist/img/user1-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        Working with AdminLTE on a great new app! Wanna join?
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">Sarah Bullock</span>
                        <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="<?php echo base_url(); ?>public/dist/img/user3-128x128.jpg" alt="message user image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        I would love to.
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                  </div>
                  <!--/.direct-chat-messages-->

                  <!-- Contacts are loaded here -->
                  <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="<?php echo base_url(); ?>public/dist/img/user1-128x128.jpg" alt="User Avatar">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Count Dracula
                              <small class="contacts-list-date float-right">2/28/2015</small>
                            </span>
                            <span class="contacts-list-msg">How have you been? I was...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="<?php echo base_url(); ?>public/dist/img/user7-128x128.jpg" alt="User Avatar">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Sarah Doe
                              <small class="contacts-list-date float-right">2/23/2015</small>
                            </span>
                            <span class="contacts-list-msg">I will be waiting for...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="<?php echo base_url(); ?>public/dist/img/user3-128x128.jpg" alt="User Avatar">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Nadia Jolie
                              <small class="contacts-list-date float-right">2/20/2015</small>
                            </span>
                            <span class="contacts-list-msg">I'll call you back at...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="<?php echo base_url(); ?>public/dist/img/user5-128x128.jpg" alt="User Avatar">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Nora S. Vans
                              <small class="contacts-list-date float-right">2/10/2015</small>
                            </span>
                            <span class="contacts-list-msg">Where is your new...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="<?php echo base_url(); ?>public/dist/img/user6-128x128.jpg" alt="User Avatar">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              John K.
                              <small class="contacts-list-date float-right">1/27/2015</small>
                            </span>
                            <span class="contacts-list-msg">Can I take a look at...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="<?php echo base_url(); ?>public/dist/img/user8-128x128.jpg" alt="User Avatar">

                          <div class="contacts-list-info">
                            <span class="contacts-list-name">
                              Kenneth M.
                              <small class="contacts-list-date float-right">1/4/2015</small>
                            </span>
                            <span class="contacts-list-msg">Never mind I found...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                    </ul>
                    <!-- /.contacts-list -->
                  </div>
                  <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <form action="#" method="post">
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-append">
                        <button type="button" class="btn btn-primary">Send</button>
                      </span>
                    </div>
                  </form>
                </div>
                <!-- /.card-footer-->
              </div>
              <!--/.direct-chat -->

              <!-- TO DO List -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    To Do List
                  </h3>

                  <div class="card-tools">
                    <ul class="pagination pagination-sm">
                      <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                      <li class="page-item"><a href="#" class="page-link">1</a></li>
                      <li class="page-item"><a href="#" class="page-link">2</a></li>
                      <li class="page-item"><a href="#" class="page-link">3</a></li>
                      <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                    </ul>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <ul class="todo-list" data-widget="todo-list">
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                      </span>
                      <!-- checkbox -->
                      <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo1" id="todoCheck1">
                        <label for="todoCheck1"></label>
                      </div>
                      <!-- todo text -->
                      <span class="text">Design a nice theme</span>
                      <!-- Emphasis label -->
                      <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                      </span>
                      <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                        <label for="todoCheck2"></label>
                      </div>
                      <span class="text">Make the theme responsive</span>
                      <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                      <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                      </span>
                      <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo3" id="todoCheck3">
                        <label for="todoCheck3"></label>
                      </div>
                      <span class="text">Let theme shine like a star</span>
                      <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                      <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                      </span>
                      <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo4" id="todoCheck4">
                        <label for="todoCheck4"></label>
                      </div>
                      <span class="text">Let theme shine like a star</span>
                      <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                      <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                      </span>
                      <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo5" id="todoCheck5">
                        <label for="todoCheck5"></label>
                      </div>
                      <span class="text">Check your messages and notifications</span>
                      <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                      <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                      </div>
                    </li>
                    <li>
                      <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                      </span>
                      <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo6" id="todoCheck6">
                        <label for="todoCheck6"></label>
                      </div>
                      <span class="text">Let theme shine like a star</span>
                      <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                      <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                      </div>
                    </li>
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
                </div>
              </div>
              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

              <!-- Map card -->
              <div class="card bg-gradient-primary">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Visitors
                  </h3>
                  <!-- card tools -->
                  <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                      <i class="far fa-calendar-alt"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.card-tools -->
                </div>
                <div class="card-body">
                  <div id="world-map" style="height: 250px; width: 100%;"></div>
                </div>
                <!-- /.card-body-->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <div id="sparkline-1"></div>
                      <div class="text-white">Visitors</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-2"></div>
                      <div class="text-white">Online</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-3"></div>
                      <div class="text-white">Sales</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.card -->

              <!-- solid sales graph -->
              <div class="card bg-gradient-info">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-th mr-1"></i>
                    Sales Graph
                  </h3>

                  <div class="card-tools">
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                      <div class="text-white">Mail-Orders</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                      <div class="text-white">Online</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">

                      <div class="text-white">In-Store</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->

              <!-- Calendar -->
              <div class="card bg-gradient-success">
                <div class="card-header border-0">

                  <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                  </h3>
                  <!-- tools card -->
                  <div class="card-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                        <i class="fas fa-bars"></i>
                      </button>
                      <div class="dropdown-menu" role="menu">
                        <a href="#" class="dropdown-item">Add new event</a>
                        <a href="#" class="dropdown-item">Clear events</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">View calendar</a>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                  <!--The calendar -->
                  <div id="calendar" style="width: 100%"></div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>public/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url(); ?>public/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url(); ?>public/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url(); ?>public/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url(); ?>public/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url(); ?>public/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url(); ?>public/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>public/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url(); ?>public/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url(); ?>public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>public/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url(); ?>public/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url(); ?>public/dist/js/pages/dashboard.js"></script>

  <!-- //// agregados por mi -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="<?php echo base_url(); ?>public/js/usuario.js"></script>
  <script src="<?php echo base_url(); ?>public/js/numero.min.js"></script>

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
        "No se permiten numeros!!",
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
        "Solo se permiten numeros",
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
          "Solo se permiten numeros decimales",
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