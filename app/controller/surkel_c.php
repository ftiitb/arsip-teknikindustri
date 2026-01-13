<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('surkel_m');
	$handler->loadModel('kdsurat_m');
	$handler->loadModel('kdarsip_m');
	$handler->loadModel('dtpejabat_m');
    $surkel = new Surkel;
	$cbsurat = new KodeSurat;
	$cbarsip = new KodeArsip;
	$cbpejabat = new Pejabat;

    switch ($action){
        case 'read':
            echo $surkel->read($_POST);
            break;
        case 'create':
            echo $surkel->create($_POST);
            break;
        case 'update':
            echo $surkel->update($_POST);
            break;
        case 'destroy':
            echo $surkel->destroy($_POST['data']);
            break;            
        case 'edit':
			echo $surkel->edit($_POST['id'],$_POST); 
			break; 
        case 'readsurat':
            echo $cbsurat->read($_POST);
            break;
        case 'readarsip':
            echo $cbarsip->read($_POST);
            break;
		case 'readpejabat':
            echo $cbpejabat->read($_POST);
            break;
    }
?>