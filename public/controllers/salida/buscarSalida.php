<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  // $response['data'] = json_encode();

  $query="SELECT * FROM salida WHERE ";
  $query .= "id = '".$_POST["id"]."'";

  $result=$conexion->query($query);

  $salidas=array();
  while($row = mysqli_fetch_assoc($result)){
    $queryBeneficiario = "SELECT nombre AS beneficiario, nit FROM tipo_beneficiado WHERE ";
    $queryBeneficiario .= "id = '". $row['institucion'] ."'";
    $resultBeneficiario=$conexion->query($queryBeneficiario);

    while($rowBeneficiario = mysqli_fetch_assoc($resultBeneficiario)){
      $beneficiario=$rowBeneficiario['beneficiario'];
      $nit=$rowBeneficiario['nit'];
    }
    $row['beneficiario']=$beneficiario;
    $row['nit']=$nit;

    array_push($salidas,$row);
  }

  $salida=array();

  foreach ($salidas as $salida){

    $lotes=array();
    $where = "";
    // $query="SELECT * FROM lote_salida WHERE id_salida='". $salida['id'] ."'";
    $query = "SELECT l.producto, ls.cantidad, l.unidad, l.categoria, l.lote, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
    FROM lote_salida ls
    INNER JOIN lote l  ON l.id = ls.id_lote
    INNER JOIN entrada e  ON e.id = l.id_entrada
    INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
    WHERE ls.id_salida = ".$salida['id'];

    $result=$conexion->query($query);
    $total=0;
    while($row = mysqli_fetch_assoc($result)){

      $total=$total+$row['cantidad'];
      array_push($lotes,$row);

    }
    $salida['total']=$total;
    $salida['lotes']=$lotes;

    array_push($salida,$salida);

  }

  $response['salidas']=$salida;
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

  require("../includes/dsn_close.php");
?>
