<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;

class Usuario extends BaseController
{
    protected $usuario;
    public function __construct()
    {
        session_start();
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
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

    public function ModificarRol()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->usuario->ModificarRol($nombrerol, $id);
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

    public function EstadoRol()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->usuario->EstadoRol($estado, $id);
            return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
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
            return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
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
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
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
}
