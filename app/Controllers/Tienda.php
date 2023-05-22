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
            return json_encode($repuesta, JSON_UNESCAPED_UNICODE);
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
            return json_encode($repuesta, JSON_UNESCAPED_UNICODE);
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
}
