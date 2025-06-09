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

    $query="SELECT * FROM benefactor_efectivo";              

    $ejecutar = mysqli_query($conexion,$query);

    $benefactores=fetch_all_assoc($ejecutar);

    $response['benefactores']=$benefactores;
    
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
