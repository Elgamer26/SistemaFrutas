<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;
use App\MailPhp\envio_correo;

class Usuario extends BaseController
{
    protected $usuario;
    protected $send_email;

    public function __construct()
    {
        session_start();
        $this->send_email = new envio_correo();
        $this->usuario = new ModeloUsuario();
    }

    /////////////////

    public function Credenciales()
    {
        if ($this->request->getMethod() == "post") {

            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');

            $repuesta_create = $this->usuario->Credenciales($usuario, $password);
            if ($repuesta_create) {
                return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
            } else {
                return json_encode(0, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function CraerToken()
    {
        if ($this->request->getMethod() == "post") {

            $_SESSION["id_user"] = $this->request->getPost('id_usu');
            echo 1;
            exit();
        }
    }

    public function CerraSesion()
    {
        session_destroy();
        return redirect()->to(base_url() . 'login');
    }

    ////////////////

    public function CreateRol()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $repuesta_create = $this->usuario->RegistraRol($nombrerol);
            return $repuesta_create[0];
        }
    }

    public function ModificarRol()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->usuario->ModificarRol($nombrerol, $id);
            return $repuesta_create[0];
        }
    }

    public function EstadoRol()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->usuario->EstadoRol($estado, $id);
            return $repuesta_create;
        }
    }

    /////////////////

    public function RegistrarUsuario()
    {
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $correo = $this->request->getPost('correo');
        $cedula = $this->request->getPost('cedula');
        $tipo_rol = $this->request->getPost('tipo_rol');
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        if (!empty($imageFile)) {
            $valor = $this->usuario->RegistrarUsuario($nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario, $password, $nombrearchivo);
            if ($valor[0] == "1") {
                $imageFile->move(ROOTPATH . 'public/img/usuario/', $nombrearchivo);
                echo $valor[0];
                exit();
            } else {
                echo $valor[0];
                exit();
            }
        } else {
            $imagen = "admin.jpg";
            $valor = $this->usuario->RegistrarUsuario($nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario, $password, $imagen);
            echo $valor[0];
            exit();
        }
    }

    public function EstadoUsuario()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->usuario->EstadoUsuario($estado, $id);
            return $repuesta_create;
        }
    }

    public function EditarUsuario()
    {
        if ($this->request->getMethod() == "post") {

            $id = $this->request->getPost('id');
            $nombres = $this->request->getPost('nombres');
            $apellidos = $this->request->getPost('apellidos');
            $correo = $this->request->getPost('correo');
            $cedula = $this->request->getPost('cedula');
            $tipo_rol = $this->request->getPost('tipo_rol');
            $usuario = $this->request->getPost('usuario');

            $repuesta_create = $this->usuario->EditarUsuario($id, $nombres, $apellidos, $correo, $cedula, $tipo_rol, $usuario);
            return $repuesta_create[0];
        }
    }

    public function EditarFotoUsuario()
    {
        $id = $this->request->getPost('id');
        $ruta_actual = $this->request->getPost('ruta_actual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');
        $valorFile = $this->usuario->EditarFotoUsuario($id, $nombrearchivo);
        if ($valorFile == 1) {
            $imageFile->move(ROOTPATH . 'public/img/usuario/', $nombrearchivo);
            if ($ruta_actual != "admin.jpg") {
                unlink(ROOTPATH . 'public/img/usuario/' . $ruta_actual);
            }
            echo $valorFile;
        } else {
            echo $valorFile;
        }
        exit();
    }

    ////////////// TRAER DATOS DEL USUARIO
    public function TraerDatosUsuario()
    {
        $id =  $_SESSION["id_user"];
        $valorData = $this->usuario->TraerDatosUsuario($id);
        echo json_encode($valorData, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function GuardarDatoPerfilUser()
    {
        $id =  $_SESSION["id_user"];
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $correo = $this->request->getPost('correo');
        $usuario = $this->request->getPost('usuario');

        $valor = $this->usuario->GuardarDatoPerfilUser($nombres, $apellidos, $correo, $usuario, $id);
        echo $valor[0];
        exit();
    }

    public function UpdatePhotoUser()
    {
        $id =  $_SESSION["id_user"];
        $ruta_actual = $this->request->getPost('fotoActual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        $valorFile = $this->usuario->EditarFotoUsuario($id, $nombrearchivo);
        if ($valorFile == 1) {
            $imageFile->move(ROOTPATH . 'public/img/usuario/', $nombrearchivo);
            if ($ruta_actual != "admin.jpg") {
                unlink(ROOTPATH . 'public/img/usuario/' . $ruta_actual);
            }
            echo $valorFile;
        } else {
            echo $valorFile;
        }
        exit();
    }

    public function CambiarPasswordUser()
    {
        $id =  $_SESSION["id_user"];
        $nuevo_password = $this->request->getPost('nuevo_password');
        $valorPass = $this->usuario->CambiarPasswordUser($id, $nuevo_password);
        echo $valorPass;
        exit();
    }

    /// editra datos de la empresa

    public function RegistrarEmpresa()
    {
        if ($this->request->getMethod() == "post") {

            $id = 1;
            $nombre = $this->request->getPost('nombre');
            $direccion = $this->request->getPost('direccion');
            $correo_e = $this->request->getPost('correo_e');
            $ruc = $this->request->getPost('ruc');
            $telefono = $this->request->getPost('telefono');
            $actividad = $this->request->getPost('actividad');
            $codigowhatsapp = $this->request->getPost('codigowhatsapp');

            $repuesta = $this->usuario->RegistrarEmpresa($id, $nombre, $direccion, $correo_e, $ruc, $telefono, $actividad, $codigowhatsapp);
            echo $repuesta;
            exit();
        }
    }

    public function UpdateImageEmpresa()
    {
        $id =  1;
        $ruta_actual = $this->request->getPost('fotoActual');
        $nombrearchivo = $this->request->getPost('nombrearchivo');
        $imageFile = $this->request->getFile('foto');

        $valorFile = $this->usuario->UpdateImageEmpresa($id, $nombrearchivo);
        if ($valorFile == 1) {
            $imageFile->move(ROOTPATH . 'public/img/empresa/', $nombrearchivo);
            unlink(ROOTPATH . 'public/img/empresa/' . $ruta_actual);
            echo $valorFile;
        } else {
            echo $valorFile;
        }
        exit();
    }

    //// RECUPERAR PASSWORD DEL ADMIN

    public function RecuperarPasswordCliente()
    {
        if ($this->request->getMethod() == "post") {

            $correo = $this->request->getPost('correo');

            $repuesta_create = $this->usuario->RecuperarPasswordCliente($correo);
            if ($repuesta_create) {

                ///////
                $length = 10;
                $key = "";
                $pattern = "*.1234567890abcdefghijklmnopqrstuvwxyz";
                $max = strlen($pattern) - 1;
                for ($i = 0; $i < $length; $i++) {
                    $key .= substr($pattern, mt_rand(0, $max), 1);
                }
                $location = base_url();
                $html = "";
                $html = '<!DOCTYPE html>
                        <html lang="es">
                        <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body>
                        <table style="border: 1px solid black; width: 100%; height: 258px;">
                        <thead>
                        <tr style="height: 73px;">
                        <td style="text-align: center; background: orange; color: white; height: 73px;" colspan="2">
                        <h1><strong>.:Password de Usuario tienda:.</strong></h1>
                        </td>
                        </tr>
                        <tr style="height: 188px;">
                        <td style="height: 134px; text-align: center;" width="20%">Su password fue cambiado con exito, use este password: <b>"' . $key . '"</b> para ingresar al sistema :)</td>
                        </tr>
                        <tr style="height: 188px;">
                        <td style="height: 51px; text-align: center;" width="20%"><a href=' . $location . '>Link de nuestro sistema.</a></td>
                        </tr>
                        </thead>
                        </table>
                        </body>
                        </html>';
                $sms = "Password de Usuario tienda";
                $respuesta = $this->send_email->enviar_correo($correo, $html, $sms);
                if ($respuesta == 1) {
                    $resp = $this->usuario->UpdatePasswordAdmin($repuesta_create[0], $key);
                    echo $resp;
                    die();
                } else {
                    echo $respuesta;
                    die();
                }
            } else {
                echo 0;
                exit();
            }
            exit();
        }
    }
}
