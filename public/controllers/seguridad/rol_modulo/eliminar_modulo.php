<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
    $user = require_bearer_token();
$response=['success'=>false,'message'=>'Error.'];
$rolId=intval($_POST['rol']??0);
$modId=intval($_POST['modulo']??0);
if($rolId>0&&$modId>0){
  $stmt=$conexion->prepare("DELETE FROM rol_modulo WHERE rol=? AND modulo=?");
  $stmt->bind_param('ii',$rolId,$modId);
  if($stmt->execute()){ $response['success']=true; $response['message']='Módulo eliminado.'; }
  else{ $response['message']='No se pudo eliminar.'; }
}else{ $response['message']='Datos inválidos.'; }
echo json_encode($response);
exit;
?>