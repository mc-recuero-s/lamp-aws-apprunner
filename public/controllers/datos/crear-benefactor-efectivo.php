<?php

    require("../../includes/dsn_open.php");

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';  

    mysqli_autocommit($conexion,FALSE);
    function checkNull($conexion, $value) {
        return isset($value) && $value !== '' ? "'" . mysqli_real_escape_string($conexion, $value) . "'" : "NULL";
    }
    
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
    $codigo = isset($_POST["codigo"]) ? $_POST["codigo"] : null;
    $tipo_documento = isset($_POST["tipo_documento"]) ? $_POST["tipo_documento"] : null;
    $numero_documento = isset($_POST["numero_documento"]) ? $_POST["numero_documento"] : null;
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : null;
    $celular = isset($_POST["celular"]) ? $_POST["celular"] : null;    
    
    $benefactor = "INSERT INTO benefactor_efectivo ";
    $benefactor .= "(id, nombre, tipo_documento, documento, correo, celular, codigo) ";
    $benefactor .= "VALUES (";
    $benefactor .= "NULL, ";
    $benefactor .= checkNull($conexion, $nombre) . ", ";    
    $benefactor .= checkNull($conexion, $tipo_documento) . ", ";
    $benefactor .= checkNull($conexion, $numero_documento) . ", ";
    $benefactor .= checkNull($conexion, $correo) . ", ";
    $benefactor .= checkNull($conexion, $celular) . ", ";
    $benefactor .= checkNull($conexion, $codigo) . ")";
        
    $conexion->query($benefactor);

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

    mysqli_close($conexion);

?>