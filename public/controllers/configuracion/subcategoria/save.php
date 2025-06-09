<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];
$id = intval($_POST['id'] ?? 0);
$categoria = intval($_POST['categoria'] ?? 0);
$nombre = $_POST['nombre'] ?? '';
$codigo = $_POST['codigo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
if ($id > 0) {
    $stmt = $conexion->prepare("
      UPDATE subcategoria
      SET categoria = ?, nombre = ?, codigo = ?, descripcion = ?
      WHERE id = ?
    ");
    $stmt->bind_param('isssi', $categoria, $nombre, $codigo, $descripcion, $id);
    $stmt->execute();
} else {
    $stmt = $conexion->prepare("
      INSERT INTO subcategoria(categoria, nombre, codigo, descripcion)
      VALUES(?, ?, ?, ?)
    ");
    $stmt->bind_param('isss', $categoria, $nombre, $codigo, $descripcion);
    $stmt->execute();
    $id = $conexion->insert_id;
}
$response['data'] = ['id' => $id];
echo json_encode($response);
exit;
?>
