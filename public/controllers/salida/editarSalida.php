<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  // $response['data'] = json_encode();

  mysqli_autocommit($conexion,FALSE);

  $cedula=$_POST["cedula"];
  $beneficiado=$_POST["beneficiado"];
  $recibido=$_POST["recibido"];

  $sqlSalidaOld="SELECT * FROM salida WHERE id=".$_POST["id"];
  $resultSalidaOld = $conexion->query($sqlSalidaOld);
  $salidaOld= mysqli_fetch_object($resultSalidaOld);

  $queryBeneficiario = "SELECT nombre AS beneficiario, nit, municipio, poblacion FROM tipo_beneficiado WHERE ";
  $queryBeneficiario .= "id = '". $salidaOld->institucion ."'";
  $resultBeneficiario=$conexion->query($queryBeneficiario);

  $salida= "INSERT INTO salida2 ";
  $salida.="(id, fecha, institucion, persona, documento, archivos, id_salida, causa, justificacion, id_usuario) ";
  $salida.="VALUES (NULL, '".$salidaOld->fecha."', '".$salidaOld->institucion."', '".$salidaOld->persona."', '".$salidaOld->documento."', '"
  .$salidaOld->archivos."', ".$_POST["id"].", '".$_POST["causa"]."', '', ".$_POST["usuario"].")";
  // echo $salida;
  $conexion->query($salida);
  $new_salida=$conexion->insert_id;
  // echo $salida;
  $justificacion="<h5>".$_POST["justificacion"]."</h5>";
  $id_salida=$_POST["id"];

  // $archivos= "";
  // if( isset($_POST['files']) ){
  //   foreach ($_POST['files'] as $i=>$valor) {
  //     $data = $_POST["files"][$i];
  //     if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
  //       $data = substr($data, strpos($data, ',') + 1);
  //       $type = strtolower($type[1]); // jpg, png, gif
  //
  //       if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
  //       }
  //
  //       $data = base64_decode($data);
  //
  //       if ($data === false) {
  //       }
  //     } else {
  //     }
  //     $archivos .= ($_POST["factura"]."_".$id_salida."_".($i+1).".{$type};");
  //     file_put_contents("../soportes/salidas/".$_POST["factura"]."_".$id_salida."_".($i+1).".{$type}", $data);
  //   }
  // }
  if(isset($_POST['lotes'])){
    foreach ($_POST['lotes'] as &$valor) {
      $strSQL = "INSERT INTO lote_salida ";
      $strSQL .="(id, id_salida ,id_lote ,cantidad , estado, estado2) ";
      $strSQL .="VALUES ";
      $strSQL .="(NULL, '".$id_salida."', '".$valor["id"]."', '".$valor["cantidad"]."', '0', '0')";
      mysqli_query($conexion, $strSQL);

      $strSQL2 = "SELECT producto, unidad FROM lote WHERE id=".$valor["id"];
      $result2=$conexion->query($strSQL2);
      $producto1=mysqli_fetch_assoc($result2);
      $producto=$producto1['producto'];
      $unidad=$producto1['unidad'];

      $justificacion=$justificacion."<p> - Se agregó -> ".$valor["cantidad"]." ".$unidad." -> ". $producto ."</p>";
    }
  }

  if(isset($_POST['lotesEliminados'])){
    foreach ($_POST['lotesEliminados'] as &$valor) {

      $strSQL2= "UPDATE lote_salida SET estado='3', id_salida='".$new_salida."' WHERE id=".$valor["id2"];
      mysqli_query($conexion, $strSQL2);

      $query="SELECT e.id
      FROM lote_salida ls
      INNER JOIN lote l  ON l.id = ls.id_lote
      INNER JOIN entrada e ON e.id = l.id_entrada
      WHERE ls.id=".$valor["id2"];
      $result=$conexion->query($query);

      $id_entrada=mysqli_fetch_assoc($result)['id'];
      $strSQL2= "UPDATE entrada SET estado='1' WHERE id=".$id_entrada;
      mysqli_query($conexion, $strSQL2);
    }
  }

  if(isset($_POST['lotesEditados'])){
    foreach ($_POST['lotesEditados'] as &$valor) {
      $strSQL = "INSERT INTO lote_salida ";
      $strSQL .="(id, id_salida ,id_lote ,cantidad , estado, estado2) ";
      $strSQL .="VALUES ";
      $strSQL .="(NULL, '".$id_salida."', '".$valor["id"]."', '".$valor["cantidad"]."', '0', '0')";
      mysqli_query($conexion, $strSQL);

      $strSQL2= "UPDATE lote_salida SET estado='4', id_salida='".$new_salida."' WHERE id=".$valor["id2"];
      mysqli_query($conexion, $strSQL2);

      $query="SELECT e.id
      FROM lote_salida ls
      INNER JOIN lote l  ON l.id = ls.id_lote
      INNER JOIN entrada e ON e.id = l.id_entrada
      WHERE ls.id=".$valor["id2"];
      $result=$conexion->query($query);

      $id_entrada=mysqli_fetch_assoc($result)['id'];
      $strSQL2= "UPDATE entrada SET estado='1' WHERE id=".$id_entrada;
      mysqli_query($conexion, $strSQL2);
    }
  }

  $salida2= "UPDATE salida2 SET justificacion='".$justificacion."' WHERE id=".$new_salida;
  $conexion->query($salida2);

  $salida= "UPDATE salida SET institucion='$beneficiado' , fecha='".$_POST["fecha"]."' , persona='$recibido', documento='$cedula', estado='3' WHERE id=".$id_salida;
  $conexion->query($salida);

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

  // require("../includes/dsn_close.php");
?>
