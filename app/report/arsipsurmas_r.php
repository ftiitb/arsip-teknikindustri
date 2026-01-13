<?php
   $handler->loadModel("arsipsurmas_m"); 
  $arsipsurmas = new ArsipSurmas;
  
  $rs = $arsipsurmas->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'surmas/'.$include_file;
  
  
?>