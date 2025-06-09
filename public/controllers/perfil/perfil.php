<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  // $response['data'] = json_encode();

  mysqli_autocommit($conexion,FALSE);

  // $id=$conexion->insert_id;

  $perfil=  "UPDATE usuario ";
  $perfil.= "SET nombre='".$_POST["nombre"]."', apellido='".$_POST["apellido"]."', correo='".$_POST["correo"]."', usuario='".$_POST["usuario"]."', contrasena='".$_POST["contrasena"]."' WHERE correo='".$_POST["correo"]."'";

  $conexion->query($perfil);

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
