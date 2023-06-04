<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloVenta
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

    function SelectCliente()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM cliente WHERE estado = 1 ORDER BY id DESC";
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

    function ListarVentasTiendaWeb()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            ventaweb.id,
            CONCAT_WS( ' ', cliente.nombre, cliente.apellidos ) AS cliente,
            cliente.cedula,
            ventaweb.direccion,
            ventaweb.subtotal,
            ventaweb.impuesto,
            ventaweb.total,
            ventaweb.fecha,
            ventaweb.n_venta,
            ventaweb.comprobante,
            ventaweb.iva,
            ventaweb.estado,
            ventaweb.fecharegistro,
            ventaweb.ciudad,
            ventaweb.referencia 
            FROM
                ventaweb
                INNER JOIN cliente ON ventaweb.cliente_id = cliente.id 
            ORDER BY
            ventaweb.id DESC";
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

    function ListProdcutosDisponibles()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id,
            producto.codigo,
            producto.nombre,
            tipo_producto.tipo,
            producto.precio,
            producto.descripcion,
            producto.imagen,
            producto.estado,
            producto.cantidad 
            FROM
                producto
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
            WHERE
                producto.estado = 1 
                AND producto.cantidad != 0 
            ORDER BY
            producto.id DESC";
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

    function ListOfertaDisponibles()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id,
            producto.codigo,
            producto.nombre,
            tipo_producto.tipo,
            producto.precio,
            producto.imagen,
            producto.cantidad,
            oferta.fecha_inicio,
            oferta.fecha_fin,
            oferta.tipo_oferta,
            oferta.valor_descuento
            FROM
                producto
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id
                INNER JOIN oferta ON producto.id = oferta.producto_id 
            WHERE
                producto.estado = 1 
                AND producto.cantidad <> 0 
            ORDER BY
            producto.id DESC";
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
