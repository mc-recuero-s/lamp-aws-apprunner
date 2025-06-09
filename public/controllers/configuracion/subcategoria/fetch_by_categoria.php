<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();

$categoriaId = intval($_GET['categoria'] ?? 0);
$response = ['success' => true, 'message' => 'Hecho.'];

$stmt = $conexion->prepare("
  SELECT id, nombre
  FROM subcategoria
  WHERE categoria = ?
");
$stmt->bind_param('i', $categoriaId);
$stmt->execute();
$res = $stmt->get_result();

$data = [];
while ($row = $res->fetch_assoc()) {
    $data[] = $row;
}

$response['data'] = ['data' => $data];
echo json_encode($response);
exit;
?>
