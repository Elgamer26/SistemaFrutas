<?php

namespace App\Controllers;

use App\Models\ModeloVenta;

class Venta extends BaseController
{
    protected $venta;
    public function __construct()
    {
        $this->venta = new ModeloVenta();
    }

    //////////////// REGISTRO DE VENTA
    public function RegistrarVentaCarrito()
    {
        if ($this->request->getMethod() == "post") {

            $cliente = $this->request->getPost('cliente');
            $fecha_c = $this->request->getPost('fecha_c');
            $numero_compra = $this->request->getPost('numero_compra');
            $tipo_comprobante = $this->request->getPost('tipo_comprobante');
            $iva = $this->request->getPost('iva');
            $subtotal = $this->request->getPost('subtotal');
            $impuesto_sub = $this->request->getPost('impuesto_sub');
            $total_pagar = $this->request->getPost('total_pagar');

            $repuesta = $this->venta->RegistrarVenta($cliente, $fecha_c, $numero_compra, $tipo_comprobante, $iva, $subtotal, $impuesto_sub, $total_pagar);
            echo $repuesta;
            exit();
        }
    }

    public function DetalleCompraMaterial()
    {
        if ($this->request->getMethod() == "post") {

            $id = (string)$this->request->getPost('id');
            $idp = (string)$this->request->getPost('idp');
            $cantidad = (string)$this->request->getPost('cantidad');
            $sale = (string)$this->request->getPost('sale');
            $precio = (string)$this->request->getPost('precio');
            $desc_dolar = (string)$this->request->getPost('desc_dolar');
            $oferta = (string)$this->request->getPost('oferta');
            $desc_oferta = (string)$this->request->getPost('desc_oferta');
            $subtotals = (string)$this->request->getPost('subtotals');


            $arraglo_idp = explode(",", $idp); //aqui separo los datos
            $arraglo_cantidad = explode(",", $cantidad); //aqui separo los datos
            $arraglo_sale = explode(",", $sale); //aqui separo los datos
            $arraglo_precio  = explode(",", $precio); //aqui separo los datos
            $arraglo_desc_dolar = explode(",", $desc_dolar); //aqui separo los datos  
            $arraglo_oferta = explode(",", $oferta); //aqui separo los datos
            $arraglo_desc_oferta  = explode(",", $desc_oferta); //aqui separo los datos
            $arraglo_subtotals = explode(",", $subtotals); //aqui separo los datos  

            for ($i = 0; $i < count($arraglo_idp); $i++) {
                $repuesta_create = $this->venta->RegistrarVentaDetalle($id, $arraglo_idp[$i], $arraglo_cantidad[$i], $arraglo_sale[$i], $arraglo_precio[$i], $arraglo_desc_dolar[$i], $arraglo_oferta[$i], $arraglo_desc_oferta[$i], $arraglo_subtotals[$i]);
            }

            echo $repuesta_create;
            exit();
        }
    }
}
