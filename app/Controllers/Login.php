<?php

namespace App\Controllers;

use App\Models\ModeloUsuario;

class Login extends BaseController
{
    protected $usuario;
    public function __construct()
    {
        session_start();
        $this->usuario = new ModeloUsuario();
    }

    public function index()
    {
        if (isset($_SESSION["id_user"])) {
            return redirect()->to(base_url() . 'admin');
        } else {
            return view('login/index.php');
        }
     
    }

}