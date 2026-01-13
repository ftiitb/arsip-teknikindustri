<?php
   $handler->loadModel("kdarsip_m"); 
  $kodearsip = new KodeArsip;
  
  $rs = $kodearsip->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'kdarsip/'.$include_file;
  
  
?>