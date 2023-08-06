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
            ventaweb.referencia,
            ventaweb.tipopago
            FROM
                ventaweb
                INNER JOIN cliente ON ventaweb.cliente_id = cliente.id 
            WHERE ventaweb.comprobante = 'PayPal' or ventaweb.comprobante = 'efectivo' 
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

    function ListarVentas()
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
            WHERE ventaweb.comprobante != 'PayPal'
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
            IFNULL(producto.imagen, (select foto from imagenproducto where imagenproducto.id_producto = producto.id LIMIT 1)) as imagen,
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
            IFNULL(producto.imagen, (select foto from imagenproducto where imagenproducto.id_producto = producto.id LIMIT 1)) as imagen,
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

    //////// registro de venta
    function RegistrarVenta($cliente, $fecha_c, $numero_compra, $tipo_comprobante, $iva, $subtotal, $impuesto_sub, $total_pagar)
    {
        try {
            $result = 0;

            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO ventaweb (cliente_id, subtotal, impuesto, total, fecha, n_venta, comprobante, iva) VALUE (?,?,?,?,?,?,?,?)";

            $query = $c->prepare($sql);
            $query->bindParam(1, $cliente);
            $query->bindParam(2, $subtotal);
            $query->bindParam(3, $impuesto_sub);
            $query->bindParam(4, $total_pagar);
            $query->bindParam(5, date("Y-m-d"));
            $query->bindParam(6, $numero_compra);
            $query->bindParam(7, $tipo_comprobante);
            $query->bindParam(8, $iva);

            if ($query->execute()) {
                $result = $c->lastInsertId();
            } else {
                $result = 0;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function RegistrarVentaDetalle($id, $arraglo_idp, $arraglo_cantidad, $arraglo_sale, $arraglo_precio, $arraglo_desc_dolar, $arraglo_oferta, $arraglo_desc_oferta, $arraglo_subtotals)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO ventawebdetalle (ventaid, productoid, cantidad, sale, precio, oferta, descuento, total, descuento_moneda) VALUE (?,?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $arraglo_idp);
            $query->bindParam(3, $arraglo_cantidad);
            $query->bindParam(4, $arraglo_sale);
            $query->bindParam(5, $arraglo_precio);
            $query->bindParam(6, $arraglo_oferta);
            $query->bindParam(7, $arraglo_desc_oferta);
            $query->bindParam(8, $arraglo_subtotals);
            $query->bindParam(9, $arraglo_desc_dolar);

            if ($query->execute()) {

                $sql_p = "SELECT cantidad FROM producto where id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idp);
                $query_p->execute();
                $data = $query_p->fetch();

                $stock = $data[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }

                $stock = $stock - $arraglo_sale;

                $sql_m = "UPDATE producto SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idp);

                if ($query_m->execute()) {
                    $result = 1;
                } else {
                    $result = 0;
                }
            } else {
                $result = 0;
            }

            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function AnularFacturaVentaWeb($id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE ventaweb SET estado = 0 WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $res;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }
}
