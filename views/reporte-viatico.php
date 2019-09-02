<?php
include 'session.php';
include_once '../libs/plantilla.php';
require_once '../models/class.viaticos.php';

$listar = new Viaticos();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(200,30, utf8_decode('Listado de Viáticos'),0,0,'C');
$pdf->Ln(25); // Espaciado de lineas
$pdf->SetFillColor(112,186,255); // Color azul de la franja
$pdf->SetTextColor(240, 255, 240); // Color blanco del texto de la franja
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,10,'Id',1,0,'C',1);
$pdf->Cell(32,10,'Peaje',1,0,'C',1);
$pdf->Cell(32,10,'Comida',1,0,'C',1);
$pdf->Cell(40,10,'Combustible',1,0,'C',1);
$pdf->Cell(32,10,'Otros',1,0,'C',1);
$pdf->Cell(40,10,'Total',1,1,'C',1);

$pdf->SetFont('Arial','',10);

// Ejecutar script Listar
$data = $listar->Listar();

// Realiza recorrido de la tabla
foreach ($data as $key => $valor) {
    
    $pdf->SetTextColor(3, 3, 3);
    $pdf->Cell(15,10,$valor['id_viaticos'],1,0,'C');
    $pdf->Cell(32,10,$valor['peaje'],1,0,'C');
    $pdf->Cell(32,10,$valor['comida'],1,0,'C');
    $pdf->Cell(40,10,$valor['combustible'],1,0,'C');
    $pdf->Cell(32,10,$valor['otros'],1,0,'C');
    $pdf->Cell(40,10,$valor['total'],1,1,'C');
}

$pdf->Output();