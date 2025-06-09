<?php
    header('Content-Type: application/json; charset=utf-8');
    require("../../../includes/auth.php");
    $user = require_bearer_token();
    $sql = "SELECT s.id,s.nombre,s.abreviatura,s.elemento,p.nombre AS parent_name
            FROM modulo s
            JOIN modulo p ON s.modulo = p.id
            WHERE s.modulo IS NOT NULL
            ORDER BY p.id, s.id";
    $res = $conexion->query($sql);
    $data = [];
    while($row = $res->fetch_assoc()) $data[] = $row;
    echo json_encode(['success'=>true,'message'=>'','data'=>['data'=>$data]]);
?>