<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
    $user = require_bearer_token();
$response = ['success'=>true,'message'=>'Hecho.'];
$perfilId = intval($_GET['perfil'] ?? 0);
$stmt = $conexion->prepare("SELECT r.id,r.nombre
  FROM perfil_rol pr
  JOIN rol r ON pr.rol = r.id
  WHERE pr.perfil = ?");
$stmt->bind_param('i',$perfilId);
$stmt->execute();
$result = $stmt->get_result();
$data = [];
while($row = $result->fetch_assoc()) $data[] = $row;
$response['data'] = $data;
echo json_encode($response);
exit;
?>