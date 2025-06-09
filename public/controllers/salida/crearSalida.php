<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  // $response['data'] = json_encode();

  mysqli_autocommit($conexion,FALSE);

  $sql="SELECT * FROM salida ORDER BY id DESC LIMIT 1";
  $sql="SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'salida'";
  $result = $conexion->query($sql);
  $newFactura = date("Y").'-'. mysqli_fetch_assoc($result)["AUTO_INCREMENT"];

  $salida= "INSERT INTO salida ";
  $salida.="(id, factura, fecha, institucion, persona, documento, archivos, estado, estado2) ";
  $salida.="VALUES (NULL, '".$newFactura."', '".$_POST["fecha"]."', '".$_POST["beneficiado"]."', '".$_POST["recibido"]."', '".$_POST["cedula"]."', '', '1', '1')";

  $conexion->query($salida);

  $id_salida=$conexion->insert_id;
  $archivos= "";
  if( isset($_POST['files']) ){
    foreach ($_POST['files'] as $i=>$valor) {
      $data = $_POST["files"][$i];
      if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
        $data = substr($data, strpos($data, ',') + 1);
        $type = strtolower($type[1]); // jpg, png, gif

        if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
        }

        $data = base64_decode($data);

        if ($data === false) {
        }
      } else {
      }
      $archivos .= ($_POST["factura"]."_".$id_salida."_".($i+1).".{$type};");
      file_put_contents("../soportes/salidas/".$_POST["factura"]."_".$id_salida."_".($i+1).".{$type}", $data);
    }
  }

  foreach ($_POST['lotes'] as &$valor) {
    $strSQL = "INSERT INTO lote_salida ";
    $strSQL .="(id, id_salida ,id_lote ,cantidad ,estado, estado2) ";
    $strSQL .="VALUES ";
    $strSQL .="(NULL, '".$id_salida."', '".$valor["id"]."', '".$valor["cantidad"]."', '0', '0')";
    // echo $strSQL;

    mysqli_query($conexion, $strSQL);
  }

  $salida= "UPDATE salida SET archivos='".$archivos."' WHERE id=".$id_salida;
  // echo $salida;
  $conexion->query($salida);
  if (!mysqli_commit($conexion)) {
    $response['success'] = false;
    $response['message'] = 'Ha ocurrido un error, intente nuevamente.';
    http_response_code(500);
    echo json_encode($response);
    exit();
  }else{
    $sql="SELECT * FROM salida ORDER BY id DESC LIMIT 1";
    $sql="SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'salida'";
    $result = $conexion->query($sql);
    $proximo="";
    if (mysqli_num_rows($result) > 0 ) {
      $proximo=date("Y").'-'. mysqli_fetch_assoc($result)["AUTO_INCREMENT"];
    }
    $response['proximo'] = $proximo;
    http_response_code(200);
    echo json_encode($response);
  }

  mysqli_rollback($conexion);

  mysqli_close($conexion);

  // require("../includes/dsn_close.php");
?>
