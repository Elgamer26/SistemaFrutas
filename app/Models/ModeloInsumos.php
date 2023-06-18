<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloInsumos
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

    function ListarInsumoComprar()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            insumo.id, 
            insumo.codigo, 
            insumo.nombre, 
            insumo.tipo_id, 
            tipoinsumo.tipo, 
            insumo.precio, 
            insumo.descripcion, 
            insumo.imagen, 
            insumo.estado,
            insumo.cantidad
            FROM
            insumo
            INNER JOIN
            tipoinsumo
            ON 
            insumo.tipo_id = tipoinsumo.id WHERE insumo.estado = 1 ORDER BY insumo.id DESC";
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

    ////////////

    function ListadoTipoInsumo()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipoinsumo ORDER BY id DESC";
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

    function ListarInsumo()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            insumo.id, 
            insumo.codigo, 
            insumo.nombre, 
            insumo.tipo_id, 
            tipoinsumo.tipo, 
            insumo.precio, 
            insumo.descripcion, 
            insumo.imagen, 
            insumo.estado,
            insumo.cantidad
            FROM
            insumo
            INNER JOIN
            tipoinsumo
            ON 
            insumo.tipo_id = tipoinsumo.id
            ORDER BY insumo.id DESC";
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

    function RegistraTipoInsumo($rol)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistraTipoInsumo(?)";
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

    function EstadoIsnumo($estado, $id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE tipoinsumo SET estado = ? WHERE id = ?";
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

    function TraerTipoInsumoEdit($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipoinsumo WHERE id = ?";
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

    function EditarTipoInsumo($nombrerol, $id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarTipoInsumo(?,?)";
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

    function SelectTipoInsumo()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipoinsumo WHERE estado = 1 ORDER BY id DESC";
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

    function RegistrarInsumo($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $nombrearchivo)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistrarInsumo(?,?,?,?,?,?)";
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

    function EstadoInsumoI($estado, $id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE insumo SET estado = ? WHERE id = ?";
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

    function TraerInsumoEdit($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            insumo.id, 
            insumo.codigo, 
            insumo.nombre, 
            insumo.tipo_id, 
            tipoinsumo.tipo, 
            insumo.precio, 
            insumo.descripcion, 
            insumo.imagen, 
            insumo.estado
            FROM
            insumo
            INNER JOIN
            tipoinsumo
            ON 
            insumo.tipo_id = tipoinsumo.id WHERE insumo.id = ?";
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

    function EditarInsumo($insumoID, $codigo, $nombres, $tipo_producto, $precio_venta, $descripcion)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarInsumo(?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $insumoID);
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

    function EditarFotoInsumo($id, $foto)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE insumo SET imagen = ? where id = ?";
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

    ///// MATERIALES

    function ListarMaterialComprar()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            material.id, 
            material.codigo, 
            material.nombre, 
            material.tipo_id, 
            tipo_material.tipo, 
            material.precio, 
            material.descripcion, 
            material.imagen, 
            material.estado,
            material.cantidad
            FROM
            material
            INNER JOIN
            tipo_material
            ON 
            material.tipo_id = tipo_material.id WHERE material.estado = 1 ORDER BY material.id DESC";
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

    function ListadoTipoMaterial()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipo_material ORDER BY id DESC";
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

    function SelectTipoMaterial()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipo_material WHERE estado = 1 ORDER BY id DESC";
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

    function RegistraTipoMaterial($rol)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistraTipoMaterial(?)";
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

    function EstadoTipoMaterial($estado, $id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE tipo_material SET estado = ? WHERE id = ?";
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

    function TraerTipoMaterialEdit($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tipo_material WHERE id = ?";
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

    function EditarTipoMaterial($nombrerol, $id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarTipoMaterial(?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $nombrerol);
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

    function ListarMaterial()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            material.id, 
            material.codigo, 
            material.nombre, 
            material.tipo_id, 
            tipo_material.tipo, 
            material.precio, 
            material.descripcion, 
            material.imagen, 
            material.estado,
            material.cantidad
            FROM
            material
            INNER JOIN
            tipo_material
            ON 
            material.tipo_id = tipo_material.id ORDER BY material.id DESC";
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

    function TraerMaterialEdit($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            material.id, 
            material.codigo, 
            material.nombre, 
            material.tipo_id, 
            tipo_material.tipo, 
            material.precio, 
            material.descripcion, 
            material.imagen, 
            material.estado
            FROM
            material
            INNER JOIN
            tipo_material
            ON 
            material.tipo_id = tipo_material.id 
            WHERE material.id = ?";
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

    function RegistrarMaterial($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $nombrearchivo)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistrarMaterial(?,?,?,?,?,?)";
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

    function EstadoMaterial($estado, $id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE material SET estado = ? WHERE id = ?";
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

    function EditarMaterial($insumoID, $codigo, $nombres, $tipo_producto, $precio_venta, $descripcion)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarMaterial(?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $insumoID);
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

    function EditarFotoMaterial($id, $foto)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE material SET imagen = ? where id = ?";
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
