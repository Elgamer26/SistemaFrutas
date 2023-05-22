<?php

namespace App\Controllers;

use App\Models\ModeloProducto;
use App\SmsWhatsapp\Whatsapp;

class Producto extends BaseController
{
    protected $producto;
    protected $sms;

    public function __construct()
    {
        $this->sms = new Whatsapp();
        $this->producto = new ModeloProducto();
    }

    //////////////// TIPO DE PRODUCTO

    public function RegistraTipoProducto()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $repuesta_create = $this->producto->RegistraTipoProducto($nombrerol);
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

    public function EstadoTipo()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->producto->EstadoTipo($estado, $id);
            return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
        }
    }

    public function EditarTipoProducto()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->producto->EditarTipoProducto($nombrerol, $id);
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

    //// REGISTRO DE PRODUCTOS 

    public function RegistraProducto()
    {
        $codigo = $this->request->getPost('codigo');
        $nombres = $this->request->getPost('nombres');
        $tipo_producto = $this->request->getPost('tipo_producto');
        $precio_venta = $this->request->getPost('precio_venta');
        $descripcion = $this->request->getPost('descripcion');

        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        if (!empty($imageFile)) {
            $valor = $this->producto->RegistraProducto($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $nombrearchivo);
            if ($valor[0] == "1") {
                $imageFile->move(ROOTPATH . 'public/img/producto/', $nombrearchivo);
                echo $valor[0];
                exit();
            } else {
                echo $valor[0];
                exit();
            }
        } else {
            $imagen = "producto.jpg";
            $valor = $this->producto->RegistraProducto($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $imagen);
            echo $valor[0];
            exit();
        }
    }

    public function EstadoProducto()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->producto->EstadoProducto($estado, $id);
            return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
        }
    }

    public function EditarProducto()
    {
        $productoID = $this->request->getPost('productoID');
        $codigo = $this->request->getPost('codigo');
        $nombres = $this->request->getPost('nombres');
        $tipo_producto = $this->request->getPost('tipo_producto');
        $precio_venta = $this->request->getPost('precio_venta');
        $descripcion = $this->request->getPost('descripcion');
        $valor = $this->producto->EditarProducto($productoID, $codigo, $nombres, $tipo_producto, $precio_venta, $descripcion);
        echo json_encode($valor[0], JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function EditarFotoProducto()
    {
        $id = $this->request->getPost('id');
        $ruta_actual = $this->request->getPost('ruta_actual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');

        $imageFile = $this->request->getFile('foto');
        $valorFile = $this->producto->EditarFotoProducto($id, $nombrearchivo);
        if ($valorFile == 1) {
            $imageFile->move(ROOTPATH . 'public/img/producto/', $nombrearchivo);
            if ($ruta_actual != "producto.jpg") {
                unlink(ROOTPATH . 'public/img/producto/' . $ruta_actual);
            }
            echo $valorFile;
        } else {
            echo $valorFile;
        }
        exit();
    }

    public function RegistroOferta()
    {
        $producto = $this->request->getPost('producto');
        $fechainicio = $this->request->getPost('fechainicio');
        $fechafin = $this->request->getPost('fechafin');
        $tipooferta = $this->request->getPost('tipooferta');
        $valordescuento = $this->request->getPost('valordescuento');

        $valor = $this->producto->RegistroOferta($producto, $fechainicio, $fechafin, $tipooferta, $valordescuento);
        echo $valor;
        exit();
    }

    public function EditarOferta()
    {
        $idoferta = $this->request->getPost('idoferta');
        $fechainicio = $this->request->getPost('fechainicio');
        $fechafin = $this->request->getPost('fechafin');
        $tipooferta = $this->request->getPost('tipooferta');
        $valordescuento = $this->request->getPost('valordescuento');
        $valor = $this->producto->EditarOferta($idoferta, $fechainicio, $fechafin, $tipooferta, $valordescuento);
        echo $valor;
        exit();
    }

    ///PAGINADOR DE OFERTAS

    public function Pagination_oferta()
    {
        if ($this->request->getMethod() == "post") {
            $partida = $this->request->getPost('partida');
            $valor = $this->request->getPost('valor');
            $repuesta = $this->producto->Pagination_oferta($partida, $valor);
            return json_encode($repuesta, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

    // ELIMINAR LA OFERTA
    public function EliminarOferta()
    {
        $idoferta = $this->request->getPost('idoferta');
        $idproducto = $this->request->getPost('idproducto');
        $valor = $this->producto->EliminarOferta($idoferta, $idproducto);
        echo $valor;
        exit();
    }

    /// ENVIAR OFERTA POR SMS whatsapp 
    public function EnviarOfertasSMS()
    {
        $id = $this->request->getPost('id');
        $sms = $this->producto->GeneraOfertaSms($id);

        if ($sms == 0) {
            echo $sms;
            exit();
        } else {
            $mensaje = $this->sms->enviar_mensaje($sms);
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
}
