<?php

  require("../../includes/dsn_open.php");

  function unique_multidim_array($array, $key) {
      $temp_array = array();
      $i = 0;
      $key_array = array();

      foreach($array as $val) {
          if (!in_array($val[$key], $key_array)) {
              $key_array[$i] = $val[$key];
              $temp_array[$i] = $val;
          }
          $i++;
      }
      return $temp_array;
  }
  function unique_multidim_array2($array, $key) {
      $temp_array = array();
      $i = 0;
      $key_array = array();

      foreach($array as $val) {
          if (!in_array($val[$key], $key_array)) {
              $key_array[$i] = $val[$key];
              array_push($temp_array, $val);
          }else{
            $key2 = array_search($val[$key], array_column($temp_array, 'id'));
            // $temp_array[$key2]["ubicacion"].=(" , ".$val["ubicacion"]);
          }
          $i++;
      }
      return $temp_array;
  }


  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  // $response['data'] = json_encode();

  if( isset($_POST['benefactor']) ){
    $query="SELECT * FROM entrada WHERE ";
    $query .= "institucion = ".$_POST["benefactor"]." AND ((estado = 1) OR estado Is NULL)";
  }else{
    $query="SELECT * FROM entrada WHERE ((estado = 1) OR estado Is NULL) ";
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

  $lotes=array();
  $newEntradas=array();

  foreach ($entradas as $entrada){

    $where = "";
    $query="SELECT l.id as id, l.id_entrada, l.id_bodega, l.cantidad, l.unidad, l.categoria, l.lote, l.producto, l.vencimiento, l.estado, l.estado2 ";
    if(isset($_POST['bodega']) && count($_POST['bodega'])>0){
      $query.=", b.ubicacion ";
    }
    $query.=" FROM lote l";

    if(isset($_POST['bodega']) && count($_POST['bodega'])>0){
      $query.=" INNER JOIN bodega_lote bl ON l.id = bl.id_lote ";
      $query.=" INNER JOIN bodega b ON b.id = bl.id_bodega ";
    }

    $query.= " WHERE l.id_entrada='". $entrada['id'] ."'";

    if(isset($_POST['cantidad']) && $_POST['cantidad']!=""){
      $where .= " AND l.cantidad >= '".$_POST['cantidad']."'";
    }
    if(isset($_POST['unidad']) && $_POST['unidad']!=""){
      $where .= " AND l.unidad LIKE '".$_POST['unidad']."'";
    }
    if(isset($_POST['categoria']) && $_POST['categoria']!=""){
      $where .= " AND l.categoria LIKE '".$_POST['categoria']."'";
    }
    if(isset($_POST['lote']) && $_POST['lote']!=""){
      $where .= " AND l.lote LIKE '".$_POST['lote']."'";
    }
    if(isset($_POST['producto']) && $_POST['producto']!=""){
      $where .= " AND l.producto LIKE '%".$_POST['producto']."%'";
    }
    if(isset($_POST['vencimiento']) && $_POST['vencimiento']!=""){
      $where .= " AND l.vencimiento <= '".$_POST['vencimiento']."'";
    }
    if(isset($_POST['bodega']) && count($_POST['bodega'])>0){
      $where.=" and (";
      foreach ($_POST['bodega'] as $bodega){
        $where.=" b.id='". $bodega ."' or";
      }
      $where=substr($where, 0, -2);
      $where.=")";
    }
    if($where != ""){
      $query.= " ". $where;
    }
    // echo $query;
    $result=$conexion->query($query);

    $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
    $queryBenefactor .= "id = '". $entrada['institucion'] ."'";
    // echo $queryBenefactor;
    $resultBenefactor=$conexion->query($queryBenefactor);
    while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      $benefactor=$rowBenefactor['benefactor'];
      $codBenefactor=$rowBenefactor['codBenefactor'];
    }


    $lotes=unique_multidim_array2($lotes, "id");

    $lotesExistentes=false;
    $existencia=0;
    // echo var_dump($result);
    if($result){
      while($row = mysqli_fetch_assoc($result)){

        $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
        $query2 .= "id_lote = '". $row['id'] ."'";
        $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
        $result2=$conexion->query($query2);

        $row['total']=mysqli_fetch_assoc($result2)['total'];
        if($row['cantidad']>$row['total'] && $lotesExistentes==false){
          $lotesExistentes=true;
        }

        // if(!(isset($_POST['bodega']) && count($_POST['bodega'])>0)){
        $query3 = "SELECT b.ubicacion FROM bodega_lote bl ";
        $query3 .= " INNER JOIN bodega b ON b.id = bl.id_bodega WHERE bl.id_lote = '". $row['id'] ."' ";
        $result3=$conexion->query($query3);
        $ubicacion="";
        while($row3 = mysqli_fetch_assoc($result3)){
          $ubicacion.=", ".$row3['ubicacion']." ";
        }
        if($ubicacion != ""){
          $ubicacion=substr($ubicacion, 1, -1);
        }
        $row['ubicacion']=$ubicacion;
        // }

        $existencia=$existencia+($row['cantidad']-$row['total']);
        $row['benefactor']=$benefactor;
        $row['codBenefactor']=$codBenefactor;
        array_push($lotes,$row);

      }
      $entrada['existencia']=$existencia;

      if(($result->num_rows) > 0 && $lotesExistentes== true) {
        array_push($newEntradas,$entrada);
      }
    }
  }

  // $query="SELECT * FROM entrada WHERE estado = 1";



  $busqueda['entradas']=$newEntradas;
  $busqueda['lotes']=$lotes;

  $response['data']=$busqueda;

  echo json_encode($response,true);
  mysqli_close($conexion);

?>
