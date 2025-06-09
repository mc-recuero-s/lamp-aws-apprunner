<?php
header('Content-Type: application/json; charset=utf-8');
require("../../includes/auth.php");
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];
$cat = intval($_POST['categorizacion'] ?? 0);
$order = $_POST['order'] ?? [];
foreach ($order as $idx => $itemId) {
    $stmt = $conexion->prepare("UPDATE categorizacion_item SET `order` = ? WHERE id = ? AND categorizacion = ?");
    $o = $idx + 1;
    $stmt->bind_param('iii', $o, $itemId, $cat);
    $stmt->execute();
}
echo json_encode($response);
exit;

?>