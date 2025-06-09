<?php

require("../../includes/dsn_open.php");

$response = array();
$response['success'] = false;
$response['message'] = 'Ha ocurrido un error, intente nuevamente.';

mysqli_autocommit($conexion, FALSE);

function checkNull($conexion, $value) {
    return (isset($value) && $value !== '')
        ? "'" . mysqli_real_escape_string($conexion, $value) . "'"
        : "NULL";
}

$nombre = $_POST["nombre"] ?? null;
$banco = $_POST["banco"] ?? null;
$tipo = $_POST["tipo"] ?? null;
$numero = $_POST["numero"] ?? null;

$sql = "INSERT INTO cuentas (id, nombre, banco, tipo, numero, creacion)
        VALUES (
            NULL,
            " . checkNull($conexion, $nombre) . ",
            " . checkNull($conexion, $banco) . ",
            " . checkNull($conexion, $tipo) . ",
            " . checkNull($conexion, $numero) . ",
            CURRENT_TIMESTAMP
        )";

if ($conexion->query($sql)) {
    mysqli_commit($conexion);
    $response['success'] = true;
    $response['message'] = 'Cuenta creada exitosamente.';
} else {
    mysqli_rollback($conexion);
    $response['message'] = 'Error en la base de datos: ' . $conexion->error;
}

header('Content-Type: application/json');
echo json_encode($response);

mysqli_close($conexion);

?>
