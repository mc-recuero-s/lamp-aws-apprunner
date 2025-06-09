<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$departamentoId = intval($_GET['departamento'] ?? 0);
$sql = "SELECT id, nombre FROM municipio WHERE departamento = ? ORDER BY nombre";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $departamentoId);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$response = [
    'success' => true,
    'message' => 'Municipios cargados.',
    'data' => $result
];
echo json_encode($response);
exit;
?>
