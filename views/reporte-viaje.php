<?php
include 'session.php';
include_once '../libs/plantilla.php';
require_once '../models/class.asignar-viaje.php';

$listar = new AsignarViaje();

$pdf = new PDF('L', 'mm', 'A3');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(400,30, utf8_decode('Listado de Asignación de Viajes'),0,0,'C');
$pdf->Ln(25); // Espaciado de lineas
$pdf->SetFillColor(112,186,255); // Color azul de la franja
$pdf->SetTextColor(240, 255, 240); // Color blanco del texto de la franja
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,10,'Id',1,0,'C',1);
$pdf->Cell(35,10,utf8_decode('Número Guía'),1,0,'C',1);
$pdf->Cell(100,10,'Chofer',1,0,'C',1);
$pdf->Cell(55,10,'Origen',1,0,'C',1);
$pdf->Cell(55,10,'Destino',1,0,'C',1);
$pdf->Cell(100,10,'Cliente',1,0,'C',1);
$pdf->Cell(35,10,'Fecha',1,1,'C',1);

$pdf->SetFont('Arial','',10);

// Ejecutar script Listar
$data = $listar->Listar();

// Realiza recorrido de la tabla
foreach ($data as $key => $valor) {
    
    $pdf->SetTextColor(3, 3, 3);
    $pdf->Cell(15,10,$valor['id_viaje'],1,0,'C');
    $pdf->Cell(35,10,$valor['numero_guia'],1,0,'C');
    $pdf->Cell(100,10,utf8_decode($valor['nombre'] ." ". $valor['apellido']),1,0,'C');
    $pdf->Cell(55,10,utf8_decode($valor['origen']),1,0,'C');
    $pdf->Cell(55,10,utf8_decode($valor['destino']),1,0,'C');
    $pdf->Cell(100,10,utf8_decode($valor['razon_social']),1,0,'C');
    $pdf->Cell(35,10,utf8_decode($valor['fecha']),1,1,'C');
}

$pdf->Output();