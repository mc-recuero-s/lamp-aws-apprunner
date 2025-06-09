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
        
    $benefactor = "UPDATE benefactor_efectivo ";
    $benefactor .= "SET ";
    $benefactor .= "nombre=". checkNull($conexion, $nombre) . ", ";        
    $benefactor .= "tipo_documento=". checkNull($conexion, $tipo_documento) . ", ";
    $benefactor .= "documento=". checkNull($conexion, $numero_documento) . ", ";
    $benefactor .= "correo=". checkNull($conexion, $correo) . ", ";
    $benefactor .= "celular=". checkNull($conexion, $celular) . " ";
    $benefactor .= " WHERE id=".$_POST["id"];
    // $benefactor .= "codigo=". checkNull($conexion, $celular) . " ";                

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

    mysqli_rollback($conexion);

    mysqli_close($conexion);

?>