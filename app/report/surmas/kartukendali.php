<?php
require ABSPATH .'includes/fpdf/fpdf.php'; 

$pdf=new FPDF('L','mm','A4');
$pdf->SetRightMargin(153.5);
$pdf->AddPage();

printHeader($pdf);
printBodyHead($pdf);
//lets print from recordset $rs
$pdf->SetY(31);
$pdf->SetFont('Arial', '', 10);
$row=$rs->FetchNextObject();
$pdf->Cell(40);
$pdf->Cell(32,6,'','B',0);
  	if ($row->NOMOR<100){
		$nomor_pad=str_pad($row->NOMOR, 3,"000",STR_PAD_LEFT);
	}else{
		$nomor_pad=$row->NOMOR;
	}
$pdf->Cell(0,6,$nomor_pad.'/SRT.MASUK/'.$row->KODEARSIP.'/'.$row->TAHUN,'B',1);
$pdf->Cell(40);
$pdf->Cell(32,6,'','B',0);
$pdf->Cell(0,6,date_format(date_create($row->TANGGALTERIMA, new DateTimeZone('Asia/Jakarta')), 'd F Y'),'B',1);
$pdf->Cell(40);
$pdf->Cell(0,0.3,'','BT',1);//bottom space
$pdf->Cell(40);
$pdf->Cell(32,6,'','B',0);
$pdf->Cell(0,6,$row->PENGIRIM,'B',1);
$pdf->Cell(40);
$pdf->Cell(32,6,'','B',0);
$pdf->Cell(0,6,$row->NOMORSURAT,'B',1);
$pdf->Cell(40);
$pdf->Cell(32,6);
$pdf->Cell(43,6,date_format(date_create($row->TANGGALSURAT), 'd F Y'));

$pdf->SetY(64);
$pdf->Cell(32);
$pdf->MultiCell(100,4,$row->PERIHAL,0,'J');
//print rs3
$pdf->SetY(86);
$nourut=1;
while ($row=$rs3->FetchNextObject()) {
	$pdf->Cell(42);//left space
	$pdf->Cell(7,6,$nourut++.'.',0,0,'C');
	$pdf->Cell(0,6,$row->INSTRUKSI,0,1);
}
$pdf->Cell(42);//left space
$pdf->Cell(7,6,$nourut++.'.',0,0,'C');
$pdf->Cell(0,10,'..........................................................................');
//print rs2
$pdf->SetY(86);
$pdf->SetFont('Arial', '', 10);
$nourut=1;
$aurut='a';
$hasprintgroup=false;
while ($row=$rs2->FetchNextObject()) {
    if(stristr($row->SUBUNIT, 'Koordinator') === FALSE) {
		$pdf->Cell(2);//left space
		$pdf->Cell(5,6,$nourut++.'.',0,0,'C');
		$pdf->Cell(40,6,$row->SUBUNIT,0,1);		
	}else{
		if (!$hasprintgroup){
			$hasprintgroup=true;
			$pdf->Cell(2);//left space
			$pdf->Cell(5,6,$nourut++.'.',0,0,'C');
			$pdf->Cell(40,6,'Koordinator',0,1);
		}
		$pdf->Cell(5);//left space
		$strgroup=str_replace("Koordinator", "", $row->SUBUNIT);
		$pdf->Cell(5,6,$aurut++.'.',0,0,'C');
		$pdf->Cell(40,6,$strgroup,0,1);
	}
}
$pdf->Cell(40,10,'..................................',0,0,'C');
$pdf->Ln();
printFooter($pdf);
$pdf->Rect(10, 10, 133.5, 190 ,'D');
$pdf->Line(50,77,50,180);
$pdf->Output();

//----------------------->function<----------------------------------
function printHeader($pdf){
	//logo
	$pdf->Image('images/logo.jpg',15,12,0,17);
	//spacertop
	$pdf->Cell(0,5);
	$pdf->Ln();
	//departement
	$pdf->Cell(19);//left space after logo
	$pdf->SetFont('Times', 'B', 12);
	$pdf->Cell(0,4,'PROGRAM STUDI TEKNIK INDUSTRI');
	$pdf->Ln();
	//company
	$pdf->Cell(19);//left space after logo
	$pdf->SetFont('Times', 'B', 14);
	$pdf->Cell(0,5,'INSTITUT TEKNOLOGI BANDUNG');
	$pdf->Ln();
	//information
	$pdf->Cell(19);//left space after logo
	$pdf->SetFont('Times', '', 9);
	$pdf->Cell(0,6,'Jl. Ganesha No.10 Bandung 40132 Labtek III Telp: (022) 2514189 Fax: (022) 2509164');
	$pdf->Ln();
	//spacerbottom
	//$pdf->Cell(0,1);
	//$pdf->Ln();
	$pdf->Cell(0,0.3,'','BT');
	$pdf->Ln();
}
function printBodyHead($pdf){
//document name
	$pdf->SetFont('Times','B', 15);
	$pdf->Cell(40,31.5,'DISPOSISI','TRB',0,'C');
//print fieldname
	$pdf->SetFont('Arial','B', 10);
	$pdf->Cell(0,0.5);//up space
	$pdf->Ln();
	$pdf->Cell(42);//left space after document name
	$pdf->Cell(27,6,'Nomor Agenda');
	$pdf->Cell(3,6,':',0,1,'C');
	$pdf->Cell(42);
	$pdf->Cell(27,6,'Tanggal Terima',0);
	$pdf->Cell(3,6,':',0,1,'C');
	$pdf->Cell(42);
	$pdf->Cell(0,0.5,'',0,1);//bottom space
	$pdf->Cell(42);
	$pdf->Cell(27,6,'Asal Surat',0);
	$pdf->Cell(3,6,':',0,1,'C');
	$pdf->Cell(42);
	$pdf->Cell(27,6,'Nomor Surat',0);
	$pdf->Cell(3,6,':',0,1,'C');
	$pdf->Cell(42);
	$pdf->Cell(27,6,'Tanggal Surat',0);
	$pdf->Cell(3,6,':',0,1,'C');
	$pdf->Cell(40);
	$pdf->Cell(0,0.5);//bottom space
	$pdf->Ln();
	
	$pdf->Cell(0,1,'','T');//up space
	$pdf->Ln();
	$pdf->Cell(2);//left space
	$pdf->Cell(27,6,'Perihal Surat');
	$pdf->Cell(3,6,':',0,1,'C');
	$pdf->Cell(0,8,'','B');//bottom space
	$pdf->Ln();
	$pdf->Cell(2);//left space
	$pdf->Cell(38,8,'Diteruskan kepada');
	$pdf->Cell(0,8,'INSTRUKSI / INFORMASI',0,0,'C');
	$pdf->Ln();
	$pdf->Cell(0,1,'','T');//up space
}
function printFooter($pdf){
	$pdf->Cell(0,2,'','T',1);
	$pdf->Cell(2);//left space
	$pdf->Cell(0,5,'Catatan :');
}
  
?>