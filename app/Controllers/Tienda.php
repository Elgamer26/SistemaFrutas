<?php

namespace App\Controllers;

use App\Models\ModeloTienda;

class Tienda extends BaseController
{
    protected $tienda;
    public function __construct()
    {
        session_start();
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

            $repuesta = $this->tienda->RegistrarVentaCarrito($id_cli, $direccion, $sub, $impuesto, $total, $ciudad, $referencia);

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
}
