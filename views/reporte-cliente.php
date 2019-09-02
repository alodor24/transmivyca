<?php
include 'session.php';
include_once '../libs/plantilla.php';
require_once '../models/class.cliente.php';

$listar = new Cliente();

$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(270,30, 'Listado de Clientes',0,0,'C');
$pdf->Ln(25); // Espaciado de lineas
$pdf->SetFillColor(112,186,255); // Color azul de la franja
$pdf->SetTextColor(240, 255, 240); // Color blanco del texto de la franja
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,10,'Id',1,0,'C',1);
$pdf->Cell(30,10,'Rif',1,0,'C',1);
$pdf->Cell(70,10,utf8_decode('Razón Social'),1,0,'C',1);
$pdf->Cell(55,10,utf8_decode('Dirección'),1,0,'C',1);
$pdf->Cell(35,10,utf8_decode('Teléfono'),1,0,'C',1);
$pdf->Cell(70,10,'Responsable',1,1,'C',1);

$pdf->SetFont('Arial','',10);

// Ejecutar script Listar
$data = $listar->Listar();

// Realiza recorrido de la tabla
foreach ($data as $key => $valor) {
    
    $pdf->SetTextColor(3, 3, 3);
    $pdf->Cell(15,10,$valor['id_cliente'],1,0,'C');
    $pdf->Cell(30,10,$valor['rif'],1,0,'C');
    $pdf->Cell(70,10,utf8_decode($valor['razon_social']),1,0,'C');
    $pdf->Cell(55,10,utf8_decode($valor['direccion']),1,0,'C');
    $pdf->Cell(35,10,$valor['telefono'],1,0,'C');
    $pdf->Cell(70,10,utf8_decode($valor['responsable']),1,1,'C');
}

$pdf->Output();