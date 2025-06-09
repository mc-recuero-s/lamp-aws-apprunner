<?php
header('Content-Type: application/json; charset=utf-8');
require '../../../includes/auth.php';
$user = require_bearer_token();
$response = ['success'=>true,'message'=>'Hecho.'];
$bodega = intval($_GET['bodega']);
$sql = "
  SELECT id, nombre, apellido
  FROM usuario
  WHERE id NOT IN (
    SELECT usuario FROM usuario_bodega WHERE bodega = $bodega
  )
";
$result = $conexion->query($sql);
$data = [];
while($row = $result->fetch_assoc()) $data[] = $row;
$response['data'] = $data;
echo json_encode($response);
?>