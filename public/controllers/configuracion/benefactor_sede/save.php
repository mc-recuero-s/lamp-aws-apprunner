<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$nit = $_POST['nit'];
$nombre = $_POST['nombre'];
$municipio = $_POST['municipio'];
$codigo = $_POST['codigo'];
$benefactor_id = intval($_POST['benefactor_id']);
$stmt = $conexion->prepare(
  "INSERT INTO benefactor_sede (nit, nombre, municipio, codigo, benefactor_id, por) VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param('ssssii', $nit, $nombre, $municipio, $codigo, $benefactor_id, $user['id']);
$stmt->execute();
$response = ['success' => true, 'message' => 'Agregado.', 'data' => ['id' => $stmt->insert_id]];
echo json_encode($response);
exit;
?>
