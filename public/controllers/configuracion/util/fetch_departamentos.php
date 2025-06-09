<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();
$sql = "SELECT id, nombre FROM departamento ORDER BY nombre";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$response = [
    'success' => true,
    'message' => 'Departamentos cargados.',
    'data' => $result
];
echo json_encode($response);
exit;
?>
