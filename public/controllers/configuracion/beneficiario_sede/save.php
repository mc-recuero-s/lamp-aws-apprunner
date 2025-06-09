<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();

$stmt = $conexion->prepare("
    INSERT INTO beneficiario_sede (
        nit,
        nombre,
        municipio,
        beneficiario_id,
        por
    ) VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "sssii",
    $_POST['nit'],
    $_POST['nombre'],
    $_POST['municipio'],
    $_POST['beneficiario_id'],
    $user['id']
);

$stmt->execute();
echo json_encode(['success' => true, 'message' => 'Sede creada']);
exit;
?>
