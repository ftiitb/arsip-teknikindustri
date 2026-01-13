<?php
   $handler->loadModel("surkel_m"); 
  $surkel = new Surkel;
  
  $rs = $surkel->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'surkel/'.$include_file;
  
  
?>