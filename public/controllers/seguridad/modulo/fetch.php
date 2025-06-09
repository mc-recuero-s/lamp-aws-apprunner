<?php

    header('Content-Type: application/json; charset=utf-8');
    require("../../../includes/auth.php");
    $user = require_bearer_token();
    $response=['success'=>true,'message'=>'Hecho.'];
    $result=$conexion->query("SELECT id,nombre,abreviatura,elemento,modulo FROM modulo WHERE modulo IS NULL");
    $data=[]; while($row=$result->fetch_assoc()) $data[]=$row;
    $response['data']=['data'=>$data];
    echo json_encode($response);
    exit;

?>