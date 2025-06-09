<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$id = intval($_GET['benefactor_id'] ?? 0);
$sql = "
  SELECT
    bs.*,
    mun.id AS municipio_id,
    mun.nombre AS municipio,
    dep.id AS departamento_id,
    dep.nombre AS departamento
  FROM benefactor_sede bs
  LEFT JOIN municipio mun ON mun.id = bs.municipio
  LEFT JOIN departamento dep ON dep.id = mun.departamento
  WHERE bs.benefactor_id = ?
";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}
$response = ['success' => true, 'data' => $data];
echo json_encode($response);
exit;
?>
