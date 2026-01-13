<?php

  require_once ABSPATH .'includes/PHPExcel/PHPExcel.php';
  
    // Create new PHPExcel object
  $objPHPExcel = new PHPExcel();
  
  // Set properties
  $objPHPExcel->getProperties()->setCreator("sisfoArsip")
  							 ->setLastModifiedBy("sisfoArsip")
  							 ->setTitle("Office 2007 XLSX Test Report Document")
  							 ->setSubject("Office 2007 XLSX Test Report Document")
  							 ->setDescription("Test Report for Office 2007 XLSX, generated using PHP classes.")
  							 ->setKeywords("office 2007 openxml php")
  							 ->setCategory("Test Report result file");
  
  	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("A")->setWidth(22);
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("B")->setWidth(10);
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("C")->setWidth(20);
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("D")->setWidth(40);
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("E")->setWidth(20);
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("F")->setWidth(7);

  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A1', 'NOMOR')
              ->setCellValue('B1', 'TANGGAL')
              ->setCellValue('C1', 'DITUJUKAN')
              ->setCellValue('D1', 'PERIHAL')
              ->setCellValue('E1', 'PENGIRIM')
              ->setCellValue('F1', 'ARSIP'); 

  $index = 2;             
  while ($row=$rs->FetchNextObject()) {
    if ($row->NOMOR<100){
		$nomor_pad=str_pad($row->NOMOR, 3,"000",STR_PAD_LEFT);
	}else{
		$nomor_pad=$row->NOMOR;
	}
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$index, $nomor_pad.'/'.$row->KODESURAT.'/'.$row->KODEARSIP.'/'.$row->TAHUN)
                ->setCellValue('B'.$index, $row->TANGGAL)
                ->setCellValue('C'.$index, $row->DITUJUKAN)
                ->setCellValue('D'.$index, $row->PERIHAL)
                ->setCellValue('E'.$index, $row->PENGIRIM)
                ->setCellValue('F'.$index, $row->KODEARSIP);  
    $index++;                              
  }
              
              
              
  // Rename sheet
  $objPHPExcel->getActiveSheet()->setTitle('Report');
  
  
  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);
  
  
  // Redirect output to a client’s web browser (Excel2007)
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header('Content-Disposition: attachment;filename="SURATKELUAR.xlsx"');
  header('Cache-Control: max-age=0');
  
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save('php://output');
  exit;
  
  

