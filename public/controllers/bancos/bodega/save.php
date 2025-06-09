<?php
header('Content-Type: application/json; charset=utf-8');
require '../../../includes/auth.php';
$user = require_bearer_token();
$id=intval($_POST['id']??0);
$nombre=$_POST['nombre']??'';
$codigo=$_POST['codigo']??'';
$banco=intval($_POST['banco']??0);
if($id>0){
  $stmt=$conexion->prepare("UPDATE bodegas SET nombre=?,codigo=?,banco=? WHERE id=?");
  $stmt->bind_param('ssii',$nombre,$codigo,$banco,$id);
  $stmt->execute();
  $message='Bodega actualizada.';
}else{
  $stmt=$conexion->prepare("INSERT INTO bodegas(nombre,codigo,banco) VALUES(?,?,?)");
  $stmt->bind_param('ssi',$nombre,$codigo,$banco);
  $stmt->execute();
  $id=$conexion->insert_id;
  $message='Bodega creada.';
}
echo json_encode(['success'=>true,'message'=>$message,'data'=>['id'=>$id]]);
?>