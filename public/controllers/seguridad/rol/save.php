<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
    $user = require_bearer_token();
$response=['success'=>true,'message'=>'Hecho.'];
$id=intval($_POST['id']??0);
$nombre=$_POST['nombre']??'';
$categoria=$_POST['categoria']??'';
if($id>0){
  $stmt=$conexion->prepare("UPDATE rol SET nombre=?,categoria=? WHERE id=?");
  $stmt->bind_param('ssi',$nombre,$categoria,$id);
  $stmt->execute();
}else{
  $stmt=$conexion->prepare("INSERT INTO rol(nombre,categoria) VALUES(?,?)");
  $stmt->bind_param('ss',$nombre,$categoria);
  $stmt->execute();
  $id=$conexion->insert_id;
}
$response['data']=['id'=>$id];
echo json_encode($response);
exit;
?>
