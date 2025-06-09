<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$userInstitution = intval($user['banco']);

$sql = "
  SELECT
    b.*,
    dep.nombre AS departamento,
    mun.nombre AS municipio,
    banco.nombre AS banco_label
  FROM beneficiario b
  LEFT JOIN municipio mun       ON mun.id = b.municipio
  LEFT JOIN departamento dep    ON dep.id = mun.departamento
  LEFT JOIN banco ON banco.id   = b.banco
  WHERE b.banco = ?
";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $userInstitution);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$response = [
    'success' => true,
    'message' => 'Hecho.',
    'data'    => $result
];
echo json_encode($response);
exit;
?>
