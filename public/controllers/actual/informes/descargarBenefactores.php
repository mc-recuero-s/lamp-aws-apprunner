<?php

require("../../../includes/dsn_open.php");
error_reporting(E_ALL & ~E_DEPRECATED);
  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';

  $d = new DateTime('first day of this month');
  $fecha=$d->format('d-m-Y');
  $query="SELECT e.id, e.persona, e.fecha, e.factura, e.institucion, b.nombre, b.nit, b.codigo FROM entrada e
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

  $nombreBenefactor="";

  $newEntradas=array();

  while($entrada = mysqli_fetch_assoc($result)){
    // array_push($entradas,$entrada);
    // echo $entrada['id'];
    // echo " , ";

    if(isset($_POST["benefactor"])){
      $nombreBenefactor=$entrada['nombre'];
    }

    $query="SELECT * FROM lote WHERE id_entrada='". $entrada['id'] ."'";

    $lotes=array();
    $result2=$conexion->query($query);

    $lotesExistentes=false;
    $existencia=0;

    while($row = mysqli_fetch_assoc($result2)){
      $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
      $query2 .= "id_lote = '". $row['id'] ."'";
      $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
      $result2=$conexion->query($query2);

      $row['total']=mysqli_fetch_assoc($result2)['total'];
      $row['lotesExistentes']=false;
      if($row['cantidad']>$row['total']){
        $row['lotesExistentes']=true;
      }
      array_push($lotes,$row);

      $existencia=$existencia+($row['cantidad']-$row['total']);

    }
    $entrada['existencia']=$existencia;
    $entrada['lotes']=$lotes;

    array_push($newEntradas,$entrada);

  }

  $busqueda['entradas']=$newEntradas;

  $response["data"]=$busqueda;
  $response["entradas"]=$entradas;
  $response["lotes"]=$lotes;



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
                 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


  // Add some data
  // $sheet = $objPHPExcel->getActiveSheet();
  $i=0;

  $order=array();

  // for ($i = 0; $i <= 300; $i++) {
  //   $objWorkSheet = $objPHPExcel->createSheet($i);
  //
  //   $objWorkSheet
  //   ->setCellValueByColumnAndRow(0,2, 'Bodega')
  //   ->setCellValueByColumnAndRow(1,2, 'Nombre Bodega')
  //   ->setCellValueByColumnAndRow(1,2, 'RIONEGRO')
  //   ->setCellValueByColumnAndRow(2,2, 'Nombre Línea')
  //   ->setCellValueByColumnAndRow(3,2, 'Referencia')
  //   ->setCellValueByColumnAndRow(4,2, 'Descripción')
  //   ->setCellValueByColumnAndRow(5,2, 'Unidad Compra')
  //   ->setCellValueByColumnAndRow(6,2, 'Factura')
  //   ->setCellValueByColumnAndRow(7,2, 'Inicial')
  //   ->setCellValueByColumnAndRow(8,2, 'Existencia')
  //   ->setCellValueByColumnAndRow(9,2, 'Dcto')
  //   ->setCellValueByColumnAndRow(10,2, 'd/m/a')
  //   ->setCellValueByColumnAndRow(11,2, 'Cantidad')
  //   ->setCellValueByColumnAndRow(12,2, 'Nit')
  //   ->setCellValueByColumnAndRow(13,2, 'Insitucion')
  //
  //   ->setCellValueByColumnAndRow(0,3, 'Bodega')
  //   ->setCellValueByColumnAndRow(1,3, 'Nombre Bodega')
  //   ->setCellValueByColumnAndRow(1,3, 'RIONEGRO')
  //   ->setCellValueByColumnAndRow(2,3, 'Nombre Línea')
  //   ->setCellValueByColumnAndRow(3,3, 'Referencia')
  //   ->setCellValueByColumnAndRow(4,3, 'Descripción')
  //   ->setCellValueByColumnAndRow(5,3, 'Unidad Compra')
  //   ->setCellValueByColumnAndRow(6,3, 'Factura')
  //   ->setCellValueByColumnAndRow(7,3, 'Inicial')
  //   ->setCellValueByColumnAndRow(8,3, 'Existencia')
  //   ->setCellValueByColumnAndRow(9,3, 'Dcto')
  //   ->setCellValueByColumnAndRow(10,3, 'd/m/a')
  //   ->setCellValueByColumnAndRow(11,3, 'Cantidad')
  //   ->setCellValueByColumnAndRow(12,3, 'Nit')
  //   ->setCellValueByColumnAndRow(13,3, 'Insitucion')
  //
  //   ->setCellValueByColumnAndRow(0,4, 'Bodega')
  //   ->setCellValueByColumnAndRow(1,4, 'Nombre Bodega')
  //   ->setCellValueByColumnAndRow(1,4, 'RIONEGRO')
  //   ->setCellValueByColumnAndRow(2,4, 'Nombre Línea')
  //   ->setCellValueByColumnAndRow(3,4, 'Referencia')
  //   ->setCellValueByColumnAndRow(4,4, 'Descripción')
  //   ->setCellValueByColumnAndRow(5,4, 'Unidad Compra')
  //   ->setCellValueByColumnAndRow(6,4, 'Factura')
  //   ->setCellValueByColumnAndRow(7,4, 'Inicial')
  //   ->setCellValueByColumnAndRow(8,4, 'Existencia')
  //   ->setCellValueByColumnAndRow(9,4, 'Dcto')
  //   ->setCellValueByColumnAndRow(10,4, 'd/m/a')
  //   ->setCellValueByColumnAndRow(11,4, 'Cantidad')
  //   ->setCellValueByColumnAndRow(12,4, 'Nit')
  //   ->setCellValueByColumnAndRow(13,4, 'Insitucion')
  //
  //   ->setCellValueByColumnAndRow(0,5, 'Bodega')
  //   ->setCellValueByColumnAndRow(1,5, 'Nombre Bodega')
  //   ->setCellValueByColumnAndRow(1,5, 'RIONEGRO')
  //   ->setCellValueByColumnAndRow(2,5, 'Nombre Línea')
  //   ->setCellValueByColumnAndRow(3,5, 'Referencia')
  //   ->setCellValueByColumnAndRow(4,5, 'Descripción')
  //   ->setCellValueByColumnAndRow(5,5, 'Unidad Compra')
  //   ->setCellValueByColumnAndRow(6,5, 'Factura')
  //   ->setCellValueByColumnAndRow(7,5, 'Inicial')
  //   ->setCellValueByColumnAndRow(8,5, 'Existencia')
  //   ->setCellValueByColumnAndRow(9,5, 'Dcto')
  //   ->setCellValueByColumnAndRow(10,5, 'd/m/a')
  //   ->setCellValueByColumnAndRow(11,5, 'Cantidad')
  //   ->setCellValueByColumnAndRow(12,5, 'Nit')
  //   ->setCellValueByColumnAndRow(13,5, 'Insitucion')
  //
  //   ->setCellValueByColumnAndRow(0,6, 'Bodega')
  //   ->setCellValueByColumnAndRow(1,6, 'Nombre Bodega')
  //   ->setCellValueByColumnAndRow(1,6, 'RIONEGRO')
  //   ->setCellValueByColumnAndRow(2,6, 'Nombre Línea')
  //   ->setCellValueByColumnAndRow(3,6, 'Referencia')
  //   ->setCellValueByColumnAndRow(4,6, 'Descripción')
  //   ->setCellValueByColumnAndRow(5,6, 'Unidad Compra')
  //   ->setCellValueByColumnAndRow(6,6, 'Factura')
  //   ->setCellValueByColumnAndRow(7,6, 'Inicial')
  //   ->setCellValueByColumnAndRow(8,6, 'Existencia')
  //   ->setCellValueByColumnAndRow(9,6, 'Dcto')
  //   ->setCellValueByColumnAndRow(10,6, 'd/m/a')
  //   ->setCellValueByColumnAndRow(11,6, 'Cantidad')
  //   ->setCellValueByColumnAndRow(12,6, 'Nit')
  //   ->setCellValueByColumnAndRow(13,6, 'Insitucion')
  //
  //   ->setCellValueByColumnAndRow(0,7, 'Bodega')
  //   ->setCellValueByColumnAndRow(1,7, 'Nombre Bodega')
  //   ->setCellValueByColumnAndRow(1,7, 'RIONEGRO')
  //   ->setCellValueByColumnAndRow(2,7, 'Nombre Línea')
  //   ->setCellValueByColumnAndRow(3,7, 'Referencia')
  //   ->setCellValueByColumnAndRow(4,7, 'Descripción')
  //   ->setCellValueByColumnAndRow(5,7, 'Unidad Compra')
  //   ->setCellValueByColumnAndRow(6,7, 'Factura')
  //   ->setCellValueByColumnAndRow(7,7, 'Inicial')
  //   ->setCellValueByColumnAndRow(8,7, 'Existencia')
  //   ->setCellValueByColumnAndRow(9,7, 'Dcto')
  //   ->setCellValueByColumnAndRow(10,7, 'd/m/a')
  //   ->setCellValueByColumnAndRow(11,7, 'Cantidad')
  //   ->setCellValueByColumnAndRow(12,7, 'Nit')
  //   ->setCellValueByColumnAndRow(13,7, 'Insitucion')
  //
  //   ->setCellValueByColumnAndRow(0,2, 'Bodega')
  //   ->setCellValueByColumnAndRow(1,2, 'Nombre Bodega')
  //   ->setCellValueByColumnAndRow(1,2, 'RIONEGRO')
  //   ->setCellValueByColumnAndRow(2,2, 'Nombre Línea')
  //   ->setCellValueByColumnAndRow(3,2, 'Referencia')
  //   ->setCellValueByColumnAndRow(4,2, 'Descripción')
  //   ->setCellValueByColumnAndRow(5,2, 'Unidad Compra')
  //   ->setCellValueByColumnAndRow(6,2, 'Factura')
  //   ->setCellValueByColumnAndRow(7,2, 'Inicial')
  //   ->setCellValueByColumnAndRow(8,2, 'Existencia')
  //   ->setCellValueByColumnAndRow(9,2, 'Dcto')
  //   ->setCellValueByColumnAndRow(10,2, 'd/m/a')
  //   ->setCellValueByColumnAndRow(11,2, 'Cantidad')
  //   ->setCellValueByColumnAndRow(12,2, 'Nit')
  //   ->setCellValueByColumnAndRow(13,2, 'Insitucion')
  //   ;
  //
  //
  //   // $objWorkSheet->setTitle($i);
  //   $i++;
  // }

  foreach ($newEntradas as $entrada){
    $encontro=false;
    $i=0;
    foreach ($order as $order1){
      if($order1['institucion'] == $entrada['institucion']){
        $encontro=$i;
      }
      $i++;
    }
    if(!($encontro===false)){
      array_push($order[$encontro]['entradas'],$entrada);
    }else{

      $order2=array();
      array_push($order2,$entrada);

      $newOrder=array();
      $newOrder['institucion']=$entrada['institucion'];
      $newOrder['codigo']=$entrada['codigo'];
      $newOrder['nombre']=$entrada['nombre'];
      $newOrder['nit']=$entrada['nit'];
      $newOrder['entradas']=$order2;

      array_push($order,$newOrder);
    }
  }



  $response["order"]=$order;
  //
  $objWorkSheet = $objPHPExcel->createSheet($i);
  $k=1;

  foreach ($order as $institucion){

    $objWorkSheet->setCellValueByColumnAndRow(0,$k, $institucion['codigo'])
    ->setCellValueByColumnAndRow(1,$k, $institucion['nombre'])
    ->setCellValueByColumnAndRow(2,$k, $institucion['nit']);
    $k++;
    $objWorkSheet->setCellValueByColumnAndRow(0,2, 'Bodega')
    ->setCellValueByColumnAndRow(1,$k, 'Nombre Bodega')
    ->setCellValueByColumnAndRow(1,$k, 'RIONEGRO')
    ->setCellValueByColumnAndRow(2,$k, 'Nombre Línea')
    ->setCellValueByColumnAndRow(3,$k, 'Referencia')
    ->setCellValueByColumnAndRow(4,$k, 'Descripción')
    ->setCellValueByColumnAndRow(5,$k, 'Unidad Compra')
    ->setCellValueByColumnAndRow(6,$k, 'Factura')
    ->setCellValueByColumnAndRow(7,$k, 'Inicial')
    ->setCellValueByColumnAndRow(8,$k, 'Existencia')
    ->setCellValueByColumnAndRow(9,$k, 'Dcto')
    ->setCellValueByColumnAndRow(10,$k, 'd/m/a')
    ->setCellValueByColumnAndRow(11,$k, 'Cantidad')
    ->setCellValueByColumnAndRow(12,$k, 'Nit')
    ->setCellValueByColumnAndRow(13,$k, 'Insitucion');
    
    $k++;
    foreach ($institucion['entradas'] as $entrada){
      $query = "SELECT e.factura, l.producto, l.cantidad, l.id ,l.unidad, l.categoria, l.lote, tp.nombre as nombreCategoria, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
      FROM lote l
      INNER JOIN tipo_producto tp ON l.categoria = tp.codigo
      INNER JOIN entrada e  ON e.id = l.id_entrada
      INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
      WHERE e.id = ".$entrada['id'];

      // echo $query;
      $result=$conexion->query($query);

      while($lote = mysqli_fetch_assoc($result)){
        $objWorkSheet->setCellValueByColumnAndRow(0,$k, '5')
        ->setCellValueByColumnAndRow(1,$k, 'RIONEGRO')
        ->setCellValueByColumnAndRow(2,$k, $lote["categoria"]." - ".$lote["nombreCategoria"])
        ->setCellValueByColumnAndRow(3,$k, $lote["categoria"].$lote["lote"].$lote["codBenefactor"])
        ->setCellValueByColumnAndRow(4,$k, $lote["producto"])
        ->setCellValueByColumnAndRow(5,$k, $lote["unidad"])
        ->setCellValueByColumnAndRow(6,$k, $lote["factura"])
        ->setCellValueByColumnAndRow(7,$k, $lote["cantidad"])
        ->setCellValueByColumnAndRow(8,$k, $lote["cantidad"]);



        $query2 = "SELECT ls.cantidad, s.factura, s.fecha, tb.nombre as beneficiado, tb.nit  FROM lote_salida ls
        INNER JOIN salida s  ON ls.id_salida = s.id
        INNER JOIN tipo_beneficiado tb ON s.institucion = tb.id ";
        $query2 .= "WHERE ls.id_lote = '". $lote['id'] ."'";
        $query2 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";
        // echo $query2;
        $result2=$conexion->query($query2);

        $cant=$lote["cantidad"];
        $cant2=0;
        $currentCantidad=$k;
        while($row = mysqli_fetch_assoc($result2)){

          $objWorkSheet->setCellValueByColumnAndRow(9,$k, $row["factura"])
          ->setCellValueByColumnAndRow(10,$k, $row["fecha"])
          ->setCellValueByColumnAndRow(11,$k, $row["cantidad"])
          ->setCellValueByColumnAndRow(12,$k, $row["nit"])
          ->setCellValueByColumnAndRow(13,$k, $row["beneficiado"]);
          $cant2+=$row["cantidad"];
          $k++;
        }
        if(($result2->num_rows) < 1 ){
          $k++;
        }
        
        $k++;
        // $objWorkSheet->setCellValueByColumnAndRow(9,1, $cant2);
        $objWorkSheet->setCellValueByColumnAndRow(8,$currentCantidad, strval($cant-$cant2));
        $objWorkSheet->getStyle('I'.$currentCantidad)->getNumberFormat()->setFormatCode('#,##0.00');
      }
    }
  }
  $objWorkSheet->setTitle("Resumen");  

  $i++;
  
  foreach ($order as $institucion){

    $objWorkSheet = $objPHPExcel->createSheet($i);

    $j=3;

    $objWorkSheet->setCellValueByColumnAndRow(0,1, $institucion['codigo'])
    ->setCellValueByColumnAndRow(1,1, $institucion['nombre'])
    ->setCellValueByColumnAndRow(2,1, $institucion['nit']);

    $objWorkSheet->setCellValueByColumnAndRow(0,2, 'Bodega')
    ->setCellValueByColumnAndRow(1,2, 'Nombre Bodega')
    ->setCellValueByColumnAndRow(1,2, 'RIONEGRO')
    ->setCellValueByColumnAndRow(2,2, 'Nombre Línea')
    ->setCellValueByColumnAndRow(3,2, 'Referencia')
    ->setCellValueByColumnAndRow(4,2, 'Descripción')
    ->setCellValueByColumnAndRow(5,2, 'Unidad Compra')
    ->setCellValueByColumnAndRow(6,2, 'Factura')
    ->setCellValueByColumnAndRow(7,2, 'Inicial')
    ->setCellValueByColumnAndRow(8,2, 'Existencia')
    ->setCellValueByColumnAndRow(9,2, 'Dcto')
    ->setCellValueByColumnAndRow(10,2, 'd/m/a')
    ->setCellValueByColumnAndRow(11,2, 'Cantidad')
    ->setCellValueByColumnAndRow(12,2, 'Nit')
    ->setCellValueByColumnAndRow(13,2, 'Insitucion');

    foreach ($institucion['entradas'] as $entrada){
      $query = "SELECT e.factura, l.producto, l.cantidad, l.id ,l.unidad, l.categoria, l.lote, tp.nombre as nombreCategoria, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
      FROM lote l
      INNER JOIN tipo_producto tp ON l.categoria = tp.codigo
      INNER JOIN entrada e  ON e.id = l.id_entrada
      INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
      WHERE e.id = ".$entrada['id'];

      // echo $query;
      $result=$conexion->query($query);

      while($lote = mysqli_fetch_assoc($result)){
        $objWorkSheet->setCellValueByColumnAndRow(0,$j, '5')
        ->setCellValueByColumnAndRow(1,$j, 'RIONEGRO')
        ->setCellValueByColumnAndRow(2,$j, $lote["categoria"]." - ".$lote["nombreCategoria"])
        ->setCellValueByColumnAndRow(3,$j, $lote["categoria"].$lote["lote"].$lote["codBenefactor"])
        ->setCellValueByColumnAndRow(4,$j, $lote["producto"])
        ->setCellValueByColumnAndRow(5,$j, $lote["unidad"])
        ->setCellValueByColumnAndRow(6,$j, $lote["factura"])
        ->setCellValueByColumnAndRow(7,$j, $lote["cantidad"])
        ->setCellValueByColumnAndRow(8,$j, $lote["cantidad"]);



        $query2 = "SELECT ls.cantidad, s.factura, s.fecha, tb.nombre as beneficiado, tb.nit  FROM lote_salida ls
        INNER JOIN salida s  ON ls.id_salida = s.id
        INNER JOIN tipo_beneficiado tb ON s.institucion = tb.id ";
        $query2 .= "WHERE ls.id_lote = '". $lote['id'] ."'";
        $query2 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";
        // echo $query2;
        $result2=$conexion->query($query2);

        $cant=$lote["cantidad"];
        $cant2=0;
        $currentCantidad=$j;
        while($row = mysqli_fetch_assoc($result2)){

          $objWorkSheet->setCellValueByColumnAndRow(9,$j, $row["factura"])
          ->setCellValueByColumnAndRow(10,$j, $row["fecha"])
          ->setCellValueByColumnAndRow(11,$j, $row["cantidad"])
          ->setCellValueByColumnAndRow(12,$j, $row["nit"])
          ->setCellValueByColumnAndRow(13,$j, $row["beneficiado"]);
          $cant2+=$row["cantidad"];
          $j++;
        }
        if(($result2->num_rows) < 1 ){
          $j++;
        }

        // $objWorkSheet->setCellValueByColumnAndRow(9,1, $cant2);
        $objWorkSheet->setCellValueByColumnAndRow(8,$currentCantidad, strval($cant-$cant2));
        $objWorkSheet->getStyle('I'.$currentCantidad)->getNumberFormat()->setFormatCode('#,##0.00');
      }


    }

    $objWorkSheet->setTitle(substr($institucion['nombre'],0,30));

    $i++;
  }

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

  if(isset($_POST["benefactor"])){
    $nameFile=$nombreBenefactor.' - '.$_POST["inicio"].'_'.$_POST["fin"].' Benefactor';
  }else{
    $nameFile="Benefactores Completo ".$_POST["inicio"].'_'.$_POST["fin"];
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

  // } catch (Exception $e) {
  //   echo 'Excepción capturada: ',  $e->getMessage(), "\n";
  // }

  echo json_encode($response,true);
  mysqli_close($conexion);

?>
