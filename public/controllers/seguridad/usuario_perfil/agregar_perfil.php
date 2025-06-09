<?php

    header('Content-Type: application/json; charset=utf-8');
    require("../../../includes/auth.php");
    $user = require_bearer_token();
    $response = ['success' => false, 'message' => 'Error.'];

    $userId  = intval($_POST['usuario'] ?? 0);
    $perfilId = intval($_POST['perfil']  ?? 0);
    if ($userId > 0 && $perfilId > 0) {
        $stmt = $conexion->prepare("INSERT INTO usuario_perfil (usuario, perfil, creado, por) VALUES (?, ?, NOW(), 0)");
        $stmt->bind_param('ii', $userId, $perfilId);
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Perfil asignado.';
        } else {
            $response['message'] = 'No se pudo asignar.';
        }
    } else {
        $response['message'] = 'Datos inválidos.';
    }
    echo json_encode($response);
    exit;
    
?>