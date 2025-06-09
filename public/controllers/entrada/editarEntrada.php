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

  $cedula=$_POST["cedula"];
  $benefactor=$_POST["benefactor"];
  $entregado=$_POST["entregado"];
  $htmlLotes="<div>";
  $lotesValidos=true;
  $lotesEliminados=[];
  $lotesEditados=[];
  $lotesReales=[];
  if(isset($_POST['lotesEliminados'])){
    $lotesEliminados=$_POST['lotesEliminados'];
    foreach ($_POST['lotesEliminados'] as &$valor) {
      $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
      $query2 .= "id_lote = '". $valor['id'] ."'";
      $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";

      $result2=$conexion->query($query2);
      $valor['total']=mysqli_fetch_assoc($result2)['total'];
      if($valor['total']>0){
        $htmlLotes=$htmlLotes."<p>Lote ".$valor['lote']." - ".$valor['producto']." No se puede eliminar. </p>";
        $lotesValidos=false;
      }
    }
  }

  if(isset($_POST['lotesEditados'])){
    $lotesEditados=$_POST['lotesEditados'];
    foreach ($_POST['lotesEditados'] as &$valor) {
      $query4="SELECT cantidad FROM lote WHERE id='". $valor['id'] ."'";
      $result4=$conexion->query($query4);
      $lote= mysqli_fetch_assoc($result4);

      $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
      $query2 .= "id_lote = '". $valor['id'] ."'";
      $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";

      $result2=$conexion->query($query2);

      $valor['total']=mysqli_fetch_assoc($result2)['total'];
      // echo $valor["cantidad"]." / ".$valor['total'];
      if($valor["cantidad"]<$valor['total']){
        $htmlLotes=$htmlLotes."<p>Lote ".$valor['lote']." - ".$valor['producto']." la cantidad ".$valor['cantidad']." ya no existe. </p>";
        $lotesValidos=false;
      }
    }
  }
  if(isset($_POST['lotesReales'])){
    $lotesReales=$_POST['lotesReales'];
  }

  if($lotesValidos){

    $categoria=$_POST["traslado"];

    $sqlEntradaOld="SELECT * FROM entrada WHERE id=".$_POST["id"];
    $resultEntradaOld = $conexion->query($sqlEntradaOld);
    $entradaOld= mysqli_fetch_object($resultEntradaOld);

    $queryBeneficiario = "SELECT nombre AS beneficiario, nit FROM tipo_benefactor WHERE ";
    $queryBeneficiario .= "id = '". $entradaOld->institucion ."'";
    $resultBeneficiario=$conexion->query($queryBeneficiario);
    $institucion= mysqli_fetch_object($resultBeneficiario);

    $queryCostos = "SELECT * FROM centrodecostos WHERE ";
    $queryCostos .= "id = '". $entradaOld->idCentroCostos ."'";
    $resultCostos=$conexion->query($queryCostos);
    $costos= mysqli_fetch_object($resultCostos);

    $entrada= "INSERT INTO entrada2 ";
    $entrada.="(id, fecha, institucion, persona, documento, archivos, id_entrada, causa, justificacion, id_usuario) ";
    $entrada.="VALUES (NULL, '".$entradaOld->fecha."', '".$entradaOld->institucion."', '".$entradaOld->persona."', '".$entradaOld->documento."', '"
    .$entradaOld->archivos."', ".$_POST["id"].", '".$_POST["causa"]."', '', ".$_POST["usuario"].")";

    $conexion->query($entrada);
    $new_entrada=$conexion->insert_id;

    $justificacion="<h5>".$_POST["justificacion"]."</h5>";
    $justificacion=$justificacion."<article><h5>Fecha : ".$entradaOld->fecha."</h5>";
    $justificacion=$justificacion."<h5>Factura : ".$entradaOld->factura."</h5>";
    $justificacion=$justificacion."<h5>Benefactor: ".$institucion->beneficiario."</h5>";
    $justificacion=$justificacion."<h5>Persona: ".$entradaOld->persona."</h5>";
    $justificacion=$justificacion."<h5>Placa: ".$entradaOld->placa."</h5>";
    $justificacion=$justificacion."<h5>Digitado: ".$entradaOld->personaDigitado."</h5>";
    $justificacion=$justificacion."<h5>Tipo: ".$entradaOld->tipo."</h5>";
    $justificacion=$justificacion."<h5>Centro de costos: ".$costos->nombre."</h5>";
    $justificacion=$justificacion."<h5>Codigo centro de costos: ".$entradaOld->idCentroCostos."</h5>";
    $justificacion=$justificacion."<h5>Certificado Donación: ".$entradaOld->certificadoDonacion."</h5></article>";
    $id_entrada=$_POST["id"];

    if(isset($_POST['lotes'])){
      foreach ($_POST['lotes'] as $valor) {

        $strSQL = "INSERT INTO lote ";
        $strSQL .="(id,id_entrada,id_bodega,cantidad,unidad,categoria,lote,producto,vencimiento) ";
        $strSQL .="VALUES ";
        $strSQL .="(NULL, '".$id_entrada."',0,'".$valor["cantidad"]."','".$valor["unidad"]."','".$valor["categoria"]."','".$valor["lote"]."','".$valor["producto"]."','".$valor["vencimiento"]."')";
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

        $justificacion=$justificacion."<p> - Se agregó -> ".$valor["cantidad"]." ".$valor["unidad"]." -> ". $valor["producto"] ."</p>";

      }
    }

    if(isset($_POST['lotesEliminados'])){
      foreach ($lotesEliminados as &$valor2) {
        $strSQL2= "UPDATE lote SET estado='3', id_entrada='".$new_entrada."' WHERE id=".$valor2["id"];
        mysqli_query($conexion, $strSQL2);
      }
    }


    if(isset($_POST['lotesReales'])){
      foreach ($lotesReales as &$valor3) {
        // $new_lote=$conexion->insert_id;
        $strSQL2= "UPDATE lote SET lote = '".$valor3["lote"]."' WHERE id=".$valor3["id"];
        mysqli_query($conexion, $strSQL2);
      }
    }

    if(isset($_POST['lotesEditados'])){
      foreach ($lotesEditados as &$valor3) {

        $query4="SELECT * FROM lote WHERE id='". $valor3['id'] ."'";
        $result4=$conexion->query($query4);
        $loteEdited= mysqli_fetch_assoc($result4);

        $strSQL = "INSERT INTO lote ";
        $strSQL .="(id,id_entrada,id_bodega,cantidad,unidad,categoria,lote,producto,vencimiento,estado) ";
        $strSQL .="VALUES ";
        $strSQL .="(NULL, '".$new_entrada."',0,'".$loteEdited["cantidad"]."','".$loteEdited["unidad"]."','".$loteEdited["categoria"]."','".$loteEdited["lote"]."','".$loteEdited["producto"]."','".$loteEdited["vencimiento"]."',4)";
        mysqli_query($conexion, $strSQL);

        // $new_lote=$conexion->insert_id;
        $strSQL2= "UPDATE lote SET cantidad = '".$valor3["cantidad"]."', lote = '".$valor3["lote"]."'  WHERE id=".$valor3["id"];

        mysqli_query($conexion, $strSQL2);

      }
    }


    $salida2= "UPDATE entrada2 SET justificacion='".$justificacion."' WHERE id=".$new_entrada;
    $conexion->query($salida2);

    $strSQL2= "UPDATE entrada SET
      institucion='$benefactor',
      persona='$entregado',
      documento='$cedula',
      fecha='".$_POST["fecha"]."',
      factura='".$_POST["factura"]."',
      institucion='".$_POST["benefactor"]."',
      persona='".$_POST["entregado"]."',
      placa='".$_POST["placa"]."',
      personaDigitado='".$_POST["digitado"]."',
      documentoDigitado='".$_POST["cedulaDigitado"]."',
      tipo='".$_POST["tipo"]."',
      idCentroCostos='".$_POST["cCostos"]."',
      certificadoDonacion='".$_POST["certificado"]."',
      valorCertificadoDonacion='".$_POST["valor"]."',
      bodega='".$_POST["bodega"]."',
      categoria='".$_POST["traslado"]."',

      estado='1',
      editado='2' WHERE id=".$_POST["id"];
    $conexion->query($strSQL2);

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
  }else{
     $htmlLotes=$htmlLotes."</div>";
     $response['success'] = false;
     $response['message'] = '<section><h5>Existen lotes que no cumplen con el cambio.</h5>'.$htmlLotes.'</section>';
     http_response_code(500);
     echo json_encode($response);
     exit();
  }

?>
