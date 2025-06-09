<?php

  require("../../includes/dsn_open.php");

    $data = stripslashes(file_get_contents("php://input"));
    $myData = json_decode($data, true);
    $id = $myData['sid'];

    $query = "SELECT * FROM tipo_beneficiado WHERE id={$id}";
    
    $result = $conexion->query($query);
    $row= $result->fetch_assoc();


    echo json_encode($row);


  ?>