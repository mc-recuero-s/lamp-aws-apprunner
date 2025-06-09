<?php

    header('Content-Type: application/json; charset=utf-8');
    require("../../../includes/auth.php");
    $user = require_bearer_token();
    $response = ['success' => true, 'message' => 'Hecho.'];

    $userId = intval($_GET['user'] ?? 0);
    $stmt = $conexion->prepare("SELECT p.id, p.nombre
        FROM usuario_perfil up
        JOIN perfil p ON up.perfil = p.id
        WHERE up.usuario = ?");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $response['data'] = $data;
    echo json_encode($response);
    exit;

?>