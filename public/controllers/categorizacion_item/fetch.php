<?php
header('Content-Type: application/json; charset=utf-8');
require("../../includes/auth.php");
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];
$cat = intval($_GET['categorizacion'] ?? 0);
$stmt = $conexion->prepare("SELECT id, codigo, tipo, `order` FROM categorizacion_item WHERE categorizacion = ? ORDER BY `order`");
$stmt->bind_param('i', $cat);
$stmt->execute();
$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) $data[] = $row;
$response['data'] = ['data' => $data];
echo json_encode($response);
exit;

?>