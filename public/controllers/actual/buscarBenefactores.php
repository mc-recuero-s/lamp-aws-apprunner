<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';



  $d = new DateTime('first day of this month');
  $fecha=$d->format('d-m-Y');
  $query="SELECT e.id, e.persona, e.fecha, e.factura, b.nombre, b.nit, b.codigo, b.id as idbenefectador FROM entrada e
  INNER JOIN tipo_benefactor b ON e.institucion = b.id
  WHERE ((e.estado <> 3 AND e.estado <> 4) OR e.estado Is NULL) AND e.fecha >= '".$_POST["inicio"]."' AND e.fecha <= '".$_POST["fin"]."'";

  if(isset($_POST["benefactor"])){
    $query .= " AND e.institucion = ".$_POST["benefactor"];
  }

  $query .= " ORDER BY b.nombre ASC";

  // echo $query;
  $result=$conexion->query($query);

  $entradas=array();
  $salidas=array();
  while($row = mysqli_fetch_assoc($result)){
    array_push($entradas,$row);
  }

  foreach ($entradas as $entrada){
    // $datetime1 = date_create($entrada['fecha']);
    // $d2 = $now->format('Y-m-d');


  }

  $response['benefactores'] = $entradas;

  echo json_encode($response,true);
  mysqli_close($conexion);
?>
