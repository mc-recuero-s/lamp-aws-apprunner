<?php
  header('Content-Type: application/json; charset=utf-8');
  require '../../../includes/auth.php';
  $user = require_bearer_token();
  $response = ['success' => true, 'message' => 'Hecho.'];
  $banco = intval($_GET['banco']);
  $sql = "
    SELECT ub.id, u.nombre, u.apellido
    FROM usuario_banco ub
    JOIN usuario u ON ub.usuario = u.id
    WHERE ub.banco = $banco
  ";
  $result = $conexion->query($sql);
  $data = [];
  while ($row = $result->fetch_assoc()) {
      $data[] = $row;
  }
  $response['data'] =  $data;
  echo json_encode($response);
?>