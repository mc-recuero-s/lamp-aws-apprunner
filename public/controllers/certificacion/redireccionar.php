<?php

    require("../../includes/dsn_open.php");

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';  

    mysqli_autocommit($conexion,FALSE);
    
    $archivos="";
    if($_POST["tipo"]==1){
        $parts = explode(';', $_POST['archivos']);    
        $subParts = array_slice($parts, 0, 2);
        $archivos=implode(';', $subParts).";";
        }
    if($_POST["tipo"]==2){        
        $archivos=$_POST["id"]."_facturas.pdf;";
    }

    $certificacion= "UPDATE certificacion SET estado='1', archivos='".$archivos."' WHERE id=".$_POST['id'];
    $conexion->query($certificacion);


    echo $certificacion;

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