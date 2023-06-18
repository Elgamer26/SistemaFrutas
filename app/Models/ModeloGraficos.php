<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloGraficos
{

    private $conexion;

    function __construct()
    {
        require_once 'ModeloConection.php';
        $this->conexion = new ModeloConection();
        //abrir conexion
        $this->conexion->conexionPDO();
        //cerra conexion
        $this->conexion->cerrar_conexion();
    }

    function TraerGraficoProductosMasVendidos()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.nombre,
            tipo_producto.tipo,
            SUM( ventawebdetalle.sale ) AS cantidad,
            ventaweb.comprobante,
            ventawebdetalle.productoid 
            FROM
                ventaweb
                INNER JOIN ventawebdetalle ON ventaweb.id = ventawebdetalle.ventaid
                INNER JOIN producto ON ventawebdetalle.productoid = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
            WHERE
                ventaweb.comprobante <> 'PayPal' 
            GROUP BY
                ventawebdetalle.productoid 
            ORDER BY
            SUM( ventawebdetalle.sale ) DESC";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerGraficoProductosMasVendidosOferta()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.nombre,
            tipo_producto.tipo,
            SUM( ventawebdetalle.sale ) AS cantidad,
            ventaweb.comprobante,
            ventawebdetalle.productoid 
            FROM
                ventaweb
                INNER JOIN ventawebdetalle ON ventaweb.id = ventawebdetalle.ventaid
                INNER JOIN producto ON ventawebdetalle.productoid = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
            WHERE
                ventaweb.comprobante = 'PayPal' 
            GROUP BY
                ventawebdetalle.productoid 
            ORDER BY
            SUM( ventawebdetalle.sale ) DESC";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerGraficoClientesMasCompras()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            cliente.nombre,
            cliente.apellidos,
            COUNT( ventaweb.cliente_id ) AS cantidad 
            FROM
                cliente
                INNER JOIN ventaweb ON cliente.id = ventaweb.cliente_id 
            GROUP BY
                ventaweb.cliente_id 
            ORDER BY
            COUNT( ventaweb.cliente_id ) DESC LIMIT 10";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function TraerGraficoProductosMasComprados()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            insumo.nombre,
            COUNT( detallecompra.insumo_id ) AS cantidad 
            FROM
            detallecompra
            INNER JOIN insumo ON insumo.id = detallecompra.insumo_id 
            GROUP BY
            detallecompra.insumo_id 
            ORDER BY
            COUNT( detallecompra.insumo_id ) DESC 
            LIMIT 10";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }
}
