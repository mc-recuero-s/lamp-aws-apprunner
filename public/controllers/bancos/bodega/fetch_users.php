<?php
  header('Content-Type: application/json; charset=utf-8');
  require '../../../includes/auth.php';
  $user = require_bearer_token();
  $response = ['success'=>true,'message'=>'Hecho.'];
  $bodega = intval($_GET['bodega']);
  $sql = "
    SELECT ub.id, u.id AS id2, u.nombre, u.apellido
    FROM usuario_bodega ub
    JOIN usuario u ON ub.usuario = u.id
    WHERE ub.bodega = $bodega
  ";
  $result = $conexion->query($sql);
  $data = [];
  while($row = $result->fetch_assoc()) $data[] = $row;
  $response['data'] = $data;
  echo json_encode($response);
?>