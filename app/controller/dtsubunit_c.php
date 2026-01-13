<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('dtsubunit_m');
    $dtsubunit = new SubUnit;

    switch ($action){
        case 'read':
            echo $dtsubunit->read($_POST);
            break;
        case 'create':
            echo $dtsubunit->create($_POST);
            break;
        case 'update':
            echo $dtsubunit->update($_POST);
            break;
        case 'destroy':
            echo $dtsubunit->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $dtsubunit->edit($_POST['id'],$_POST); 
          break; 
    }
?>