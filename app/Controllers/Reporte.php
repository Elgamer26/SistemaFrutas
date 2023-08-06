<?php

namespace App\Controllers;

use App\Models\ModeloReporte;
use App\MailPhp\envio_correo;

use PhpParser\Builder\Function_;

class Reporte extends BaseController
{

    protected $reporte;
    protected $send_email;

    public function __construct()
    {
        $this->send_email = new envio_correo();
        $this->reporte = new ModeloReporte();
    }

    public function DatosEmpresaLLamer()
    {
        $empresa = $this->reporte->DatosEmpresa();
        return $empresa;
    }

    public function ReporteCompraInsumo($id)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $compra = $this->reporte->DatoComopraInsumo($id);
        $detalle = $this->reporte->DatoComopraInsumoDetalle($id);
        /////////

        $pdf->SetTitle("Compra insumo");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Compra de insumos", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode('FACTURA N°:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, $compra[4]);

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 48,  $compra[3]);

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Proveedor:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(35, 54, $compra[2]);

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('Insumo'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Precio'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Total'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }
            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(80, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["precio"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, utf8_decode($detalle[$i]["cantidad"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["total"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(10);
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Subtotal', 1, 0);
        $pdf->Cell(60, 6, "$ " . $compra[5], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Impuesto', 1, 0);
        $pdf->Cell(60, 6, "$ " . $compra[6], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Total', 1, 0);
        $pdf->Cell(60, 6, "$ " . $compra[7], '1', 1, 'R');

        if ($compra[8] != 1) {
            $pdf->Image(base_url() . 'public/img/anulado.png', 80, 250, 60);
        }

        // $pdf->SetFont('helvetica', 'B', 8);
        // $pdf->SetY(-10);
        // $pdf->Cell(95, 5, utf8_decode('Página ') .  $pdf->PageNo() . ' / {nb}', 0, 0, 'L');
        // $pdf->Cell(95, 5, date('d/m/Y | g:i:a'), 00, 1, 'R');
        // $pdf->Line(10, 287, 200, 287);
        // $pdf->Cell(0, 5, utf8_decode("Kodo Sensei © Todos los derechos reservados."), 0, 0, "C");

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("compra_pdf.pdf", "I");
    }

    public function ReporteCompraMaterial($id)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $compra = $this->reporte->DatoComopraMaterial($id);
        $detalle = $this->reporte->DatoComopraMaterialDetalle($id);
        /////////

        $pdf->SetTitle("Compra Material");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Compra de material", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode('FACTURA N°:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, $compra[4]);

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 48,  $compra[3]);

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Proveedor:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(35, 54, $compra[2]);

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('Material'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Precio'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Total'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(80, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["precio"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, utf8_decode($detalle[$i]["cantidad"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["total"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(10);
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Subtotal', 1, 0);
        $pdf->Cell(60, 6, "$ " . $compra[5], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Impuesto', 1, 0);
        $pdf->Cell(60, 6, "$ " . $compra[6], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Total', 1, 0);
        $pdf->Cell(60, 6, "$ " . $compra[7], '1', 1, 'R');

        if ($compra[8] != 1) {
            $pdf->Image(base_url() . 'public/img/anulado.png', 80, 250, 60);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("compra_pdf.pdf", "I");
    }

    public function ReporteProduccionActivas($id, $fase, $perdida)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $produccion = $this->reporte->ProduccionActivas($id);
        $detalleinsumo = $this->reporte->DetalleInsumoProduccion($id);
        $detallematerial = $this->reporte->DetalleMaterialProduccion($id);
        /////////

        $pdf->SetTitle("Produccion activa");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, utf8_decode("Producción activa"), 1, '', 'C', 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(120, 48, utf8_decode('N° Lote:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(140, 48, $produccion[0]);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(120, 54, utf8_decode('Producto:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(140, 54, $produccion[9]);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha incio:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(38, 48,  $produccion[3]);

        $pdf->Ln(50);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 54, utf8_decode('Fecha fin:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(38, 54,  $produccion[3]);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 61, utf8_decode('Usuario:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(38, 61, $produccion[10]);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 68, utf8_decode('Cantidad:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(38, 68, $produccion[8]);

        $pdf->Ln(20);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(182, 5, utf8_decode('Insumo de producción'), 0, 0, 'C');

        $pdf->Ln(10);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(90, 12, utf8_decode('Insumo'), 0, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        $pdf->Ln(10);

        for ($i = 0; $i < count($detalleinsumo); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(90, 8, utf8_decode($detalleinsumo[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(80, 8, utf8_decode($detalleinsumo[$i]["cantidad"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(182, 5, utf8_decode('Material de producción'), 0, 0, 'C');

        $pdf->Ln(10);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(90, 12, utf8_decode('Material'), 0, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        $pdf->Ln(10);

        for ($i = 0; $i < count($detallematerial); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(90, 8, utf8_decode($detallematerial[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(80, 8, utf8_decode($detallematerial[$i]["cantidad"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        if ($fase == "true") {

            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(182, 5, utf8_decode('Fase de producción'), 0, 0, 'C');

            $pdf->Ln(10);

            $pdf->SetX(15);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(25, 132, 151);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 12, utf8_decode('N°'), 0, 0, 'C', 1);
            $pdf->Cell(140, 12, utf8_decode('Fase'), 0, 0, 'C', 1);
            $pdf->Cell(30, 12, utf8_decode('Fecha'), 0, 0, 'C', 1);

            $pdf->SetFont('Arial', '', 10);

            $pdf->Ln(10);

            $faseproduccion = $this->reporte->FaseProduccion($id);

            for ($i = 0; $i < count($faseproduccion); $i++) {

                $pdf->SetX(15); //posicionamos en x

                if ($i % 2 == 0) {
                    $pdf->SetFillColor(232, 232, 232);
                    $pdf->SetDrawColor(65, 61, 61);
                } else {
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetDrawColor(65, 61, 61);
                }

                $pdf->Cell(10, 8, $i + 1, 'B', 0, 'C', 1);
                $pdf->Cell(140, 8, utf8_decode($faseproduccion[$i]["fase"]), 'B', 0, 'C', 1);
                $pdf->Cell(30, 8, utf8_decode($faseproduccion[$i]["fecha"]), 'B', 1, 'C', 1);
                $pdf->Ln(0.5);
            }
        }

        if ($perdida == "true") {

            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(182, 5, utf8_decode('Perdida de producción'), 0, 0, 'C');

            $pdf->Ln(10);

            $pdf->SetX(15);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(25, 132, 151);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
            $pdf->Cell(55, 12, utf8_decode('Usuario'), 0, 0, 'C', 1);
            $pdf->Cell(60, 12, utf8_decode('Fecha'), 0, 0, 'C', 1);
            $pdf->Cell(55, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);

            $pdf->SetFont('Arial', '', 10);

            $pdf->Ln(10);

            $perdidaproduccion = $this->reporte->PerdidaProduccion($id);

            for ($i = 0; $i < count($perdidaproduccion); $i++) {

                $pdf->SetX(15); //posicionamos en x

                if ($i % 2 == 0) {
                    $pdf->SetFillColor(232, 232, 232);
                    $pdf->SetDrawColor(65, 61, 61);
                } else {
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetDrawColor(65, 61, 61);
                }

                $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
                $pdf->Cell(55, 8, utf8_decode($perdidaproduccion[$i]["nombres"]), 'B', 0, 'C', 1);
                $pdf->Cell(60, 8, utf8_decode($perdidaproduccion[$i]["fecha"]), 'B', 0, 'C', 1);
                $pdf->Cell(55, 8, utf8_decode($perdidaproduccion[$i]["cantidad"]), 'B', 1, 'C', 1);
                $pdf->Ln(0.5);
            }
        }


        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("compra_pdf.pdf", "I");
    }

    public function ReporteProduccionFinaloizado($id, $fase, $perdida)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $produccion = $this->reporte->ProduccionActivas($id);
        $detalleinsumo = $this->reporte->DetalleInsumoProduccion($id);
        $detallematerial = $this->reporte->DetalleMaterialProduccion($id);
        /////////

        $pdf->SetTitle("Produccion activa");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39,  utf8_decode("Producción finalizado"), 1, '', 'C', 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(120, 48, utf8_decode('N° Lote:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(140, 48, $produccion[0]);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(120, 54, utf8_decode('Producto:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(140, 54, $produccion[9]);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha incio:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(38, 48,  $produccion[3]);

        $pdf->Ln(50);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 54, utf8_decode('Fecha fin:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(38, 54,  $produccion[3]);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 61, utf8_decode('Usuario:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(38, 61, $produccion[10]);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 68, utf8_decode('Cantidad:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(38, 68, $produccion[8]);

        $pdf->Ln(20);

        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(182, 5, utf8_decode('Insumo de producción'), 0, 0, 'C');

        $pdf->Ln(10);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(90, 12, utf8_decode('Insumo'), 0, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        $pdf->Ln(10);

        for ($i = 0; $i < count($detalleinsumo); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(90, 8, utf8_decode($detalleinsumo[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(80, 8, utf8_decode($detalleinsumo[$i]["cantidad"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(182, 5, utf8_decode('Material de producción'), 0, 0, 'C');

        $pdf->Ln(10);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(90, 12, utf8_decode('Material'), 0, 0, 'C', 1);
        $pdf->Cell(80, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        $pdf->Ln(10);

        for ($i = 0; $i < count($detallematerial); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(90, 8, utf8_decode($detallematerial[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(80, 8, utf8_decode($detallematerial[$i]["cantidad"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        if ($fase == "true") {

            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(182, 5, utf8_decode('Fase de producción'), 0, 0, 'C');

            $pdf->Ln(10);

            $pdf->SetX(15);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(25, 132, 151);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 12, utf8_decode('N°'), 0, 0, 'C', 1);
            $pdf->Cell(140, 12, utf8_decode('Fase'), 0, 0, 'C', 1);
            $pdf->Cell(30, 12, utf8_decode('Fecha'), 0, 0, 'C', 1);

            $pdf->SetFont('Arial', '', 10);

            $pdf->Ln(10);

            $faseproduccion = $this->reporte->FaseProduccion($id);

            for ($i = 0; $i < count($faseproduccion); $i++) {

                $pdf->SetX(15); //posicionamos en x

                if ($i % 2 == 0) {
                    $pdf->SetFillColor(232, 232, 232);
                    $pdf->SetDrawColor(65, 61, 61);
                } else {
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetDrawColor(65, 61, 61);
                }

                $pdf->Cell(10, 8, $i + 1, 'B', 0, 'C', 1);
                $pdf->Cell(140, 8, utf8_decode($faseproduccion[$i]["fase"]), 'B', 0, 'C', 1);
                $pdf->Cell(30, 8, utf8_decode($faseproduccion[$i]["fecha"]), 'B', 1, 'C', 1);
                $pdf->Ln(0.5);
            }
        }

        if ($perdida == "true") {

            $pdf->Ln(10);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(182, 5, utf8_decode('Perdida de producción'), 0, 0, 'C');

            $pdf->Ln(10);

            $pdf->SetX(15);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(25, 132, 151);

            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
            $pdf->Cell(55, 12, utf8_decode('Usuario'), 0, 0, 'C', 1);
            $pdf->Cell(60, 12, utf8_decode('Fecha'), 0, 0, 'C', 1);
            $pdf->Cell(55, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);

            $pdf->SetFont('Arial', '', 10);

            $pdf->Ln(10);

            $perdidaproduccion = $this->reporte->PerdidaProduccion($id);

            for ($i = 0; $i < count($perdidaproduccion); $i++) {

                $pdf->SetX(15); //posicionamos en x

                if ($i % 2 == 0) {
                    $pdf->SetFillColor(232, 232, 232);
                    $pdf->SetDrawColor(65, 61, 61);
                } else {
                    $pdf->SetFillColor(255, 255, 255);
                    $pdf->SetDrawColor(65, 61, 61);
                }

                $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
                $pdf->Cell(55, 8, utf8_decode($perdidaproduccion[$i]["nombres"]), 'B', 0, 'C', 1);
                $pdf->Cell(60, 8, utf8_decode($perdidaproduccion[$i]["fecha"]), 'B', 0, 'C', 1);
                $pdf->Cell(55, 8, utf8_decode($perdidaproduccion[$i]["cantidad"]), 'B', 1, 'C', 1);
                $pdf->Ln(0.5);
            }
        }


        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("compra_pdf.pdf", "I");
    }

    ////////// FACTURA DE VENTA PRODUCTO
    public function ReporteVentaWeb($id)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $venta = $this->reporte->DatosVentaWeb($id);
        $detalle = $this->reporte->DatoDetalleVentaWeb($id);
        /////////

        $pdf->SetTitle("Venta Web");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Venta Web", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode('FACTURA N°:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode($venta[8]));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 48,  utf8_decode($venta[12]));

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Cliente:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 54, utf8_decode($venta[1]));

        $pdf->Ln(50);

        if ($venta[17] != "efectivo") {
            $pdf->SetX(15);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(25, 132, 151);

            $pdf->MultiCell(182, 5, utf8_decode("Ciudad : " . $venta[13]), 0, 0, 'R', 1);

            $pdf->Ln(1);

            $pdf->SetX(15);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(25, 132, 151);
            $pdf->MultiCell(182, 5, utf8_decode("Dirección : " . $venta[3]), 0, 0, 'R', 1);

            $pdf->Ln(1);

            $pdf->SetX(15);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFillColor(25, 132, 151);

            $pdf->MultiCell(182, 5, utf8_decode("Referencia : " . $venta[14]), 0, 0, 'R', 1);
        }

        $pdf->Ln(6);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Producto'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Precio'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Oferta'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Total'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(60, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["precio"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["sale"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["oferta"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["total"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(10);
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Subtotal', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[4], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Impuesto', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[5], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Total', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[6], '1', 1, 'R');

        if ($venta[11] != 1) {
            $pdf->Image(base_url() . 'public/img/anulado.png', 80, 250, 60);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("venta_pdf.pdf", "I");
    }

    public function ReporteVenta($id)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $venta = $this->reporte->DatosVentaWeb($id);
        $detalle = $this->reporte->DatoDetalleVentaWeb($id);
        /////////

        $pdf->SetTitle("Venta");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Venta", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode('FACTURA N°:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode($venta[8]));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 48,  utf8_decode($venta[12]));

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Cliente:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 54, utf8_decode($venta[1]));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Producto'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Precio'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Oferta'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Total'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(60, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["precio"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["sale"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["oferta"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["total"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(10);
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Subtotal', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[4], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Impuesto', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[5], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Total', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[6], '1', 1, 'R');

        if ($venta[11] != 1) {
            $pdf->Image(base_url() . 'public/img/anulado.png', 80, 250, 60);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("venta_pdf.pdf", "I");
    }

    public function ReporteVentaWebEnvioCorreo()
    {

        $id = $this->request->getPost('id');

        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $venta = $this->reporte->DatosVentaWeb($id);
        $detalle = $this->reporte->DatoDetalleVentaWeb($id);
        /////////

        $pdf->SetTitle("Venta Web");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Venta Web", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode('FACTURA N°:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode($venta[8]));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 48,  utf8_decode($venta[12]));

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Cliente:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 54, utf8_decode($venta[1]));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->MultiCell(182, 5, utf8_decode("Ciudad : " . $venta[13]), 0, 0, 'R', 1);

        $pdf->Ln(1);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);
        $pdf->MultiCell(182, 5, utf8_decode("Dirección : " . $venta[3]), 0, 0, 'R', 1);

        $pdf->Ln(1);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->MultiCell(182, 5, utf8_decode("Referencia : " . $venta[14]), 0, 0, 'R', 1);

        $pdf->Ln(6);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Producto'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Precio'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Oferta'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Total'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(60, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["precio"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["sale"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["oferta"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["total"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(10);
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Subtotal', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[4], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Impuesto', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[5], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Total', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[6], '1', 1, 'R');

        // $this->response->setHeader('Content-Type', 'application/pdf');
        // $documento = $pdf->Output("", "I");

        $documento = $pdf->Output('Factura_' . Date("Y-m-d", time()) . '.pdf', 'S');

        $location = base_url();
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
        <td style="text-align: center; background: blue; color: white; height: 73px;" colspan="2">
        <h1><strong>.:Factura de compra:.</strong></h1>
        </td>
        </tr>
        <tr style="height: 188px;">
        <td style="height: 134px; text-align: center;" width="20%">Estinado cliente cliente: <b>' . $venta[1] . ' - ' . $venta[15] . '</b>, gracias por su compra</td>
        </tr>
        <tr style="height: 188px;">
        <td style="height: 51px; text-align: center;" width="20%"><a href=' . $location . '>Link de nuestro sistema.</a></td>
        </tr>
        </thead>
        </table>
        </body>
        </html>';

        $respuesta = $this->send_email->enviar_correo_WEB($venta[16], $html, "Factura de compra", $documento);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        exit();
    }

    public function EnviarCorreVenta()
    {

        $id = $this->request->getPost('id');

        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $venta = $this->reporte->DatosVentaWeb($id);
        $detalle = $this->reporte->DatoDetalleVentaWeb($id);
        /////////

        $pdf->SetTitle("Venta");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Venta", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode('FACTURA N°:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode($venta[8]));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 48,  utf8_decode($venta[12]));

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Cliente:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 54, utf8_decode($venta[1]));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Producto'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Precio'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Oferta'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Total'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(60, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["precio"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["sale"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["oferta"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, "$ " . utf8_decode($detalle[$i]["total"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(10);
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Subtotal', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[4], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Impuesto', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[5], '1', 1, 'R');
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Total', 1, 0);
        $pdf->Cell(60, 6, "$ " . $venta[6], '1', 1, 'R');

        $documento = $pdf->Output('Factura_' . Date("Y-m-d", time()) . '.pdf', 'S');

        $location = base_url();
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
        <td style="text-align: center; background: blue; color: white; height: 73px;" colspan="2">
        <h1><strong>.:Factura de compra:.</strong></h1>
        </td>
        </tr>
        <tr style="height: 188px;">
        <td style="height: 134px; text-align: center;" width="20%">Estinado cliente cliente: <b>' . $venta[1] . ' - ' . $venta[15] . '</b>, gracias por su compra</td>
        </tr>
        <tr style="height: 188px;">
        <td style="height: 51px; text-align: center;" width="20%"><a href=' . $location . '>Link de nuestro sistema.</a></td>
        </tr>
        </thead>
        </table>
        </body>
        </html>';

        $respuesta = $this->send_email->enviar_correo_WEB($venta[16], $html, "Factura de venta", $documento);
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        exit();
    }



    /////////////// MODULO REPORTES
    public function reporteventaModulo($fi, $ff)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $detalle = $this->reporte->DatosReporteVenta($fi, $ff);
        /////////

        $pdf->SetTitle("Reporte de Venta");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Reporte de venta", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode(""));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode(""));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha inicio:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 48,  utf8_decode($fi));

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Fecha fin:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 54, utf8_decode($ff));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(65, 12, utf8_decode('Producto'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Fecha'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(40, 12, utf8_decode('Total'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        $totalss = 0;
        for ($i = 0; $i < count($detalle); $i++) {

            $totalss = $totalss + $detalle[$i]["total"];
            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(65, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, utf8_decode($detalle[$i]["fecharegistro"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, utf8_decode($detalle[$i]["cantidad"]), 'B', 0, 'C', 1);
            $pdf->Cell(40, 8, "$ " . utf8_decode(number_format($detalle[$i]["total"], 2, ',', '.')), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(5);
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Total de venta', 1, 0);
        $pdf->Cell(60, 6, "$ " . number_format($totalss, 2, ',', '.'), '1', 1, 'R');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("reporte venta.pdf", "I");
    }

    public function reportecompraModulo($fi, $ff)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $detalle = $this->reporte->DatosReporteCompra($fi, $ff);
        /////////

        $pdf->SetTitle("Reporte de compra insumo");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Reporte de compra insumo", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode(""));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode(""));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha inicio:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 48,  utf8_decode($fi));

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Fecha fin:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 54, utf8_decode($ff));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(65, 12, utf8_decode('Producto'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Fecha'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(40, 12, utf8_decode('Total'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        $totalss = 0;
        for ($i = 0; $i < count($detalle); $i++) {

            $totalss = $totalss + $detalle[$i]["total"];
            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(65, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, utf8_decode($detalle[$i]["fechac"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, utf8_decode($detalle[$i]["cantidad"]), 'B', 0, 'C', 1);
            $pdf->Cell(40, 8, "$ " . utf8_decode(number_format($detalle[$i]["total"], 2, ',', '.')), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(5);
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Total de compra insumo', 1, 0);
        $pdf->Cell(60, 6, "$ " . number_format($totalss, 2, ',', '.'), '1', 1, 'R');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("reporte compra.pdf", "I");
    }

    public function reportecompraMaterialModulo($fi, $ff)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $detalle = $this->reporte->DatosReporteCompraMaterial($fi, $ff);
        /////////

        $pdf->SetTitle("Reporte de compra material");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Reporte de compra material", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode(""));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode(""));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha inicio:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 48,  utf8_decode($fi));

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Fecha fin:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 54, utf8_decode($ff));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(65, 12, utf8_decode('Producto'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Fecha'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(40, 12, utf8_decode('Total'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        $totalss = 0;
        for ($i = 0; $i < count($detalle); $i++) {

            $totalss = $totalss + $detalle[$i]["total"];
            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(65, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, utf8_decode($detalle[$i]["fechac"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, utf8_decode($detalle[$i]["cantidad"]), 'B', 0, 'C', 1);
            $pdf->Cell(40, 8, "$ " . utf8_decode(number_format($detalle[$i]["total"], 2, ',', '.')), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $pdf->Ln(5);
        $pdf->setX(95);
        $pdf->Cell(40, 6, 'Total de compra material', 1, 0);
        $pdf->Cell(60, 6, "$ " . number_format($totalss, 2, ',', '.'), '1', 1, 'R');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("reporte compra.pdf", "I");
    }

    public function reporteInsumo($id, $valor)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $detalle = $this->reporte->DatosReporteInsumos($id);
        /////////

        $pdf->SetTitle("Reporte de insumos");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Reporte de insumos", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode(""));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode(""));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Tipo:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(25, 48,  utf8_decode($valor));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(70, 12, utf8_decode('Insumo'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Codigo'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Precio'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Cantidad'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(70, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, utf8_decode($detalle[$i]["codigo"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, "$ " . utf8_decode($detalle[$i]["precio"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, utf8_decode($detalle[$i]["cantidad"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("reporte compra.pdf", "I");
    }

    public function ReporteMaterial($id, $valor)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $detalle = $this->reporte->DatosReporteMaterial($id);
        /////////

        $pdf->SetTitle("Reporte de material");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Reporte de material", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode(""));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode(""));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Tipo:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(25, 48,  utf8_decode($valor));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(70, 12, utf8_decode('Material'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Codigo'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Precio'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Cantidad'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(70, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, utf8_decode($detalle[$i]["codigo"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, "$ " . utf8_decode($detalle[$i]["precio"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, utf8_decode($detalle[$i]["cantidad"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("reporte material.pdf", "I");
    }

    public function ReportePlanta($id, $valor)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        $detalle = $this->reporte->DatosReportePlantas($id);
        /////////

        $pdf->SetTitle("Reporte de plantas");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Reporte de plantas", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode(""));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode(""));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Tipo:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(25, 48,  utf8_decode($valor));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(70, 12, utf8_decode('Planta'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Codigo'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Precio'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Cantidad'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(70, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, utf8_decode($detalle[$i]["codigo"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, "$ " . utf8_decode($detalle[$i]["precio"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, utf8_decode($detalle[$i]["cantidad"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("reporte plantas.pdf", "I");
    }

    public function ReporteCliente($id, $valor)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();

        if ($id == "cliente.createt") {
            $detalle = $this->reporte->DatosReporteClientesALL();
        } else {
            $detalle = $this->reporte->DatosReporteClientes($id);
        }

        /////////

        $pdf->SetTitle("Reporte de clientes");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Reporte de clientes", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode(""));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode(""));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Estado:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(30, 48,  utf8_decode($valor));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(70, 12, utf8_decode('Cliente'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Cedula'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Telefono'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Estado'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);
        $estado = "";

        for ($i = 0; $i < count($detalle); $i++) {

            if ($detalle[$i]["createt"] == '1') {
                $estado = "Tienda";
            } else {
                $estado = "Web";
            }

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(70, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8, utf8_decode($detalle[$i]["cedula"]), 'B', 0, 'C', 1);
            $pdf->Cell(35, 8,  utf8_decode($detalle[$i]["telefono"]), 'B', 0, 'C', 1);
            $pdf->Cell(30, 8, utf8_decode($estado), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("reporte cliente.pdf", "I");
    }

    public function ReporteOferta($fi, $ff)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();
        $detalle = $this->reporte->DatosReporteOferta($fi, $ff);

        /////////

        $pdf->SetTitle("Reporte de oferta");
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, "Reporte de oferta", 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode(""));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode(""));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha inicio:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 48,  utf8_decode($fi));

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Fecha fin:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 54, utf8_decode($ff));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(70, 12, utf8_decode('Producto'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Fecha inicio'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Fecha fin'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Tipo de oferta'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Descuento %'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);

        for ($i = 0; $i < count($detalle); $i++) {

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(70, 8, utf8_decode($detalle[$i]["nombre"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["fecha_inicio"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8,  utf8_decode($detalle[$i]["fecha_fin"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8,  utf8_decode($detalle[$i]["tipo_oferta"]), 'B', 0, 'C', 1);
            $pdf->Cell(25, 8, utf8_decode($detalle[$i]["valor_descuento"]), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("reporte oferta.pdf", "I");
    }

    public function ReporteProuccionModulo($fi, $ff)
    {
        $pdf = new \FPDF('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        ///llamo a los datos de la empresa
        $empresa = new Reporte();
        $datoempresa = $empresa->DatosEmpresaLLamer();
        $detalle = $this->reporte->DatosProduccion($fi, $ff);

        /////////

        $pdf->SetTitle(utf8_decode("Reporte de producción"));
        $pdf->Image(base_url() . 'public/img/empresa/waves.png', -10, -1, 110);
        $pdf->Image(base_url() . 'public/img/empresa/' . $datoempresa[7], 15, 0, 50);
        $pdf->SetFont('times', 'B', 13);
        $pdf->Text(90, 15, "Empresa: " . utf8_decode($datoempresa[1]), 1, '', 'C', 1);
        $pdf->Text(90, 21, "Direc: " . utf8_decode($datoempresa[2]), 1, '', 'C', 1);
        $pdf->Text(90, 27, "Telf: : " . utf8_decode($datoempresa[5]), 1, '', 'C', 1);
        $pdf->Text(90, 33, "Correo: " . utf8_decode($datoempresa[3]), 1, '', 'C', 1);
        $pdf->Text(90, 39, utf8_decode("Reporte de producción"), 1, '', 'C', 1);

        //información de # de factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(140, 48, utf8_decode(""));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(166, 48, utf8_decode(""));

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Text(15, 48, utf8_decode('Fecha inicio:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 48,  utf8_decode($fi));

        // Agregamos los datos de la factura
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Text(15, 54, utf8_decode('Fecha fin:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Text(40, 54, utf8_decode($ff));

        $pdf->Ln(50);

        $pdf->SetX(15);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(25, 132, 151);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(12, 12, utf8_decode('N°'), 0, 0, 'C', 1);
        $pdf->Cell(70, 12, utf8_decode('Producto'), 0, 0, 'C', 1);
        $pdf->Cell(20, 12, utf8_decode('Fecha inicio'), 0, 0, 'C', 1);
        $pdf->Cell(20, 12, utf8_decode('Fecha fin'), 0, 0, 'C', 1);
        $pdf->Cell(20, 12, utf8_decode('Dias'), 0, 0, 'C', 1);
        $pdf->Cell(20, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(20, 12, utf8_decode('Estado'), 0, 1, 'C', 1);

        $pdf->SetFont('Arial', '', 10);
        $estado = "";

        for ($i = 0; $i < count($detalle); $i++) {

            if ($detalle[$i]["estado"] == 1) {
                $estado = "Iniciado";
            } else {
                $estado = "Finalizado";
            }

            $pdf->SetX(15); //posicionamos en x

            if ($i % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232);
                $pdf->SetDrawColor(65, 61, 61);
            } else {
                $pdf->SetFillColor(255, 255, 255);
                $pdf->SetDrawColor(65, 61, 61);
            }

            $pdf->Cell(12, 8, $i + 1, 'B', 0, 'C', 1);
            $pdf->Cell(70, 8, utf8_decode($detalle[$i]["tipo"]), 'B', 0, 'C', 1);
            $pdf->Cell(20, 8, utf8_decode($detalle[$i]["fechaini"]), 'B', 0, 'C', 1);
            $pdf->Cell(20, 8,  utf8_decode($detalle[$i]["fechafin"]), 'B', 0, 'C', 1);
            $pdf->Cell(20, 8,  utf8_decode($detalle[$i]["dias"]), 'B', 0, 'C', 1);
            $pdf->Cell(20, 8,  utf8_decode($detalle[$i]["cantidad"]), 'B', 0, 'C', 1);
            $pdf->Cell(20, 8, utf8_decode($estado), 'B', 1, 'C', 1);
            $pdf->Ln(0.5);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("reporte produccion.pdf", "I");
    }
}
