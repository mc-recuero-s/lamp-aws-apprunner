<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$prod = intval($_GET['producto_id'] ?? 0);
$stmt = $conexion->prepare("SELECT pi.id, pi.tipo, b.nombre FROM producto_institucion pi LEFT JOIN banco b ON pi.institucion = b.id WHERE pi.producto_id = ?");
$stmt->bind_param('i', $prod);
$stmt->execute();
$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) $data[] = $row;
$response = ['success' => true, 'message' => 'Hecho.', 'data' => $data];
echo json_encode($response);
exit;
?>