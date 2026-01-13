<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('kdarsip_m');
    $kodearsip = new KodeArsip;

    switch ($action){
        case 'read':
            echo $kodearsip->read($_POST);
            break;
        case 'create':
            echo $kodearsip->create($_POST);
            break;
        case 'update':
            echo $kodearsip->update($_POST);
            break;
        case 'destroy':
            echo $kodearsip->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $kodearsip->edit($_POST['id'],$_POST); 
          break; 
    }
?>