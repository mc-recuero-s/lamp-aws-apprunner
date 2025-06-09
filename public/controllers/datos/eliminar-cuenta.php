<?php

require("../../includes/dsn_open.php");

$response = array();
$response['success'] = false;
$response['message'] = 'Ha ocurrido un error, intente nuevamente.';

mysqli_autocommit($conexion, false);

function checkNull($conexion, $value) {
    return (isset($value) && $value !== '')
        ? "'" . mysqli_real_escape_string($conexion, $value) . "'"
        : "NULL";
}

$id = $_POST["id"] ?? null;

if (!$id) {
    $response['message'] = 'ID de la cuenta no proporcionado.';
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

$sql = "DELETE FROM cuentas WHERE id = " . intval($id);

if ($conexion->query($sql)) {
    mysqli_commit($conexion);
    $response['success'] = true;
    $response['message'] = 'La cuenta se ha eliminado correctamente.';
} else {
    mysqli_rollback($conexion);
    $response['message'] = 'Error en la base de datos: ' . $conexion->error;
}

header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($conexion);

?>
