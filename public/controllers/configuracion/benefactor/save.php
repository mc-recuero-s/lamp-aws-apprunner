<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$id = intval($_POST['id'] ?? 0);
$tipo_documento = $_POST['tipo_documento'];
$documento = $_POST['documento'];
$nombre = $_POST['nombre'];
$proveedor = $_POST['proveedor'];
$sector_publico = isset($_POST['sector_publico']) ? 1 : 0;
$sector_economico = isset($_POST['sector_economico']) ? 1 : 0;
$tipo_institucion = $_POST['tipo_institucion'];
$municipio = $_POST['municipio'];
$banco = intval($_POST['banco']);
if ($id) {
  $stmt = $conexion->prepare("UPDATE benefactor SET tipo_documento=?, documento=?, nombre=?, proveedor=?, sector_publico=?, sector_economico=?, tipo_institucion=?, municipio=?, banco=? WHERE id=?");
  $stmt->bind_param('ssssiisiii', $tipo_documento, $documento, $nombre, $proveedor, $sector_publico, $sector_economico, $tipo_institucion, $municipio, $banco, $id);
  $stmt->execute();
  $response = ['success' => true, 'message' => 'Actualizado.', 'data' => ['id' => $id]];
} else {
  $stmt = $conexion->prepare("INSERT INTO benefactor (tipo_documento, documento, nombre, proveedor, sector_publico, sector_economico, tipo_institucion, municipio, banco, por) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param('ssssiisiii', $tipo_documento, $documento, $nombre, $proveedor, $sector_publico, $sector_economico, $tipo_institucion, $municipio, $banco, $user['id']);
  $stmt->execute();
  $id = $stmt->insert_id;
  $response = ['success' => true, 'message' => 'Creado.', 'data' => ['id' => $id]];
}
echo json_encode($response);
exit;
?>
