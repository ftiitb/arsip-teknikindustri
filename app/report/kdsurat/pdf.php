<?php
require ABSPATH .'includes/fpdf/fpdf.php'; 

  $pdf=new FPDF('P','mm','A4');
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(40,10,'DAFTAR KODE SURAT KELUAR');
  $pdf->Ln(); 
  
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(10,7,'NO',1,0,'C');
  $pdf->Cell(30,7,'KODE SURAT',1,0,'C'); 
  $pdf->Cell(150,7,'DESKRIPSI',1,0,'C');
  $pdf->Ln(); 
  
  $pdf->SetFont('Arial', '', 10);
     
  $nourut=1;
  while ($row=$rs->FetchNextObject()) {
    $pdf->Cell(10,7,$nourut++,1,0,'C'); 
    $pdf->Cell(30,7,$row->KODESURAT,1); 
    $pdf->Cell(150,7,$row->DESKRIPSI,1); 
    $pdf->Ln();    
  }
  
  $pdf->Output();
?>