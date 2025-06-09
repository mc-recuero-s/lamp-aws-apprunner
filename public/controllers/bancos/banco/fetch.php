<?php
    header('Content-Type: application/json; charset=utf-8');
    require '../../../includes/auth.php';
    $user = require_bearer_token();
    $result="";

    if($user["banco"]==NULL){
        $result=$conexion->query("SELECT id,nombre,logo,colores,estilos FROM banco");
    }else{
        $result = $conexion->query("SELECT id, nombre, logo, colores, estilos FROM banco WHERE id=" . intval($user['banco']));
    }
    $response=['success'=>true,'message'=>'Hecho.'];
    $data=[]; while($row=$result->fetch_assoc()) $data[]=$row;
    $response['data']=$data;
    echo json_encode($response);
?>