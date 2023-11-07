<?php

namespace App\Controllers;

use App\Models\ModeloTienda;
use App\MailPhp\envio_correo;

class Tienda extends BaseController
{
    protected $tienda;
    protected $send_email;
    public function __construct()
    {
        session_start();
        $this->send_email = new envio_correo();
        $this->tienda = new ModeloTienda();
    }

    ///PAGINADOR DE TIENDA

    public function paginartienda()
    {
        if ($this->request->getMethod() == "post") {

            $partida = $this->request->getPost('partida');
            $valor = $this->request->getPost('valor');

            $repuesta = $this->tienda->paginartienda($partida, $valor);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
            exit();
        }
        exit();
    }

    //PAGINADOR DE OFERTAS

    public function paginartiendaofertas()
    {
        if ($this->request->getMethod() == "post") {
            $partida = $this->request->getPost('partida');
            $valor = $this->request->getPost('valor');
            $repuesta = $this->tienda->paginartiendaofertas($partida, $valor);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
            exit();
        }
        exit();
    }

    /// REGISTRAR COMENTARIO DE OFERTA

    public function RegistraCalificacionOferta()
    {
        if ($this->request->getMethod() == "post") {
            if (!empty($_SESSION["TokenClie"])) {
                $iduser = $_SESSION["TokenClie"];
                $id = $this->request->getPost('id');
                $comentario_oferta = $this->request->getPost('comentario_oferta');

                $repuesta = $this->tienda->RegistraCalificacionOferta($id, $comentario_oferta, $iduser);
                echo $repuesta;
            } else {
                echo "nouser";
            }
            exit();
        }
        exit();
    }

    /// REGISTRAR COMENTARIO DE PRODUCTO

    public function RegistraCalificacion()
    {
        if ($this->request->getMethod() == "post") {
            if (!empty($_SESSION["TokenClie"])) {
                $iduser = $_SESSION["TokenClie"];
                $id = $this->request->getPost('id');
                $comentario_oferta = $this->request->getPost('comentario_oferta');

                $repuesta = $this->tienda->RegistraCalificacion($id, $comentario_oferta, $iduser);
                echo $repuesta;
            } else {
                echo "nouser";
            }
            exit();
        }
        exit();
    }

    /// INGRESAR AL CARRITO PRODUCTO NORMAL

    public function IngresarProductoCarritoNormal()
    {
        if ($this->request->getMethod() == "post") {

            if (!empty($_SESSION["TokenClie"])) {

                $iduser = $_SESSION["TokenClie"];
                $id = $this->request->getPost('id');
                $precio = $this->request->getPost('precio');
                $cantidad = $this->request->getPost('cantidad');

                $repuesta = $this->tienda->IngresarProductoCarritoNormal($iduser, $id, $precio, $cantidad);
                echo $repuesta;
                exit();
            } else {

                echo "100";
                exit();
            }
        }
    }

    /// REGISTRAR COMENTARIO DE OFERTA

    public function IngresarProductoCarritoOferta()
    {
        if ($this->request->getMethod() == "post") {

            if (!empty($_SESSION["TokenClie"])) {

                $iduser = $_SESSION["TokenClie"];
                $id = $this->request->getPost('id');
                $precio = $this->request->getPost('precio');
                $cantidad = $this->request->getPost('cantidad');

                $repuesta = $this->tienda->IngresarProductoCarritoOferta($iduser, $id, $precio, $cantidad);
                echo $repuesta;
                exit();
            } else {

                echo "100";
                exit();
            }
        }
    }

    /// CONTAR CANTIDAD DE PRODUCTOS EN CARRITO

    public function ContarCantidadCarrito()
    {
        if ($this->request->getMethod() == "get") {
            if (!empty($_SESSION["TokenClie"])) {
                $iduser = $_SESSION["TokenClie"];
                $repuesta = $this->tienda->ContarCantidadCarrito($iduser);
                echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
                exit();
            } else {
                echo json_encode("0", JSON_UNESCAPED_UNICODE);
                exit();
            }
        }
    }

    /// ELIMINAR EL PRODUCTO DEL DETALLE

    public function EliminarProductoDetalle()
    {
        if ($this->request->getMethod() == "post") {
            $id_pro = $this->request->getPost('id_pro');
            $id_cli = $_SESSION["TokenClie"];
            $repuesta = $this->tienda->EliminarProductoDetalle($id_pro, $id_cli);
            echo $repuesta;
            exit();
        }
    }

    /// REGISTRAR LA VENTA DEL CARRITO

    public function RegistrarVentaCarrito()
    {
        if ($this->request->getMethod() == "post") {

            $id_cli = $_SESSION["TokenClie"];
            $ciudad = $this->request->getPost('ciudad');
            $direccion = $this->request->getPost('direccion');
            $referencia = $this->request->getPost('referencia');

            $sub = $this->request->getPost('sub');
            $impuesto = $this->request->getPost('impuesto');
            $total = $this->request->getPost('totals');
            $estado = "paypal";

            $repuesta = $this->tienda->RegistrarVentaCarrito($id_cli, $direccion, $sub, $impuesto, $total, $ciudad, $referencia, $estado);

            if ($repuesta > 0) {

                $id = (string)$this->request->getPost('id');
                $cantidad = (string)$this->request->getPost('cantidad');
                $sale = (string)$this->request->getPost('sale');
                $precio = (string)$this->request->getPost('precio');
                $oferta = (string)$this->request->getPost('oferta');
                $descuento = (string)$this->request->getPost('descuento');
                $totalsub = (string)$this->request->getPost('totalsub');

                $arraglo_id = explode(",", $id); //aqui separo los datos
                $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
                $arraglo_sale = explode(",", $sale); //aqui separo los datos
                $arraglo_precio = explode(",", $precio); //aqui separo los datos
                $arraglo_oferta  = explode(",", $oferta); //aqui separo los datos
                $arraglo_descuento  = explode(",", $descuento); //aqui separo los datos
                $arraglo_total = explode(",", $totalsub); //aqui separo los datos  

                for ($i = 0; $i < count($arraglo_id); $i++) {
                    $repuesta_create = $this->tienda->RegistrarVentaCarritoDetalle($repuesta, $arraglo_id[$i], $arraglo_cantidad[$i], $arraglo_sale[$i], $arraglo_precio[$i], $arraglo_oferta[$i], $arraglo_descuento[$i], $arraglo_total[$i]);
                }

                if ($repuesta_create > 0) {
                    echo $repuesta;
                    exit();
                } else {
                    echo $repuesta_create;
                    exit();
                }
            } else {
                echo $repuesta;
                exit();
            }
            exit();
        }
    }

    public function RegistrarVentaCarritoEfectivo()
    {
        if ($this->request->getMethod() == "post") {

            $id_cli = $_SESSION["TokenClie"];
            $ciudad = $this->request->getPost('ciudad');
            $direccion = $this->request->getPost('direccion');
            $referencia = $this->request->getPost('referencia');

            $sub = $this->request->getPost('sub');
            $impuesto = $this->request->getPost('impuesto');
            $total = $this->request->getPost('totals');
            $estado = "efectivo";

            $repuesta = $this->tienda->RegistrarVentaCarrito($id_cli, $direccion, $sub, $impuesto, $total, $ciudad, $referencia, $estado);

            if ($repuesta > 0) {

                $id = (string)$this->request->getPost('id');
                $cantidad = (string)$this->request->getPost('cantidad');
                $sale = (string)$this->request->getPost('sale');
                $precio = (string)$this->request->getPost('precio');
                $oferta = (string)$this->request->getPost('oferta');
                $descuento = (string)$this->request->getPost('descuento');
                $totalsub = (string)$this->request->getPost('totalsub');

                $arraglo_id = explode(",", $id); //aqui separo los datos
                $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
                $arraglo_sale = explode(",", $sale); //aqui separo los datos
                $arraglo_precio = explode(",", $precio); //aqui separo los datos
                $arraglo_oferta  = explode(",", $oferta); //aqui separo los datos
                $arraglo_descuento  = explode(",", $descuento); //aqui separo los datos
                $arraglo_total = explode(",", $totalsub); //aqui separo los datos  

                for ($i = 0; $i < count($arraglo_id); $i++) {
                    $repuesta_create = $this->tienda->RegistrarVentaCarritoDetalle($repuesta, $arraglo_id[$i], $arraglo_cantidad[$i], $arraglo_sale[$i], $arraglo_precio[$i], $arraglo_oferta[$i], $arraglo_descuento[$i], $arraglo_total[$i]);
                }

                if ($repuesta_create > 0) {
                    echo $repuesta;
                    exit();
                } else {
                    echo $repuesta_create;
                    exit();
                }
            } else {
                echo $repuesta;
                exit();
            }
            exit();
        }
    }

    public function AnularFacturaVentaWeb()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $repuesta_create = $this->tienda->AnularFacturaVentaWeb($id);
            return $repuesta_create;
        }
    }

    public function CalificarProducto()
    {
        if ($this->request->getMethod() == "post") {
            if (!empty($_SESSION["TokenClie"])) {

                $iduser = $_SESSION["TokenClie"];
                $estado = $this->request->getPost('estado');
                $idproducto = $this->request->getPost('idproducto');

                $repuesta = $this->tienda->CalificarProducto($iduser, $estado, $idproducto);
                echo $repuesta;
                exit();
            } else {

                echo 0;
                exit();
            }
        }
    }

    public function TraerCalificaionCliente()
    {
        if ($this->request->getMethod() == "post") {
            if (!empty($_SESSION["TokenClie"])) {
                $iduser = $_SESSION["TokenClie"];
                $idproducto = $this->request->getPost('idproducto');
                $repuesta = $this->tienda->TraerCalificaionCliente($iduser, $idproducto);
                echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
                exit();
            } else {
                echo 0;
                exit();
            }
        }
    }

    public function CalificarProductoOferta()
    {
        if ($this->request->getMethod() == "post") {
            if (!empty($_SESSION["TokenClie"])) {

                $iduser = $_SESSION["TokenClie"];
                $estado = $this->request->getPost('estado');
                $idproducto = $this->request->getPost('idproducto');

                $repuesta = $this->tienda->CalificarProductoOferta($iduser, $estado, $idproducto);
                echo $repuesta;
                exit();
            } else {
                echo 0;
                exit();
            }
        }
    }

    public function TraerCalificaionClienteOferta()
    {
        if ($this->request->getMethod() == "post") {
            if (!empty($_SESSION["TokenClie"])) {
                $iduser = $_SESSION["TokenClie"];
                $idproducto = $this->request->getPost('idproducto');
                $repuesta = $this->tienda->TraerCalificaionClienteOferta($iduser, $idproducto);
                echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
                exit();
            } else {
                echo 0;
                exit();
            }
        }
    }

    public function EditarPasswordCliente()
    {
        if ($this->request->getMethod() == "post") {
            $iduser = $_SESSION["TokenClie"];
            $passnew = $this->request->getPost('passnew');

            $repuesta = $this->tienda->EditarPasswordCliente($iduser, $passnew);
            echo $repuesta;
            exit();
        }
    }

    public function RegistrarComprobanteServientrega()
    {
        $id = $this->request->getPost('id');
        $codigo = $this->request->getPost('codigo');

        $count = 0;
        if (!empty($_FILES["img_extra"]["tmp_name"])) {
            foreach ($_FILES["img_extra"]["name"] as $key => $value) {

                $extra = explode('.', $_FILES["img_extra"]["name"][$key]);
                $renombrar = sha1($_FILES["img_extra"]["name"][$key]) . time();
                $nombre_final = $renombrar . "" . $count . "." . $extra[1];

                $valor_img = $this->tienda->RegistrarComprobanteServientrega($id, $codigo, $nombre_final);
                if ($valor_img == 1) {

                    $imagen = ROOTPATH . 'public/img/servientrega/' . $nombre_final;
                    move_uploaded_file($_FILES["img_extra"]["tmp_name"][$key], $imagen);

                    $dataa = $this->tienda->TraerDatos_De_Imagen_Cliente($id);
                    $correo = $dataa[2];
                    $location = base_url();
                    $html = '<!DOCTYPE html>
                    <html lang="es">
                    <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body>
                    <table style="border: 1px solid black; width: 100%; height: 258px;">
                    <thead>
                    <tr style="height: 73px;">
                    <td style="text-align: center; background: #9bfab0; color: black; height: 73px;" colspan="2">
                    <h1><strong>.:Guía de envio:.</strong></h1>
                    </td>
                    </tr>
                    <tr style="height: 188px;">
                    <td style="height: 134px; text-align: center;" width="20%">Estimado cliente cliente: <b>' . $dataa[0] . ' - ' . $dataa[1] . '</b>, reciba  su guía de servientrega - Código: ' . $dataa[3] . '</td>
                    <center> <img src="' . base_url() . 'public/img/servientrega/' . $nombre_final . '" width="250px" height="150px" alt="' . $imagen . '" /> </center>
                    </tr>
                    <tr style="height: 188px;">
                    <td style="height: 51px; text-align: center;" width="20%"><a href=' . $location . '>Link de nuestro sistema.</a></td>
                    </tr>
                    </thead>
                    </table>
                    </body>
                    </html>';
                    $sms = "Guía de envio - Servientrega";
                    $this->send_email->enviar_correo($correo, $html, $sms);
                }
                $count++;
            }
            echo $valor_img;
            exit();
        } else {
            echo 2;
            exit();
        }
    }

    public function DescargarArchivo()
    {
        $id = $this->request->getPost('id');
        $valor = $this->tienda->DescargarArchivo($id);
        echo json_encode($valor, JSON_UNESCAPED_UNICODE);
        exit();
    }

    ////////////////
    public function paginartiendaCategorias()
    {
        if ($this->request->getMethod() == "post") {
            $partida = $this->request->getPost('partida');
            $valor = $this->request->getPost('valor');
            $id = $this->request->getPost('id');

            $repuesta = $this->tienda->paginartiendaCategorias($partida, $valor, $id);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
            exit();
        }
        exit();
    }
}
