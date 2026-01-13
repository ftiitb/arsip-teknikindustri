<?php
   $handler->loadModel("dtindividu_m"); 
  $individu = new Individu;
  
  $rs = $individu->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'dtindividu/'.$include_file;
  
  
?>