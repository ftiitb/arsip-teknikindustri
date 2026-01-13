<?php
   $handler->loadModel("dtinstruksi_m"); 
  $dtinstruksi = new Instruksi;
  
  $rs = $dtinstruksi->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'dtinstruksi/'.$include_file;
  
  
?>