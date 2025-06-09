<?php

    require("../../../includes/auth.php");
    $user = require_bearer_token();

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';

    header('Content-Type: application/json');
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conexion->prepare("SELECT id,nombre,apellido,correo,usuario FROM usuario WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();

    $response['data'] = $row;

    echo json_encode($response, true);
    mysqli_close($conexion);

?>