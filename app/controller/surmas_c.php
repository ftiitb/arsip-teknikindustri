<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('surmas_m');
	$handler->loadModel('kdarsip_m');
	$handler->loadModel('dtsubunit_m');
    $surmas = new Surmas;
	$cbarsipsurmas = new KodeArsip;
	$dsSubunit = new SubUnit;
	
    switch ($action){
        case 'read':
            echo $surmas->read($_POST);
            break;
        case 'create':
            echo $surmas->create($_POST);
            break;
        case 'update':
            echo $surmas->update($_POST);
            break;
		case 'updatedisposisi':
            echo $surmas->updatedisposisi($_POST);
            break;
        case 'destroy':
            echo $surmas->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $surmas->edit($_POST['id'],$_POST); 
          break;
        case 'readarsip':
            echo $cbarsipsurmas->read($_POST);
            break;	
		case 'readSubunit':
            echo $dsSubunit->read($_POST);
            break;
    }
?>