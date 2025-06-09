<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();

$id = intval($_GET['beneficiario_id'] ?? 0);

$sql = "
  SELECT
    bs.*,
    dep.id                AS departamento_id,
    dep.nombre           AS departamento,
    bs.municipio         AS municipio_id,
    mun.nombre           AS municipio
  FROM beneficiario_sede bs
  LEFT JOIN municipio mun     ON mun.id = bs.municipio
  LEFT JOIN departamento dep  ON dep.id = mun.departamento
  WHERE bs.beneficiario_id = ?
  ORDER BY bs.id DESC
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode([
  'success' => true,
  'data'    => $data
]);
exit;
