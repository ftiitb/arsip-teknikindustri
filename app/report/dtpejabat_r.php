<?php
   $handler->loadModel("dtpejabat_m"); 
  $pejabat = new Pejabat;
  
  $rs = $pejabat->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'dtpejabat/'.$include_file;
  
  
?>