<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';



  $d = new DateTime('first day of this month');
  $fecha=$d->format('d-m-Y');
  $query="SELECT s.id, s.persona, s.fecha, s.factura, b.nombre, b.nit, b.poblacion, b.id as idbeneficiado FROM salida s
  INNER JOIN tipo_beneficiado b ON s.institucion = b.id
  WHERE ((s.estado <> 3 AND s.estado <> 4) OR s.estado Is NULL) AND s.fecha >= '".$_POST["inicio"]."' AND s.fecha <= '".$_POST["fin"]."'";

  if(isset($_POST["beneficiado"])){
    $query .= " AND s.institucion = ".$_POST["beneficiado"];
  }

  // echo $query;
  $result=$conexion->query($query);

  $salidas=array();
  while($row = mysqli_fetch_assoc($result)){
    array_push($salidas,$row);
  }

  foreach ($salidas as $entrada){
    // $datetime1 = date_create($entrada['fecha']);
    // $d2 = $now->format('Y-m-d');


  }

  $response['beneficiados'] = $salidas;

  echo json_encode($response,true);
  mysqli_close($conexion);
?>
