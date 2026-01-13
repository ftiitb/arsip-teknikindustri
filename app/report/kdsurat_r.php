<?php
   $handler->loadModel("kdsurat_m"); 
  $kodesurat = new KodeSurat;
  
  $rs = $kodesurat->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'kdsurat/'.$include_file;
  
  
?>