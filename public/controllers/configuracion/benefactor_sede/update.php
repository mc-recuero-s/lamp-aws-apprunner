<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$id = intval($_POST['id']);
$nit = $_POST['nit'];
$nombre = $_POST['nombre'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];
$codigo = $_POST['codigo'];
$stmt = $conexion->prepare(
  "UPDATE benefactor_sede SET nit = ?, nombre = ?, municipio = ?, codigo = ? WHERE id = ?"
);
$stmt->bind_param('ssssi', $nit, $nombre, $municipio, $codigo, $id);
$stmt->execute();
$response = ['success' => true, 'message' => 'Actualizado.'];
echo json_encode($response);
exit;
?>