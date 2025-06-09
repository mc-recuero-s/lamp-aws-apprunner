<?php
    header('Content-Type: application/json; charset=utf-8');
    require("../../../includes/auth.php");
    $user = require_bearer_token();
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conexion->prepare("SELECT id, nombre, abreviatura, elemento, modulo FROM modulo WHERE modulo = ? ORDER BY id");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    echo json_encode([
    'success' => true,
    'message' => 'Hecho.',
    'data'    => ['data' => $rows]
    ]);
    exit;
?>