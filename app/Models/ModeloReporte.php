<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloReporte
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

    //// INSUMO PARA COMPRAR

    function DatosEmpresa()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM empresa";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    /////// DATOS DE COMPRA INSUMOS

    function DatoComopraInsumo($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            compra.id,
            proveedor.ruc,
            proveedor.razon_social,
            compra.fechac,
            compra.n_compra,
            compra.subtotal,
            compra.impuesto,
            compra.total,
            compra.estado
            FROM
            compra
            INNER JOIN proveedor ON compra.proveedor_id = proveedor.id 
            WHERE
            compra.id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function DatoComopraInsumoDetalle($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            detallecompra.compra_id,
            insumo.nombre,
            detallecompra.precio,
            detallecompra.cantidad,
            detallecompra.descuento,
            detallecompra.total 
            FROM
                detallecompra
                INNER JOIN insumo ON detallecompra.insumo_id = insumo.id 
            WHERE
            detallecompra.compra_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    /////// DATOS DE COMPRA INSUMOS

    function DatoComopraMaterial($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
                compra_material.id,
                proveedor.ruc,
                proveedor.razon_social,
                compra_material.fechac,
                compra_material.n_compra,
                compra_material.subtotal,
                compra_material.impuesto,
                compra_material.total,
                compra_material.estado
                FROM
                compra_material
                INNER JOIN proveedor ON compra_material.proveedor_id = proveedor.id 
                WHERE
                compra_material.id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function DatoComopraMaterialDetalle($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
                detallecompramaterial.compra_id,
                material.nombre,
                detallecompramaterial.precio,
                detallecompramaterial.cantidad,
                detallecompramaterial.descuento,
                detallecompramaterial.total 
                FROM
                    detallecompramaterial
                    INNER JOIN material ON detallecompramaterial.material_id = material.id 
                WHERE
                detallecompramaterial.compra_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    //////////PRODUCCION ACTIVAS

    function ProduccionActivas($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            produccion.id, 
            produccion.nombre, 
            produccion.fecharegistro, 
            produccion.fechaini, 
            produccion.fechafin, 
            produccion.dias, 
            produccion.productoid, 
            produccion.estado,  
            produccion.cantidad, 
            producto.nombre, 
            usuario.nombres
            FROM
            produccion
            INNER JOIN
            producto
            ON 
            produccion.productoid = producto.id
            INNER JOIN
            usuario
            ON 
            produccion.usuarioid = usuario.id
            WHERE
            produccion.id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch();
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function DetalleInsumoProduccion($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            detalleproduccioninsumo.produccion_id,
            insumo.nombre,
            detalleproduccioninsumo.cantidad 
            FROM
            detalleproduccioninsumo
            INNER JOIN insumo ON detalleproduccioninsumo.insumo_id = insumo.id
            where detalleproduccioninsumo.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    function DetalleMaterialProduccion($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            detalleproduccionmaterial.produccion_id,
            material.nombre,
            detalleproduccionmaterial.cantidad 
            FROM
            detalleproduccionmaterial
            INNER JOIN material ON detalleproduccionmaterial.material_id = material.id 
            WHERE
            detalleproduccionmaterial.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    function FaseProduccion($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            faseproduccion.produccion_id,
            fase.fase,
            faseproduccion.fecha 
            FROM
                faseproduccion
                INNER JOIN fase ON faseproduccion.fase_id = fase.id 
            WHERE
            faseproduccion.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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

    function PerdidaProduccion($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            perdida_produccion.produccion_id,
            usuario.nombres,
            perdida_produccion.fecha,
            perdida_produccion.cantidad 
            FROM
                perdida_produccion
                INNER JOIN usuario ON perdida_produccion.usuario_id = usuario.id 
            WHERE
            perdida_produccion.produccion_id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
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
