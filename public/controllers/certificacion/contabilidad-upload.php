<?php

    require("../../includes/dsn_open.php");

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';  

    mysqli_autocommit($conexion,FALSE);
    $archivos="";
    if( isset($_POST['file']) ){        
        $data = $_POST["file"];
        if (preg_match('/^data:application\/pdf;base64,/', $data)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = "pdf"; 
            $data = base64_decode($data);
        } else {
        }
        $archivos =$_POST["archivos"]. ($_POST["id"]."_recibo.{$type};");
        file_put_contents("../../soportes/certificacion/".$_POST["id"]."_recibo.{$type}", $data);        
    }    

    $certificacion= "UPDATE certificacion SET archivos='".$archivos."' WHERE id=".$_POST["id"];
    
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