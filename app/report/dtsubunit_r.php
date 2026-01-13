<?php
   $handler->loadModel("dtsubunit_m"); 
  $dtsubunit = new SubUnit;
  
  $rs = $dtsubunit->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'dtsubunit/'.$include_file;
  
  
?>