<?php

    require("../../includes/dsn_open.php");

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';  

    mysqli_autocommit($conexion,FALSE);

    function checkNull($conexion, $value) {
        return isset($value) && $value !== '' ? "'" . mysqli_real_escape_string($conexion, $value) . "'" : "NULL";
    }
    
    $institucion = isset($_POST["institucion"]) ? $_POST["institucion"] : null;
    $numero_documento = isset($_POST["numero_documento"]) ? $_POST["numero_documento"] : null;
    $monto = isset($_POST["monto"]) ? $_POST["monto"] : null;
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;
    $factura = isset($_POST["factura"]) ? $_POST["factura"] : null;
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : null;
    $expedicion = isset($_POST["expedicion"]) ? $_POST["expedicion"] : null;
    // $expedicion = "2025-01-30 14:00:00.000000";
    $asignacion = isset($_POST["asignacion"]) ? $_POST["asignacion"] : null;    
    $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : null;    
    $anio = isset($_POST["anio"]) ? $_POST["anio"] : null;    
        
    $query = "SELECT COALESCE(MAX(CAST(SUBSTRING_INDEX(id_anual, '-', -1) AS UNSIGNED)), 0) + 1
            FROM certificacion
            WHERE anio = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $anio);
    $stmt->execute();
    $stmt->bind_result($nuevo_numero);
    $stmt->fetch();
    $stmt->close();

    $id_anual = "{$anio}-{$nuevo_numero}";

    $certificacion = "INSERT INTO certificacion ";
    $certificacion .= "(id, institucion, monto, descripcion, factura, tipo, expedicion_factura, id_anual, anio, asignacion, archivos, estado, categoria) ";
    $certificacion .= "VALUES (";
    $certificacion .= "NULL, ";
    $certificacion .= checkNull($conexion, $institucion) . ", ";        
    $certificacion .= checkNull($conexion, $monto) . ", ";
    $certificacion .= checkNull($conexion, $descripcion) . ", ";
    $certificacion .= checkNull($conexion, $factura) . ", ";
    $certificacion .= checkNull($conexion, $tipo) . ", ";
    $certificacion .= checkNull($conexion, $expedicion) . ", ";
    $certificacion .= checkNull($conexion, $id_anual) . ", ";
    $certificacion .= checkNull($conexion, $anio) . ", ";
    $certificacion .= checkNull($conexion, $asignacion) . ", ";    
    $certificacion .= " '', ";
    $certificacion .= " 1 , ";    
    $certificacion .= checkNull($conexion, $categoria) . ")";    
        
    // echo $certificacion;
    $conexion->query($certificacion);

    $id_certificacion=$conexion->insert_id;

    $archivos= "";
    if( isset($_POST['facturas']) ){        
        $data = $_POST["facturas"][1];
        if (preg_match('/^data:application\/pdf;base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = "pdf"; 
            $data = base64_decode($data);
        } else {
        }
        $dir = "../../soportes/certificacion/";
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $archivos .= ($id_certificacion."_facturas.{$type};");
        file_put_contents("../../soportes/certificacion/".$id_certificacion."_facturas.{$type}", $data);        
    }else{
        $archivos .= "null;";
    }    

    $certificacion= "UPDATE certificacion SET archivos='".$archivos."' WHERE id=".$id_certificacion;
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