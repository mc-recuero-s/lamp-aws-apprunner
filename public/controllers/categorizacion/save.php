<?php
header('Content-Type: application/json; charset=utf-8');
require("../../includes/auth.php");
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];
$id = intval($_POST['id'] ?? 0);
$nombre = $_POST['nombre'];
$version = intval($_POST['version']);
$actual = isset($_POST['actual']) ? 1 : 0;
if ($id) {
    $stmt = $conexion->prepare("UPDATE categorizacion SET nombre = ?, version = ?, actual = ? WHERE id = ?");
    $stmt->bind_param('siii', $nombre, $version, $actual, $id);
    $stmt->execute();
} else {
    $stmt = $conexion->prepare("INSERT INTO categorizacion (nombre, version, actual) VALUES (?, ?, ?)");
    $stmt->bind_param('sii', $nombre, $version, $actual);
    $stmt->execute();
    $id = $stmt->insert_id;
}
$response['data'] = ['data' => ['id' => $id]];
echo json_encode($response);
exit;
?>