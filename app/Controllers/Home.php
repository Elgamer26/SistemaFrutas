<?php

namespace App\Controllers;

use App\Models\ModeloTienda;

class Home extends BaseController
{
    protected $tienda;
    public function __construct()
    {
        session_start();
        $this->tienda = new ModeloTienda();
    }

    public function index()
    {
        if (empty($_SESSION["TokenClie"])) {
            $token = "NOTOKEN";
        } else {
            $token = $_SESSION["NombUser"];
        }
        $data = [
            "token" => $token
        ];
        echo view('tienda/header', $data);
        echo view('tienda/index', $data);
        echo view('tienda/footer');
    }

    public function ofertas()
    {
        if (empty($_SESSION["TokenClie"])) {
            $token = "NOTOKEN";
        } else {
            $token = $_SESSION["NombUser"];
        }
        $data = [
            "token" => $token
        ];
        echo view('tienda/header', $data);
        echo view('tienda/product');
        echo view('tienda/footer');
    }

    public function Detalle($id)
    {
        if ($this->request->getMethod() == "get") {

            if (empty($_SESSION["TokenClie"])) {
                $token = "NOTOKEN";
            } else {
                $token = $_SESSION["NombUser"];
            }

            $producto = $this->tienda->TraerProductoTienda($id);
            $comentario = $this->tienda->TraerComentarioProductoNormal($id);

            $data = [
                "token" => $token,
                "producto" => $producto,
                "comentario" => $comentario,
            ];
            echo view('tienda/header', $data);
            echo view('tienda/single', $data);
            echo view('tienda/footer');
        }
    }

    public function DetalleOferta($id)
    {
        if ($this->request->getMethod() == "get") {

            if (empty($_SESSION["TokenClie"])) {
                $token = "NOTOKEN";
            } else {
                $token = $_SESSION["NombUser"];
            }

            $oferta = $this->tienda->TraerProductoTiendaOferta($id);
            $comentario = $this->tienda->TraerComentarioProducto($id);
            $data = [
                "token" => $token,
                "producto" => $oferta,
                "comentario" => $comentario,
            ];

            echo view('tienda/header', $data);
            echo view('tienda/oferta', $data);
            echo view('tienda/footer');
        }
    }

    public function login()
    {
        return view('tienda/login');
    }

    public function Registro()
    {
        return view('tienda/Registro');
    }

    public function Recuperar()
    {
        return view('tienda/Recuperar');
    }

    public function detallecarrito()
    {
        if (empty($_SESSION["TokenClie"])) {
            $token = "NOTOKEN";
            $detallecompra = [];
        } else {
            $token = $_SESSION["NombUser"];
            $detallecompra = $this->tienda->TraerProductosDelCliente($_SESSION["TokenClie"]);
        }

        $data = [
            "token" => $token,
            "detallecompra" => $detallecompra
        ];
        echo view('tienda/header', $data);
        echo view('tienda/detallecarrito');
        echo view('tienda/footer');
    }
}
