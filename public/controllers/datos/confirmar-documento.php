<?php

    require("../../includes/dsn_open.php");


    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';    

    function fetch_all_assoc($result) {
        $all_rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $all_rows[] = $row;
        }
        return $all_rows;
    }

    $sql = "SELECT * FROM benefactor_efectivo WHERE documento = '".$_POST['documento']."'";
    
    $ejecutar = mysqli_query($conexion,$sql);

    $benefactor=fetch_all_assoc($ejecutar);
    if(isset($benefactor[0])){
        $benefactor=$benefactor[0];
    }else{
        $benefactor="";
    }

    $response['benefactor']=$benefactor;

    session_start();
    error_reporting(0);

    // if(isset($_SESSION['user'])){
    //     $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
    //     $ejecutar = mysqli_query($conexion,$sql);

    //     $user=mysqli_fetch_assoc($ejecutar);
    //     unset($user['contrasena']);
    //     $response['usuario']=$user;
    // }

    echo json_encode($response,true);
    mysqli_close($conexion);

?>
