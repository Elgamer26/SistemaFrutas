<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;
use App\Models\ModeloCliente;

class Admin extends BaseController
{
    protected $usuario;
    protected $cliente;
    public function __construct()
    {
        session_start();
        $this->usuario = new ModeloUsuario();
        $this->cliente = new ModeloCliente();
    }

    public function index()
    {
        if (!isset($_SESSION["id_user"])) {
            return redirect()->to(base_url() . 'login');
        } else {
            return view('admin/index.php');
        }
    }

    /////////// ROL

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

    ////////// USUARIO

    public function UsuariosAccion($valor)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {

                $ListaUsuario = $this->usuario->ListaUsuario();
                $data = [
                    'ListaUsuario' => $ListaUsuario
                ];
                return view('admin/usuario/lista.php', $data);
            } else if ($valor == "create") {
                $rol = $this->usuario->SelectRol();
                $data = [
                    'titulo' => "Crear usuario <i class='fa fa-plus'></i>",
                    'texto' => "Registro de usuario <i class='fa fa-user'></i>",
                    'accion' => "<button onclick='RegistraUsuario();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => '', '2' => '', '3' => '', '4' => '', '5' => '', '7' => '', '9' => ''],
                    'plus' => true,
                    'rol' => $rol,
                    'image' => true
                ];
                return view('admin/usuario/FormUsuario.php', $data);
            }
        }
    }

    public function EditarUsuario($valor)
    {
        if ($this->request->getMethod() == "get") {
            $rol = $this->usuario->SelectRol();
            $DataEditar = $this->usuario->TraerUsuarioEditar($valor);

            $data = [
                'titulo' => "Editar usuario <i class='fa fa-edit'></i>",
                'texto' => "Editar usuario <i class='fa fa-user'></i>",
                'accion' => "<button onclick='EditarUsuario();' class='btn btn-primary'>Guardar</button>",
                'color' => "primary",
                'editar' => $DataEditar,
                'plus' => false,
                'rol' => $rol,
                'image' => true
            ];
            return view('admin/usuario/FormUsuario.php', $data);
        }
    }

    public function EditarUsuarioFoto($valor)
    {
        if ($this->request->getMethod() == "get") {
            $rol = $this->usuario->SelectRol();
            $DataEditar = $this->usuario->TraerUsuarioEditar($valor);

            $data = [
                'titulo' => "Editar Foto del usuario <i class='fa fa-image'></i>",
                'texto' => "Editar Foto <i class='fa fa-user'></i>",
                'accion' => "<button onclick='EditarFotoUsuario();' class='btn btn-warning'>Guardar</button>",
                'color' => "warning",
                'editar' => $DataEditar,
                'plus' => true,
                'rol' => $rol,
                'image' => false
            ];
            return view('admin/usuario/FormUsuario.php', $data);
        }
    }

    ////// EMPRESA

    public function EmpresaView()
    {
        if ($this->request->getMethod() == "get") {

            $ListEmpresa = $this->usuario->ListEmpresa();
            $data = [
                'titulo' => "Datos de la Hacienda <i class='fa fa-home'></i>",
                'texto' => "Información de la Hacienda <i class='fa fa-home'></i>",
                'accion' => "<button onclick='GuardarDatosHacienda();' class='btn btn-primary'> Guardar</button>",
                'color' => "primary",
                'ListEmpresa' => $ListEmpresa,
            ];
            return view('admin/usuario/FormEmpresa.php', $data);
        }
    }

    /// CLIENTE 

    public function ListadoCliente($valor)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "tienda") {

                $ListaCliente = $this->cliente->ListaCliente(0);
                $data = [
                    'titulo' => "Listado de clientes Tienda <i class='fa fa-shopping-cart'></i>",
                    'texto' => "Listado de clientes <i class='fa fa-users'></i>",
                    'ListaCliente' => $ListaCliente,
                    'valorr' => "tienda"
                ];

                return view('admin/cliente/ListCliente.php', $data);
            } else if ($valor == "empresa") {
                $ListaCliente = $this->cliente->ListaCliente(1);
                $data = [
                    'titulo' => "Listado de clientes Empresa <i class='fa fa-home'></i>",
                    'texto' => "Listado de clientes <i class='fa fa-users'></i>",
                    'ListaCliente' => $ListaCliente,
                    'valorr' => "empresa"
                ];

                return view('admin/cliente/ListCliente.php', $data);
            }
        }
    }

    public function cliente($valor, $id, $estado)
    {
        if ($this->request->getMethod() == "get") {

            if ($valor == "new") {
                $data = [
                    'titulo' => "Crear Cliente <i class='fa fa-plus'></i>",
                    'texto' => "Registro de Cliente <i class='fa fa-users'></i>",
                    'accion' => "<button onclick='RegistraCliente();' class='btn btn-success'>Guardar</button>",
                    'color' => "success"
                ];
                return view('admin/cliente/CreateCliente.php', $data);

            } else if ($valor == "edit") {
                $cliente = $this->cliente->TraerCliente($id);
                $data = [
                    'titulo' => "Editar Cliente <i class='fa fa-edit'></i>",
                    'texto' => "Editar el Cliente <i class='fa fa-users'></i>",
                    'accion' => "<button onclick='EditarCliente();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $cliente,
                    'btn' => $estado,
                ];
                return view('admin/cliente/FormCliente.php', $data);
            }
        }
    }
}
