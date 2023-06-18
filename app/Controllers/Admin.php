<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;
use App\Models\ModeloCliente;
use App\Models\ModeloProducto;
use App\Models\ModeloInsumos;
use App\Models\ModeloProveedor;
use App\Models\ModeloProduccion;
use App\Models\ModeloVenta;

class Admin extends BaseController
{
    protected $usuario;
    protected $cliente;
    protected $producto;
    protected $insumo;
    protected $proveedor;
    protected $produccion;
    protected $venta;

    public function __construct()
    {
        date_default_timezone_set('America/Guayaquil');
        session_start();
        $this->usuario = new ModeloUsuario();
        $this->cliente = new ModeloCliente();
        $this->producto = new ModeloProducto();
        $this->insumo = new ModeloInsumos();
        $this->proveedor = new ModeloProveedor();
        $this->produccion = new ModeloProduccion();
        $this->venta = new ModeloVenta();
    }

    public function index()
    {
        if (!isset($_SESSION["id_user"])) {
            return redirect()->to(base_url() . 'login');
        } else {
            $data = $this->usuario->LlamarDatosDashboard();
            $dato = [
                'data' =>  $data,
            ];
            return view('admin/index.php', $dato);
        }
    }

    public function Recuperar()
    {
        return view('login/Recuperar.php');
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
            } else if ($valor == "foto") {

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

    /////////// TIPO DE INSUMO

    public function TipoInsumo($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                $ListadoTipo = $this->insumo->ListadoTipoInsumo();
                $data = [
                    'ListadoTipo' => $ListadoTipo
                ];
                return view('admin/InsumoMaterial/ListTipoInsumo.php', $data);
            } else if ($valor == "create") {
                $data = [
                    'titulo' => "Crear Tipo <i class='fa fa-plus'></i>",
                    'texto' => "Registro Tipo de insumo <i class='fa fa-cube'></i>",
                    'accion' => "<button onclick='RegistraTipoInsumo();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => '', '2' => ''],
                ];
                return view('admin/InsumoMaterial/FormTipo.php', $data);
            } else if ($valor == "edit") {
                $DataEditar = $this->insumo->TraerTipoInsumoEdit($id);
                $data = [
                    'titulo' => "Editar Tipo <i class='fa fa-plus'></i>",
                    'texto' => "Editar Tipo de insumo <i class='fa fa-cube'></i>",
                    'accion' => "<button onclick='EditarTipoInsumo();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $DataEditar,
                ];
                return view('admin/InsumoMaterial/FormTipo.php', $data);
            }
        }
    }

    ///////////  INSUMOS

    public function Insumos($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                $ListaInsumo = $this->insumo->ListarInsumo();
                $data = [
                    'ListaInsumo' => $ListaInsumo
                ];
                return view('admin/InsumoMaterial/ListaInsumo.php', $data);
            } else if ($valor == "create") {

                $tipo = $this->insumo->SelectTipoInsumo();
                $data = [
                    'titulo' => "Crear Tipo <i class='fa fa-plus'></i>",
                    'texto' => "Registro de insumo <i class='fa fa-cubes'></i>",
                    'accion' => "<button onclick='RegistrarInsumo();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => rand(1, 999999999), '2' => '', '3' => '', '4' => '', '5' => '', '6' => '', '7' => ''],
                    'plus' => true,
                    'tipo' => $tipo,
                    'image' => true
                ];
                return view('admin/InsumoMaterial/FormInsumo.php', $data);
            } else if ($valor == "edit") {

                $DataEditar = $this->insumo->TraerInsumoEdit($id);
                $tipo = $this->insumo->SelectTipoInsumo();


                $data = [
                    'titulo' => "Editar Insumo <i class='fa fa-plus'></i>",
                    'texto' => "Editar Insumo <i class='fa fa-cube'></i>",
                    'accion' => "<button onclick='EditarInsumo();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $DataEditar,
                    'plus' => false,
                    'tipo' => $tipo,
                    'image' => true
                ];
                return view('admin/InsumoMaterial/FormInsumo.php', $data);
            } else if ($valor == "foto") {

                $DataEditar = $this->insumo->TraerInsumoEdit($id);
                $tipo = $this->insumo->SelectTipoInsumo();

                $data = [
                    'titulo' => "Editar Foto del Insumo <i class='fa fa-image'></i>",
                    'texto' => "Editar Foto <i class='fa fa-image'></i>",
                    'accion' => "<button onclick='EditarFotoInsumo();' class='btn btn-warning'>Guardar</button>",
                    'color' => "warning",
                    'editar' => $DataEditar,
                    'plus' => true,
                    'tipo' => $tipo,
                    'image' => false
                ];

                return view('admin/InsumoMaterial/FormInsumo.php', $data);
            }
        }
    }

    ///////////  MATERIALES

    public function TipoMaterial($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                $ListadoTipo = $this->insumo->ListadoTipoMaterial();
                $data = [
                    'ListadoTipo' => $ListadoTipo
                ];
                return view('admin/InsumoMaterial/ListTipoMaterial.php', $data);
            } else if ($valor == "create") {
                $data = [
                    'titulo' => "Crear Tipo <i class='fa fa-plus'></i>",
                    'texto' => "Registro Tipo de material <i class='fa fa-cube'></i>",
                    'accion' => "<button onclick='RegistraTipoMaterial();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => '', '2' => ''],
                ];
                return view('admin/InsumoMaterial/FormTipoMaterial.php', $data);
            } else if ($valor == "edit") {
                $DataEditar = $this->insumo->TraerTipoMaterialEdit($id);
                $data = [
                    'titulo' => "Editar Tipo <i class='fa fa-plus'></i>",
                    'texto' => "Editar Tipo de material <i class='fa fa-cube'></i>",
                    'accion' => "<button onclick='EditarTipoMaterial();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $DataEditar,
                ];
                return view('admin/InsumoMaterial/FormTipoMaterial.php', $data);
            }
        }
    }

    ///////////  MATERIAL

    public function Material($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                $ListaMaterial = $this->insumo->ListarMaterial();
                $data = [
                    'ListaMaterial' => $ListaMaterial
                ];
                return view('admin/InsumoMaterial/ListaMaterial.php', $data);
            } else if ($valor == "create") {

                $tipo = $this->insumo->SelectTipoMaterial();
                $data = [
                    'titulo' => "Crear Material <i class='fa fa-plus'></i>",
                    'texto' => "Registro de Material <i class='fa fa-cubes'></i>",
                    'accion' => "<button onclick='RegistrarMaterial();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => rand(1, 999999999), '2' => '', '3' => '', '4' => '', '5' => '', '6' => '', '7' => ''],
                    'plus' => true,
                    'tipo' => $tipo,
                    'image' => true
                ];
                return view('admin/InsumoMaterial/FormMaterial.php', $data);
            } else if ($valor == "edit") {

                $DataEditar = $this->insumo->TraerMaterialEdit($id);
                $tipo =  $this->insumo->SelectTipoMaterial();

                $data = [
                    'titulo' => "Editar Material <i class='fa fa-plus'></i>",
                    'texto' => "Editar Material <i class='fa fa-cube'></i>",
                    'accion' => "<button onclick='EditarMaterial();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $DataEditar,
                    'plus' => false,
                    'tipo' => $tipo,
                    'image' => true
                ];
                return view('admin/InsumoMaterial/FormMaterial.php', $data);
            } else if ($valor == "foto") {

                $DataEditar = $this->insumo->TraerMaterialEdit($id);
                $tipo =  $this->insumo->SelectTipoMaterial();

                $data = [
                    'titulo' => "Editar Foto del Material <i class='fa fa-image'></i>",
                    'texto' => "Editar Foto <i class='fa fa-image'></i>",
                    'accion' => "<button onclick='EditarFotoMaterial();' class='btn btn-warning'>Guardar</button>",
                    'color' => "warning",
                    'editar' => $DataEditar,
                    'plus' => true,
                    'tipo' => $tipo,
                    'image' => false
                ];

                return view('admin/InsumoMaterial/FormMaterial.php', $data);
            }
        }
    }

    ///////// PROVEEDOR

    public function proveedor($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                $ListaProveddor = $this->proveedor->ListarProveedor();
                $data = [
                    'ListaProveddor' => $ListaProveddor
                ];
                return view('admin/compra/ListProveedor.php', $data);
            } else if ($valor == "create") {

                $data = [
                    'titulo' => "Crear Proveedor <i class='fa fa-plus'></i>",
                    'texto' => "Registro de Proveedor <i class='fa fa-cubes'></i>",
                    'accion' => "<button onclick='RegistrarProveedor();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => '', '2' => '', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '']
                ];
                return view('admin/compra/FormProveedor.php', $data);
            } else if ($valor == "edit") {

                $DataEditar = $this->proveedor->TraerProveedorEdit($id);

                $data = [
                    'titulo' => "Editar Proveedor <i class='fa fa-edit'></i>",
                    'texto' => "Editar el Proveedor <i class='fa fa-cubes'></i>",
                    'accion' => "<button onclick='EditarProveedor();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $DataEditar
                ];
                return view('admin/compra/FormProveedor.php', $data);
            }
        }
    }

    public function CompraInsumos($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {

                $ListaCompra = $this->proveedor->ListarCompraInsumo();
                $data = [
                    'ListaCompra' => $ListaCompra
                ];
                return view('admin/compra/ListCompraInsumo.php', $data);
            } else if ($valor == "create") {

                $proveedor = $this->proveedor->SelectProveedor();
                $insumo = $this->insumo->ListarInsumoComprar();
                $data = [
                    'titulo' => "Compra de insumo <i class='fa fa-shopping-cart'></i>",
                    'texto' => "Registro de compra <i class='fa fa-edit'></i>",
                    'accion' => "<button onclick='RegistrarCompraInsumos();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => date("YmdHms"), '2' => '', '3' => '', '4' => '', '5' => '', '6' => '', '7' => ''],
                    'comprobante' => ['0' => 'Nota de venta', '1' => 'Factura'],
                    'proveedor' => $proveedor,
                    'insumo' => $insumo
                ];
                return view('admin/compra/FormCompraInsumo.php', $data);
            }
        }
    }

    public function CompraMaterial($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {

                $ListaCompra = $this->proveedor->ListarCompraMaterial();
                $data = [
                    'ListaCompra' => $ListaCompra
                ];
                return view('admin/compra/ListCompraMaterial.php', $data);
            } else if ($valor == "create") {

                $proveedor = $this->proveedor->SelectProveedor();
                $material = $this->insumo->ListarMaterialComprar();

                $data = [
                    'titulo' => "Compra de material <i class='fa fa-shopping-cart'></i>",
                    'texto' => "Registro de compra <i class='fa fa-edit'></i>",
                    'accion' => "<button onclick='RegistrarCompraMaterial();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => date("YmdHms"), '2' => '', '3' => '', '4' => '', '5' => '', '6' => '', '7' => ''],
                    'comprobante' => ['0' => 'Nota de venta', '1' => 'Factura'],
                    'proveedor' => $proveedor,
                    'material' => $material
                ];
                return view('admin/compra/FormCompraMaterial.php', $data);
            }
        }
    }

    public function produccion($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                return view('admin/produccion/ListProduccion');
            } else if ($valor == "create") {
                $producto = $this->producto->ListProductoProduccion();
                $insumo = $this->insumo->ListarInsumoComprar();
                $material = $this->insumo->ListarMaterialComprar();
                $data = [
                    'titulo' => "Crear producción <i class='fa fa-plus'></i>",
                    'texto' => "Registro de producción <i class='fa fa-edit'></i>",
                    'accion' => "<button onclick='RegistrarProduccionPlantas();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'producto' => $producto,
                    'material' => $material,
                    'insumo' => $insumo
                ];
                return view('admin/produccion/ForProduccion', $data);
            } else if ($valor == "perdida") {
                $perdida = $this->produccion->ListarPerdida();
                $data = [
                    'perdida' => $perdida
                ];
                return view('admin/produccion/ListPerdidad', $data);
            } else if ($valor == "newperdida") {
                $produccion = $this->produccion->ListProduccionActivas();
                $data = [
                    'titulo' => "Registro de perdida <i class='fa fa-plus'></i>",
                    'texto' => "Registro perdida de producción <i class='fa fa-cube'></i>",
                    'accion' => "<button onclick='RegistroPerdidaProduccion();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'produccion' => $produccion
                ];
                return view('admin/produccion/FormPerdida.php', $data);
            } else if ($valor == "fases") {
                $fase = $this->produccion->ListFases();
                $data = [
                    'fase' => $fase
                ];
                return view('admin/produccion/ListFases.php',  $data);
            } else if ($valor == "registerFase") {
                $produccion = $this->produccion->ListProduccionActivas();
                $data = [
                    'titulo' => "Registrar fase <i class='fa fa-plus'></i>",
                    'texto' => "Registro fase de producción <i class='fa fa-edit'></i>",
                    'accion' => "<button onclick='RegistrarProduccionPlantas();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'produccion' => $produccion
                ];
                return view('admin/produccion/RegisterFase.php',  $data);
            } else if ($valor == "finalizado") {
                return view('admin/produccion/ProduccionFinalizado.php');
            }
        }
    }

    ///////////  MATERIAL

    public function oferta($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {
                return view('admin/oferta/ListOfertas.php');
            } else if ($valor == "registro") {
                $producto = $this->producto->SelectProductoOferta();
                $data = [
                    'titulo' => "Crear oferta <i class='fa fa-plus'></i>",
                    'texto' => "Registro de oferta <i class='fa fa-cubes'></i>",
                    'accion' => "<button onclick='RegistroOferta();' class='btn btn-success'>Guardar</button>",
                    'volver' => '<a onclick="cargar_contenido(`contenido_principal`,`' .  base_url() . 'admin/oferta/registro/0`);" class="btn btn-danger">Recargar</a>',
                    'color' => "success",
                    'editar' => ['0' => '', '1' => '', '2' => date("Y-m-d"), '3' => date("Y-m-d"), '4' => '', '5' => '0'],
                    'producto' => $producto,
                    'tipo' => ['0' => '2x1', '1' => '3x1', '2' => 'Descuento %'],
                    'ocultar'  => true,
                ];
                return view('admin/oferta/FormOferta.php', $data);
            } else if ($valor == "editar") {

                $producto = $this->producto->SelectProductoOferta();
                $oferta = $this->producto->TraerOfertaEditar($id);

                $data = [
                    'titulo' => "Editar oferta <i class='fa fa-edit'></i>",
                    'texto' => "Editar la oferta <i class='fa fa-cubes'></i>",
                    'accion' => "<button onclick='EditarOferta();' class='btn btn-primary'>Guardar</button>",
                    'volver' => '<a onclick="cargar_contenido(`contenido_principal`,`' .  base_url() . 'admin/oferta/list/0`);" class="btn btn-danger">Volver</a>',
                    'color' => "primary",
                    'editar' => $oferta,
                    'producto' => $producto,
                    'tipo' => ['0' => '2x1', '1' => '3x1', '2' => 'Descuento %'],
                    'ocultar'  => false,
                ];

                return view('admin/oferta/FormOferta.php', $data);
            }
        }
    }

    /// COMENTARIOS DE CLIENTES PRODUCTOS
    public function comentatios($accion, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($accion == "list") {
                $producto = $this->producto->SelecProductoComentado();
                $data = [
                    'producto' => $producto,
                    'detalle' => [],
                    'id' => ['0' => 0],
                ];
                return view('admin/cliente/ListComentario.php', $data);
            } else  if ($accion == "listDetalle") {
                $detalle = $this->producto->TraerComentarioProductoCliente($id);
                echo json_encode($detalle, JSON_UNESCAPED_UNICODE);
                exit();
            } else  if ($accion == "califica") {

                $califica = $this->producto->ListCalificaionProducto();
                $data = [
                    'califica' => $califica
                ];

                return view('admin/cliente/ListCalificacion.php', $data);
            }
        }
    }

    /////////// NUEVA VENTA
    public function ventas($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "list") {

                $ListVenta = $this->venta->ListarVentas();
                $data = [
                    'ListVenta' => $ListVenta
                ];
                return view('admin/venta/ListVentaProducto.php', $data);
            } else if ($valor == "web") {

                $ListVenta = $this->venta->ListarVentasTiendaWeb();
                $data = [
                    'ListVenta' => $ListVenta
                ];
                return view('admin/venta/ListVentasTiendaWeb', $data);
            } else if ($valor == "new") {

                $cliente = $this->venta->SelectCliente();
                $producto = $this->venta->ListProdcutosDisponibles();
                $ofertas = $this->venta->ListOfertaDisponibles();

                $data = [
                    'titulo' => "Venta de producto <i class='fa fa-shopping-cart'></i>",
                    'texto' => "Registro de venta <i class='fa fa-plus'></i>",
                    'accion' => "<button onclick='RegistraVentaproducto();' class='btn btn-success'>Guardar</button>",
                    'color' => "success",
                    'editar' => ['0' => '', '1' => date("YmdHms"), '2' => '', '3' => '', '4' => '', '5' => '', '6' => '', '7' => ''],
                    'comprobante' => ['0' => 'Nota de venta', '1' => 'Factura'],
                    'cliente' => $cliente,
                    'producto' => $producto,
                    'ofertas' => $ofertas
                ];
                return view('admin/venta/FormVentaProducto.php', $data);
            }
        }
    }

    /////////// REPORTES

    public function reporte($valor, $id)
    {
        if ($this->request->getMethod() == "get") {
            if ($valor == "venta_tienda") {
                $data = [
                    'fecha' => date("Y-m-d")
                ];
                return view('admin/reporte/ReporteVentaTienda', $data);
            } else if ($valor == "compra") {
                $data = [
                    'fecha' => date("Y-m-d")
                ];
                return view('admin/reporte/ReporteCompra', $data);
            } else if ($valor == "compramaterial") {
                $data = [
                    'fecha' => date("Y-m-d")
                ];
                return view('admin/reporte/ReporteCompraMaterial', $data);
            } else if ($valor == "reporteinsumos") {
                $insumo = $this->insumo->SelectTipoInsumo();
                $data = [
                    'fecha' => date("Y-m-d"),
                    'insumo' => $insumo,
                ];
                return view('admin/reporte/ReporteInsumos', $data);
            } else if ($valor == "reportematerial") {
                $tipo = $this->insumo->SelectTipoMaterial();
                $data = [
                    'fecha' => date("Y-m-d"),
                    'insumo' => $tipo,
                ];
                return view('admin/reporte/ReporteMaterial', $data);
            } else if ($valor == "ReportePlantas") {
                $tipo = $this->producto->SelecTipoProducto();
                $data = [
                    'fecha' => date("Y-m-d"),
                    'insumo' => $tipo,
                ];
                return view('admin/reporte/ReportePlantas', $data);
            } else if ($valor == "ReporteCliente") {
                return view('admin/reporte/ReporteCliente');
            } else if ($valor == "ReporteOfertas") {
                $data = [
                    'fecha' => date("Y-m-d")
                ];
                return view('admin/reporte/ReporteOfertas', $data);
            }
        }
    }
}
