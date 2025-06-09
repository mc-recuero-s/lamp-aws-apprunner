<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  // $response['data'] = json_encode();

  $query="SELECT * FROM entrada WHERE ";
  $query .= "id = ".$_POST["id"];

  $result=$conexion->query($query);

  $entradas=array();
  while($row = mysqli_fetch_assoc($result)){
    $queryBenefactor = "SELECT nombre AS benefactor, nit, id, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
    $queryBenefactor .= "id = '". $row['institucion'] ."'";
    $resultBenefactor=$conexion->query($queryBenefactor);

    while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      $benefactorSelect=$rowBenefactor['codBenefactor'].'-'.$rowBenefactor['id'].'-'.$rowBenefactor['nit'];
      $benefactor=$rowBenefactor['benefactor'];
      $codBenefactor=$rowBenefactor['codBenefactor'];
    }

    $queryPlaca = "SELECT id FROM placas WHERE ";
    $queryPlaca .= "placa = '". $row['placa'] ."'";
    $resultPlaca=$conexion->query($queryPlaca);
    $placa="";
    while($rowPlaca = mysqli_fetch_assoc($resultPlaca)){
      $placa=$rowPlaca['id'];
    }

    $row['benefactorSelect']=$benefactorSelect;
    $row['benefactor']=$benefactor;
    $row['codBenefactor']=$codBenefactor;

    $row['recibido']=$row['documento'];
    $row['placa2']=$row['placa'];
    $row['placa']=$placa;
    $row['digitado']=$row['documentoDigitado'];
    $row['cCostos']=$row['idCentroCostos'];

    $row['traslado']=false;
    if($row['categoria']==2){      
      $row['traslado']=true;
    }

    array_push($entradas,$row);
  }

  $busqueda['entradas']=$entradas;

  $lotes=array();

  foreach ($entradas as $entrada){

    $where = "";
    $query="SELECT * FROM lote WHERE id_entrada='". $entrada['id'] ."'";

    if($where != ""){
      $query.= " ". $where;
    }

    $result=$conexion->query($query);

    $queryBenefactor = "SELECT nombre AS benefactor, nit, id, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
    $queryBenefactor .= "id = '". $entrada['institucion'] ."'";
    $resultBenefactor=$conexion->query($queryBenefactor);

    while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      $benefactorSelect=$rowBenefactor['codBenefactor'].'-'.$rowBenefactor['id'].'-'.$rowBenefactor['nit'];
      $benefactor=$rowBenefactor['benefactor'];
      $codBenefactor=$rowBenefactor['codBenefactor'];
    }

    while($row = mysqli_fetch_assoc($result)){
      $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
      $query2 .= "id_lote = '". $row['id'] ."'";
      $result2=$conexion->query($query2);

      $row['total']=mysqli_fetch_assoc($result2)['total'];
      $row['benefactorSelect']=$benefactorSelect;
      $row['benefactor']=$benefactor;
      $row['codBenefactor']=$codBenefactor;

      array_push($lotes,$row);
    }
  }

  $busqueda['lotes']=$lotes;

  $response['data']=$busqueda;

  echo json_encode($response,true);
  mysqli_close($conexion);

?>
