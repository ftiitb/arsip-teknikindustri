<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('dtpejabat_m');
    $pejabat = new Pejabat;

    switch ($action){
        case 'read':
            echo $pejabat->read($_POST);
            break;
        case 'create':
            echo $pejabat->create($_POST);
            break;
        case 'update':
            echo $pejabat->update($_POST);
            break;
        case 'destroy':
            echo $pejabat->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $pejabat->edit($_POST['id'],$_POST); 
          break; 
    }
?>