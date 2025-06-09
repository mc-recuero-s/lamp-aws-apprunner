<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  // $response['data'] = json_encode();

  if( isset($_POST['benefactor']) ){
    $query="SELECT * FROM entrada WHERE ";
    $query .= "institucion = ".$_POST["benefactor"];
  }else{
    $query="SELECT * FROM entrada";
  }

  $result=$conexion->query($query);

  $entradas=array();
  while($row = mysqli_fetch_assoc($result)){
    $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
    $queryBenefactor .= "id = '". $row['institucion'] ."'";
    $resultBenefactor=$conexion->query($queryBenefactor);

    while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      $benefactor=$rowBenefactor['benefactor'];
      $codBenefactor=$rowBenefactor['codBenefactor'];
    }
    $row['benefactor']=$benefactor;
    $row['codBenefactor']=$codBenefactor;
    array_push($entradas,$row);
  }

  $busqueda['entradas']=$entradas;

  $lotes=array();

  foreach ($entradas as $entrada){

    $where = "";
    $query="SELECT * FROM lote WHERE id_entrada='". $entrada['id'] ."'";

    if(isset($_POST['cantidad']) && $_POST['cantidad']!=""){
      $where .= " AND cantidad >= '".$_POST['cantidad']."'";
    }
    if(isset($_POST['unidad']) && $_POST['unidad']!=""){
      $where .= " AND unidad LIKE '".$_POST['unidad']."'";
    }
    if(isset($_POST['categoria']) && $_POST['categoria']!=""){
      $where .= " AND categoria LIKE '".$_POST['categoria']."'";
    }
    if(isset($_POST['lote']) && $_POST['lote']!=""){
      $where .= " AND lote LIKE '".$_POST['lote']."'";
    }
    if(isset($_POST['producto']) && $_POST['producto']!=""){
      $where .= " AND producto LIKE '".$_POST['producto']."'";
    }
    if(isset($_POST['vencimiento']) && $_POST['vencimiento']!=""){
      $where .= " AND vencimiento <= '".$_POST['vencimiento']."'";
    }

    if($where != ""){
      $query.= " ". $where;
    }

    $result=$conexion->query($query);

    $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
    $queryBenefactor .= "id = '". $entrada['institucion'] ."'";
    $resultBenefactor=$conexion->query($queryBenefactor);

    while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      $benefactor=$rowBenefactor['benefactor'];
      $codBenefactor=$rowBenefactor['codBenefactor'];
    }

    while($row = mysqli_fetch_assoc($result)){
      $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
      $query2 .= "id_lote = '". $row['id'] ."'";
      $result2=$conexion->query($query2);

      $row['total']=mysqli_fetch_assoc($result2)['total'];
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
