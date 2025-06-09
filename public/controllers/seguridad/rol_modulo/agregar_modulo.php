<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
    $user = require_bearer_token();
$response=['success'=>false,'message'=>'Error.'];
$rolId=intval($_POST['rol']??0);
$modId=intval($_POST['modulo']??0);
if($rolId>0&&$modId>0){
  $stmt=$conexion->prepare("INSERT INTO rol_modulo(rol,modulo,creado,por)VALUES(?,?,NOW(),0)");
  $stmt->bind_param('ii',$rolId,$modId);
  if($stmt->execute()){ $response['success']=true; $response['message']='Módulo asignado.'; }
  else{ $response['message']='No se pudo asignar.'; }
}else{ $response['message']='Datos inválidos.'; }
echo json_encode($response);
exit;
?>