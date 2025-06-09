<?php
    header('Content-Type: application/json; charset=utf-8');
    require '../../../includes/auth.php';
    $user = require_bearer_token();
    $id=intval($_GET['id']??0);
    $stmt=$conexion->prepare("SELECT id,nombre,codigo,banco FROM bodegas WHERE id=?");
    $stmt->bind_param('i',$id); $stmt->execute();
    $data=$stmt->get_result()->fetch_assoc();
    echo json_encode(['success'=>true,'message'=>'','data'=>$data]);
?>