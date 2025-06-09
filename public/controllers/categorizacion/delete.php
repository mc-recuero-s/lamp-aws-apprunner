<?php
header('Content-Type: application/json; charset=utf-8');
require("../../includes/auth.php");
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];
$id = intval($_POST['id'] ?? 0);
$stmt = $conexion->prepare("DELETE FROM categorizacion WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
echo json_encode($response);
exit;

?>