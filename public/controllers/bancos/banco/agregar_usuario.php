<?php
header('Content-Type: application/json; charset=utf-8');
require '../../../includes/auth.php';
$user = require_bearer_token();
$banco   = intval($_POST['banco']);
$usuario = intval($_POST['usuario']);
$sql = "
  INSERT INTO usuario_banco (usuario, banco, creado, por)
  VALUES ($usuario, $banco, NOW(), 0)
";
if ($conexion->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Usuario agregado']);
} else {
    echo json_encode(['success' => false, 'message' => $conexion->error]);
}
?>