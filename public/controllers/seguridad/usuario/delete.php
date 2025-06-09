<?php
require("../../../includes/auth.php");
$user  = require_bearer_token();
$banco = isset($user['banco']) ? intval($user['banco']) : 0;
$response = ['success' => true, 'message' => 'Hecho.'];
header('Content-Type: application/json');
$id = intval($_POST['id'] ?? 0);

if ($banco > 0) {
    $delRel = $conexion->prepare("
        DELETE FROM usuario_banco 
         WHERE usuario = ? 
           AND banco = ?
    ");
    $delRel->bind_param('ii', $id, $banco);
    $delRel->execute();

    $delUser = $conexion->prepare("
        DELETE FROM usuario 
         WHERE id = ? 
           AND tipo = 1
    ");
    $delUser->bind_param('i', $id);
    $delUser->execute();
} else {
    $delUser = $conexion->prepare("
        DELETE FROM usuario 
         WHERE id = ? 
           AND tipo = 0
    ");
    $delUser->bind_param('i', $id);
    $delUser->execute();
}

echo json_encode($response, true);
mysqli_close($conexion);
?>
