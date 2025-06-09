<?php
header('Content-Type: application/json; charset=utf-8');
require '../../../includes/auth.php';
$user = require_bearer_token();
$input = json_decode(file_get_contents('php://input'), true);
$id = intval($input['id'] ?? $_POST['id'] ?? 0);
// Borrar archivo antiguo
if($row = $conexion->query("SELECT logo FROM banco WHERE id={$id}")->fetch_assoc()){
  if($row['logo'] && file_exists(__DIR__.'/uploads/'.$row['logo']))
    unlink(__DIR__.'/uploads/'.$row['logo']);
}
$stmt=$conexion->prepare("DELETE FROM banco WHERE id=?");
$stmt->bind_param('i',$id);
$stmt->execute();
echo json_encode(['success'=>true,'message'=>'Banco eliminado.']);
?>