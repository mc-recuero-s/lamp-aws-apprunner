<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
    $user = require_bearer_token();
$response = ['success'=>false,'message'=>'Error.'];
$perfilId = intval($_POST['perfil'] ?? 0);
$rolId    = intval($_POST['rol'] ?? 0);
if($perfilId>0 && $rolId>0){
  $stmt = $conexion->prepare("INSERT INTO perfil_rol (perfil,rol,creado,por) VALUES(?,?,NOW(),0)");
  $stmt->bind_param('ii',$perfilId,$rolId);
  if($stmt->execute()){ $response['success']=true; $response['message']='Rol asignado.'; }
  else{ $response['message']='No se pudo asignar.'; }
}else{ $response['message']='Datos inválidos.'; }
echo json_encode($response);
exit;
?>