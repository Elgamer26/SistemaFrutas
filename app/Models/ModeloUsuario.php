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














    ///////////////////////
    function verifcar_usuario($usuario, $passs)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            estado,
            passwordd,
            usuario,
            id 
            FROM
            usuario
            WHERE
            BINARY usuario = ? 
            AND BINARY passwordd = ? LIMIT 1";
            $query = $c->prepare($sql);
            $query->bindParam(1, $usuario);
            $query->bindParam(2, $passs);
            $query->execute();
            $result = $query->fetch();
            $this->conexion->cerrar_conexion();
            return $result;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function ValidarCorreo($correo)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            correo
            FROM
            usuario 
            WHERE
            BINARY correo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $correo);
            $query->execute();
            $result = $query->fetch();
            $this->conexion->cerrar_conexion();
            return $result;
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function RestablecerPassword($correo, $key)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();
            $sql_a = "UPDATE usuario SET passwordd = ? WHERE correo = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $key);
            $querya->bindParam(2, $correo);
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
    ///////////////////////



    function registra_usuario($nombres, $correo, $usuario, $passwordd, $foto)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql = "SELECT * FROM usuario where correo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $correo);
            $query->execute();
            $data = $query->fetch();
            if (empty($data)) {

                $sql_c = "SELECT * FROM usuario where usuario = ?";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $usuario);
                $query_c->execute();
                $data_c = $query_c->fetch();
                if (empty($data_c)) {

                    $sql_a = "INSERT INTO usuario (nombres, correo, usuario, passwordd, foto) VALUES (?,?,?,?,?)";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $nombres);
                    $querya->bindParam(2, $correo);
                    $querya->bindParam(3, $usuario);
                    $querya->bindParam(4, $passwordd);
                    $querya->bindParam(5, $foto);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3; // ya esxiste usuario
                }
            } else {
                $res = 2; // ya esxiste correo
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

    function ListarUsuario()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM usuario ORDER BY id DESC";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $arreglo;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }



    function EditarUsuario11($nombre, $correo, $usuario, $id)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql = "SELECT * FROM usuario where correo = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $correo);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch();
            if (empty($data)) {

                $sql_c = "SELECT * FROM usuario where usuario = ? AND id != ?";
                $query_c = $c->prepare($sql_c);
                $query_c->bindParam(1, $usuario);
                $query_c->bindParam(2, $id);
                $query_c->execute();
                $data_c = $query_c->fetch();
                if (empty($data_c)) {

                    $sql_a = "UPDATE usuario SET nombres = ?, correo = ?, usuario = ? WHERE id = ?";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $nombre);
                    $querya->bindParam(2, $correo);
                    $querya->bindParam(3, $usuario);
                    $querya->bindParam(4, $id);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3; // ya esxiste usuario
                }
            } else {
                $res = 2; // ya esxiste correo
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

    function EditarFotoUser($id, $foto)
    {
        try {
            $res = "";
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

    // modelo lenguaje

    function RegistraLenguaje($nombre, $nombrearchivo)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql = "SELECT * FROM lenguaje where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch();
            if (empty($data)) {

                $sql_a = "INSERT INTO lenguaje (nombre, foto) VALUES (?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $nombrearchivo);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste nombre
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

    function ListarLenguaje()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM lenguaje ORDER BY id DESC";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $arreglo;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function EstadoLenguaje($id, $dato)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "UPDATE lenguaje SET estado = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $dato);
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

    function EditarLenguaje($nombre, $id)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql = "SELECT * FROM lenguaje where nombre = ? and id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch();
            if (empty($data)) {

                $sql_a = "UPDATE lenguaje SET nombre = ? WHERE id = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $id);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste nombre
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

    function EditarFotoLneguaje($id, $foto)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "UPDATE lenguaje SET foto = ? where id = ?";
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

    // modelo tecnologia

    function CrearTecnologia($nombre, $nombrearchivo)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql = "SELECT * FROM tecnologia where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch();
            if (empty($data)) {

                $sql_a = "INSERT INTO tecnologia (nombre, foto) VALUES (?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $nombrearchivo);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste nombre
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

    function ListarTecnologia()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tecnologia ORDER BY id DESC";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $arreglo;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function EstadoTecnologia($id, $dato)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "UPDATE tecnologia SET estado = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $dato);
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

    function EditarTecnologia($nombre, $id)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql = "SELECT * FROM tecnologia where nombre = ? and id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch();
            if (empty($data)) {

                $sql_a = "UPDATE tecnologia SET nombre = ? WHERE id = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $id);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste nombre
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

    function EditarFotoTecnologia($id, $foto)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "UPDATE tecnologia SET foto = ? where id = ?";
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

    // modelo perfil


    function ListarPerfil()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM perfil WHERE id = 1";
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

    function EditarDatosPerfil($nombre, $apellido, $correo, $telefono, $pais, $direccion, $sobremi, $profesion)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "UPDATE perfil SET nombre = ?, apellidois = ?, correo = ?, telefono = ?, pais = ?, direccion = ?, profesion = ?, sobremi = ? WHERE id = 1";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $nombre);
            $querya->bindParam(2, $apellido);
            $querya->bindParam(3, $correo);
            $querya->bindParam(4, $telefono);
            $querya->bindParam(5, $pais);
            $querya->bindParam(6, $direccion);
            $querya->bindParam(7, $profesion);
            $querya->bindParam(8, $sobremi);

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

    function CargarHojaVida($nombrearchivo)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "UPDATE perfil SET hojavida = ? WHERE id = 1";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $nombrearchivo);

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

    function EditarFotoPerfil($nombrearchivo)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "UPDATE perfil SET foto = ? WHERE id = 1";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $nombrearchivo);

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

    // Select Lnegujae

    function TraerLenguaje()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM lenguaje WHERE estado = 1 ORDER BY id DESC";
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

    // Select Tecnologia

    function TraerTecnologia()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM tecnologia WHERE estado = 1 ORDER BY id DESC";
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

    // modelo Tipo

    function CrearTipos($nombre)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql = "SELECT * FROM Tipo_proyecto where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch();
            if (empty($data)) {

                $sql_a = "INSERT INTO Tipo_proyecto (nombre) VALUES (?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste nombre
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

    function ListarTipos()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM Tipo_proyecto ORDER BY id DESC";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            //cerramos la conexion
            $this->conexion->cerrar_conexion();
            return $arreglo;
        } catch (\Exception $e) {
            $this->conexion->cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function Estadotipo($id, $dato)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "UPDATE Tipo_proyecto SET estado = ? where id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $dato);
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

    function EditaTiposs($nombre, $id)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql = "SELECT * FROM Tipo_proyecto where nombre = ? AND id != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);

            $query->execute();
            $data = $query->fetch();
            if (empty($data)) {

                $sql_a = "UPDATE Tipo_proyecto SET nombre = ? WHERE id = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $id);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2; // ya esxiste nombre
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

    // Select Tecnologia

    function TraerTipoProyecto()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT * FROM Tipo_proyecto WHERE estado = 1 ORDER BY id DESC";
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

    // registra proyectos

    function RegistrarProyecto($nombre, $precio, $descuento, $tipo_des, $idlenguaje, $idtecnologia, $id_tipo_proyecto, $fecha_creacion, $detalle_proyecto)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql = "SELECT * FROM proyectos where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch();
            if (empty($data)) {

                $sql_a = "INSERT INTO proyectos 
                (nombre, precio, descuento, tipo_des, idlenguaje, idtecnologia, id_tipo_proyecto, fecha_proyecto, detalle) 
                VALUES (?,?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $precio);
                $querya->bindParam(3, $descuento);
                $querya->bindParam(4, $tipo_des);
                $querya->bindParam(5, $idlenguaje);
                $querya->bindParam(6, $idtecnologia);
                $querya->bindParam(7, $id_tipo_proyecto);
                $querya->bindParam(8, $fecha_creacion);
                $querya->bindParam(9, $detalle_proyecto);

                if ($querya->execute()) {
                    $res =  $c->lastInsertId();
                } else {
                    $res = "cero";
                }
            } else {
                $res = "dos"; // ya esxiste nombre
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

    function RegistrarProyectoImagen($valor, $nombre_final)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "INSERT INTO proyectos_imagen (id_proyecto, foto) VALUES (?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $valor);
            $querya->bindParam(2, $nombre_final);

            if ($querya->execute()) {
                $res =  1;
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

    function ListaProyectos()
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            proyectos.id,
            proyectos.nombre as proyecto,
            proyectos.precio,
            proyectos.descuento,
            proyectos.tipo_des,
            proyectos.idlenguaje,
            lenguaje.nombre as lenguaje,
            proyectos.idtecnologia,
            tecnologia.nombre as tecnologia,
            proyectos.id_tipo_proyecto,
            tipo_proyecto.nombre as tipo_proyecto,
            proyectos.fecha_proyecto,
            proyectos.detalle,
            proyectos.fecha_registro,
            proyectos.estado 
            FROM
            proyectos
            INNER JOIN tecnologia ON proyectos.idtecnologia = tecnologia.id
            INNER JOIN tipo_proyecto ON proyectos.id_tipo_proyecto = tipo_proyecto.id
            INNER JOIN lenguaje ON proyectos.idlenguaje = lenguaje.id ORDER BY proyectos.id DESC";
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

    function ListaProyectos_id($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            proyectos.id,
            proyectos.nombre as proyecto,
            proyectos.precio,
            proyectos.descuento,
            proyectos.tipo_des,
            proyectos.idlenguaje,
            lenguaje.nombre as lenguaje,
            proyectos.idtecnologia,
            tecnologia.nombre as tecnologia,
            proyectos.id_tipo_proyecto,
            tipo_proyecto.nombre as tipo_proyecto,
            proyectos.fecha_proyecto,
            proyectos.detalle,
            proyectos.fecha_registro,
            proyectos.estado 
            FROM
            proyectos
            INNER JOIN tecnologia ON proyectos.idtecnologia = tecnologia.id
            INNER JOIN tipo_proyecto ON proyectos.id_tipo_proyecto = tipo_proyecto.id
            INNER JOIN lenguaje ON proyectos.idlenguaje = lenguaje.id WHERE proyectos.id = ?";
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

    function ListaProyectos_imagenes($id)
    {
        try {
            $c = $this->conexion->conexionPDO();
            $sql = "SELECT
            proyectos_imagen.id,
            proyectos_imagen.id_proyecto,
            proyectos_imagen.foto 
            FROM
            proyectos_imagen 
            WHERE
            proyectos_imagen.id_proyecto = ?";
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

    function QuitarImagenProyecto($id, $id_proyecto)
    {
        try {
            $res = "";
            $c = $this->conexion->conexionPDO();

            $sql_a = "DELETE FROM proyectos_imagen WHERE id = ? AND id_proyecto = ? ";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $id_proyecto);

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
