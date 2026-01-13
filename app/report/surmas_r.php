<?php
$handler->loadModel("surmas_m");
$handler->loadModel("dtsubunit_m");
$handler->loadModel("dtinstruksi_m");
$surmas = new Surmas;
$subunit = new SubUnit;
$instruksi = new Instruksi;

if ($_POST['mode']=='kendali'){

	$rs = $surmas->doReport2($_POST['id'],$_POST);
	$rs2 = $subunit->doReport($_POST);
	$rs3 = $instruksi->doReport($_POST);
	
	include 'surmas/kartukendali.php';

}else{
	   
	$rs = $surmas->doReport($_POST); 
	  
	$include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
	  
	include 'surmas/'.$include_file;
}
  
?>