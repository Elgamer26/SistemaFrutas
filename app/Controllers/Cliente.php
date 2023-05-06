<?php

namespace App\Controllers;

use App\Models\ModeloCliente;

class Cliente extends BaseController
{
    protected $cliente;
    public function __construct()
    {
        session_start();
        $this->cliente = new ModeloCliente();
    }

    ///////////////// Credenciales del usuario

    public function CredencialesCliente()
    {
        if ($this->request->getMethod() == "post") {

            $cliente = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');

            $repuesta_create = $this->cliente->CredencialesCliente($cliente, $password);
            if ($repuesta_create) {
                return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
            } else {
                return json_encode(0, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function CraerTokenCliente()
    {
        if ($this->request->getMethod() == "post") {
            $_SESSION["TokenClie"] = $this->request->getPost('id_usu');
            $_SESSION["NombUser"] = $this->request->getPost('user');
            echo 1;
            exit();
        }
    }

    public function CerraSesionCliente()
    {
        session_destroy();
        return redirect()->to(base_url());
    }

    //////////////// REgistro de cliente

    public function RegistraCliente()
    {
        if ($this->request->getMethod() == "post") {

            $nombre = $this->request->getPost('nombre');
            $apellidos = $this->request->getPost('apellidos');
            $correo = $this->request->getPost('correo');
            $cedula = $this->request->getPost('cedula');
            $sexo = $this->request->getPost('sexo');
            $direccion = $this->request->getPost('direccion');
            $telefono = $this->request->getPost('telefono'); 
            $repuesta_create = $this->cliente->RegistraCliente($nombre, $apellidos, $correo, $cedula, $sexo, $direccion, $telefono);
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

    public function EditarCliente()
    {
        if ($this->request->getMethod() == "post") {
            $id = $this->request->getPost('id');
            $nombre = $this->request->getPost('nombre');
            $apellidos = $this->request->getPost('apellidos');
            $correo = $this->request->getPost('correo');
            $cedula = $this->request->getPost('cedula');
            $sexo = $this->request->getPost('sexo');
            $direccion = $this->request->getPost('direccion');
            $telefono = $this->request->getPost('telefono'); 
            $repuesta_create = $this->cliente->EditarCliente($id, $nombre, $apellidos, $correo, $cedula, $sexo, $direccion, $telefono);
            return json_encode($repuesta_create[0], JSON_UNESCAPED_UNICODE);
        }
    }

    public function EstadoCliente()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->cliente->EstadoCliente($estado, $id);
            return json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
        }
    }

}
