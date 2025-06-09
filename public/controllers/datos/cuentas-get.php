<?php

require("../../includes/dsn_open.php");

$response = array();
$response['success'] = true;
$response['message'] = 'Hecho.';

function fetch_all_assoc($result) {
    $all_rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $all_rows[] = $row;
    }
    return $all_rows;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id === 0) {
    $response['success'] = false;
    $response['message'] = 'ID no válido.';
    echo json_encode($response, true);
    mysqli_close($conexion);
    exit;
}

$query = "SELECT * FROM cuentas WHERE id = " . $id;
$ejecutar = mysqli_query($conexion, $query);

$cuentas = fetch_all_assoc($ejecutar);

if (!empty($cuentas)) {
    $response['cuenta'] = $cuentas[0];
} else {
    $response['success'] = false;
    $response['message'] = 'No se encontró la cuenta.';
}

echo json_encode($response, true);
mysqli_close($conexion);

?>
