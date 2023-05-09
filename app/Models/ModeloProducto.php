<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloProducto
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

    function ListadoProductos()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id, 
            producto.codigo, 
            producto.nombre, 
            producto.tipo_id, 
            tipo_producto.tipo, 
            producto.precio, 
            producto.descripcion, 
            producto.imagen, 
            producto.estado
            FROM
            producto
            INNER JOIN
            tipo_producto
            ON 
            producto.tipo_id = tipo_producto.id ORDER BY producto.id DESC";
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

    function ListadoTipoProducto()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipo_producto ORDER BY id DESC";
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

    function RegistraTipoProducto($rol)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistraTipoProducto(?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $rol);
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

    function EstadoTipo($estado, $id)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE tipo_producto SET estado = ? WHERE id = ?";
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

    function TraerTipoProductoEdit($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipo_producto WHERE id = ?";
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

    function EditarTipoProducto($nombrerol, $id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarTipoProducto(?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombrerol);
            $query->bindParam(2, $id);
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

    function SelecTipoProducto()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipo_producto WHERE estado = 1 ORDER BY id DESC";
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

    function RegistraProducto($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $nombrearchivo)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistraProducto(?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigo);
            $query->bindParam(2, $nombres);
            $query->bindParam(3, $tipo_producto);
            $query->bindParam(4, $precio_venta);
            $query->bindParam(5, $descripcion);
            $query->bindParam(6, $nombrearchivo);
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

    function EstadoProducto($estado, $id)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE producto SET estado = ? WHERE id = ?";
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

    function TraerProducto($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            producto.id, 
            producto.codigo, 
            producto.nombre, 
            producto.tipo_id, 
            tipo_producto.tipo, 
            producto.precio, 
            producto.descripcion, 
            producto.imagen, 
            producto.estado
            FROM
            producto
            INNER JOIN
            tipo_producto
            ON 
            producto.tipo_id = tipo_producto.id WHERE producto.id = ?";
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

    function EditarProducto($productoID, $codigo, $nombres, $tipo_producto, $precio_venta, $descripcion)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarProducto(?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $productoID);
            $query->bindParam(2, $codigo);
            $query->bindParam(3, $nombres);
            $query->bindParam(4, $tipo_producto);
            $query->bindParam(5, $precio_venta);
            $query->bindParam(6, $descripcion);
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

    function EditarFotoProducto($id, $foto)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE producto SET imagen = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $foto);
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
}
