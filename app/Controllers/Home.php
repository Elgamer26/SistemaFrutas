<?php

namespace App\Controllers;

use App\Models\ModeloTienda;

class Home extends BaseController
{
    protected $tienda;
    public function __construct()
    {
        session_start();
        $this->tienda = new ModeloTienda();
    }

    public function index()
    {
        if (empty($_SESSION["TokenClie"])) {
            $token = "NOTOKEN";
        } else {
            $token = $_SESSION["NombUser"];
        }

        $categorias = $this->tienda->TraerCategoriasTienda();

        $data = [
            "token" => $token,
            "categorias" => $categorias
        ];
        
        echo view('tienda/header', $data);
        echo view('tienda/index', $data);
        echo view('tienda/footer');
    }

    public function ofertas()
    {
        if (empty($_SESSION["TokenClie"])) {
            $token = "NOTOKEN";
        } else {
            $token = $_SESSION["NombUser"];
        }

        $categorias = $this->tienda->TraerCategoriasTienda();

        $data = [
            "token" => $token,
            "categorias" => $categorias
        ];
        echo view('tienda/header', $data);
        echo view('tienda/product');
        echo view('tienda/footer');
    }

    public function Detalle($id)
    {
        if ($this->request->getMethod() == "get") {

            if (empty($_SESSION["TokenClie"])) {
                $token = "NOTOKEN";
            } else {
                $token = $_SESSION["NombUser"];
            }

            $categorias = $this->tienda->TraerCategoriasTienda();
            $producto = $this->tienda->TraerProductoTienda($id);
            $comentario = $this->tienda->TraerComentarioProductoNormal($id);
            $countcalificar = $this->tienda->TraercalificacionProducto($id);
            $Imagen = $this->tienda->TraerImagenProducto($id);

            $data = [
                "token" => $token,
                "producto" => $producto,
                "comentario" => $comentario,
                "countcalificar" => $countcalificar,
                "Imagen" => $Imagen,
                "categorias" => $categorias
            ];

            echo view('tienda/header', $data);
            echo view('tienda/single', $data);
            echo view('tienda/footer');
        }
    }

    public function DetalleOferta($id)
    {
        if ($this->request->getMethod() == "get") {

            if (empty($_SESSION["TokenClie"])) {
                $token = "NOTOKEN";
            } else {
                $token = $_SESSION["NombUser"];
            }

            $categorias = $this->tienda->TraerCategoriasTienda();
            $oferta = $this->tienda->TraerProductoTiendaOferta($id);
            $comentario = $this->tienda->TraerComentarioProducto($id);
            $countcalificar = $this->tienda->TraercalificacionProductoOferta($id);
            $Imagen = $this->tienda->TraerImagenProducto($id);

            $data = [
                "token" => $token,
                "producto" => $oferta,
                "comentario" => $comentario,
                "countcalificar" => $countcalificar,
                "Imagen" => $Imagen,
                "categorias" => $categorias
            ];

            echo view('tienda/header', $data);
            echo view('tienda/oferta', $data);
            echo view('tienda/footer');
        }
    }

    public function Nosotros()
    {

        if (empty($_SESSION["TokenClie"])) {
            $token = "NOTOKEN";
        } else {
            $token = $_SESSION["NombUser"];
        }

        $categorias = $this->tienda->TraerCategoriasTienda();

        $data = [
            "token" => $token,
            "categorias" => $categorias
        ];

        echo view('tienda/header', $data);
        echo view('tienda/typo.php');
        echo view('tienda/footer');
    }

    public function login()
    {
        return view('tienda/login');
    }

    public function Registro()
    {
        return view('tienda/Registro');
    }

    public function Recuperar()
    {
        return view('tienda/Recuperar');
    }

    public function detallecarrito()
    {
        if (empty($_SESSION["TokenClie"])) {
            $token = "NOTOKEN";
            // $detallecompra = [];
        } else {
            $token = $_SESSION["NombUser"];
            // $detallecompra = $this->tienda->TraerProductosDelCliente($_SESSION["TokenClie"]);
        }

        $nombreHost = gethostname();
        $direccionIP = $_SERVER['SERVER_ADDR'];
        $usecomprador = $nombreHost . "-" . $direccionIP;
        $detallecompra = $this->tienda->TraerProductosDelCliente($usecomprador);

        $categorias = $this->tienda->TraerCategoriasTienda();

        $data = [
            "token" => $token,
            "detallecompra" => $detallecompra,
            "categorias" => $categorias
        ];
        
        echo view('tienda/header', $data);
        echo view('tienda/detallecarrito');
        echo view('tienda/footer');
    }

    public function EstadoPedidos()
    {
        if (empty($_SESSION["TokenClie"])) {
            $token = "NOTOKEN";
            $detallecompra = [];
        } else {
            $token = $_SESSION["NombUser"];
            $detallecompra = $this->tienda->TraerEstadoPedidos($_SESSION["TokenClie"]);
        }
        $categorias = $this->tienda->TraerCategoriasTienda();
        $data = [
            "token" => $token,
            "detallecompra" => $detallecompra,
            "categorias" => $categorias
        ];
        
        echo view('tienda/header', $data);
        echo view('tienda/EstadoPedido');
        echo view('tienda/footer');
    }

    ///////////////////// DASHBOARD DEL CLIENTE
    public function Perfil()
    {
        if (!empty($_SESSION["TokenClie"])) {
            $data = [
                'id' => $_SESSION["TokenClie"],
                'user' => $_SESSION["NombUser"]
            ];

            return view('cliente/index',  $data);
        }
    }

    public function DatosCliente($valor)
    {
        if ($this->request->getMethod() == "get") {

            if ($valor == "data") {

                $id = $_SESSION["TokenClie"];
                $cliente = $this->tienda->TraerDatosCliente($id);

                $data = [
                    'titulo' => "Editar perfil del cliente <i class='fa fa-edit'></i>",
                    'texto' => "Editar perfil del Cliente <i class='fa fa-user'></i>",
                    'accion' => "<button onclick='EditarDatoCliente();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $cliente,
                ];
                return view('cliente/Perfil.php', $data);
            }
        }
    }

    public function Credenciales($valor)
    {
        if ($this->request->getMethod() == "get") {

            if ($valor == "data") {

                $id = $_SESSION["TokenClie"];
                $cliente = $this->tienda->TraerDatosCliente($id);

                $data = [
                    'titulo' => "Cambiar password <i class='fa fa-edit'></i>",
                    'texto' => "Cambiar password <i class='fa fa-key'></i>",
                    'accion' => "<button onclick='EditarPasswordCliente();' class='btn btn-primary'>Guardar</button>",
                    'color' => "primary",
                    'editar' => $cliente,
                ];
                return view('cliente/credenciales.php', $data);
            }
        }
    }

    ///////////LISTADO DE VENTAS
    public function ListaCompras($valor)
    {
        if ($this->request->getMethod() == "get") {

            $id = $_SESSION["TokenClie"];

            if ($valor == "tienda") {

                $ListVenta = $this->tienda->ListarComprasCliente($id);
                $data = [
                    'ListVenta' => $ListVenta,
                    'title'  => '<h1>Listado de compra <i class="fa fa-shopping-cart"></i></h1>',
                    'item'  => ' <li class="breadcrumb-item active">Listado compra</li>',
                    'item2'  => '<h3 class="card-title"><b>Lista de compras</b> </h3>',
                    'token'  => false,
                ];

                return view('cliente/Compras.php', $data);
            } else if ($valor == "web") {

                $ListVenta = $this->tienda->ListarComprasClienteWeb($id);
                $data = [
                    'ListVenta' => $ListVenta,
                    'title'  => '<h1>Listado de compras web <i class="fa fa-shopping-cart"></i><i class="fa fa-home"></i></h1>',
                    'item'  => ' <li class="breadcrumb-item active">Listado compra web</li>',
                    'item2'  => '<h3 class="card-title"><b>Lista de compras web</b> </h3>',
                    'token'  => true,
                ];

                return view('cliente/Compras.php', $data);
            }
        }
    }

    // CATEGORIAS
    public function Categoria($id)
    {
        if ($this->request->getMethod() == "get") {

            if (!is_numeric($id)){
                return redirect()->to(base_url() . 'home');
            }

            if (empty($_SESSION["TokenClie"])) {
                $token = "NOTOKEN";
            } else {
                $token = $_SESSION["NombUser"];
            }
    
            $categorias = $this->tienda->TraerCategoriasTienda();
            $productos = $this->tienda->TraerProductosCategorias($id);
    
            $data = [
                "token" => $token,
                "categorias" => $categorias,
                "productos" => $productos,
                "id" =>  $id
            ];

            echo view('tienda/header', $data);
            echo view('tienda/Categoria');
            echo view('tienda/footer');

        }
    }
}
