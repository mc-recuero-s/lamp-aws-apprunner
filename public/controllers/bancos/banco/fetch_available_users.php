<?php
header('Content-Type: application/json; charset=utf-8');
require '../../../includes/auth.php';
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];
$banco = intval($_GET['banco']);
$sql = "
  SELECT id, nombre, apellido
  FROM usuario
  WHERE id NOT IN (
    SELECT usuario FROM usuario_banco WHERE banco = $banco
  )
";
$result = $conexion->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$response['data'] = $data;
echo json_encode($response);
?>