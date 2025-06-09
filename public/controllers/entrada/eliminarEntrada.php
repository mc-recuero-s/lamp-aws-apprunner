<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  // $response['data'] = json_encode();

  mysqli_autocommit($conexion,FALSE);


  $strSQL = "DELETE FROM lote WHERE id_entrada= ".$_POST['id'];
  mysqli_query($conexion, $strSQL);


  $entrada= "DELETE FROM entrada WHERE id= ".$_POST['id'];
  $conexion->query($entrada);
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

  // mysqli_close($conexion);

  // require("../../includes/dsn_close.php");
?>
