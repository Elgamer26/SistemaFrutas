<style>
    .boton {
        border: 1px solid #2e518b;
        /*anchura, estilo y color borde*/
        padding: 10px;
        /*espacio alrededor texto*/
        background-color: #ffffff;
        /*color botón*/
        color: #2e518b;
        /*color texto*/
        text-decoration: none;
        /*decoración texto*/
        text-transform: uppercase;
        /*capitalización texto*/
        font-family: 'Helvetica', sans-serif;
        /*tipografía texto*/
        border-radius: 50px;
        /*bordes redondos*/
    }

    .boton:hover {
        border: 1px solid #2e518b;
        /*anchura, estilo y color borde*/
        padding: 10px;
        /*espacio alrededor texto*/
        background-color: #2e518b;
        /*color botón*/
        color: #ffffff;
        /*color texto*/
        text-decoration: none;
        /*decoración texto*/
        text-transform: uppercase;
        /*capitalización texto*/
        font-family: 'Helvetica', sans-serif;
        /*tipografía texto*/
        border-radius: 50px;
        /*bordes redondos*/
    }

    .nogusta {
        border: 1px solid #2e518b;
        /*anchura, estilo y color borde*/
        padding: 10px;
        /*espacio alrededor texto*/
        background-color: #2e518b;
        /*color botón*/
        color: #ffffff;
        /*color texto*/
        text-decoration: none;
        /*decoración texto*/
        text-transform: uppercase;
        /*capitalización texto*/
        font-family: 'Helvetica', sans-serif;
        /*tipografía texto*/
        border-radius: 50px;
        /*bordes redondos*/
    }

    .nogusta:hover {
        border: 1px solid #2e518b;
        /*anchura, estilo y color borde*/
        padding: 10px;
        /*espacio alrededor texto*/
        background-color: #ffffff;
        /*color botón*/
        color: #2e518b;
        /*color texto*/
        text-decoration: none;
        /*decoración texto*/
        text-transform: uppercase;
        /*capitalización texto*/
        font-family: 'Helvetica', sans-serif;
        /*tipografía texto*/
        border-radius: 50px;
        /*bordes redondos*/
    }
</style>

<div class="single contact">
    <div class="container">
        <div class="single-main">
            <div class="col-md-9 single-main-left">
                <div class="sngl-top">
                    <div class="col-md-5 single-top-left">

                        <?php if (!empty($Imagen)) { ?>

                            <div class="flexslider">
                                <ul class="slides">

                                    <?php foreach ($Imagen as $rowI) { ?>

                                        <li data-thumb="<?php echo base_url(); ?>public/img/producto/<?php echo $rowI["foto"]; ?>">
                                            <div class="thumb-image"> <img src="<?php echo base_url(); ?>public/img/producto/<?php echo $rowI["foto"]; ?>" data-imagezoom="true" class="img-responsive zoom-img" alt="Imagen producto" /> </div>
                                        </li>

                                    <?php } ?>
                                </ul>
                            </div>

                            <script src="<?php echo base_url(); ?>public/tienda/js/imagezoom.js"></script>
                            <script defer src="<?php echo base_url(); ?>public/tienda/js/jquery.flexslider.js"></script>
                            <link rel="stylesheet" href="<?php echo base_url(); ?>public/tienda/css/flexslider.css" type="text/css" media="screen" />

                            <script>
                                // Can also be used with $(document).ready()
                                $(window).load(function() {
                                    $('.flexslider').flexslider({
                                        animation: "slide",
                                        controlNav: "thumbnails"
                                    });
                                });
                            </script>

                        <?php } else {  ?>

                            <div class="flexslider">
                                <ul class="slides">
                                    <li data-thumb="images/s-1.jpg">
                                        <div class="thumb-image"> <img src="<?php echo base_url(); ?>public/img/producto/producto.jpg" data-imagezoom="true" class="img-responsive" alt="" /> </div>
                                    </li>
                                </ul>
                            </div>

                        <?php } ?>

                    </div>

                    <input type="hidden" id="idproducto" value="<?php echo $producto[0]; ?>">

                    <div class="col-md-7 single-top-right">
                        <div class="single-para simpleCart_shelfItem">
                            <h2><?php echo $producto[1]; ?> </h2>
                            <div class="star-on">
                                <a> <?php echo $producto[2]; ?> </a>
                                <div class="clearfix"> </div>
                            </div>

                            <?php if ($producto[10] == "Descuento %") { ?>
                                <h5 class="item_price">$ <?php echo number_format($producto[3] - (($producto[3] * $producto[11]) / 100), 2, '.', ''); ?> / <del style="font-size: 20px;"> $ <?php echo $producto[3]; ?> <del> </h5>
                            <?php } else { ?>
                                <h5 class="item_price">$ <?php echo $producto[3]; ?></h5>
                            <?php } ?>

                            <p><b>Detalle: </b> <?php echo $producto[7]; ?></p>
                            <h5 class="item_price"></h5>
                            <div class="star-on">
                                <a> <b>Tipo de oferta: </b> <?php echo $producto[10]; ?> </a> <br>
                                <a> <b>Fecha inicio: </b> <?php echo $producto[8]; ?> </a> <br>
                                <a> <b>Fecha fin: </b> <?php echo $producto[9]; ?> </a> <br>
                                <a> <b>Descuento: </b> <?php echo $producto[11]; ?> %</a>
                                <div class="clearfix"> </div>
                            </div>
                            <a class="add-cart item_add" onclick="AgregarCarritoOferta('<?php echo $producto[0]; ?>','<?php echo $producto[3]; ?>');">Agregar a carrito</a>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="col-lg-12 single-right-left simpleCart_shelfItem">

                    <h3 style="text-align: center;"><b>Comentarios</b></h3>

                    <style>
                        ::-webkit-scrollbar {
                            width: 4px;
                        }

                        ::-webkit-scrollbar-thumb {
                            background-color: #4c4c6a;
                            border-radius: 2px;
                        }

                        .chatbox {
                            width: 100%;
                            height: 350px;
                            max-height: 400px;
                            display: flex;
                            flex-direction: column;
                            overflow: hidden;
                            box-shadow: 0 0 4px rgba(0, 0, 0, .14), 0 4px 8px rgba(0, 0, 0);
                            border-radius: 10px;
                        }

                        .chat-window {
                            flex: auto;
                            /*	max-height: calc(100% - 60px); */
                            background: #2a2a2a;
                            overflow: auto;
                        }

                        .chat-input {
                            flex: 0 0 auto;
                            height: 60px;
                            background: #40434e;
                            border-top: 1px solid #2671ff;
                            box-shadow: 0 0 4px rgba(0, 0, 0, .14), 0 4px 8px rgba(0, 0, 0, .28);
                        }

                        .chat-input input {
                            height: 59px;
                            line-height: 60px;
                            outline: 0 none;
                            border: none;
                            width: calc(100% - 60px);
                            color: white;
                            text-indent: 10px;
                            font-size: 12pt;
                            padding: 0;
                            background: #40434e;
                        }

                        .chat-input button {
                            float: right;
                            outline: 0 none;
                            border: none;
                            background: rgba(255, 255, 255, .25);
                            height: 40px;
                            width: 40px;
                            border-radius: 50%;
                            padding: 2px 0 0 0;
                            margin: 10px;
                            transition: all 0.15s ease-in-out;
                        }

                        .chat-input input[good]+button {
                            box-shadow: 0 0 2px rgba(0, 0, 0, .12), 0 2px 4px rgba(0, 0, 0, .24);
                            background: #2671ff;
                        }

                        .chat-input input[good]+button:hover {
                            box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                        }

                        .chat-input input[good]+button path {
                            fill: white;
                        }

                        .msg-container {
                            position: relative;
                            display: inline-block;
                            width: 100%;
                            margin: 0;
                            padding: 5px;
                        }

                        .msg-box {
                            display: flex;
                            background: #5b5e6c;
                            padding: 10px 10px 0 10px;
                            border-radius: 0 6px 6px 0;
                            /* max-width: 80%; */
                            width: auto;
                            float: left;
                            box-shadow: 0 0 2px rgba(0, 0, 0, .12), 0 2px 4px rgba(0, 0, 0, .24);
                        }

                        .user-img {
                            display: inline-block;
                            border-radius: 50%;
                            height: 40px;
                            width: 40px;
                            background: #2671ff;
                            margin: 0 10px 10px 0;
                        }

                        .flr {
                            flex: 1 0 auto;
                            display: flex;
                            flex-direction: column;
                            width: calc(100% - 50px);
                        }

                        .messages {
                            flex: 1 0 auto;
                        }

                        .msg {
                            display: inline-block;
                            font-size: 11pt;
                            line-height: 13pt;
                            color: rgba(255, 255, 255, .7);
                            margin: 0 0 4px 0;
                        }

                        .msg:first-of-type {
                            margin-top: 8px;
                        }

                        .timestamp {
                            color: rgba(0, 0, 0, .38);
                            font-size: 8pt;
                            margin-bottom: 10px;
                        }

                        .username {
                            margin-right: 3px;
                        }

                        .posttime {
                            margin-left: 3px;
                        }

                        .msg-self .msg-box {
                            border-radius: 6px 0 0 6px;
                            background: #2671ff;
                            float: right;
                        }

                        .msg-self .user-img {
                            margin: 0 0 10px 10px;
                        }

                        .msg-self .msg {
                            text-align: right;
                        }

                        .msg-self .timestamp {
                            text-align: right;
                        }
                    </style>

                    <body>

                        <section class="chatbox">

                            <section class="chat-window">

                                <?php foreach ($comentario as $row) { ?>

                                    <article class="msg-container msg-self" id="msg-0">
                                        <div class="msg-box" style="width: 100%;  background: #1d1d1d;">
                                            <div class="flr">
                                                <div class="messages">
                                                    <p class="msg" style="padding: 0; margin: 0; text-align: center; color: green; font-size: 10px;" id="msg-1">
                                                        <b><?php echo $row["nombre"]; ?> </b>
                                                    </p>
                                                    <br>
                                                    <span style="color: white">
                                                        <?php echo $row["detalle"]; ?>
                                                    </span>
                                                </div>
                                                <span style="color: white;" class="timestamp"><span class="username"><b> <?php echo $row["fecha"]; ?></b></span></span>
                                            </div>
                                        </div>
                                    </article>

                                <?php } ?>

                            </section>

                        </section>

                        <?php if ($token != "NOTOKEN") { ?>

                            <article class="msg-container msg-self" id="msg-0">
                                <div class="msg-box" style="width: 100%;  background: #1d1d1d; border-radius: 10px;">
                                    <div class="flr">
                                        <div class="messages">
                                            <span style="color: white">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <label for="comentario_oferta">Ingrese un comentario</label>
                                                        <input type="text" class="form-control" id="comentario_oferta" maxlength="100">
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label for="comentario_oferta"></label> <br>
                                                        <button class="btn btn-success" onclick="RegistraCalificacionOferta();"><i class="fa fa-send"></i> Enviar</button>
                                                    </div>
                                                </div>
                                            </span>

                                        </div>
                                        <span style="color: white;" class="timestamp"><span class="username"> </span></span>
                                    </div>
                                </div>

                            </article>

                        <?php } ?>

                    </body>
                </div>
            </div>

            <div class="col-md-3 single-right text-center">
                <div class="w_sidebar">
                    <section class="sky-form">
                        <h4 style="text-align: center;"><b>Calificación</b></h4>
                        <div class="row1 scroll-pane" style="height: 120px;">
                            <div class="col col-4">

                                <a class="boton" id="megusta" onclick="CalificarProductoOferta('Megusta', <?php echo $producto[0]; ?>);"> <label> <i class="far fa-thumbs-up"></i> Me gusta</label> </a>
                                <br>
                                <br>
                                <a class="boton" id="nogusta" onclick="CalificarProductoOferta('Nomegusta', <?php echo $producto[0]; ?>);"> <label> <i class="far fa-thumbs-down"></i> No me gusta</label> </a>

                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="col-md-3 single-right text-center">
                <div class="w_sidebar">
                    <div class="row1" style="height: 50px; overflow: hidden;">
                        <div class="col col-4">

                            <div class="progress" style="padding: 0px; margin: 0px;">
                                <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $countcalificar[0]; ?> <i class="far fa-thumbs-up"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"> </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        TraerCalificaionClienteOferta();
    });
</script>

<!-- <script>
    var BaseUrl;
    BaseUrl = "<?php echo base_url(); ?>";
</script>

<script src="<?php echo base_url(); ?>public/js/tienda.js"></script> -->