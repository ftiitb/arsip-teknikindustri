<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('kdsurat_m');
    $kodesurat = new KodeSurat;

    switch ($action){
        case 'read':
            echo $kodesurat->read($_POST);
            break;
        case 'create':
            echo $kodesurat->create($_POST);
            break;
        case 'update':
            echo $kodesurat->update($_POST);
            break;
        case 'destroy':
            echo $kodesurat->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $kodesurat->edit($_POST['id'],$_POST); 
          break; 
    }
?>