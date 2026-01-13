<?php
   $handler->loadModel("arsipsurkel_m"); 
  $arsipsurkel = new ArsipSurkel;
  
  $rs = $arsipsurkel->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'surkel/'.$include_file;
  
  
?>