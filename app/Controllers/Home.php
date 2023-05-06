<?php
namespace App\Controllers;
class Home extends BaseController
{
    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        if (empty($_SESSION["TokenClie"])){
            $token = "NOTOKEN";
        }else{
            $token = $_SESSION["NombUser"];
        }
        $data = [
            "token" => $token
        ];
        return view('tienda/index', $data);
    }

    public function login()
    {
        return view('tienda/login');
    }

    public function Registro()
    {
        return view('tienda/Registro');
    }
}
