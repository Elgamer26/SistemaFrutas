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
                            <span style="color: white;"><i style="color: white;" class="fa fa-user"></i> <?php echo $token; ?> </span> <a href="<?php echo base_url(); ?>cliente/CerraSesionCliente" class="btn btn-danger">Cerra sesion</a>
                        <?php } ?>
                        <div class="clearfix"></div>
                    </div>

                </div>

                <div class="col-md-6 top-header-left">
                    <div class="cart box_1">
                        <a href="checkout.html">
                            <div class="total">
                                <span class="simpleCart_total"></span>
                            </div>
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                        <!-- <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p> -->
                        <div class="clearfix"> </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="logo">
        <a href="<?php echo base_url(); ?>">
            <h1>Tienda Online</h1>
        </a>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header">
                <div class="col-md-9 header-left">
                    <div class="top-nav">
                        <ul class="memenu skyblue">
                            <li class="active"><a href="<?php echo base_url(); ?>">Inicio</a></li>
                            <li class="grid"><a href="<?php echo base_url(); ?>home/ofertas" >Ofertas</a>
                            </li>
                            <li class="grid"><a href="#">Women</a>
                            </li>
                            <li class="grid"><a href="#">Kids</a>
                            </li>
                            <li class="grid"><a href="typo.html">Blog</a>
                            </li>
                            <li class="grid"><a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="clearfix"> </div>
            </div>
        </div>
    </div>