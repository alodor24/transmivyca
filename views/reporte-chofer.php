<?php
include 'session.php';
include_once '../libs/plantilla.php';
require_once '../models/class.chofer.php';

$listar = new Chofer();

$pdf = new PDF('L','mm','A3');
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Cell(410,30, 'Listado de Choferes',0,0,'C');
$pdf->Ln(25); // Espaciado de lineas
$pdf->SetFillColor(112,186,255); // Color azul de la franja
$pdf->SetTextColor(240, 255, 240); // Color blanco del texto de la franja
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,10,'Id',1,0,'C',1);
$pdf->Cell(30,10,utf8_decode('Cédula'),1,0,'C',1);
$pdf->Cell(50,10,'Nombre',1,0,'C',1);
$pdf->Cell(50,10,'Apellido',1,0,'C',1);
$pdf->Cell(50,10,utf8_decode('Dirección'),1,0,'C',1);
$pdf->Cell(35,10,utf8_decode('Teléfono'),1,0,'C',1);
$pdf->Cell(60,10,'Vencimiento Licencia',1,0,'C',1);
$pdf->Cell(70,10,utf8_decode('Vencimiento Certificado Médico'),1,0,'C',1);
$pdf->Cell(40,10,'Fecha Ingreso',1,1,'C',1);

$pdf->SetFont('Arial','',10);

// Ejecutar script Listar
$data = $listar->Listar();

// Realiza recorrido de la tabla
foreach ($data as $key => $valor) {
    
    $pdf->SetTextColor(3, 3, 3);
    $pdf->Cell(15,10,$valor['id_chofer'],1,0,'C');
    $pdf->Cell(30,10,$valor['cedula'],1,0,'C');
    $pdf->Cell(50,10,utf8_decode($valor['nombre']),1,0,'C');
    $pdf->Cell(50,10,utf8_decode($valor['apellido']),1,0,'C');
    $pdf->Cell(50,10,utf8_decode($valor['direccion']),1,0,'C');
    $pdf->Cell(35,10,$valor['telefono'],1,0,'C');
    $pdf->Cell(60,10,$valor['fecha_vencimiento_licencia'],1,0,'C');
    $pdf->Cell(70,10,$valor['fecha_vencimiento_certificado_medico'],1,0,'C');
    $pdf->Cell(40,10,$valor['fecha_ingreso'],1,1,'C');
}

$pdf->Output();