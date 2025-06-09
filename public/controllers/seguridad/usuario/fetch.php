<?php

    require("../../../includes/auth.php");
    $user = require_bearer_token();

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';

    header('Content-Type: application/json');
    $mysqli = new mysqli('localhost','root','',$base);
    if ($mysqli->connect_error) exit(json_encode(['data'=>[]]));
    
    $banco = isset($user['banco']) ? intval($user['banco']) : 0;
    if ($banco > 0) {
        $sql = "SELECT u.* 
                FROM usuario u 
                INNER JOIN usuario_banco ub ON u.id = ub.usuario 
                WHERE ub.banco = $banco 
                AND u.tipo = 1";
    } else {
        $sql = "SELECT * 
                FROM usuario 
                WHERE tipo = 0";
    }
    $result = $mysqli->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) $data[] = $row;
    $response['data'] = ['data' => $data];
    echo json_encode($response, true);
    mysqli_close($conexion);

?>