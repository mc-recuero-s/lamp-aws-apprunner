
<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$userInstitution = intval($user['banco']);

$response = ['success' => true, 'message' => 'Hecho.'];
$sql = "
  SELECT 
    p.id,
    p.codigo,
    p.nombre,
    p.unidad,
    p.subcategoria,
    s.nombre AS subcategoria_nombre,
    p.observaciones,
    p.valor_comercial,
    p.etiqueta,
    pi.tipo,
    CASE
      WHEN pi.tipo = 'abaco' THEN 'Ábaco'
      ELSE b.nombre
    END AS institucion_label
  FROM producto p
  LEFT JOIN subcategoria s ON p.subcategoria = s.id
  LEFT JOIN producto_institucion pi ON pi.producto_id = p.id
  LEFT JOIN banco b ON b.id = pi.institucion
  WHERE pi.institucion = ?
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $userInstitution);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$response = [
    'success' => true,
    'message' => 'Hecho.',
    'data' => $result
];
echo json_encode($response);
exit;
?>
