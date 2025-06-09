<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$response = ['success' => true, 'message' => 'Hecho.'];
$sql = "
  SELECT 
    s.id,
    s.categoria,
    c.nombre AS categoria_nombre,
    s.nombre,
    s.codigo,
    s.descripcion
  FROM subcategoria s
  JOIN categoria c ON s.categoria = c.id
";
$result = $conexion->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$response['data'] = ['data' => $data];
echo json_encode($response);
exit;
?>
