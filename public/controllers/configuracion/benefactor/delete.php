<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$id = intval($_POST['id'] ?? 0);
$stmt = $conexion->prepare("DELETE FROM benefactor WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$response = ['success' => true, 'message' => 'Eliminado.'];
echo json_encode($response);
exit;
?>