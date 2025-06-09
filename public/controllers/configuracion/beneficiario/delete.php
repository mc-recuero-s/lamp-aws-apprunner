<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$id = intval($_POST['id'] ?? 0);
$stmt = $conexion->prepare("DELETE FROM beneficiario WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
echo json_encode(['success' => true]);
exit;
?>