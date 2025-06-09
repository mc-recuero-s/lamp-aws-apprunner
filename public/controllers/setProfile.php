<?php
    session_start();
    header('Content-Type: application/json');
    if(empty($_SESSION['user'])||!in_array($_POST['type'],['superadmin','banco','bodega'])){
        echo json_encode(['success'=>false]); exit;
    }
    switch($_POST['type']){
    case 'superadmin':
        $_SESSION['current_profile']=['type'=>'superadmin','id'=>null];
        break;
    case 'banco':
        $_SESSION['current_profile']=['type'=>'banco','id'=>intval($_POST['id'])];
        break;
    case 'bodega':
        $_SESSION['current_profile']=['type'=>'bodega','id'=>intval($_POST['id'])];
        break;
    }
    unset($_SESSION['permissions']);
    echo json_encode(['success'=>true]);
?>