<?php
header('Content-Type: application/json; charset=utf-8');
require '../../../includes/auth.php';
$user = require_bearer_token();
$id=intval(json_decode(file_get_contents('php://input'), true)['id'] ?? $_GET['id'] ?? 0);
$stmt=$conexion->prepare("SELECT id,nombre,logo,colores,estilos FROM banco WHERE id=?");
$stmt->bind_param('i',$id);
$stmt->execute();
$data=$stmt->get_result()->fetch_assoc();
echo json_encode(['success'=>true,'message'=>'','data'=>$data]);
?>