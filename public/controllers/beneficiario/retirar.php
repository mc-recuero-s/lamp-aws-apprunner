<?php

require("../../includes/dsn_open.php");

    $data = stripslashes(file_get_contents("php://input"));
    $myData = json_decode($data, true);
    $id = $myData['sid'];

    if(!empty($id)){

        $querySelect = "SELECT * FROM tipo_beneficiado WHERE id={$id} AND estado ='Activo'";

        $resultado=$conexion->query($querySelect);

        if($resultado->num_rows > 0){

            $query = "UPDATE tipo_beneficiado SET estado='Inactivo' WHERE id={$id}";
    
            $result = $conexion->query($query);
        
            if($result==true){
                echo mysqli_query($conexion, $query);
            }
            else{
                echo('Hubo un error al querer deshabilitar la institución.');
            }
        }
        else{
            echo('La institución ya está deshabilitada.');
            echo mysqli_query($conexion, 2);
        }   
    }
?>