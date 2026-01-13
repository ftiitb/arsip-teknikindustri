<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('arsipsurkel_m');
	$handler->loadModel('kdsurat_m');
	$handler->loadModel('kdarsip_m');
	$handler->loadModel('dtpejabat_m');
    $arsipsurkel = new ArsipSurkel;
	$cbsurat2 = new KodeSurat;
	$cbarsip2 = new KodeArsip;
	$cbpejabat2 = new Pejabat;
	
    switch ($action){
        case 'read':
            echo $arsipsurkel->read($_POST);
            break;
        case 'update':
            echo $arsipsurkel->update($_POST);
            break;
        case 'destroy':
            echo $arsipsurkel->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $arsipsurkel->edit($_POST['id'],$_POST); 
          break; 
        case 'readsurat':
            echo $cbsurat2->read($_POST);
            break;
        case 'readarsip':
            echo $cbarsip2->read($_POST);
            break;
		case 'readpejabat':
            echo $cbpejabat2->read($_POST);
            break;
    }
?>