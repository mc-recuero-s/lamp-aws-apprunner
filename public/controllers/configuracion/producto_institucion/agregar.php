<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$prod = intval($_POST['producto_id'] ?? 0);
$inst = intval($_POST['institucion'] ?? 0);
$tipo = $_POST['tipo'];
$stmt = $conexion->prepare("INSERT INTO producto_institucion (producto_id, institucion, tipo, por) VALUES (?, ?, ?, ?)");
$stmt->bind_param('iisi', $prod, $inst, $tipo, $user['id']);
$stmt->execute();
$response = ['success' => true, 'message' => 'Agregado.', 'data' => ['id' => $stmt->insert_id]];
echo json_encode($response);
exit;
?>