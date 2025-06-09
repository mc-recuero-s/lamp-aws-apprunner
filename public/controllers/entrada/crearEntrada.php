<?php
  // 1 natural
  // 2 completo
  // 3 editado
  // 4 eliminado


  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  // $response['data'] = json_encode();

  mysqli_autocommit($conexion,FALSE);

  $categoria=$_POST["traslado"];


  $entrada= "INSERT INTO entrada ";
  $entrada.="(id, factura, fecha, institucion, persona, documento, placa, personaDigitado, documentoDigitado, tipo, idCentroCostos, certificadoDonacion, valorCertificadoDonacion, bodega, archivos, estado, categoria) ";
  $entrada.="VALUES (NULL, '".$_POST["factura"]."', '".$_POST["fecha"]."', '".$_POST["benefactor"]."', '".$_POST["entregado"]."', '".$_POST["cedula"]."', '".$_POST["placa"]."', '".$_POST["digitado"]."', '".$_POST["cedulaDigitado"]."','".$_POST["tipo"]."', '".$_POST["cCostos"]."', '".$_POST["certificado"]."', '".$_POST["valor"]."', '".$_POST["bodega"]."', '', '1', '".$categoria."')";
  // echo $entrada;
  $conexion->query($entrada);

  $id_entrada=$conexion->insert_id;
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
      $archivos .= ($_POST["factura"]."_".$id_entrada."_".($i+1).".{$type};");
      file_put_contents("../soportes/entradas/".$_POST["factura"]."_".$id_entrada."_".($i+1).".{$type}", $data);
    }
  }

  // echo $id_entrada;
  foreach ($_POST['lotes'] as $valor) {

    $strSQL = "INSERT INTO lote ";
    $strSQL .="(id,id_entrada,id_bodega,individual,individual_cantidad,cantidad,unidad,categoria,lote,producto,vencimiento,valorUnitario,valorIva) ";
    $strSQL .="VALUES ";
    $strSQL .="(NULL, '".$id_entrada."',0,'".$valor["individual"]."','".$valor["individualCantidad"]."','".$valor["cantidad"]."','".$valor["unidad"]."','".$valor["categoria"]."','".$valor["lote"]."','".$valor["producto"]."','".$valor["vencimiento"]."','".$valor["valorUnitario"]."','".$valor["valorIva"]."')";
    // mysqli_query($conexion, $strSQL);
    $conexion->query($strSQL);
    $id_lote=$conexion->insert_id;
    // echo $id_lote;
    if (isset($valor["bodega"])){
      foreach ( (array) $valor["bodega"] as $bodega) {
        $strSQL2 = "INSERT INTO bodega_lote ";
        $strSQL2 .="(id, id_bodega, id_lote, estado, creado) ";
        $strSQL2 .="VALUES ";
        $strSQL2 .="(NULL, '".$bodega."', '".$id_lote."', '0', '".$_POST["fecha"]."')";
        // echo $strSQL2;
        mysqli_query($conexion, $strSQL2);
      }
    }
  }

  $entrada= "UPDATE entrada SET archivos='".$archivos."' WHERE id=".$id_entrada;
  $conexion->query($entrada);
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
