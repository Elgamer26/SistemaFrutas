<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloProveedor
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

    ///////// PROVEEDOR

    function ListarProveedor()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM
            proveedor ORDER BY id DESC";
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

    function RegistrarProveedor($ruc, $razon_social, $correo, $direccion, $telefono, $encargado, $descripcion)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistrarProveedor(?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $ruc);
            $query->bindParam(2, $razon_social);
            $query->bindParam(3, $correo);
            $query->bindParam(4, $direccion);
            $query->bindParam(5, $telefono);
            $query->bindParam(6, $encargado);
            $query->bindParam(7, $descripcion);
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

    function EstadoProveedor($estado, $id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE proveedor SET estado = ? WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $estado);
            $querya->bindParam(2, $id);
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

    function TraerProveedorEdit($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM proveedor WHERE id = ?";
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

    function EditarProveedor($id, $ruc, $razon_social, $correo, $direccion, $telefono, $encargado, $descripcion)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarProveedor(?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $ruc);
            $query->bindParam(2, $razon_social);
            $query->bindParam(3, $correo);
            $query->bindParam(4, $direccion);
            $query->bindParam(5, $telefono);
            $query->bindParam(6, $encargado);
            $query->bindParam(7, $descripcion);
            $query->bindParam(8, $id);
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

    /////// COMPRA INSUMO

    function ListarCompraInsumo()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            compra.id, 
            compra.proveedor_id, 
            proveedor.razon_social, 
            compra.fechac, 
            compra.n_compra, 
            compra.comprobante, 
            compra.iva, 
            compra.subtotal, 
            compra.impuesto, 
            compra.total, 
            compra.estado
            FROM
            compra
            INNER JOIN
            proveedor
            ON 
            compra.proveedor_id = proveedor.id order by compra.id DESC";
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

    function SelectProveedor()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM proveedor WHERE estado = 1 ORDER BY id DESC";
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

    function GuardarCompraInsumo($proveedor, $fecha_c, $numero_compra, $tipo_comprobante, $iva, $subtotal, $impuesto_sub, $total_pagar)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO compra (proveedor_id, fechac, n_compra, comprobante, iva, subtotal, impuesto, total) VALUES (?,?,?,?,?,?,?,?)";

            $query = $c->prepare($sql);
            $query->bindParam(1, $proveedor);
            $query->bindParam(2, $fecha_c);
            $query->bindParam(3, $numero_compra);
            $query->bindParam(4, $tipo_comprobante);
            $query->bindParam(5, $iva);
            $query->bindParam(6, $subtotal);
            $query->bindParam(7, $impuesto_sub);
            $query->bindParam(8, $total_pagar);

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

    function DetalleCompraInsumo($id, $arraglo_ida, $arraglo_precio, $arraglo_cantidad, $arraglo_descuento, $arraglo_total)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO DetalleCompra (compra_id, insumo_id, precio, cantidad, descuento, total) VALUES (?,?,?,?,?,?)";

            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $arraglo_ida);
            $query->bindParam(3, $arraglo_precio);
            $query->bindParam(4, $arraglo_cantidad);
            $query->bindParam(5, $arraglo_descuento);
            $query->bindParam(6, $arraglo_total);

            if ($query->execute()) {

                $sql_p = "SELECT cantidad FROM insumo where id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_ida);
                $query_p->execute();
                $data = $query_p->fetch();

                $stock = $data[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }

                $stock = $stock + $arraglo_cantidad;

                $sql_m = "UPDATE insumo SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_ida);

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

    function AnularFactura($id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE compra SET estado = 0 WHERE id = ?";
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

    ///// COMPRA MATERIAL

    function GuardarCompraMaterial($proveedor, $fecha_c, $numero_compra, $tipo_comprobante, $iva, $subtotal, $impuesto_sub, $total_pagar)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO compra_material (proveedor_id, fechac, n_compra, comprobante, iva, subtotal, impuesto, total) VALUES (?,?,?,?,?,?,?,?)";

            $query = $c->prepare($sql);
            $query->bindParam(1, $proveedor);
            $query->bindParam(2, $fecha_c);
            $query->bindParam(3, $numero_compra);
            $query->bindParam(4, $tipo_comprobante);
            $query->bindParam(5, $iva);
            $query->bindParam(6, $subtotal);
            $query->bindParam(7, $impuesto_sub);
            $query->bindParam(8, $total_pagar);

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

    function DetalleCompraMaterial($id, $arraglo_ida, $arraglo_precio, $arraglo_cantidad, $arraglo_descuento, $arraglo_total)
    {
        try {
            $result = 0;
            $c = $this->conexion->conexionPDO();
            $sql = "INSERT INTO DetalleCompraMaterial (compra_id, material_id, precio, cantidad, descuento, total) VALUES (?,?,?,?,?,?)";

            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $arraglo_ida);
            $query->bindParam(3, $arraglo_precio);
            $query->bindParam(4, $arraglo_cantidad);
            $query->bindParam(5, $arraglo_descuento);
            $query->bindParam(6, $arraglo_total);

            if ($query->execute()) {

                $sql_p = "SELECT cantidad FROM material where id = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_ida);
                $query_p->execute();
                $data = $query_p->fetch();

                $stock = $data[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }

                $stock = $stock + $arraglo_cantidad;

                $sql_m = "UPDATE material SET cantidad = ? where id = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_ida);

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

    function AnularFacturaMaterial($id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE compra_material SET estado = 0 WHERE id = ?";
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

    function ListarCompraMaterial()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            compra_material.id, 
            compra_material.proveedor_id, 
            proveedor.razon_social, 
            compra_material.fechac, 
            compra_material.n_compra, 
            compra_material.comprobante, 
            compra_material.iva, 
            compra_material.subtotal, 
            compra_material.impuesto, 
            compra_material.total, 
            compra_material.estado
            FROM
            compra_material
            INNER JOIN
            proveedor
            ON 
            compra_material.proveedor_id = proveedor.id order by compra_material.id DESC";
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
