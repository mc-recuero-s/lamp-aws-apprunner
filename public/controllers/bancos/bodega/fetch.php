<?php
header('Content-Type: application/json; charset=utf-8');
require '../../../includes/auth.php';
$user = require_bearer_token();
$userInstitution = intval($user['banco']);
$response=['success'=>true,'message'=>'Hecho.'];
$sql = "SELECT b.id,b.nombre,b.codigo,b.banco, bn.nombre AS banco_nombre
          FROM bodegas b
          LEFT JOIN banco bn ON b.banco = bn.id
          WHERE b.banco = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $userInstitution);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$response['data']=$result;
echo json_encode($response);
?>