<?php
require ABSPATH .'includes/fpdf/pdf.php'; 

$pdf=new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'AGENDA SURAT MASUK - TEKNIK INDUSTRI ITB',0,0,'C');
$pdf->Ln(); 
  
$pdf->SetFont('Arial', 'B', 10);
  
$pdf->Cell(28,7,'NOMOR',1,0,'C'); 
$pdf->Cell(21,7,'TANGGAL',1,0,'C'); 
$pdf->Cell(30,7,'DITUJUKAN',1,0,'C');
$pdf->Cell(35,7,'PENGIRIM',1,0,'C');
$pdf->Cell(45,7,'NOMOR',1,0,'C');
$pdf->Cell(21,7,'TANGGAL',1,0,'C');
$pdf->Cell(80,7,'PERIHAL',1,0,'C');
$pdf->Cell(15,7,'ARSIP',1,0,'C');
$pdf->Ln(); 
  
$pdf->SetFont('Arial', '', 10);

$order   = array("\r\n", "\n", "\r");
$replace = ' ';

$pdf->SetWidths(array(28,21,30,35,45,21,80,15));
$pdf->SetAligns(array('C','C','L','L','L','C','L','C'));

while ($row=$rs->FetchNextObject()) {
  	if ($row->NOMOR<100){
		$nomor_pad=str_pad($row->NOMOR, 3,"000",STR_PAD_LEFT);
	}else{
		$nomor_pad=$row->NOMOR;
	}
	$Col1=$nomor_pad.'/'.$row->KODEARSIP.'/'.$row->TAHUN;
	$Col2=date_format(date_create($row->TANGGALTERIMA), 'd/m/Y');
	$Col3=str_replace($order, $replace, $row->DITUJUKAN);
	$Col4=str_replace($order, $replace, $row->PENGIRIM);
	$Col5=str_replace($order, $replace, $row->NOMORSURAT);
	$Col6=date_format(date_create($row->TANGGALSURAT), 'd/m/Y');
	$Col7=str_replace($order, $replace, $row->PERIHAL);
	$Col8=$row->KODEARSIP;
	
	$pdf->Row(array($Col1,$Col2,$Col3,$Col4,$Col5,$Col6,$Col7,$Col8));

}
  
$pdf->Output();

?>