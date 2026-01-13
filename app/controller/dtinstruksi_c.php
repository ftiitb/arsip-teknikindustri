<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('dtinstruksi_m');
    $dtinstruksi = new Instruksi;

    switch ($action){
        case 'read':
            echo $dtinstruksi->read($_POST);
            break;
        case 'create':
            echo $dtinstruksi->create($_POST);
            break;
        case 'update':
            echo $dtinstruksi->update($_POST);
            break;
        case 'destroy':
            echo $dtinstruksi->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $dtinstruksi->edit($_POST['id'],$_POST); 
          break; 
    }
?>