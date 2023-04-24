<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;

class Admin extends BaseController
{
    protected $usuario;
    public function __construct()
    {
        session_start();
        $this->usuario = new ModeloUsuario();
    }

    public function index()
    {
        return view('admin/index.php');
    }

    public function rolesuser($valor)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                $ListadoRoles = $this->usuario->ListadoRoles();
                $data = [
                    'ListadoRoles' => $ListadoRoles
                ];
                return view('admin/ListaRol.php', $data);
            } else if ($valor == "create") {
                $data = [
                    'titulo' => "Crear Rol <i class='fa fa-plus'></i>",
                    'texto' => "Registro Rol de usuario <i class='fa fa-user'></i>",
                    'accion' => "<button onclick='RegistraRol();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => ''],
                ];
                return view('admin/FormRol.php', $data);
            }
        }
    }

    public function EditarRol($valor)
    {
        if ($this->request->getMethod() == "get") {
            $editar = $this->usuario->EditarRol($valor);
            $data = [
                'titulo' => "Editar Rol <i class='fa fa-edit'></i>",
                'texto' => "Editar Rol de usuario <i class='fa fa-user'></i>",
                'accion' => "<button onclick='ModificarRol($valor);' class='btn btn-primary'>Guardar</button>",
                'color' => "primary",
                'editar' => $editar
            ];

            return view('admin/FormRol.php', $data);
        }
    }

    public function UsuariosAccion($valor)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                $ListadoRoles = $this->usuario->ListadoRoles();
                $data = [
                    'ListadoRoles' => $ListadoRoles
                ];
                return view('admin/usuario/lista.php', $data);
            } else if ($valor == "create") {
                $rol = $this->usuario->SelectRol();
                $data = [
                    'titulo' => "Crear usuario <i class='fa fa-plus'></i>",
                    'texto' => "Registro de usuario <i class='fa fa-user'></i>",
                    'accion' => "<button onclick='RegistraUsuario();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => ''],
                    'rol' => $rol,
                ];
                return view('admin/usuario/FormUsuario.php', $data);
            }
        }
    }
}
