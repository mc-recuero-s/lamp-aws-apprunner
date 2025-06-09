<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';

  // Insert some values
  mysqli_autocommit($conexion,FALSE);

  $query="";
  $id= $_POST["id"];
  if($_POST["tipo"]=="producto"){
    $query= "DELETE FROM tipo_producto WHERE id =".$id;
  }
  if($_POST["tipo"]=='benefactor'){
    $query= "DELETE FROM tipo_benefactor WHERE id =".$id;
  }
  if($_POST["tipo"]=='beneficiados'){
    $query= "DELETE FROM tipo_beneficiado WHERE id =".$id;
  }
  if($_POST["tipo"]=='recibidoEntrada'){
    $query= "DELETE FROM recibido WHERE id =".$id;
  }
  if($_POST["tipo"]=='recibidoSalida'){
    $query= "DELETE FROM recibido WHERE id =".$id;
  }
  if($_POST["tipo"]=='digitador'){
    $query= "DELETE FROM digitadores WHERE id =".$id;
  }
  if($_POST["tipo"]=='bodega'){
    $query= "DELETE FROM bodega WHERE id =".$id;
  }
  if($_POST["tipo"]=='placa'){
    $query= "DELETE FROM placas WHERE id =".$id;
  }

  $conexion->query($query);

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
