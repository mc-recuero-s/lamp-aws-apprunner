<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
    $user = require_bearer_token();
$response=['success'=>true,'message'=>'Hecho.'];
$rolId=intval($_GET['rol']??0);
$stmt=$conexion->prepare("SELECT m.id,m.nombre
  FROM rol_modulo rm
  JOIN modulo m ON rm.modulo=m.id
  WHERE rm.rol=?");
$stmt->bind_param('i',$rolId);
$stmt->execute();
$res=$stmt->get_result();
$data=[]; while($row=$res->fetch_assoc()) $data[]=$row;
$response['data']=$data;
echo json_encode($response);
exit;
?>