<?php

    require("../../includes/dsn_open.php");

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';  


    function checkNull($conexion, $value) {
        return isset($value) && $value !== '' ? "'" . mysqli_real_escape_string($conexion, $value) . "'" : "NULL";
    }
    
    $id = isset($_POST["id"]) ? $_POST["id"] : null;    
    $estado = isset($_POST["estado"]) ? $_POST["estado"] : null;
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;      
    
    $historial = "INSERT INTO certificacion_historial ";
    $historial .= "(id,	certificacion,	estado,	observacion) ";
    $historial .= "VALUES (";
    $historial .= "NULL, ";
    $historial .= checkNull($conexion, $id) . ", ";    
    $historial .= checkNull($conexion, $estado) . ", ";
    $historial .= checkNull($conexion, $descripcion) . ")";    
        
    $conexion->query($historial);


    mysqli_autocommit($conexion,FALSE);

    $certificacion= "UPDATE certificacion SET estado='7' WHERE id=".$_POST['id'];
    $conexion->query($certificacion);


    if (!mysqli_commit($conexion)) {
        $response['success'] = false;
        $response['message'] = 'Ha ocurrido un error, intente nuevamente.';
        http_response_code(500);
        echo json_encode($response);
        exit();
    }else{
        http_response_code(200);
        echo json_encode($response);
    }

    mysqli_rollback($conexion);

    mysqli_close($conexion);

?>