<?php

namespace App\Models;

use App\Models\ModeloConetion;
use ModeloConection;

class ModeloUsuario
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

    //////////////
    function Credenciales($usuario, $passs)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            usuario.id,
            usuario.estado
            FROM
            usuario where BINARY usuario.usuario = ? 
            and BINARY usuario.passwordd = ?";
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

    //////LLAMAR DATOS DEL DASHBOARD 

    function LlamarDatosDashboard()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "call llamer_etiquetas()";
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

    //////////// ROLES

    function ListadoRoles()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM rol ORDER BY id DESC";
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

    function RegistraRol($rol)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistrarRol(?)";
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

    function EditarRol($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM rol where id = ?";
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

    function ModificarRol($rol, $id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call ModificarRol(?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $rol);
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

    function EstadoRol($estado, $id)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE rol SET estado = ? WHERE id = ?";
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

    function SelectRol()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM rol where estado = 1 ORDER BY id DESC";
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

    //////////// USUARIO

    function ListaUsuario()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            usuario.id,
            usuario.nombres,
            usuario.apellidos,
            usuario.correo,
            usuario.cedula,
            usuario.rol_id,
            rol.rol,
            usuario.usuario,
            usuario.passwordd,
            usuario.foto,
            DATE(usuario.fecha) AS fecha,
            usuario.estado 
            FROM
                usuario
                INNER JOIN rol ON usuario.rol_id = rol.id 
            ORDER BY
            usuario.id DESC";
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

    function RegistrarUsuario($nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario, $password, $imagen)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call RegistrarUsuario(?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombres);
            $query->bindParam(2, $apellidos);
            $query->bindParam(3, $correo);
            $query->bindParam(4, $cedula);
            $query->bindParam(5, $tipo_rol);
            $query->bindParam(6, $usuario);
            $query->bindParam(7, $password);
            $query->bindParam(8, $imagen);
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

    function EstadoUsuario($estado, $id)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE usuario SET estado = ? WHERE id = ?";
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

    function TraerUsuarioEditar($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            usuario.id,
            usuario.nombres,
            usuario.apellidos,
            usuario.correo,
            usuario.cedula,
            usuario.rol_id,
            rol.rol,
            usuario.usuario,
            usuario.passwordd,
            usuario.foto,
            DATE(usuario.fecha) AS fecha,
            usuario.estado 
            FROM
                usuario
                INNER JOIN rol ON usuario.rol_id = rol.id 
            WHERE usuario.id = ?";
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

    function EditarUsuario($id, $nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call EditarUsuario(?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $nombres);
            $query->bindParam(3, $apellidos);
            $query->bindParam(4, $correo);
            $query->bindParam(5, $cedula);
            $query->bindParam(6, $tipo_rol);
            $query->bindParam(7, $usuario);
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

    function EditarFotoUsuario($id, $foto)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE usuario SET foto = ? where id = ?";
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

    /////////////////// DATOS DEL USUARIO

    function TraerDatosUsuario($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            usuario.id,
            usuario.nombres,
            usuario.apellidos,
            usuario.correo,
            usuario.cedula,
            rol.rol,
            usuario.usuario,
            usuario.passwordd,
            usuario.foto
            FROM
                usuario
                INNER JOIN rol ON usuario.rol_id = rol.id 
            WHERE usuario.id = ?";
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

    function GuardarDatoPerfilUser($nombres, $apellidos, $correo, $usuario, $id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "Call GuardarDatoPerfilUser(?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombres);
            $query->bindParam(2, $apellidos);
            $query->bindParam(3, $correo);
            $query->bindParam(4, $usuario);
            $query->bindParam(5, $id);
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

    function CambiarPasswordUser($id, $nuevo_password)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE usuario SET passwordd = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $nuevo_password);
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

    function ListEmpresa()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM empresa WHERE id = 1";
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

    function RegistrarEmpresa($id, $nombre, $direccion, $correo_e, $ruc, $telefono, $actividad, $codigowhatsapp)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();
            $sql = "UPDATE empresa SET nombre = ?, direccion = ?, correo = ?, ruc = ?, telefono = ?, actividad = ?, codigowhatsapp = ? WHERE id = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $direccion);
            $query->bindParam(3, $correo_e);
            $query->bindParam(4, $ruc);
            $query->bindParam(5, $telefono);
            $query->bindParam(6, $actividad);
            $query->bindParam(7, $codigowhatsapp);
            $query->bindParam(8, $id);
            if ($query->execute()) {
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

    function UpdateImageEmpresa($id, $foto)
    {
        try {
            $res = 0;
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE empresa SET foto = ? where id = ?";
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

    /// RECUPERAR PASSWORD DEL ADMIN

    function RecuperarPasswordCliente($correo)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT id FROM usuario where correo = ?";
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

    function UpdatePasswordAdmin($id, $pass)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE usuario SET passwordd = ? WHERE id = ?";
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

}
