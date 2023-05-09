<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;
use App\Models\ModeloCliente;
use App\Models\ModeloProducto;

class Admin extends BaseController
{
    protected $usuario;
    protected $cliente;
    protected $producto;
    public function __construct()
    {
        session_start();
        $this->usuario = new ModeloUsuario();
        $this->cliente = new ModeloCliente();
        $this->producto = new ModeloProducto();
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

    /////////// TIPO DE PRODUCTOS

    public function tipoProducto($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                $ListadoTipo = $this->producto->ListadoTipoProducto();
                $data = [
                    'ListadoTipo' => $ListadoTipo
                ];
                return view('admin/producto/ListTipoProducto.php', $data);
            } else if ($valor == "create") {
                $data = [
                    'titulo' => "Crear Tipo <i class='fa fa-plus'></i>",
                    'texto' => "Registro Tipo de producto <i class='fa fa-cube'></i>",
                    'accion' => "<button onclick='RegistraTipoProducto();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => '', '2' => ''],
                ];
                return view('admin/producto/FormTipo.php', $data);
            } else if ($valor == "edit") {
                $DataEditar = $this->producto->TraerTipoProductoEdit($id);
                $data = [
                    'titulo' => "Editar Tipo <i class='fa fa-plus'></i>",
                    'texto' => "Editar Tipo de producto <i class='fa fa-cube'></i>",
                    'accion' => "<button onclick='EditarTipoProducto();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $DataEditar,
                ];
                return view('admin/producto/FormTipo.php', $data);
            }
        }
    }

    //////////PRODUCTO

    public function Producto($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                $ListarProducto = $this->producto->ListadoProductos();
                $data = [
                    'ListarProducto' => $ListarProducto
                ];
                return view('admin/producto/ListaProducto.php', $data);
            } else if ($valor == "create") {

                $tipo = $this->producto->SelecTipoProducto();
                $data = [
                    'titulo' => "Crear Producto <i class='fa fa-plus'></i>",
                    'texto' => "Registro de Producto <i class='fa fa-cubes'></i>",
                    'accion' => "<button onclick='RegistraProducto();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => rand(1, 999999999), '2' => '', '3' => '', '4' => '', '5' => '', '6' => '', '7' => ''],
                    'plus' => true,
                    'tipo' => $tipo,
                    'image' => true
                ];
                return view('admin/producto/FormProducto.php', $data);
            } else if ($valor == "edit") {

                $tipo = $this->producto->SelecTipoProducto();
                $traerProducto = $this->producto->traerProducto($id);

                $data = [
                    'titulo' => "Editar Producto <i class='fa fa-edit'></i>",
                    'texto' => "Editar Producto <i class='fa fa-cubes'></i>",
                    'accion' => "<button onclick='EditarProducto();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $traerProducto,
                    'plus' => false,
                    'tipo' => $tipo,
                    'image' => true
                ];
                
                return view('admin/producto/FormProducto.php', $data);
            }else if ($valor == "foto") {

                $tipo = $this->producto->SelecTipoProducto();
                $traerProducto = $this->producto->traerProducto($id);

                $data = [
                    'titulo' => "Editar Foto del producto <i class='fa fa-image'></i>",
                    'texto' => "Editar Foto <i class='fa fa-image'></i>",
                    'accion' => "<button onclick='EditarFotoProducto();' class='btn btn-warning'>Guardar</button>",
                    'color' => "warning",
                    'editar' => $traerProducto,
                    'plus' => true,
                    'tipo' => $tipo,
                    'image' => false
                ];
                
                return view('admin/producto/FormProducto.php', $data);
            }
        }
    }
}
