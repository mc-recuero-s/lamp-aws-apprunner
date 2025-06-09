<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';

  $now = new DateTime("now");

  $query4="SELECT l.id ,e.id as id2, l.cantidad, l.unidad, e.fecha ,e.factura, e.institucion, l.producto, l.vencimiento, l.categoria, l.lote, e.categoria as estado2entrada FROM lote l
  INNER JOIN entrada e ON l.id_entrada = e.id
  WHERE ((l.estado <> 3 AND l.estado <> 4) OR l.estado Is NULL) AND ((e.estado <> 3 AND e.estado <> 4) OR e.estado Is NULL) AND l.vencimiento <= '".$now->format('Y-m-d')."' ORDER BY l.vencimiento ASC";
  $result4=$conexion->query($query4);

  $lotesExistentes=false;
  $existencia=0;
  $lotes=[];
  while($row = mysqli_fetch_assoc($result4)){
    $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
    $query2 .= "id_lote = '". $row['id'] ."'";
    $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
    $result2=$conexion->query($query2);

    $row['total']=mysqli_fetch_assoc($result2)['total'];

    $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
    $queryBenefactor .= "id = '". $row['institucion'] ."'";
    $resultBenefactor=$conexion->query($queryBenefactor);

    while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      $benefactor=$rowBenefactor['benefactor'];
      $codBenefactor=$rowBenefactor['codBenefactor'];
    }
    $row['benefactor']=$benefactor;
    $row['codBenefactor']=$codBenefactor;

    $row['existencia']=$existencia+($row['cantidad']-$row['total']);
    if($row['cantidad']>$row['total']){
    // if($row['cantidad']>$row['total'] && $lotesExistentes==false){
      // $lotesExistentes=true;
      array_push($lotes,$row);
    }
    // $row['benefactor']=$benefactor;
    // $row['codBenefactor']=$codBenefactor;
    // // array_push($lotes,$row);
    // if($existencia>0){
    //   array_push($newLotes,$row);
    // }
  }
  $data1=[];
  foreach ($lotes as $row){
    $datetime1 = date_create($row['vencimiento']);
    $d2 = $now->format('Y-m-d');
    $datetime2 = date_create($d2);
    // echo var_dump($datetime2);
    $interval = date_diff($datetime1, $datetime2);
    $day= $interval->format('%a');
    if(!($day==0)){
      $day="-".$day;
    }
    $row['day']=$day;
    $class='';

    $factura=$row['factura'];

    $row1= '
      <li data-id="'.$row['id'].'" class="item type4 vencido">
        <div class="task">
          <div class="icon">'.$day.'</div>
          <div class="name">'.$row['producto'].'</div>
        </div>

        <div class="status">
          <div class="factura"> '.$factura.' </div>
          <div class="text"> '.$row['categoria'].''.$row['lote'].''.$row['codBenefactor'].' </div>
          <div class="text"> '.$row['benefactor'].' </div>
        </div>

        <div class="dates">
          <div class="unidad"> '.$row['cantidad'].' / '.$row['existencia'].$row['unidad'].' </div>
          <div class="vencimiento"> '.$row['vencimiento'].' </div>
        </div>

        <div class="user">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/></svg>
        </div>
      </li>
    ';
    array_push($data1,$row);
  }














  $now = new DateTime("now");

  $query3="SELECT l.id ,e.id as id2, l.cantidad, l.unidad, e.fecha ,e.factura, e.institucion, l.producto, l.vencimiento, l.categoria, l.lote, e.categoria as estado2entrada FROM lote l
  INNER JOIN entrada e ON l.id_entrada = e.id
  WHERE ((l.estado <> 3 AND l.estado <> 4) OR l.estado Is NULL) AND ((e.estado <> 3 AND e.estado <> 4) OR e.estado Is NULL)  AND l.vencimiento > '".$now->format('Y-m-d')."' ORDER BY l.vencimiento ASC";
  $result=$conexion->query($query3);

  $lotesExistentes=false;
  $existencia=0;
  $lotes=[];
  while($row = mysqli_fetch_assoc($result)){
    $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
    $query2 .= "id_lote = '". $row['id'] ."'";
    $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
    $result2=$conexion->query($query2);

    $row['total']=mysqli_fetch_assoc($result2)['total'];

    $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
    $queryBenefactor .= "id = '". $row['institucion'] ."'";
    $resultBenefactor=$conexion->query($queryBenefactor);

    while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      $benefactor=$rowBenefactor['benefactor'];
      $codBenefactor=$rowBenefactor['codBenefactor'];
    }
    $row['benefactor']=$benefactor;
    $row['codBenefactor']=$codBenefactor;

    $row['existencia']=$existencia+($row['cantidad']-$row['total']);
    if($row['cantidad']>$row['total']){
    // if($row['cantidad']>$row['total'] && $lotesExistentes==false){
      // $lotesExistentes=true;
      array_push($lotes,$row);
    }
    // $row['benefactor']=$benefactor;
    // $row['codBenefactor']=$codBenefactor;
    // // array_push($lotes,$row);
    // if($existencia>0){
    //   array_push($newLotes,$row);
    // }
  }
  // $entrada['existencia']=$existencia;




  $data2=[];
  foreach ($lotes as $row){

  // while($row = mysqli_fetch_assoc($result)){
    $datetime1 = date_create($row['vencimiento']);
    $d2 = $now->format('Y-m-d');
    $datetime2 = date_create($d2);
    // echo var_dump($datetime2);
    $interval = date_diff($datetime1, $datetime2);
    $day= $interval->format('%a');
    $class='';
    if($day<15){
      $class='type1';
    }
    if($day>=15 && $day<31){
      $class='type2';
    }
    if($day>30){
      $class='type3';
    }
    $row['type']=$class;     
    $row['day']=$day;
    $factura=$row['factura'];
    if($row['estado2entrada']==2){
      $factura="Traslado - ".$row['factura'];
    }

    $row2= '
      <li data-id="'.$row['id'].'" class="item '.$class.'">
        <div class="task">
          <div class="icon">'.$day.'</div>
          <div class="name">'.$row['producto'].'</div>
        </div>

        <div class="status">
          <div class="factura"> '.$factura.' </div>
          <div class="text"> '.$row['categoria'].''.$row['lote'].''.$row['codBenefactor'].' </div>
          <div class="text"> '.$row['benefactor'].' </div>
        </div>

        <div class="dates">
          <div class="unidad"> '.$row['cantidad'].' / '.$row['existencia'].$row['unidad'].' </div>
          <div class="vencimiento"> '.$row['vencimiento'].' </div>
        </div>

        <div class="user">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/></svg>
        </div>
      </li>
    ';
    array_push($data2,$row);
  }

  $response['data1'] = $data1;
  $response['data2'] = $data2;




  echo json_encode($response,true);
  mysqli_close($conexion);
?>
