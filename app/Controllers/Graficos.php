<?php
namespace App\Controllers;
use App\Models\ModeloGraficos;
class Graficos extends BaseController
{
    protected $graficos;
    public function __construct()
    {
        $this->graficos = new ModeloGraficos();
    }

    ////////////////  
    public function TraerGraficoProductosMasVendidos()
    {
        if ($this->request->getMethod() == "get") {
            $repuesta = $this->graficos->TraerGraficoProductosMasVendidos();
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }

    /////////
    public function TraerGraficoProductosMasVendidosOferta()
    {
        if ($this->request->getMethod() == "get") {
            $repuesta = $this->graficos->TraerGraficoProductosMasVendidosOferta();
            echo json_encode($repuesta, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
}
