<?php
include 'session.php';
include_once '../libs/plantilla.php';
require_once '../models/class.chuto.php';

$listar = new Chuto();

$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(280,30, 'Listado de Chutos',0,0,'C');
$pdf->Ln(25); // Espaciado de lineas
$pdf->SetFillColor(112,186,255); // Color azul de la franja
$pdf->SetTextColor(240, 255, 240); // Color blanco del texto de la franja
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,10,'Id',1,0,'C',1);
$pdf->Cell(30,10,utf8_decode('Matrícula'),1,0,'C',1);
$pdf->Cell(40,10,'Marca',1,0,'C',1);
$pdf->Cell(30,10,'Modelo',1,0,'C',1);
$pdf->Cell(30,10,'Color',1,0,'C',1);
$pdf->Cell(25,10,'Eje',1,0,'C',1);
$pdf->Cell(25,10,utf8_decode('Año'),1,0,'C',1);
$pdf->Cell(40,10,'Serial Motor',1,0,'C',1);
$pdf->Cell(45,10,utf8_decode('Serial Carrocería'),1,1,'C',1);

$pdf->SetFont('Arial','',10);

// Ejecutar script Listar
$data = $listar->Listar();

// Realiza recorrido de la tabla
foreach ($data as $key => $valor) {
    
    $pdf->SetTextColor(3, 3, 3);
    $pdf->Cell(15,10,$valor['id_chuto'],1,0,'C');
    $pdf->Cell(30,10,$valor['matricula_chuto'],1,0,'C');
    $pdf->Cell(40,10,utf8_decode($valor['marca']),1,0,'C');
    $pdf->Cell(30,10,utf8_decode($valor['modelo']),1,0,'C');
    $pdf->Cell(30,10,utf8_decode($valor['color']),1,0,'C');
    $pdf->Cell(25,10,$valor['eje'],1,0,'C');
    $pdf->Cell(25,10,$valor['annio'],1,0,'C');
    $pdf->Cell(40,10,$valor['serial_motor'],1,0,'C');
    $pdf->Cell(45,10,$valor['serial_carroceria'],1,1,'C');
}

$pdf->Output();