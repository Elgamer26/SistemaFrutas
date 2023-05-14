<?php

namespace App\Controllers;

class Reporte extends BaseController
{
    public function ReporteCompraInsumo()
    {
        $mpdf = new \Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    }
}
