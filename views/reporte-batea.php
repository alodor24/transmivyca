<?php
include 'session.php';
include_once '../libs/plantilla.php';
require_once '../models/class.batea.php';

$listar = new Batea();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(200,30, 'Listado de Bateas',0,0,'C');
$pdf->Ln(25); // Espaciado de lineas
$pdf->SetFillColor(112,186,255); // Color azul de la franja
$pdf->SetTextColor(240, 255, 240); // Color blanco del texto de la franja
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,10,'Id',1,0,'C',1);
$pdf->Cell(40,10,utf8_decode('Matrícula'),1,0,'C',1);
$pdf->Cell(50,10,'Serial',1,0,'C',1);
$pdf->Cell(40,10,'Eje',1,0,'C',1);
$pdf->Cell(45,10,'Fecha Registro',1,1,'C',1);

$pdf->SetFont('Arial','',10);

// Ejecutar script Listar
$data = $listar->Listar();

// Realiza recorrido de la tabla
foreach ($data as $key => $valor) {
    
    $pdf->SetTextColor(3, 3, 3);
    $pdf->Cell(15,10,$valor['id_batea'],1,0,'C');
    $pdf->Cell(40,10,$valor['matricula_batea'],1,0,'C');
    $pdf->Cell(50,10,$valor['serial'],1,0,'C');
    $pdf->Cell(40,10,$valor['eje'],1,0,'C');
    $pdf->Cell(45,10,$valor['fecha_registro'],1,1,'C');
}

$pdf->Output();