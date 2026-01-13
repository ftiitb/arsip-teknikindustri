<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('confsurmas_m');
    $confsurmas = new ConfigSurmas;

    switch ($action){
        case 'update':
            echo $confsurmas->update($_POST);
            break;         
        case 'edit':
			echo $confsurmas->edit($_POST['id'],$_POST); 
			break; 
    }
?>