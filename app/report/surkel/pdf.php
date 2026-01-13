<?php
require ABSPATH .'includes/fpdf/pdf.php'; 

$pdf=new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'AGENDA SURAT KELUAR - TEKNIK INDUSTRI ITB',0,0,'C');
$pdf->Ln(12);
  
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(45,7,'NOMOR',1,0,'C'); 
$pdf->Cell(20,7,'TANGGAL',1,0,'C'); 
$pdf->Cell(40,7,'DITUJUKAN',1,0,'C');
$pdf->Cell(120,7,'PERIHAL',1,0,'C');  
$pdf->Cell(40,7,'PENGIRIM',1,0,'C');
$pdf->Cell(15,7,'ARSIP',1,0,'C');
$pdf->Ln(); 
  
$pdf->SetFont('Arial', '', 10);
     
$order   = array("\r\n", "\n", "\r");
$replace = ' ';

$pdf->SetWidths(array(45,20,40,120,40,15));
$pdf->SetAligns(array('C','C','L','L','L','C'));

while ($row=$rs->FetchNextObject()) {
  
	if ($row->NOMOR<100){
		$nomor_pad=str_pad($row->NOMOR, 3,"000",STR_PAD_LEFT);
	}else{
		$nomor_pad=$row->NOMOR;
	}
	
	$Col1=$nomor_pad.'/'.$row->KODESURAT.'/'.$row->KODEARSIP.'/'.$row->TAHUN; 
    $Col2=date_format(date_create($row->TANGGAL), 'd/m/Y'); 
    $Col3=str_replace($order, $replace, $row->DITUJUKAN); 
    $Col4=str_replace($order, $replace, $row->PERIHAL); 
    $Col5=str_replace($order, $replace, $row->PENGIRIM); 
    $Col6=$row->KODEARSIP; 

	$pdf->Row(array($Col1,$Col2,$Col3,$Col4,$Col5,$Col6));
	
}
  
$pdf->Output();

?>