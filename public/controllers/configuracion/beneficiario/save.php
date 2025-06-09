<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();

$id = intval($_POST['id'] ?? 0);

$tipo_documento   = $_POST['tipo_documento'];
$documento        = $_POST['documento'];
$nombre           = $_POST['nombre'];
$proveedor        = $_POST['proveedor']        ?? '';
$sector_publico   = isset($_POST['sector_publico'])  ? 1 : 0;
$sector_economico = isset($_POST['sector_economico']) ? 1 : 0;
$tipo_institucion = $_POST['tipo_institucion'];
$municipio        = intval($_POST['municipio'] ?? 0);   
$banco            = intval($_POST['banco'] ?? 0);

if ($id) {
    $stmt = $conexion->prepare("
        UPDATE beneficiario
        SET tipo_documento   = ?,
            documento        = ?,
            nombre           = ?,
            proveedor        = ?,
            sector_publico   = ?,
            sector_economico = ?,
            tipo_institucion = ?,
            municipio        = ?,
            banco            = ?
        WHERE id = ?
    ");
    $stmt->bind_param(
        'ssssiiisii',
        $tipo_documento,
        $documento,
        $nombre,
        $proveedor,
        $sector_publico,
        $sector_economico,
        $tipo_institucion,
        $municipio,
        $banco,
        $id
    );
    $stmt->execute();

    echo json_encode([
        'success' => true,
        'message' => 'Actualizado'
    ]);
    exit;
} else {
    $stmt = $conexion->prepare("
        INSERT INTO beneficiario
          (tipo_documento, documento, nombre, proveedor, sector_publico, sector_economico, tipo_institucion, municipio, banco, por)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $por = $user['id'];
    $stmt->bind_param(
        'ssssiiisii',
        $tipo_documento,
        $documento,
        $nombre,
        $proveedor,
        $sector_publico,
        $sector_economico,
        $tipo_institucion,
        $municipio,
        $banco,
        $por
    );
    $stmt->execute();

    echo json_encode([
        'success' => true,
        'message' => 'Creado'
    ]);
    exit;
}
