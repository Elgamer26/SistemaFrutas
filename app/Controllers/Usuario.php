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
}
