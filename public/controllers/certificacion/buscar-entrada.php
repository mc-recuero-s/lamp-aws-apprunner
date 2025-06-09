<?php

    require("../../includes/dsn_open.php");

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';  


    function checkNull($conexion, $value) {
        return isset($value) && $value !== '' ? "'" . mysqli_real_escape_string($conexion, $value) . "'" : "NULL";
    }
    
    $factura = isset($_POST["value"]) ? $_POST["value"] : null;        
    
    $sql = "SELECT * FROM entrada WHERE factura LIKE '%". $factura."%' LIMIT 10";    
        
    $ejecutar = mysqli_query($conexion,$sql);
    $entradas=mysqli_fetch_all($ejecutar, MYSQLI_ASSOC);           

    $response['entradas']=$entradas;

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