<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
    $user = require_bearer_token();
$response=['success'=>false,'message'=>'Error.'];
$rolId=intval($_POST['rol']??0);
$funcId=intval($_POST['funcionalidad']??0);
if($rolId>0&&$funcId>0){
  $stmt=$conexion->prepare("DELETE FROM rol_funcionalidad WHERE rol=? AND funcionalidad=?");
  $stmt->bind_param('ii',$rolId,$funcId);
  if($stmt->execute()){ $response['success']=true;$response['message']='Funcionalidad eliminada.'; }
  else{ $response['message']='No se pudo eliminar.'; }
}else{ $response['message']='Datos inválidos.'; }
echo json_encode($response);
exit;
?>