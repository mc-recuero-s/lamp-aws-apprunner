<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$stmt = $conexion->prepare("UPDATE beneficiario_sede SET nit=?, nombre=?, municipio=? WHERE id=?");
$stmt->bind_param("sssi", $_POST['nit'], $_POST['nombre'], $_POST['municipio'], $_POST['id']);
$stmt->execute();
echo json_encode(['success' => true, 'message' => 'Sede actualizada']);
exit;
?>