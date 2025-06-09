<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';

  // Insert some values
  mysqli_autocommit($conexion,FALSE);

  $query="";

  if($_POST["tipo"]=="producto"){
    $query= "INSERT INTO tipo_producto ";
    $query.= "(id, nombre, codigo, creacion) ";
    $query.= "VALUES (NULL,'".$_POST["nombre"]."','".$_POST["codigo"]."','".$_POST["creacion"]."')";
  }
  if($_POST["tipo"]=='benefactor'){
    $query= "INSERT INTO tipo_benefactor ";
    $query.= "(id, nombre,	nit,	codigo,	creacion) ";
    $query.= "VALUES (NULL,'".$_POST["nombre"]."','".$_POST["nit"]."','".$_POST["codigo"]."','".$_POST["creacion"]."')";
  }
  if($_POST["tipo"]=='beneficiados'){
    $query= "INSERT INTO tipo_beneficiado ";
    $query.= "(id, nombre,	nit,	municipio,	creacion) ";
    $query.= "VALUES (NULL,'".$_POST["nombre"]."','".$_POST["nit"]."','".$_POST["municipio"]."','".$_POST["creacion"]."')";
  }
  if($_POST["tipo"]=='recibidoEntrada'){
    $query= "INSERT INTO recibido ";
    $query.= "(id, nombre,documento,tipo,creacion) ";
    $query.= "VALUES (NULL,'".$_POST["nombre"]."','".$_POST["cedula"]."','1','".$_POST["creacion"]."')";
  }
  if($_POST["tipo"]=='recibidoSalida'){
    $query= "INSERT INTO recibido ";
    $query.= "(id, nombre,documento, tipo,creacion) ";
    $query.= "VALUES (NULL,'".$_POST["nombre"]."','".$_POST["cedula"]."','2','".$_POST["creacion"]."')";
  }
  if($_POST["tipo"]=='digitador'){
    $query= "INSERT INTO digitadores ";
    $query.= "(id, nombre,cedula, tipo) ";
    $query.= "VALUES (NULL,'".$_POST["nombre"]."','".$_POST["cedula"]."','0')";    
  }
  if($_POST["tipo"]=='bodega'){
    $query= "INSERT INTO bodega ";
    $query.= "(id, ubicacion, creacion) ";
    $query.= "VALUES (NULL,'".$_POST["ubicacion"]."','".$_POST["creacion"]."')";
  }
  if($_POST["tipo"]=='placa'){
    $query= "INSERT INTO placas ";
    $query.= "(id, placa, creacion) ";
    $query.= "VALUES (NULL,'".$_POST["placa"]."','".$_POST["creacion"]."')";
  }
  if($_POST["tipo"]=='digitado'){
    $query= "INSERT INTO placas ";
    $query.= "(id, placa, creacion) ";
    $query.= "VALUES (NULL,'".$_POST["placa"]."','".$_POST["creacion"]."')";
  }




  $conexion->query($query);

  $id=$conexion->insert_id;

  if (!mysqli_commit($conexion)) {
    $response['success'] = false;
    $response['message'] = 'Ha ocurrido un error, intente nuevamente.';
    http_response_code(500);
    echo json_encode($response);
    exit();
  }else{
    $response['data'] = $id;
    http_response_code(200);
    echo json_encode($response);
  }

  mysqli_rollback($conexion);

  mysqli_close($conexion);

?>
