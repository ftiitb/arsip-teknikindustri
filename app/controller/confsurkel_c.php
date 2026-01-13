<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('confsurkel_m');
    $confsurkel = new ConfigSurkel;

    switch ($action){
        case 'update':
            echo $confsurkel->update($_POST);
            break;         
        case 'edit':
			echo $confsurkel->edit($_POST['id'],$_POST); 
			break; 
    }
?>