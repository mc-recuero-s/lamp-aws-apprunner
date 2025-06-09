<?php

require("../../../includes/dsn_open.php");
error_reporting(E_ALL & ~E_DEPRECATED);
  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';

  $now = new DateTime("now");


   error_reporting(E_ERROR);
  ini_set('display_errors', FALSE);
  ini_set('display_startup_errors', FALSE);
  ini_set('memory_limit', '2G');
  date_default_timezone_set('Europe/London');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/../../Classes/PHPExcel.php';

  // Create new PHPExcel object
  $objPHPExcel = new PHPExcel();
  //
  $query4="SELECT l.id ,e.id as id2, l.cantidad, l.unidad, e.fecha ,e.factura, e.institucion, l.producto, l.vencimiento, l.categoria, l.lote, e.categoria as estado2entrada FROM lote l
  INNER JOIN entrada e ON l.id_entrada = e.id
  WHERE ((l.estado <> 3 AND l.estado <> 4) OR l.estado Is NULL) AND l.vencimiento <= '".$now->format('Y-m-d')."' ORDER BY l.vencimiento ASC";
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
      array_push($lotes,$row);
    }
  }

  $objPHPExcel->getProperties()->setCreator("Saciar")
  							 ->setLastModifiedBy("Saciar - 05")
  							 ->setTitle("Saciar Informe")
  							 ->setSubject("Saciar Informe")
  							 ->setDescription("Saciar Informe")
  							 ->setKeywords("Saciar Informe")
  							 ->setCategory("Saciar Informe");

  $i=0;
  $objWorkSheet = $objPHPExcel->createSheet($i);
  $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega 05')
  ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
  ->setCellValueByColumnAndRow(1,1, 'RIONEGRO')
  ->setCellValueByColumnAndRow(2,1, 'Institucion')
  ->setCellValueByColumnAndRow(3,1, 'Referencia')
  ->setCellValueByColumnAndRow(4,1, 'Descripción')
  ->setCellValueByColumnAndRow(5,1, 'Factura')
  ->setCellValueByColumnAndRow(6,1, 'Inicial')
  ->setCellValueByColumnAndRow(7,1, 'Existencia')
  ->setCellValueByColumnAndRow(8,1, 'Unidad Compra')
  ->setCellValueByColumnAndRow(9,1, 'Fecha')
  ->setCellValueByColumnAndRow(10,1, 'Fecha vencimiento')
  ->setCellValueByColumnAndRow(11,1, 'Dias restantes');
  $j=2;
  foreach ($lotes as $row){
    $datetime1 = date_create($row['vencimiento']);
    $d2 = $now->format('Y-m-d');
    $datetime2 = date_create($d2);

    $interval = date_diff($datetime1, $datetime2);
    $day= $interval->format('%a');
    if(!($day==0)){
      $day="-".$day;
    }

    $objWorkSheet->setCellValueByColumnAndRow(2,$j, $row["benefactor"])
    ->setCellValueByColumnAndRow(3,$j, $row["categoria"].$row["lote"].$row["codBenefactor"])
    ->setCellValueByColumnAndRow(4,$j, $row["producto"])
    ->setCellValueByColumnAndRow(5,$j, $row["factura"])
    ->setCellValueByColumnAndRow(6,$j, $row["cantidad"])
    ->setCellValueByColumnAndRow(7,$j, $row["existencia"])
    ->setCellValueByColumnAndRow(8,$j, $row["unidad"])
    ->setCellValueByColumnAndRow(9,$j, $row["fecha"])
    ->setCellValueByColumnAndRow(10,$j, $row["vencimiento"])
    ->setCellValueByColumnAndRow(11,$j, $day);
    if($row['estado2entrada']==2){
      $objWorkSheet->setCellValueByColumnAndRow(12,$j, "Traslado - ".$row["factura"]);
    }
    $j++;
  }
  $objWorkSheet->setTitle('Vencidos');
  $i++;



  $now = new DateTime("now");

  $query3="SELECT l.id ,e.id as id2, l.cantidad, l.unidad, e.fecha ,e.factura, e.institucion, l.producto, l.vencimiento, l.categoria, l.lote, e.categoria as estado2entrada FROM lote l
  INNER JOIN entrada e ON l.id_entrada = e.id
  WHERE ((l.estado <> 3 AND l.estado <> 4) OR l.estado Is NULL) AND l.vencimiento > '".$now->format('Y-m-d')."' ORDER BY l.vencimiento ASC";
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
      array_push($lotes,$row);
    }
  }


  $objWorkSheet = $objPHPExcel->createSheet($i);
  $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega 05')
  ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
  ->setCellValueByColumnAndRow(1,1, 'RIONEGRO')
  ->setCellValueByColumnAndRow(2,1, 'Institucion')
  ->setCellValueByColumnAndRow(3,1, 'Referencia')
  ->setCellValueByColumnAndRow(4,1, 'Descripción')
  ->setCellValueByColumnAndRow(5,1, 'Factura')
  ->setCellValueByColumnAndRow(6,1, 'Inicial')
  ->setCellValueByColumnAndRow(7,1, 'Existencia')
  ->setCellValueByColumnAndRow(8,1, 'Unidad Compra')
  ->setCellValueByColumnAndRow(9,1, 'Fecha')
  ->setCellValueByColumnAndRow(10,1, 'Fecha vencimiento')
  ->setCellValueByColumnAndRow(11,1, 'Dias restantes');
  $j=2;
  foreach ($lotes as $row){
    $datetime1 = date_create($row['vencimiento']);
    $d2 = $now->format('Y-m-d');
    $datetime2 = date_create($d2);
    $interval = date_diff($datetime1, $datetime2);
    $day= $interval->format('%a');
    if($day<15){
      $objWorkSheet->setCellValueByColumnAndRow(2,$j, $row["benefactor"])
      ->setCellValueByColumnAndRow(3,$j, $row["categoria"].$row["lote"].$row["codBenefactor"])
      ->setCellValueByColumnAndRow(4,$j, $row["producto"])
      ->setCellValueByColumnAndRow(5,$j, $row["factura"])
      ->setCellValueByColumnAndRow(6,$j, $row["cantidad"])
      ->setCellValueByColumnAndRow(7,$j, $row["existencia"])
      ->setCellValueByColumnAndRow(8,$j, $row["unidad"])
      ->setCellValueByColumnAndRow(9,$j, $row["fecha"])
      ->setCellValueByColumnAndRow(10,$j, $row["vencimiento"])
      ->setCellValueByColumnAndRow(11,$j, $day);
      if($row['estado2entrada']==2){
        $objWorkSheet->setCellValueByColumnAndRow(12,$j, "Traslado - ".$row["factura"]);
      }
      $j++;
    }
  }
  $objWorkSheet->setTitle('15 Dias');
  $i++;





  $objWorkSheet = $objPHPExcel->createSheet($i);
  $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega 05')
  ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
  ->setCellValueByColumnAndRow(1,1, 'RIONEGRO')
  ->setCellValueByColumnAndRow(2,1, 'Institucion')
  ->setCellValueByColumnAndRow(3,1, 'Referencia')
  ->setCellValueByColumnAndRow(4,1, 'Descripción')
  ->setCellValueByColumnAndRow(5,1, 'Factura')
  ->setCellValueByColumnAndRow(6,1, 'Inicial')
  ->setCellValueByColumnAndRow(7,1, 'Existencia')
  ->setCellValueByColumnAndRow(8,1, 'Unidad Compra')
  ->setCellValueByColumnAndRow(9,1, 'Fecha')
  ->setCellValueByColumnAndRow(10,1, 'Fecha vencimiento')
  ->setCellValueByColumnAndRow(11,1, 'Dias restantes');
  $j=2;
  foreach ($lotes as $row){

    $datetime1 = date_create($row['vencimiento']);
    $d2 = $now->format('Y-m-d');
    $datetime2 = date_create($d2);
    $interval = date_diff($datetime1, $datetime2);
    $day= $interval->format('%a');

    if($day>=15 && $day<31){
      $objWorkSheet->setCellValueByColumnAndRow(2,$j, $row["benefactor"])
      ->setCellValueByColumnAndRow(3,$j, $row["categoria"].$row["lote"].$row["codBenefactor"])
      ->setCellValueByColumnAndRow(4,$j, $row["producto"])
      ->setCellValueByColumnAndRow(5,$j, $row["factura"])
      ->setCellValueByColumnAndRow(6,$j, $row["cantidad"])
      ->setCellValueByColumnAndRow(7,$j, $row["existencia"])
      ->setCellValueByColumnAndRow(8,$j, $row["unidad"])
      ->setCellValueByColumnAndRow(9,$j, $row["fecha"])
      ->setCellValueByColumnAndRow(10,$j, $row["vencimiento"])
      ->setCellValueByColumnAndRow(11,$j, $day);
      if($row['estado2entrada']==2){
        $objWorkSheet->setCellValueByColumnAndRow(12,$j, "Traslado - ".$row["factura"]);
      }
      $j++;
      $class='type2';
    }
  }
  $objWorkSheet->setTitle('15 a 30 Dias');
  $i++;




  $objWorkSheet = $objPHPExcel->createSheet($i);
  $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega 05')
  ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
  ->setCellValueByColumnAndRow(1,1, 'RIONEGRO')
  ->setCellValueByColumnAndRow(2,1, 'Institucion')
  ->setCellValueByColumnAndRow(3,1, 'Referencia')
  ->setCellValueByColumnAndRow(4,1, 'Descripción')
  ->setCellValueByColumnAndRow(5,1, 'Factura')
  ->setCellValueByColumnAndRow(6,1, 'Inicial')
  ->setCellValueByColumnAndRow(7,1, 'Existencia')
  ->setCellValueByColumnAndRow(8,1, 'Unidad Compra')
  ->setCellValueByColumnAndRow(9,1, 'Fecha')
  ->setCellValueByColumnAndRow(10,1, 'Fecha vencimiento')
  ->setCellValueByColumnAndRow(11,1, 'Dias restantes');
  $j=2;
  foreach ($lotes as $row){

    $datetime1 = date_create($row['vencimiento']);
    $d2 = $now->format('Y-m-d');
    $datetime2 = date_create($d2);
    $interval = date_diff($datetime1, $datetime2);
    $day= $interval->format('%a');
    if($day>30){
      $objWorkSheet->setCellValueByColumnAndRow(2,$j, $row["benefactor"])
      ->setCellValueByColumnAndRow(3,$j, $row["categoria"].$row["lote"].$row["codBenefactor"])
      ->setCellValueByColumnAndRow(4,$j, $row["producto"])
      ->setCellValueByColumnAndRow(5,$j, $row["factura"])
      ->setCellValueByColumnAndRow(6,$j, $row["cantidad"])
      ->setCellValueByColumnAndRow(7,$j, $row["existencia"])
      ->setCellValueByColumnAndRow(8,$j, $row["unidad"])
      ->setCellValueByColumnAndRow(9,$j, $row["fecha"])
      ->setCellValueByColumnAndRow(10,$j, $row["vencimiento"])
      ->setCellValueByColumnAndRow(11,$j, $day);
      if($row['estado2entrada']==2){
        $objWorkSheet->setCellValueByColumnAndRow(12,$j, "Traslado - ".$row["factura"]);
      }
      $j++;
    }
  }
  $objWorkSheet->setTitle('mas de 30 Dias');
  $i++;

  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
      foreach ($worksheet->getColumnIterator() as $column) {
          $worksheet
              ->getColumnDimension($column->getColumnIndex())
              ->setAutoSize(true);
      }
  }

  $sheetIndex = $objPHPExcel->getIndex(
    $objPHPExcel->getSheetByName('Worksheet')
  );
  $objPHPExcel->removeSheetByIndex($sheetIndex);

  $objPHPExcel->setActiveSheetIndex(0);

  $nameFile="Inventario_Lista_de_vencimiento_".date("Y-m-d-h-i-sa");

  $callStartTime = microtime(true);
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

  if (!file_exists(realpath("../../../").'/soportes/informes')) {
    mkdir(realpath("../../../").'/soportes/informes', 0777, true);
  }

  $objWriter->save(str_replace(__FILE__,realpath("../../../").'/soportes/informes/'.$nameFile.'.xlsx',__FILE__));

  $data = new stdClass();
  $data->file=$nameFile;

  $response["data"]=$data;

  echo json_encode($response,true);
  mysqli_close($conexion);

?>
