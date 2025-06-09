<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$stmt = $conexion->prepare("DELETE FROM beneficiario_sede WHERE id = ?");
$stmt->bind_param("i", $_POST['id']);
$stmt->execute();
echo json_encode(['success' => true]);
exit;
?>