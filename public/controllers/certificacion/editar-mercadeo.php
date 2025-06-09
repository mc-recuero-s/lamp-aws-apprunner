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
    $monto = isset($_POST["monto"]) ? $_POST["monto"] : null;
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;
    $factura = isset($_POST["factura"]) ? $_POST["factura"] : null;    
    $expedicion = isset($_POST["expedicion"]) ? $_POST["expedicion"] : null;
    $asignacion = isset($_POST["asignacion"]) ? $_POST["asignacion"] : null;    
    $redirect = isset($_POST["redirect"]) ? $_POST["redirect"] : null; 
    
    $certificacion = "UPDATE certificacion ";   
    $certificacion .= "SET ";    
    $certificacion .= "institucion=". checkNull($conexion, $institucion) . ", ";        
    $certificacion .= "monto=". checkNull($conexion, $monto) . ", ";
    $certificacion .= "descripcion=". checkNull($conexion, $descripcion) . ", ";
    $certificacion .= "factura=". checkNull($conexion, $factura) . ", ";
    $certificacion .= "expedicion=". checkNull($conexion, $expedicion) . ", ";
    $certificacion .= "asignacion=". checkNull($conexion, $asignacion) . ", ";
    $certificacion .= "estado = ". checkNull($conexion, $redirect) . " ";   
    
    $id_certificacion=$_POST["id"];
    if(isset($_POST['facturas'])){
        $archivos= "";    
        if( isset($_POST['facturas']) ){        
            $data = $_POST["facturas"][1];
            if (preg_match('/^data:application\/pdf;base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = "pdf"; 
                $data = base64_decode($data);
            } else {
            }
            $archivos .= ($id_certificacion."_facturas.{$type};");
            file_put_contents("../../soportes/certificacion/".$id_certificacion."_facturas.{$type}", $data);         
        }else{
            $archivos .= "null;";
        }       
        if($_POST["redirect"]=="2"){            
            $archivos = $archivos.$id_certificacion."_certificado.{$type}";             
        }
        $certificacion .= ", archivos='".$archivos."'";        
    }

    
    $certificacion .= " WHERE id=".$id_certificacion;  
    
    // echo $certificacion;

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