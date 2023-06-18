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
            echo $repuesta_create[0];
            exit();
        }
    }

    public function EstadoIsnumo()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EstadoIsnumo($estado, $id);
            echo $repuesta_create;
            exit();
        }
    }

    public function EditarTipoInsumo()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EditarTipoInsumo($nombrerol, $id);
            echo $repuesta_create[0];
            exit();
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
            echo $repuesta_create;
            exit();
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
        echo $valor[0];
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
            echo $repuesta_create[0];
        }
    }

    public function EstadoTipoMaterial()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EstadoTipoMaterial($estado, $id);
            echo $repuesta_create;
        }
    }

    public function EditarTipoMaterial()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EditarTipoMaterial($nombrerol, $id);
            echo $repuesta_create[0];
        }
    }

    //// REGISTRO DE MATERIAL 

    public function RegistrarMaterial()
    {
        $codigo = $this->request->getPost('codigo');
        $nombres = $this->request->getPost('nombres');
        $tipo_producto = $this->request->getPost('tipo_producto');
        $precio_venta = $this->request->getPost('precio_venta');
        $descripcion = $this->request->getPost('descripcion');

        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        if (!empty($imageFile)) {
            $valor = $this->InsumoMaterial->RegistrarMaterial($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $nombrearchivo);
            if ($valor[0] == "1") {
                $imageFile->move(ROOTPATH . 'public/img/material/', $nombrearchivo);
                echo $valor[0];
                exit();
            } else {
                echo $valor[0];
                exit();
            }
        } else {
            $imagen = "material.jpg";
            $valor = $this->InsumoMaterial->RegistrarMaterial($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $imagen);
            echo $valor[0];
            exit();
        }
    }

    public function EstadoMaterial()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->InsumoMaterial->EstadoMaterial($estado, $id);
            echo $repuesta_create;
            exit();
        }
    }

    public function EditarMaterial()
    {
        $insumoID = $this->request->getPost('insumoID');
        $codigo = $this->request->getPost('codigo');
        $nombres = $this->request->getPost('nombres');
        $tipo_producto = $this->request->getPost('tipo_producto');
        $precio_venta = $this->request->getPost('precio_venta');
        $descripcion = $this->request->getPost('descripcion');
        $valor = $this->InsumoMaterial->EditarMaterial($insumoID, $codigo, $nombres, $tipo_producto, $precio_venta, $descripcion);
        echo $valor[0];
        exit();
    }

    public function EditarFotoMaterial()
    {
        $id = $this->request->getPost('id');
        $ruta_actual = $this->request->getPost('ruta_actual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');

        $imageFile = $this->request->getFile('foto');
        $valorFile = $this->InsumoMaterial->EditarFotoMaterial($id, $nombrearchivo);
        if ($valorFile == 1) {
            $imageFile->move(ROOTPATH . 'public/img/material/', $nombrearchivo);
            if ($ruta_actual != "material.jpg") {
                unlink(ROOTPATH . 'public/img/material/' . $ruta_actual);
            }
            echo $valorFile;
        } else {
            echo $valorFile;
        }
        exit();
    }
}
