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
    $tipo_documento = isset($_POST["tipo_documento"]) ? $_POST["tipo_documento"] : null;
    $documento = isset($_POST["documento"]) ? $_POST["documento"] : null;
    $correo = isset($_POST["correo"]) ? $_POST["correo"] : null;
    $celular = isset($_POST["celular"]) ? $_POST["celular"] : null;
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
    $certificacion .= "(id, institucion, tipo, monto, destinatario, fecha_donacion, remitente, asignacion, descripcion, factura, expedicion_factura, id_anual, anio, expedicion, archivos, estado, categoria) ";
    $certificacion .= "VALUES (";
    $certificacion .= "NULL, ";
    $certificacion .= checkNull($conexion, $institucion) . ", ";
    $certificacion .= checkNull($conexion, $tipo) . ", ";
    $certificacion .= checkNull($conexion, $monto) . ", ";
    $certificacion .= checkNull($conexion, $destinatario) . ", ";
    $certificacion .= checkNull($conexion, $fecha_donacion) . ", ";
    $certificacion .= checkNull($conexion, $remitente) . ", ";
    $certificacion .= checkNull($conexion, $asignacion) . ", ";
    $certificacion .= checkNull($conexion, $descripcion) . ", ";
    $certificacion .= checkNull($conexion, $factura) . ", ";
    $certificacion .= checkNull($conexion, $expedicion_factura) . ", ";
    $certificacion .= checkNull($conexion, $id_anual) . ", ";
    $certificacion .= checkNull($conexion, $anio) . ", ";
    $certificacion .= "'2025-01-30 14:00:00.000000' , ";
    // $certificacion .= checkNull($conexion, $expedicion) . ", ";
    $certificacion .= " '', ";
    $certificacion .= " 1 , ";
    $certificacion .= checkNull($conexion, $categoria) . ")";

    // echo $certificacion;
    $conexion->query($certificacion);

    $id_certificacion=$conexion->insert_id;

    $archivos= "";
    if( isset($_POST['soporte']) ){
        $data = $_POST["soporte"][1];
        if (preg_match('/^data:application\/pdf;base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = "pdf";
            $data = base64_decode($data);
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
        }
        $dir = "../../soportes/certificacion/";
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $archivo = $id_certificacion . "_soporte.{$type}";
        $archivos .= ($archivo . ";");
        file_put_contents($dir . $archivo, $data);
    }else{
        $archivos .= "null;";
    }
    if( isset($_POST['facturas']) ){
        $data = $_POST["facturas"][1];
        if (preg_match('/^data:application\/pdf;base64,/', $data)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = "pdf";
            $data = base64_decode($data);
        }
        $archivos .= ($id_certificacion."_factura.{$type};");
        file_put_contents("../../soportes/certificacion/".$id_certificacion."_factura.{$type}", $data);
    }

    $certificacion= "UPDATE certificacion SET archivos='".$archivos."' WHERE id=".$id_certificacion;
    $conexion->query($certificacion);

    if (!mysqli_commit($conexion)) {

        mysqli_rollback($conexion);
        
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