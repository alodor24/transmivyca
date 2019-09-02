<?php
require_once 'fpdf/fpdf.php';
	
class PDF extends FPDF {
    
    function Header() {
        $this->Image('../views/images/logo.png', 10, 10, 50);
        $this->SetFont('Arial','B',18);
        $this->Cell(40);
        $this->Ln(15);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','B', 10);
        $this->SetTextColor(3, 3, 3);
        $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }		
}