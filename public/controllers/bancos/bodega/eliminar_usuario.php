<?php
header('Content-Type: application/json; charset=utf-8');
require '../../../includes/auth.php';
$user = require_bearer_token();
$id = intval($_POST['id']);
$sql = "DELETE FROM usuario_bodega WHERE id = $id";
if($conexion->query($sql))
  echo json_encode(['success'=>true,'message'=>'Usuario eliminado']);
else
  echo json_encode(['success'=>false,'message'=>$conexion->error]);
?>