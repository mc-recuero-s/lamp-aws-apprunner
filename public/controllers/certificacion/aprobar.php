<?php

    require("../../includes/dsn_open.php");    
    require_once('dompdf/vendor/autoload.php');        
    include 'html.php';
    
    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';   

    $dompdf = new Dompdf\Dompdf();    
    $dompdf->loadHtml($html);    
    $dompdf->setPaper('A4', 'portrait');   
    // $dompdf->set_options(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]); 
    $dompdf->render();    
    $output = $dompdf->output();
    file_put_contents(str_replace(__FILE__,realpath("../../").'/soportes/certificacion/'.$_POST['id'].'_certificado.pdf',__FILE__), $output);
    
    mysqli_autocommit($conexion,FALSE);     
    
    $delete_query = "DELETE FROM certificacion_entradas WHERE id_certificacion='".$_POST['id']."'";
    $conexion->query($delete_query);
    if (!mysqli_commit($conexion)) {
    }else{
        http_response_code(200);
        echo json_encode($response);
    }


    $archivos =$_POST["archivos"]."". ($_POST["id"]."_certificado.pdf");

    $certificacion= "UPDATE certificacion SET estado='2', archivos='".$archivos."' WHERE id=".$_POST['id'];
    $conexion->query($certificacion);

    if($_POST["tipo"]=="2"){
        foreach ($_POST['entradas'] as $valor) {
            $strSQL = "INSERT INTO certificacion_entradas ";
            $strSQL .="(id,id_certificacion,id_entrada) ";
            $strSQL .="VALUES ";
            $strSQL .="(NULL, '".$_POST['id']."','".$valor."')";
            // echo $strSQL;
            // mysqli_query($conexion, $strSQL);
            $conexion->query($strSQL);
        }
    }

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