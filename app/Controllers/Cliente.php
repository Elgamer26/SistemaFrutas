<?php

namespace App\Controllers;

use App\Models\ModeloCliente;
use App\MailPhp\envio_correo;

class Cliente extends BaseController
{

    protected $cliente;
    protected $send_email;

    public function __construct()
    {
        session_start();
        $this->send_email = new envio_correo();
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
                echo json_encode($repuesta_create, JSON_UNESCAPED_UNICODE);
                exit();
            } else {
                echo 0;
                exit();
            }
        }
    }

    public function BloquearUsuario()
    {
        if ($this->request->getMethod() == "post") {

            $cliente = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');

            $repuesta_create = $this->cliente->BloquearUsuario($cliente, $password);
            echo $repuesta_create;
            exit();
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
            if ($repuesta_create[0] > 3) {
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
                    <td style="text-align: center; background: #9bfab0; color: black; height: 73px;" colspan="2">
                    <h1><strong>.:Password de cliente:.</strong></h1>
                    </td>
                    </tr>
                    <tr style="height: 188px;">
                    <td style="height: 134px; text-align: center;" width="20%">Estimando cliente su password fue creado con exito, use este password: <b>"' . $key . '"</b> para ingresar al sistema, gracias por confiar en nosotros :)</td>
                    </tr>
                    <tr style="height: 188px;">
                    <td style="height: 51px; text-align: center;" width="20%"><a href=' . $location . '>Link de nuestro sistema.</a></td>
                    </tr>
                    </thead>
                    </table>
                    </body>
                    </html>';
                $sms = "Password de cliente";
                $respuesta = $this->send_email->enviar_correo($correo, $html, $sms);
                if ($respuesta == 1) {
                    $resp = $this->cliente->UpdatePasswordClient($repuesta_create[0], $key);
                    echo $resp;
                    die();
                } else {
                    echo $respuesta;
                    die();
                }
            } else {
                echo $repuesta_create[0];
                die();
            }
        }
    }

    public function RegistraClienteTienda()
    {
        if ($this->request->getMethod() == "post") {

            $nombre = $this->request->getPost('nombre');
            $apellidos = $this->request->getPost('apellidos');
            $correo = $this->request->getPost('correo');
            $cedula = $this->request->getPost('cedula');
            $sexo = $this->request->getPost('sexo');
            $direccion = $this->request->getPost('direccion');
            $telefono = $this->request->getPost('telefono');
            $repuesta_create = $this->cliente->RegistraClienteTienda($nombre, $apellidos, $correo, $cedula, $sexo, $direccion, $telefono);
            if ($repuesta_create[0] > 3) {
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
                    <td style="text-align: center; background: #9bfab0; color: black; height: 73px;" colspan="2">
                    <h1><strong>.:Password de cliente:.</strong></h1>
                    </td>
                    </tr>
                    <tr style="height: 188px;">
                    <td style="height: 134px; text-align: center;" width="20%">Estimando cliente su password fue creado con exito, use este password: <b>"' . $key . '"</b> para ingresar al sistema, gracias por confiar en nosotros :)</td>
                    </tr>
                    <tr style="height: 188px;">
                    <td style="height: 51px; text-align: center;" width="20%"><a href=' . $location . '>Link de nuestro sistema.</a></td>
                    </tr>
                    </thead>
                    </table>
                    </body>
                    </html>';
                $sms = "Password de cliente";
                $respuesta = $this->send_email->enviar_correo($correo, $html, $sms);
                if ($respuesta == 1) {
                    $resp = $this->cliente->UpdatePasswordClient($repuesta_create[0], $key);
                    echo $resp;
                    die();
                } else {
                    echo $respuesta;
                    die();
                }
            } else {
                echo $repuesta_create[0];
                die();
            }
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
            echo $repuesta_create[0];
            exit();
        }
    }

    public function EstadoCliente()
    {
        if ($this->request->getMethod() == "post") {
            $estado = $this->request->getPost('estado');
            $id = $this->request->getPost('id');
            $repuesta_create = $this->cliente->EstadoCliente($estado, $id);
            echo $repuesta_create;
            exit();
        }
    }

    //// RECUPERAR PASSWORD DEL CLIENTE EN TIENDA

    public function RecuperarPasswordCliente()
    {
        if ($this->request->getMethod() == "post") {
            $correo = $this->request->getPost('correo');
            $repuesta_create = $this->cliente->RecuperarPasswordCliente($correo);
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
                    <td style="text-align: center; background: #9bfab0; color: black; height: 73px;" colspan="2">
                    <h1><strong>.:Password de cliente:.</strong></h1>
                    </td>
                    </tr>
                    <tr style="height: 188px;">
                    <td style="height: 134px; text-align: center;" width="20%">Estimando cliente su password fue creado con exito, use este password: <b>"' . $key . '"</b> para ingresar al sistema, gracias por confiar en nosotros :)</td>
                    </tr>
                    <tr style="height: 188px;">
                    <td style="height: 51px; text-align: center;" width="20%"><a href=' . $location . '>Link de nuestro sistema.</a></td>
                    </tr>
                    </thead>
                    </table>
                    </body>
                    </html>';
                $sms = "Password de cliente";
                $respuesta = $this->send_email->enviar_correo($correo, $html, $sms);
                if ($respuesta == 1) {
                    $resp = $this->cliente->UpdatePasswordClient($repuesta_create[0], $key);
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

    public function ReactivarClienteDias() {
        $activar = $this->cliente->ReactivarClienteDias();
    }
}
