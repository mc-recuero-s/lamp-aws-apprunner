<?php

require("../../includes/dsn_open.php");

$response = array();
$response['success'] = false;
$response['message'] = 'Ha ocurrido un error, intente nuevamente.';

mysqli_autocommit($conexion, FALSE);

function checkNull($conexion, $value) {
    return isset($value) && $value !== ''
        ? "'" . mysqli_real_escape_string($conexion, $value) . "'"
        : "NULL";
}

$id = $_POST["id"] ?? null;
$nombre = $_POST["nombre"] ?? null;
$banco = $_POST["banco"] ?? null;
$tipo = $_POST["tipo"] ?? null;
$numero = $_POST["numero"] ?? null;

$sql = "UPDATE cuentas SET
            nombre = " . checkNull($conexion, $nombre) . ",
            banco = " . checkNull($conexion, $banco) . ",
            tipo = " . checkNull($conexion, $tipo) . ",
            numero = " . checkNull($conexion, $numero) . "
        WHERE id = " . intval($id);

if ($conexion->query($sql)) {
    mysqli_commit($conexion);
    $response['success'] = true;
    $response['message'] = 'La cuenta se ha actualizado correctamente.';
} else {
    mysqli_rollback($conexion);
    $response['message'] = 'Error en la base de datos: ' . $conexion->error;
}

header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($conexion);

?>
