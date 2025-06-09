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

$query = "SELECT * FROM cuentas";

$ejecutar = mysqli_query($conexion, $query);

$cuentas = fetch_all_assoc($ejecutar);

$response['cuentas'] = $cuentas;

error_reporting(0);

echo json_encode($response, true);
mysqli_close($conexion);

?>
