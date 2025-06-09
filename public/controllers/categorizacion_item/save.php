<?php
header('Content-Type: application/json; charset=utf-8');
require("../../includes/auth.php");
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];

$id  = intval($_POST['id'] ?? 0);
$cat = intval($_POST['categorizacion'] ?? 0);
$tipo= $_POST['tipo'] ?? '';

if ($id) {
    $stmt = $conexion->prepare("
      UPDATE categorizacion_item 
         SET tipo = ?
       WHERE id = ?
    ");
    $stmt->bind_param('si', $tipo, $id);
    $stmt->execute();
} else {
    // 1) calculo siguiente orden
    $stmt = $conexion->prepare("
      SELECT COALESCE(MAX(`order`),0) + 1 AS nxt 
        FROM categorizacion_item 
       WHERE categorizacion = ?
    ");
    $stmt->bind_param('i', $cat);
    $stmt->execute();
    $nxt = $stmt->get_result()->fetch_assoc()['nxt'];

    // 2) inserto con código provisional 0
    $stmt = $conexion->prepare("
      INSERT INTO categorizacion_item 
        (codigo, tipo, `order`, categorizacion) 
      VALUES (0, ?, ?, ?)
    ");
    $stmt->bind_param('sii', $tipo, $nxt, $cat);
    $stmt->execute();
    $newId = $stmt->insert_id;

    // 3) actualizo `codigo` con el id generado
    $upd = $conexion->prepare("
      UPDATE categorizacion_item 
         SET codigo = ? 
       WHERE id = ?
    ");
    $upd->bind_param('ii', $newId, $newId);
    $upd->execute();

    $id = $newId;
}

$response['data'] = ['data' => ['id' => $id]];
echo json_encode($response);
exit;


?>