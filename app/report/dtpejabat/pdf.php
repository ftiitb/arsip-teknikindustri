<?php
require ABSPATH .'includes/fpdf/fpdf.php'; 

  $pdf=new FPDF('P','mm','A4');
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(40,10,'DAFTAR PEJABAT');
  $pdf->Ln(); 
  
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(10,7,'NO',1,0,'C');
  $pdf->Cell(80,7,'JABATAN',1,0,'C'); 
  $pdf->Cell(70,7,'NAMA PEJABAT',1,0,'C');
    $pdf->Cell(30,7,'NIP',1,0,'C');
  $pdf->Ln(); 
  
  $pdf->SetFont('Arial', '', 10);
     
  $nourut=1;
  while ($row=$rs->FetchNextObject()) {
    $pdf->Cell(10,7,$nourut++,1,0,'C'); 
    $pdf->Cell(80,7,$row->JABATAN,1); 
    $pdf->Cell(70,7,$row->NAMAPEJABAT,1); 
    $pdf->Cell(30,7,$row->NIPPEJABAT,1); 
    $pdf->Ln();    
  }
  
  $pdf->Output();
?>