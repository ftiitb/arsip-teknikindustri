<?php
require ABSPATH .'includes/fpdf/fpdf.php'; 

  $pdf=new FPDF('P','mm','A4');
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(40,10,'DAFTAR INDIVIDU');
  $pdf->Ln(); 
  
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(10,7,'NO',1,0,'C');
  $pdf->Cell(80,7,'NAMA',1,0,'C'); 
  $pdf->Cell(80,7,'EMAIL',1,0,'C');
  $pdf->Cell(20,7,'STATUS',1,0,'C');
  $pdf->Ln(); 
  
  $pdf->SetFont('Arial', '', 10);
  
  $nourut=1;
  while ($row=$rs->FetchNextObject()) {
    $pdf->Cell(10,7,$nourut++,1,0,'C'); 
    $pdf->Cell(80,7,$row->NAMA,1); 
    $pdf->Cell(80,7,$row->EMAIL,1); 
    $pdf->Cell(20,7,$row->STATUS,1); 
    $pdf->Ln();   
  }
  
  $pdf->Output();
?>