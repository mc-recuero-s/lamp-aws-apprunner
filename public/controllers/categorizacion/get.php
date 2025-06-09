<?php
header('Content-Type: application/json; charset=utf-8');
require("../../includes/auth.php");
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];
$id = intval($_GET['id'] ?? 0);
$stmt = $conexion->prepare("SELECT id, nombre, version, actual FROM categorizacion WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$response['data'] = ['data' => $row];
echo json_encode($response);
exit;
?>