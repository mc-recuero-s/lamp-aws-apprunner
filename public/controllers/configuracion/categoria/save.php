<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];
$id = intval($_POST['id'] ?? 0);
$nombre = $_POST['nombre'] ?? '';
$codigo = $_POST['codigo'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
if ($id > 0) {
    $stmt = $conexion->prepare("UPDATE categoria SET nombre = ?, codigo = ?, descripcion = ? WHERE id = ?");
    $stmt->bind_param('sssi', $nombre, $codigo, $descripcion, $id);
    $stmt->execute();
} else {
    $stmt = $conexion->prepare("INSERT INTO categoria(nombre,codigo,descripcion) VALUES(?,?,?)");
    $stmt->bind_param('sss', $nombre, $codigo, $descripcion);
    $stmt->execute();
    $id = $conexion->insert_id;
}
$response['data'] = ['id' => $id];
echo json_encode($response);
exit;
?>
