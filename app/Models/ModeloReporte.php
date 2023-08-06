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

    //////////// REPORTE DE VENTA WEB

    function DatosVentaWeb($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            ventaweb.id,
            CONCAT_WS( ' ', cliente.nombre) AS cliente,
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
            ventaweb.referencia,
            cliente.apellidos,
            cliente.correo,
            ventaweb.tipopago
            FROM
                ventaweb
                INNER JOIN cliente ON ventaweb.cliente_id = cliente.id 
            WHERE ventaweb.id = ?";
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

    function DatoDetalleVentaWeb($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.nombre,
            ventawebdetalle.cantidad,
            ventawebdetalle.sale,
            ventawebdetalle.precio,
            ventawebdetalle.oferta,
            ventawebdetalle.descuento,
            ventawebdetalle.total 
            FROM
                ventawebdetalle
                INNER JOIN producto ON ventawebdetalle.productoid = producto.id 
            WHERE
            ventawebdetalle.ventaid = ?";
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


    ///// MODULO REPORTE DE VENTA
    function DatosReporteVenta($fi, $ff)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.nombre,
            DATE(ventaweb.fecharegistro) AS fecharegistro,
            COUNT( ventawebdetalle.cantidad ) AS cantidad,
            SUM(ventawebdetalle.total) as total,
            ventaweb.comprobante 
        FROM
            ventawebdetalle
            INNER JOIN ventaweb ON ventawebdetalle.ventaid = ventaweb.id
            INNER JOIN producto ON ventawebdetalle.productoid = producto.id 
        WHERE
            ventaweb.comprobante != 'PayPal' and DATE(ventaweb.fecharegistro) BETWEEN ? and ?
        GROUP BY
            ventawebdetalle.productoid ";
            $query = $c->prepare($sql);
            $query->bindParam(1, $fi);
            $query->bindParam(2, $ff);
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

    function DatosReporteCompra($fi, $ff)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            insumo.nombre,
            compra.fechac,
            COUNT( detallecompra.insumo_id ) AS cantidad,
            SUM( detallecompra.total ) AS total 
            FROM
                insumo
                INNER JOIN detallecompra ON insumo.id = detallecompra.insumo_id
                INNER JOIN compra ON detallecompra.compra_id = compra.id 
            WHERE
                compra.fechac BETWEEN ? AND ? 
            GROUP BY
            detallecompra.insumo_id";
            $query = $c->prepare($sql);
            $query->bindParam(1, $fi);
            $query->bindParam(2, $ff);
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

    function DatosReporteCompraMaterial($fi, $ff)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            material.nombre,
            compra_material.fechac,
            COUNT(detallecompramaterial.material_id) as cantidad,
            SUM(detallecompramaterial.total ) as total
            FROM
            compra_material
            INNER JOIN detallecompramaterial ON compra_material.id = detallecompramaterial.compra_id
            INNER JOIN material ON material.id = detallecompramaterial.material_id 
            WHERE
            compra_material.fechac BETWEEN ? AND ? 
            GROUP BY
            detallecompramaterial.material_id ";
            $query = $c->prepare($sql);
            $query->bindParam(1, $fi);
            $query->bindParam(2, $ff);
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

    function DatosReporteInsumos($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            nombre,
            codigo,
            precio,
            (cantidad) as cantidad,
            tipo_id 
            FROM
                insumo 
            WHERE
            tipo_id = ?";
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

    function DatosReporteMaterial($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            material.nombre,
            material.codigo,
            material.precio,
            material.cantidad,
            material.tipo_id 
            FROM
                material 
            WHERE
            material.tipo_id =?";
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

    function DatosReportePlantas($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.nombre,
            producto.codigo,
            producto.tipo_id,
            producto.cantidad,
            producto.precio 
            FROM
                producto 
            WHERE
            producto.tipo_id = ?";
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

    function DatosReporteClientes($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            cliente.nombre,
            cliente.apellidos,
            cliente.cedula,
            cliente.sexo,
            cliente.createt,
            cliente.telefono
            FROM
                cliente 
            WHERE
            cliente.createt = ?";
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

    function DatosReporteClientesALL()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            cliente.nombre,
            cliente.apellidos,
            cliente.cedula,
            cliente.sexo,
            cliente.createt,
            cliente.telefono
            FROM
            cliente";
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

    function DatosReporteOferta($fi, $ff)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.nombre,
            oferta.fecha_inicio,
            oferta.fecha_fin,
            oferta.tipo_oferta,
            oferta.valor_descuento,
            oferta.fecha_registro 
            FROM
            producto
            INNER JOIN oferta ON producto.id = oferta.producto_id 
            WHERE DATE(oferta.fecha_registro) BETWEEN ? AND ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $fi);
            $query->bindParam(2, $ff);
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

    function DatosProduccion($fi, $ff)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            tipo_producto.tipo,
            produccion.fecharegistro,
            produccion.fechaini,
            produccion.fechafin,
            produccion.dias,
            produccion.estado,
            produccion.cantidad,
            produccion.id 
            FROM
                produccion
                INNER JOIN producto ON produccion.productoid = producto.id
                INNER JOIN tipo_producto ON producto.tipo_id = tipo_producto.id 
            WHERE
            DATE ( produccion.fecharegistro ) BETWEEN ? AND ?  ORDER BY produccion.id DESC";
            $query = $c->prepare($sql);
            $query->bindParam(1, $fi);
            $query->bindParam(2, $ff);
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
