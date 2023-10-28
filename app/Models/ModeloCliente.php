<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloCliente
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

    ////////////// Login

    function CredencialesCliente($usuario, $passs)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            cliente.id,
            cliente.estado,
            cliente.nombre
            FROM
            cliente where BINARY cliente.correo = ? and BINARY cliente.password = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $usuario);
            $query->bindParam(2, $passs);
            $query->execute();
            $result = $query->fetch();
            return $result;
            //cerramos la conexion
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    //////////// REGISTRA CLIENTE

    function ListaCliente($valor)
    {
        try {
            $c = $this->conexion->conexionPDO();
            // $sql = "SELECT * FROM cliente WHERE createt = ? ORDER BY id DESC";
            $sql = "SELECT * FROM cliente WHERE createt = createt ORDER BY nombre ASC";
            $query = $c->prepare($sql);
            // $query->bindParam(1, $valor);
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

    function RegistraCliente($nombre, $apellidos, $correo, $cedula, $sexo, $direccion, $telefono)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistraCliente(?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $apellidos);
            $query->bindParam(3, $correo);
            $query->bindParam(4, $cedula);
            $query->bindParam(5, $sexo);
            $query->bindParam(6, $direccion);
            $query->bindParam(7, $telefono);
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

    function RegistraClienteTienda($nombre, $apellidos, $correo, $cedula, $sexo, $direccion, $telefono)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistraClienteTienda(?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $apellidos);
            $query->bindParam(3, $correo);
            $query->bindParam(4, $cedula);
            $query->bindParam(5, $sexo);
            $query->bindParam(6, $direccion);
            $query->bindParam(7, $telefono);
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

    function EditarCliente($id, $nombre, $apellidos, $correo, $cedula, $sexo, $direccion, $telefono)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarCliente(?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $apellidos);
            $query->bindParam(3, $correo);
            $query->bindParam(4, $cedula);
            $query->bindParam(5, $sexo);
            $query->bindParam(6, $direccion);
            $query->bindParam(7, $telefono);
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

    function TraerCliente($valor)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM cliente WHERE id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $valor);
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

    function EstadoCliente($estado, $id)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE cliente SET estado = ? WHERE id = ?";
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

    function UpdatePasswordClient($id, $pass)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE cliente SET password = ? WHERE id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $pass);
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

    /// RECUPERAR PASSWORD DEL CLIENTE EN TIENDA

    function RecuperarPasswordCliente($correo)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            cliente.id
            FROM
            cliente where cliente.correo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $correo);
            $query->execute();
            $result = $query->fetch();
            return $result;
            //cerramos la conexion
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        exit();
    }
}
