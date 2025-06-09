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
    $query= "UPDATE tipo_producto SET nombre='".$_POST["nombre"]."' , codigo='".$_POST["codigo"]."'  WHERE id=".$id;
  }
  if($_POST["tipo"]=='benefactor'){
    $query= "UPDATE tipo_benefactor SET nombre='".$_POST["nombre"]."' , nit='".$_POST["nit"]."', codigo='".$_POST["codigo"]."'  WHERE id=".$id;
  }
  if($_POST["tipo"]=='beneficiados'){
    $query= "UPDATE tipo_beneficiado SET nombre='".$_POST["nombre"]."' , nit='".$_POST["nit"]."', municipio='".$_POST["municipio"]."', poblacion='".$_POST["poblacion"]."'  WHERE id=".$id;
  }
  if($_POST["tipo"]=='recibidoEntrada'){
    $query= "UPDATE recibido SET nombre='".$_POST["nombre"]."' , documento='".$_POST["cedula"]."'  WHERE id=".$id;
  }
  if($_POST["tipo"]=='recibidoSalida'){
    $query= "UPDATE recibido SET nombre='".$_POST["nombre"]."' , documento='".$_POST["cedula"]."'  WHERE id=".$id;
  }
  if($_POST["tipo"]=='digitador'){
    $query= "UPDATE digitadores SET nombre='".$_POST["nombre"]."' , cedula='".$_POST["cedula"]."'  WHERE id=".$id;
  }
  if($_POST["tipo"]=='bodega'){
    $query= "UPDATE bodega SET ubicacion='".$_POST["ubicacion"]."' WHERE id=".$id;
  }
  if($_POST["tipo"]=='placa'){
    $query= "UPDATE placas SET placa='".$_POST["placa"]."' WHERE id=".$id;
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
