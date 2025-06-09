<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$id = intval($_GET['id'] ?? 0);
$stmt = $conexion->prepare("
  SELECT
    b.*,
    mun.departamento
  FROM benefactor b
  LEFT JOIN municipio mun ON mun.id = b.municipio
  WHERE b.id = ?
");
$stmt->bind_param('i', $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$response = ['success' => true, 'data' => $data];
echo json_encode($response);
exit;
?>
