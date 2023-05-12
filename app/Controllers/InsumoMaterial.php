<?php

namespace App\Controllers;

use App\Models\ModeloInsumos;

class InsumoMaterial extends BaseController
{
    protected $InsumoMaterial;
    public function __construct()
    {
        $this->InsumoMaterial = new ModeloInsumos();
    }

    //////////////// TIPO DE INSUMO

    public function RegistraTipoInsumo()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $repuesta_create = $this->InsumoMaterial->RegistraTipoInsumo($nombrerol);
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

    public function EstadoIsnumo()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EstadoIsnumo($estado, $id);
            return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
        }
    }

    public function EditarTipoInsumo()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EditarTipoInsumo($nombrerol, $id);
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

    //// REGISTRO DE INSUMO 

    public function RegistrarInsumo()
    {
        $codigo = $this->request->getPost('codigo');
        $nombres = $this->request->getPost('nombres');
        $tipo_producto = $this->request->getPost('tipo_producto');
        $precio_venta = $this->request->getPost('precio_venta');
        $descripcion = $this->request->getPost('descripcion');

        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        if (!empty($imageFile)) {
            $valor = $this->InsumoMaterial->RegistrarInsumo($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $nombrearchivo);
            if ($valor[0] == "1") {
                $imageFile->move(ROOTPATH . 'public/img/insumo/', $nombrearchivo);
                echo $valor[0];
                exit();
            } else {
                echo $valor[0];
                exit();
            }
        } else {
            $imagen = "insumo.jpg";
            $valor = $this->InsumoMaterial->RegistrarInsumo($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $imagen);
            echo $valor[0];
            exit();
        }
    }

    public function EstadoInsumoI()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EstadoInsumoI($estado, $id);
            return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
        }
    }

    public function EditarInsumo()
    {
        $insumoID = $this->request->getPost('insumoID');
        $codigo = $this->request->getPost('codigo');
        $nombres = $this->request->getPost('nombres');
        $tipo_producto = $this->request->getPost('tipo_producto');
        $precio_venta = $this->request->getPost('precio_venta');
        $descripcion = $this->request->getPost('descripcion');
        $valor = $this->InsumoMaterial->EditarInsumo($insumoID, $codigo, $nombres, $tipo_producto, $precio_venta, $descripcion);
        echo json_encode($valor[0], JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function EditarFotoInsumo()
    {
        $id = $this->request->getPost('id');
        $ruta_actual = $this->request->getPost('ruta_actual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');

        $imageFile = $this->request->getFile('foto');
        $valorFile = $this->InsumoMaterial->EditarFotoInsumo($id, $nombrearchivo);
        if ($valorFile == 1) {
            $imageFile->move(ROOTPATH . 'public/img/insumo/', $nombrearchivo);
            if ($ruta_actual != "insumo.jpg") {
                unlink(ROOTPATH . 'public/img/insumo/' . $ruta_actual);
            }
            echo $valorFile;
        } else {
            echo $valorFile;
        }
        exit();
    }

    /// TIPO DE MATERIAL

    public function RegistraTipoMaterial()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $repuesta_create = $this->InsumoMaterial->RegistraTipoMaterial($nombrerol);
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

    public function EstadoTipoMaterial()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EstadoTipoMaterial($estado, $id);
            return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
        }
    }

    public function EditarTipoMaterial()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EditarTipoMaterial($nombrerol, $id);
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

}
