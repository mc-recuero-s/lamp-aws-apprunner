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
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : null;
    $monto = isset($_POST["monto"]) ? $_POST["monto"] : null;
    $destinatario = isset($_POST["destinatario"]) ? $_POST["destinatario"] : null;
    $fecha_donacion = isset($_POST["fecha_donacion"]) ? $_POST["fecha_donacion"] : null;
    $remitente = isset($_POST["remitente"]) ? $_POST["remitente"] : null;
    $asignacion = isset($_POST["asignacion"]) ? $_POST["asignacion"] : null;
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;
    $factura = isset($_POST["factura"]) ? $_POST["factura"] : null;
    $expedicion_factura = isset($_POST["expedicion_factura"]) ? $_POST["expedicion_factura"] : null;
    $expedicion = isset($_POST["expedicion"]) ? $_POST["expedicion"] : null;
    $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : null;
    $redirect = isset($_POST["redirect"]) ? $_POST["redirect"] : "1";
    
    $certificacion = "UPDATE certificacion ";   
    $certificacion .= "SET ";    
    $certificacion .= "institucion=". checkNull($conexion, $institucion) . ", ";    
    $certificacion .= "tipo=". checkNull($conexion, $tipo) . ", ";
    $certificacion .= "monto=". checkNull($conexion, $monto) . ", ";
    $certificacion .= "destinatario=". checkNull($conexion, $destinatario) . ", ";
    $certificacion .= "fecha_donacion=". checkNull($conexion, $fecha_donacion) . ", ";
    $certificacion .= "remitente=". checkNull($conexion, $remitente) . ", ";
    $certificacion .= "asignacion=". checkNull($conexion, $asignacion) . ", ";
    $certificacion .= "descripcion=". checkNull($conexion, $descripcion) . ", ";
    $certificacion .= "factura=". checkNull($conexion, $factura) . ", ";
    $certificacion .= "expedicion_factura=". checkNull($conexion, $expedicion_factura) . ", ";
    $certificacion .= "expedicion=". checkNull($conexion, $expedicion) . ", ";    
    $certificacion .= "estado = ". checkNull($conexion, $redirect) . " ";                       
    
    $id_certificacion=$_POST["id"];
    if(isset($_POST['soporte']) || isset($_POST['informe'])){
        $archivos= "";    
        if( isset($_POST['soporte']) ){        
            $data = $_POST["soporte"][1];
            if (preg_match('/^data:application\/pdf;base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = "pdf"; 
                $data = base64_decode($data);
            } else {
            }
            $archivos .= ($id_certificacion."_soporte.{$type};");
            file_put_contents("../../soportes/certificacion/".$id_certificacion."_soporte.{$type}", $data);        
        }else{
            $archivos .= "null;";
        }
        if( isset($_POST['informe']) ){        
            $data = $_POST["informe"][1];
            if (preg_match('/^data:application\/pdf;base64,/', $data)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = "pdf"; 
                $data = base64_decode($data);
            } else {
            }
            $archivos .= ($id_certificacion."_informe.{$type};");
            file_put_contents("../../soportes/certificacion/".$id_certificacion."_informe.{$type}", $data);        
        }else{
            $archivos .= "null;";
        }  
        if($_POST["redirect"]=="2"){            
            $archivos = $archivos.($id_certificacion."_recibo.{$type}".";".$id_certificacion."_certificado.{$type}");             
        }
        $certificacion .= ", archivos='".$archivos."'";        
    }

    
    $certificacion .= " WHERE id=".$id_certificacion;  
    
    echo $certificacion;

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