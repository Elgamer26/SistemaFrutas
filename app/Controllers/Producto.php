<?php

namespace App\Controllers;

use App\Models\ModeloProducto;
use App\Models\ModeloUsuario;
// use App\SmsWhatsapp\Whatsapp;
use App\MailPhp\envio_correo;

class Producto extends BaseController
{
    protected $producto;
    // protected $sms;
    protected $send_email;
    protected $empresa;
    public function __construct()
    {
        $this->send_email = new envio_correo();
        // $this->sms = new Whatsapp();
        $this->producto = new ModeloProducto();
        $this->empresa = new ModeloUsuario();
    }

    //////////////// TIPO DE PRODUCTO

    public function RegistraTipoProducto()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $repuesta_create = $this->producto->RegistraTipoProducto($nombrerol);
            echo $repuesta_create[0];
            exit();
        }
    }

    public function EstadoTipo()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->producto->EstadoTipo($estado, $id);
            echo $repuesta_create;
            exit();
        }
    }

    public function EditarTipoProducto()
    {
        if ($this->request->getMethod() == "post") {
            $nombrerol = $this->request->getPost('nombrerol');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->producto->EditarTipoProducto($nombrerol, $id);
            echo $repuesta_create[0];
            exit();
        }
    }

    //// REGISTRO DE PRODUCTOS 

    public function RegistraProducto()
    {
        $codigo = $this->request->getPost('codigo');
        $nombres = $this->request->getPost('nombres');
        $tipo_producto = $this->request->getPost('tipo_producto');
        $precio_venta = $this->request->getPost('precio_venta');
        $descripcion = $this->request->getPost('descripcion');
        $tamaño_producto = $this->request->getPost('tamaño_producto');

        $nombrearchivo = $this->request->getPost('nombrearchivo');

        if (!empty($_FILES["img_extra"]["tmp_name"])) {

            $imagen = null;
            $valor = $this->producto->RegistraProducto($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $imagen, $tamaño_producto);

            if ($valor[0] > 2) {

                $count = 0;
                foreach ($_FILES["img_extra"]["name"] as $key => $value) {

                    $extra = explode('.', $_FILES["img_extra"]["name"][$key]);
                    $renombrar = sha1($_FILES["img_extra"]["name"][$key]) . time();
                    $nombre_final = $renombrar . "" . $count . "." . $extra[1];

                    $valor_img = $this->producto->RegistrarImagen($valor[0], $nombre_final);
                    if ($valor_img == 1) {
                        move_uploaded_file($_FILES["img_extra"]["tmp_name"][$key], ROOTPATH . 'public/img/producto/' . $nombre_final);
                    }

                    $count++;
                }

                echo $valor_img;
                exit();
            } else {
                echo $valor[0];
                exit();
            }
        } else {

            $imagen = "producto.jpg";
            $valor = $this->producto->RegistraProducto($codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $imagen, $tamaño_producto);
            if ($valor[0] > 2) {
                echo 1;
                exit();
            } else {
                echo $valor[0];
                exit();
            }
        }
    }

    public function EstadoProducto()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->producto->EstadoProducto($estado, $id);
            echo $repuesta_create;
            exit();
        }
    }

    //ELIMINRA IMAGEN DEL PRODUCTO
    public function QuitarImagenProyect()
    {
        if ($this->request->getMethod() == "post") {

            $id = $this->request->getPost('id');
            $id_producto = $this->request->getPost('id_producto');
            $foto = $this->request->getPost('foto');

            $repuesta_create = $this->producto->EliminarImagenProducto($id, $id_producto);

            if ($repuesta_create == 1) {
                if ($foto != "producto.jpg") {
                    unlink(ROOTPATH . 'public/img/producto/' . $foto);
                }
            }

            echo $repuesta_create;
            exit();
        }
    }

    public function EditarProducto()
    {
        $productoID = $this->request->getPost('productoID');
        $codigo = $this->request->getPost('codigo');
        $nombres = $this->request->getPost('nombres');
        $tipo_producto = $this->request->getPost('tipo_producto');
        $precio_venta = $this->request->getPost('precio_venta');
        $descripcion = $this->request->getPost('descripcion');
        $tamaño_producto = $this->request->getPost('tamaño_producto');

        $valor = $this->producto->EditarProducto($productoID, $codigo, $nombres, $tipo_producto, $precio_venta, $descripcion, $tamaño_producto);
        echo $valor[0];
        exit();
    }

    public function EditarFotoProducto()
    {
        $id = $this->request->getPost('id');
        $count = 0;
        if (!empty($_FILES["img_extra"]["tmp_name"])) {
            foreach ($_FILES["img_extra"]["name"] as $key => $value) {

                $extra = explode('.', $_FILES["img_extra"]["name"][$key]);
                $renombrar = sha1($_FILES["img_extra"]["name"][$key]) . time();
                $nombre_final = $renombrar . "" . $count . "." . $extra[1];

                $valor_img = $this->producto->RegistrarImagen($id, $nombre_final);
                if ($valor_img == 1) {
                    move_uploaded_file($_FILES["img_extra"]["tmp_name"][$key], ROOTPATH . 'public/img/producto/' . $nombre_final);
                }
                $count++;
            }
            echo $valor_img;
            exit();
        } else {
            echo 2;
            exit();
        }
    }

    public function RegistroOferta()
    {
        $producto = $this->request->getPost('producto');
        $fechainicio = $this->request->getPost('fechainicio');
        $fechafin = $this->request->getPost('fechafin');
        $tipooferta = $this->request->getPost('tipooferta');
        $valordescuento = $this->request->getPost('valordescuento');

        $valor = $this->producto->RegistroOferta($producto, $fechainicio, $fechafin, $tipooferta, $valordescuento);
        echo $valor;
        exit();
    }

    public function EditarOferta()
    {
        $idoferta = $this->request->getPost('idoferta');
        $fechainicio = $this->request->getPost('fechainicio');
        $fechafin = $this->request->getPost('fechafin');
        $tipooferta = $this->request->getPost('tipooferta');
        $valordescuento = $this->request->getPost('valordescuento');
        $valor = $this->producto->EditarOferta($idoferta, $fechainicio, $fechafin, $tipooferta, $valordescuento);
        echo $valor;
        exit();
    }

    ///PAGINADOR DE OFERTAS

    public function Pagination_oferta()
    {
        if ($this->request->getMethod() == "post") {
            $partida = $this->request->getPost('partida');
            $valor = $this->request->getPost('valor');
            $repuesta = $this->producto->Pagination_oferta($partida, $valor);
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

    // ELIMINAR LA OFERTA
    public function EliminarOferta()
    {
        $idoferta = $this->request->getPost('idoferta');
        $idproducto = $this->request->getPost('idproducto');
        $valor = $this->producto->EliminarOferta($idoferta, $idproducto);
        echo $valor;
        exit();
    }

    /// ENVIAR OFERTA POR CORREO 
    public function EnviarCorreoOfertas()
    {
        $id = $this->request->getPost('id');

        $cliente = $this->producto->ObtenerCorreoClientes();
        $producto = $this->producto->ObtenerProductEnvio($id);
        //echo json_encode($cliente[0], JSON_UNESCAPED_UNICODE);

        $dato = array();
        $html = "";
        $url = base_url();

        for ($i = 0; $i < count($cliente[0]); $i++) {
            $dato[] = $cliente[$i]["correo"];
        }

        $html = "ESTIMADO(A) CLIENTE(A), TENEMOS UNA NUEVA OFERTA ESPECIALMENTE PARA USTED HASTA <strong>'" . $producto["fecha_fin"] . "' </strong>, TIPO DE LA OFERTA <b>'" . $producto["tipo_oferta"] . "'</b>, EL PRODUCTO EN OFERTA ES: <b>'" . $producto["nombre"] . ' - ' . $producto["tipo"] . "'</b>, INGRESA A NUESTRA PAGINA WEB <a href='" . $url . "'> Link de nuestra tienda</a> <br><br><img alt='Promocion' src='" . $url . "public/img/producto/" . $producto["imagen"] . "' style='width: 400px;height: 250px'>";
        $sms = "Ofertas disponibles";
        $respuesta = $this->send_email->enviar_correo_oferta($dato, $html, $sms);

        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        exit();
    }

    /// ENVIAR OFERTA POR SMS whatsapp 
    public function EnviarCorreoOfertasWhatsapp()
    {

        $id = $this->request->getPost('id');
        $cliente = $this->producto->ObtenerCorreoClientes();
        $producto = $this->producto->ObtenerProductEnvio($id);
        $dataempresa = $this->empresa->ListEmpresa();

        $sms = [];
        $url = base_url();
        for ($i = 0; $i < count($cliente); $i++) {
            //  if (mb_strlen($cliente[$i]["telefono"]) == 10) {
            $telefono = substr($cliente[$i]["telefono"], 1);
            $postal = "593" . $telefono;
            $sms[] = ["numero" => $postal, "mensaje" => "VIVERO DANIELITO LE RECUERDA: ESTIMADO(A) CLIENTE(A): " . $cliente[$i]["nombre"] . " " . $cliente[$i]["apellidos"] . ", TENEMOS UNA OFERTA ESPECIALMENTE PARA TI, HASTA EL: " . $producto["fecha_fin"] . ", NOMBRE DEL PRODUCTO: " . $producto["nombre"] . " - " . $producto["tipo"] . ", EL TIPO DE OFERTA ES: " . $producto["tipo_oferta"] . ", INGRESA A NUESTRA PAGINA WEB " . $url . ", PARA VER MAS DETALLE DE LA OFERTA, GRACIAS POR CONFIAR EN NOSOTROS"];
            $sms[] = ["numero" => $postal, "url" => "" . $url . "public/img/producto/" . $producto["imagen"] . ""];
            // }
        }

        // $mensaje = $this->sms->enviar_mensaje($sms);
        // echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        // exit();

        //$url = "http://localhost:8080/whatsapp/vivero.php";
        $url = "https://whatsapp.i-sistener.xyz/vivero.php";

        // Los datos de formulario
        $datos = [
            "sms" => $sms,
            "token" => $dataempresa[8],
        ];

        // Crear opciones de la petición HTTP
        $opciones = array(
            "http" => array(
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($datos), # Agregar el contenido definido antes
            ),
        );

        # Preparar petición
        $contexto = stream_context_create($opciones);

        # Hacerla
        $resultado = file_get_contents($url, false, $contexto);

        if ($resultado === false) {
            echo "Error haciendo petición";
            exit();
        }

        # si no salimos allá arriba, todo va bien
        echo print_r($resultado);
        exit();
    }


    public function listartipoprodNEW()
    {
        $ListadoTipo = $this->producto->ListadoTipoProductoNEW();
        echo json_encode($ListadoTipo, JSON_UNESCAPED_UNICODE);
    }
}
