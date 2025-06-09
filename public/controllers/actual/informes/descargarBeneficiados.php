<?php

  require("../../../includes/dsn_open.php");
error_reporting(E_ALL & ~E_DEPRECATED);
  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';


  $d = new DateTime('first day of this month');
  $fecha=$d->format('d-m-Y');
  $inicio = $_POST["inicio"];
  $fin= $_POST["fin"];
  $query="SELECT s.id, s.persona, s.fecha, s.factura, b.nombre, b.nit, b.poblacion FROM salida s
  INNER JOIN tipo_beneficiado b ON s.institucion = b.id
  WHERE ((s.estado <> 3 AND s.estado <> 4) OR s.estado Is NULL) AND s.fecha >= '$inicio' AND s.fecha <= '$fin'";

  if(isset($_POST["beneficiado"])){
    $query .= " AND s.institucion = ".$_POST["beneficiado"];
  }

  // echo $query;
  $result=$conexion->query($query);
  // $result2=;
  $nombreBeneficiado="";

  $salidas=array();
  while($row = mysqli_fetch_assoc($result)){
    array_push($salidas,$row);
  }


  $lotes=array();
  $salidasOrden=array();

  foreach ($salidas as $salida){

    if(isset($_POST["beneficiado"])){
      $nombreBeneficiado=$salida['nombre'];
    }

    $lotesExistentes=false;
    $existencia=0;

    $query="SELECT l.unidad, l.producto, l.categoria, l.unidad, l.lote, ls.cantidad FROM lote l
    INNER JOIN lote_salida ls ON l.id = ls.id_lote
    INNER JOIN salida s ON ls.id_salida = s.id
    WHERE s.id='". $salida['id'] ."'";

    // echo $query;
    $result=$conexion->query($query);

    $lotes=array();

    while($row = mysqli_fetch_assoc($result)){
      array_push($lotes,$row);
    }
    $salida['lotes']=$lotes;


    $query2 = "SELECT SUM(ls.cantidad) AS total FROM lote_salida ls ";
    $query2 .= " INNER JOIN lote l ON ls.id_lote = l.id ";
    $query2 .= " WHERE id_salida = '". $salida['id'] ."'";
    $query2 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL) AND l.unidad = 'kg'";

    // echo $query2;
    $result2=$conexion->query($query2);
    $salida['kg']=mysqli_fetch_assoc($result2)['total'];
    if($salida['kg']==""){
      $salida['kg']='0.00';
    }

    $query3 = "SELECT SUM(ls.cantidad) AS total FROM lote_salida ls ";
    $query3 .= " INNER JOIN lote l ON ls.id_lote = l.id ";
    $query3 .= " WHERE id_salida = '". $salida['id'] ."'";
    $query3 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL) AND l.unidad = 'lt'";
    $result3=$conexion->query($query3);
    $salida['lt']=mysqli_fetch_assoc($result3)['total'];
    if($salida['lt']==""){
      $salida['lt']='0.00';
    }

    $query4 = "SELECT SUM(ls.cantidad) AS total FROM lote_salida ls ";
    $query4 .= " INNER JOIN lote l ON ls.id_lote = l.id ";
    $query4 .= " WHERE id_salida = '". $salida['id'] ."'";
    $query4 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL) AND l.unidad = 'un'";
    $result4=$conexion->query($query4);
    $salida['un']=mysqli_fetch_assoc($result4)['total'];
    if($salida['un']==""){
      $salida['un']='0.00';
    }

    $salida['total']=$salida['kg']+$salida['lt']+$salida['un'];
    // $salida['total']='0';

    array_push($salidasOrden,$salida);
  }

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

  // Set document properties
  $objPHPExcel->getProperties()->setCreator("Saciar")
  							 ->setLastModifiedBy("Saciar - 05")
  							 ->setTitle("Saciar Informe")
  							 ->setSubject("Saciar Informe")
  							 ->setDescription("Saciar Informe")
  							 ->setKeywords("Saciar Informe")
  							 ->setCategory("Saciar Informe");


  // Add some data
  // $sheet = $objPHPExcel->getActiveSheet();
  $i=0;

  // var_dump($busqueda['entradas']);
  $objWorkSheet = $objPHPExcel->createSheet($i);

  $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Factura')
  ->setCellValueByColumnAndRow(1,1, 'Fecha')
  ->setCellValueByColumnAndRow(2,1, 'Institución')
  ->setCellValueByColumnAndRow(3,1, 'NIT')
  ->setCellValueByColumnAndRow(4,1, 'Kilogramos')
  ->setCellValueByColumnAndRow(5,1, 'litros')
  ->setCellValueByColumnAndRow(6,1, 'Unidades')
  ->setCellValueByColumnAndRow(7,1, 'Total');
  $j=2;
  foreach ($salidasOrden as $salida){

    $objWorkSheet->setCellValueByColumnAndRow(0,$j, $salida["factura"])
    ->setCellValueByColumnAndRow(1,$j, $salida["fecha"])
    ->setCellValueByColumnAndRow(2,$j, $salida["nombre"])
    ->setCellValueByColumnAndRow(3,$j, $salida["nit"])
    ->setCellValueByColumnAndRow(4,$j, $salida["kg"])
    ->setCellValueByColumnAndRow(5,$j, $salida["lt"])
    ->setCellValueByColumnAndRow(6,$j, $salida["un"])
    ->setCellValueByColumnAndRow(7,$j, $salida["total"]);

    $j++;

  }

  $objWorkSheet->setTitle('Instituciones Beneficiadas');


  $i=1;

  // var_dump($busqueda['entradas']);
  $objWorkSheet = $objPHPExcel->createSheet($i);

  $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Factura')
  ->setCellValueByColumnAndRow(1,1, 'Fecha')
  ->setCellValueByColumnAndRow(2,1, 'Institución')
  ->setCellValueByColumnAndRow(3,1, 'NIT')
  ->setCellValueByColumnAndRow(4,1, 'Kilogramos')
  ->setCellValueByColumnAndRow(5,1, 'litros')
  ->setCellValueByColumnAndRow(6,1, 'Unidades')
  ->setCellValueByColumnAndRow(7,1, 'Total')
  ->setCellValueByColumnAndRow(8,1, 'Producto')
  ->setCellValueByColumnAndRow(9,1, 'Cantidad')
  ->setCellValueByColumnAndRow(10,1, 'Unidad');
  $j=2;
  foreach ($salidasOrden as $salida){

    $objWorkSheet->setCellValueByColumnAndRow(0,$j, $salida["factura"])
    ->setCellValueByColumnAndRow(1,$j, $salida["fecha"])
    ->setCellValueByColumnAndRow(2,$j, $salida["nombre"])
    ->setCellValueByColumnAndRow(3,$j, $salida["nit"])
    ->setCellValueByColumnAndRow(4,$j, $salida["kg"])
    ->setCellValueByColumnAndRow(5,$j, $salida["lt"])
    ->setCellValueByColumnAndRow(6,$j, $salida["un"])
    ->setCellValueByColumnAndRow(7,$j, $salida["total"]);

    $j++;

    foreach ($salida['lotes'] as $lote){
      $objWorkSheet->setCellValueByColumnAndRow(8,$j, $lote["producto"])
      ->setCellValueByColumnAndRow(9,$j, $lote["cantidad"])
      ->setCellValueByColumnAndRow(10,$j, $lote["unidad"]);
      $j++;
    }

  }

  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
      foreach ($worksheet->getColumnIterator() as $column) {
          $worksheet
              ->getColumnDimension($column->getColumnIndex())
              ->setAutoSize(true);
      }
  }

  $objWorkSheet->setTitle('Instituciones Completo');

  $sheetIndex = $objPHPExcel->getIndex(
    $objPHPExcel->getSheetByName('Worksheet')
  );
  $objPHPExcel->removeSheetByIndex($sheetIndex);

  $objPHPExcel->setActiveSheetIndex(0);

  if(isset($_POST["beneficiado"])){
    $nameFile=$nombreBeneficiado.' - '.$inicio.'_'.$fin.' Beneficiado';
  }else{
    $nameFile="Beneficiados_Completo ".' - '.$inicio.'_'.$fin;
  }

  // $nameFile="Inventario_Por_Lotes_Actual_".date("Y-m-d-h-i-sa");
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
