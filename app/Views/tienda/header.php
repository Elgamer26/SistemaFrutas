<!DOCTYPE html>
<html>

<head>
    <title>Tienda Online</title>
    <link href="<?php echo base_url(); ?>public/tienda/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <script src="<?php echo base_url(); ?>public/tienda/js/jquery-1.11.0.min.js"></script>
    <link href="<?php echo base_url(); ?>public/tienda/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>public/img/tienda.jpg" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/plugins/fontawesome-free/css/all.min.css">
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <script src="<?php echo base_url(); ?>public/tienda/js/simpleCart.min.js"> </script>
    <link href="<?php echo base_url(); ?>public/tienda/css/memenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="<?php echo base_url(); ?>public/tienda/js/memenu.js"></script>
    <script>
        $(document).ready(function() {
            $(".memenu").memenu();
        });
    </script>
    <script src="<?php echo base_url(); ?>public/tienda/js/jquery.easydropdown.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
</head>

<body>
    <div class="top-header">
        <div class="container">
            <div class="top-header-main">

                <div class="col-md-6 top-header-left">
                    <div class="drop">
                        <?php if ($token == "NOTOKEN") { ?>
                            <a href="<?php echo base_url(); ?>home/login"><span style="color: white;">Iniciar sesión </span> &nbsp; <i style="color: white;" class="fa fa-user"></i></a>
                            &nbsp; &nbsp; &nbsp; &nbsp; <a href="<?php echo base_url(); ?>admin">Admin</a> <i class="fa fa-home"></i>
                        <?php } else { ?>
                            <a href="<?php echo base_url(); ?>home/Perfil" class="btn btn-success"><i class="fa fa-user"></i> <?php echo $token; ?></a> - <a href="<?php echo base_url(); ?>cliente/CerraSesionCliente" class="btn btn-danger">Cerra sesion</a>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>

                </div>

                <?php if ($token != "NOTOKEN") { ?>

                    <div class="col-md-6 top-header-left">
                        <div class="cart box_1">
                            <a href="<?php echo base_url(); ?>home/detallecarrito">
                                <div class="total">
                                    <span id="totalproducto"> </span>
                                </div>
                                <i style="font-size: 20px;" class="fa fa-shopping-cart"></i>
                            </a>
                            <!-- <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p> -->
                            <div class="clearfix"> </div>
                        </div>
                    </div>

                <?php } ?>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="logo" style="
                height: 130px;
                padding: 0;">
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>/public/img/logo.png" width="170" alt="logo.png">
        </a>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header">
                <div class="col-md-9 header-left">
                    <div class="top-nav">
                        <ul class="memenu skyblue">
                            <li class="active"><a href="<?php echo base_url(); ?>">Inicio</a></li>
                            <li class="grid"><a href="<?php echo base_url(); ?>home/ofertas">Ofertas</a>
                            </li>
                            <?php if ($token != "NOTOKEN") { ?>
                                <li class="grid"><a href="<?php echo base_url(); ?>home/detallecarrito">Detalle carrito</a>
                                <?php } ?>
                                </li>
                                <li class="grid"><a href="<?php echo base_url(); ?>home/Nosotros">Nosotros</a>
                                </li>

                                <li class="grid"><a href="#">Caterorias</a>
                                    <div class="mepanel" style="display: none;width: 500px;left: 100px; border-radius: 25px;">
                                        <div class="row">
                                            <div class="col5 me-one">
                                                <ul>

                                                    <?php if (!empty($categorias) && is_array($categorias)) {

                                                        foreach ($categorias as $tipo_item) { ?>

                                                            <li><a href="#"><?= esc($tipo_item["tipo"]); ?></a></li>

                                                    <?php }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <!-- <div class="col1 me-one">
										<ul>
											<li><a href="products.html">GIRASOLES</a></li>
											<li><a href="products.html">COCOTEROS</a></li>
											<li><a href="products.html">PALMA</a></li>
											<li><a href="products.html">MEDICINALES</a></li> 
										</ul>	
									</div>
									<div class="col1 me-one">
										<ul>
											<li><a href="products.html">ARTIFICIALES</a></li>
											<li><a href="products.html">PLANTA DE MANGO</a></li>
											<li><a href="products.html">TROPICALES</a></li>
											<li><a href="products.html">MANZANOS</a></li> 
										</ul>	
									</div> -->
                                        </div>
                                    </div>
                                </li>

                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="clearfix"> </div>
            </div>
        </div>
    </div>