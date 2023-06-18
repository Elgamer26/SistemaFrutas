<?php

namespace App\Controllers;

use App\Models\ModeloProveedor;

class Compra extends BaseController
{
    protected $proveedor;
    public function __construct()
    {
        $this->proveedor = new ModeloProveedor();
    }

    //////////////// REGISTRO DE PROVEEDOR

    public function RegistrarProveedor()
    {
        if ($this->request->getMethod() == "post") {

            $ruc = $this->request->getPost('ruc');
            $razon_social = $this->request->getPost('razon_social');
            $correo = $this->request->getPost('correo');
            $direccion = $this->request->getPost('direccion');
            $telefono = $this->request->getPost('telefono');
            $encargado = $this->request->getPost('encargado');
            $descripcion = $this->request->getPost('descripcion');

            $repuesta_create = $this->proveedor->RegistrarProveedor($ruc, $razon_social, $correo, $direccion, $telefono, $encargado, $descripcion);
            return $repuesta_create[0];
        }
    }

    public function EstadoProveedor()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->proveedor->EstadoProveedor($estado, $id);
            return $repuesta_create;
        }
    }

    public function EditarProveedor()
    {
        if ($this->request->getMethod() == "post") {

            $id = $this->request->getPost('id');
            $ruc = $this->request->getPost('ruc');
            $razon_social = $this->request->getPost('razon_social');
            $correo = $this->request->getPost('correo');
            $direccion = $this->request->getPost('direccion');
            $telefono = $this->request->getPost('telefono');
            $encargado = $this->request->getPost('encargado');
            $descripcion = $this->request->getPost('descripcion');

            $repuesta_create = $this->proveedor->EditarProveedor($id, $ruc, $razon_social, $correo, $direccion, $telefono, $encargado, $descripcion);
            return $repuesta_create[0];
        }
    }

    ////// REGISTRO DE COMPRA INSUMO

    public function GuardarCompraInsumo()
    {
        if ($this->request->getMethod() == "post") {

            $proveedor = $this->request->getPost('proveedor');
            $fecha_c = $this->request->getPost('fecha_c');
            $numero_compra = $this->request->getPost('numero_compra');
            $tipo_comprobante = $this->request->getPost('tipo_comprobante');
            $iva = $this->request->getPost('iva');
            $subtotal = $this->request->getPost('subtotal');
            $impuesto_sub = $this->request->getPost('impuesto_sub');
            $total_pagar = $this->request->getPost('total_pagar');

            $repuesta_create = $this->proveedor->GuardarCompraInsumo($proveedor, $fecha_c, $numero_compra, $tipo_comprobante, $iva, $subtotal, $impuesto_sub, $total_pagar);
            return $repuesta_create;
        }
    }

    public function DetalleCompraInsumo()
    {
        if ($this->request->getMethod() == "post") {

            $id = (string)$this->request->getPost('id');
            $ida = (string)$this->request->getPost('ida');
            $precio = (string)$this->request->getPost('precio');
            $cantidad = (string)$this->request->getPost('cantidad');
            $descuento = (string)$this->request->getPost('descuento');
            $total = (string)$this->request->getPost('total');

            $arraglo_ida = explode(",", $ida); //aqui separo los datos
            $arraglo_precio = explode(",", $precio); //aqui separo los datos
            $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
            $arraglo_descuento  = explode(",", $descuento); //aqui separo los datos
            $arraglo_total = explode(",", $total); //aqui separo los datos  

            for ($i = 0; $i < count($arraglo_ida); $i++) {
                $repuesta_create = $this->proveedor->DetalleCompraInsumo($id, $arraglo_ida[$i], $arraglo_precio[$i], $arraglo_cantidad[$i], $arraglo_descuento[$i], $arraglo_total[$i]);
            }

            return $repuesta_create;
        }
    }

    public function AnularFactura()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $repuesta_create = $this->proveedor->AnularFactura($id);
            return $repuesta_create;
        }
    }

    ////// REGISTRO DE COMPRA MATERIAL

    public function GuardarCompraMaterial()
    {
        if ($this->request->getMethod() == "post") {

            $proveedor = $this->request->getPost('proveedor');
            $fecha_c = $this->request->getPost('fecha_c');
            $numero_compra = $this->request->getPost('numero_compra');
            $tipo_comprobante = $this->request->getPost('tipo_comprobante');
            $iva = $this->request->getPost('iva');
            $subtotal = $this->request->getPost('subtotal');
            $impuesto_sub = $this->request->getPost('impuesto_sub');
            $total_pagar = $this->request->getPost('total_pagar');

            $repuesta_create = $this->proveedor->GuardarCompraMaterial($proveedor, $fecha_c, $numero_compra, $tipo_comprobante, $iva, $subtotal, $impuesto_sub, $total_pagar);
            return $repuesta_create;
        }
    }

    public function DetalleCompraMaterial()
    {
        if ($this->request->getMethod() == "post") {

            $id = (string)$this->request->getPost('id');
            $ida = (string)$this->request->getPost('ida');
            $precio = (string)$this->request->getPost('precio');
            $cantidad = (string)$this->request->getPost('cantidad');
            $descuento = (string)$this->request->getPost('descuento');
            $total = (string)$this->request->getPost('total');

            $arraglo_ida = explode(",", $ida); //aqui separo los datos
            $arraglo_precio = explode(",", $precio); //aqui separo los datos
            $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
            $arraglo_descuento  = explode(",", $descuento); //aqui separo los datos
            $arraglo_total = explode(",", $total); //aqui separo los datos  

            for ($i = 0; $i < count($arraglo_ida); $i++) {
                $repuesta_create = $this->proveedor->DetalleCompraMaterial($id, $arraglo_ida[$i], $arraglo_precio[$i], $arraglo_cantidad[$i], $arraglo_descuento[$i], $arraglo_total[$i]);
            }

            return $repuesta_create;
        }
    }

    public function AnularFacturaMaterial()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $repuesta_create = $this->proveedor->AnularFacturaMaterial($id);
            return $repuesta_create;
        }
    }
}
