<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('dtindividu_m');
    $individu = new Individu;

    switch ($action){
        case 'read':
            echo $individu->read($_POST);
            break;
        case 'create':
            echo $individu->create($_POST);
            break;
        case 'update':
            echo $individu->update($_POST);
            break;
        case 'destroy':
            echo $individu->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $individu->edit($_POST['id'],$_POST); 
          break; 
    }
?>