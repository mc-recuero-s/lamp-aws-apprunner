<?php

    header('Content-Type: application/json; charset=utf-8');
    require("../../../includes/auth.php");
    $user = require_bearer_token();
    $response=['success'=>true,'message'=>'Hecho.'];
    // obtener con JOIN para nombre de módulo
    $sql = "SELECT f.id,f.nombre,f.abreviatura,f.elemento,f.ver,f.editar,f.eliminar,f.modulo,m.nombre AS modulo_nombre
            FROM funcionalidad f
            JOIN modulo m ON f.modulo = m.id";
    $res = $conexion->query($sql);
    $data=[]; while($row=$res->fetch_assoc()) $data[]=$row;
    $response['data']=['data'=>$data];
    echo json_encode($response);
    exit;

?>