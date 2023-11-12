<?php

namespace App\Controllers;

use App\Models\ModeloProduccion;

class Produccion extends BaseController
{
    protected $produccion;
    public function __construct()
    {
        session_start();
        $this->produccion = new ModeloProduccion();
    }

    //////////////// CANTIDAD DE INSUMOS DISPONIBLES

    public function TraerCantidadInsumo()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $repuesta = $this->produccion->TraerCantidadInsumo($id);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

    //////////////// CANTIDAD DE MATERIAL DISPONIBLES

    public function TraerCantidadMaterial()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $repuesta = $this->produccion->TraerCantidadMaterial($id);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

    ////// REGISTRO DE PRODUCCION

    public function RegistrarProduccionPlantas()
    {
        if ($this->request->getMethod() == "post") {

            $iduser = $_SESSION["id_user"];
            $nombreproduccion = $this->request->getPost('nombreproduccion');
            $fechainicio = $this->request->getPost('fechainicio');
            $fechaFin = $this->request->getPost('fechaFin');
            $diasproduccion = $this->request->getPost('diasproduccion');
            $producto = $this->request->getPost('producto');
            $cantidadprod = $this->request->getPost('cantidadprod');

            $repuesta = $this->produccion->RegistrarProduccionPlantas($nombreproduccion, $fechainicio, $fechaFin, $diasproduccion, $producto, $iduser, $cantidadprod);
            echo $repuesta;
        }
        exit();
    }

    public function RegistrarDetalleInsumoProduccion()
    {
        if ($this->request->getMethod() == "post") {

            $id = (string)$this->request->getPost('id');
            $idinsumo = (string)$this->request->getPost('idinsumo');
            $cantidad = (string)$this->request->getPost('cantidad');

            $arraglo_idinsumo = explode(",", $idinsumo); //aqui separo los datos 
            $arraglo_cantidad = explode(",", $cantidad); //aqui separo los dat 

            for ($i = 0; $i < count($arraglo_idinsumo); $i++) {
                $repuesta = $this->produccion->RegistrarDetalleInsumoProduccion($id, $arraglo_idinsumo[$i], $arraglo_cantidad[$i]);
            }

            echo $repuesta;
            exit();
        }
    }

    public function RegistrarDetalleMaterialProduccion()
    {
        if ($this->request->getMethod() == "post") {

            $id = (string)$this->request->getPost('id');
            $idmaterial = (string)$this->request->getPost('idmaterial');
            $cantidad = (string)$this->request->getPost('cantidad');

            $arraglo_idmaterial = explode(",", $idmaterial); //aqui separo los datos 
            $arraglo_cantidad = explode(",", $cantidad); //aqui separo los dat 

            for ($i = 0; $i < count($arraglo_idmaterial); $i++) {
                $repuesta = $this->produccion->RegistrarDetalleMaterialProduccion($id, $arraglo_idmaterial[$i], $arraglo_cantidad[$i]);
            }

            echo $repuesta;
            exit();
        }
    }

    ///PAGINADOR DE PRODUCCION

    public function PaginadorProduccion()
    {
        if ($this->request->getMethod() == "post") {

            $partida = $this->request->getPost('partida');
            $valor = $this->request->getPost('valor');

            $repuesta = $this->produccion->PaginadorProduccion($partida, $valor);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

    /// REGISTAR PERDIDA

    public function RegistroPerdidaProduccion()
    {
        if ($this->request->getMethod() == "post") {

            $iduser = $_SESSION["id_user"];
            $produccion = $this->request->getPost('produccion');
            $cantidadperdida = $this->request->getPost('cantidadperdida');
            $detalleperdida = $this->request->getPost('detalleperdida');
            $fechaperdida = $this->request->getPost('fechaperdida');

            $repuesta = $this->produccion->RegistroPerdidaProduccion($produccion, $cantidadperdida, $detalleperdida,  $fechaperdida, $iduser);
            echo $repuesta;
            exit();
        }
    }

    public function EliminarLaPerdida()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $cantidad = $this->request->getPost('cantidad');
            $idprod = $this->request->getPost('idprod');

            $repuesta = $this->produccion->EliminarLaPerdida($id, $cantidad, $idprod);
            echo $repuesta;
            exit();
        }
    }

    public function traerCantidadProduction()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $repuesta = $this->produccion->traerCantidadProduction($id);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

    ///// REGISTRO DE FASE DE PRODUCCION

    public function RegistrarFaseProduccion()
    {
        if ($this->request->getMethod() == "post") {

            $produccion = $this->request->getPost('produccion');
            $fecharegistro = $this->request->getPost('fecharegistro');
            $diasproduccion = $this->request->getPost('diasproduccion');
            $detallefase = $this->request->getPost('detallefase');

            $repuesta = $this->produccion->RegistrarFaseProduccion($produccion, $fecharegistro, $diasproduccion,  $detallefase);
            echo $repuesta;
            exit();
        }
    }

    public function TraerNumeroFaseProduccion()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $repuesta = $this->produccion->TraerNumeroFaseProduccion($id);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    public function TraerDetalleFaseProduccion()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $repuesta = $this->produccion->TraerDetalleFaseProduccion($id);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    public function EliminarFaseProduccion()
    {
        if ($this->request->getMethod() == "post") {

            $id_fase = $this->request->getPost('id_fase');
            $id_produccion = $this->request->getPost('id_produccion');

            $repuesta = $this->produccion->EliminarFaseProduccion($id_fase, $id_produccion);
            echo $repuesta;
            exit();
        }
    }

    ///PAGINADOR DE PRODUCCION FINALIZADO

    public function paginationFinalizado()
    {
        if ($this->request->getMethod() == "post") {

            $partida = $this->request->getPost('partida');
            $valor = $this->request->getPost('valor');

            $repuesta = $this->produccion->paginationFinalizado($partida, $valor);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

    ///EDITAT FASE TIPO
    public function EditarFaseTipo()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $nombre = $this->request->getPost('nombre');
            $repuesta = $this->produccion->EditarFaseTipo($id, $nombre);
            echo $repuesta;
            exit();
        }
    }

    //// VER DETALLE DE PERDIDA EN PRODUCCION

    public function VerPerdidaProduccion()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $repuesta = $this->produccion->VerPerdidaProduccion($id);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    //// ELIMINAR LA PRODUCCION

    public function EliminarProduccion()
    {
        if ($this->request->getMethod() == "post") {

            $id = $this->request->getPost('id');
            $productoid = $this->request->getPost('productoid');
            $cantidad = $this->request->getPost('cantidad');

            $repuesta = $this->produccion->EliminarProduccion($id, $productoid, $cantidad);
            echo $repuesta;
            exit();
        }
    }
}
