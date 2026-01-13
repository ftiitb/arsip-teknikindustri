<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('arsipsurmas_m');
	$handler->loadModel('kdarsip_m');
    $arsipsurmas = new ArsipSurmas;
	$cbarsipsurmas2 = new KodeArsip;

    switch ($action){
        case 'read':
            echo $arsipsurmas->read($_POST);
            break;
        case 'create':
            echo $arsipsurmas->create($_POST);
            break;
        case 'update':
            echo $arsipsurmas->update($_POST);
            break;
        case 'destroy':
            echo $arsipsurmas->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $arsipsurmas->edit($_POST['id'],$_POST); 
          break;
        case 'readarsip':
            echo $cbarsipsurmas2->read($_POST);
            break;		  
    }
?>