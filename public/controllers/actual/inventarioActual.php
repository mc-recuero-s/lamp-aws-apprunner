<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';


  // include "../configuracion/completarEntradas.php";
  if( isset($_POST['benefactor']) ){
    $query="SELECT * FROM entrada WHERE ";
    // $query .= "institucion = ".$_POST["benefactor"]." AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)" ;
    $query .= "institucion = ".$_POST["benefactor"]." AND ((estado = 1) OR estado Is NULL)" ;
  }else{
    // $query="SELECT * FROM entrada WHERE ((estado <> 3 AND estado <> 4 AND estado <> 2) OR estado Is NULL)";
    $query="SELECT * FROM entrada WHERE ((estado = 1) OR estado Is NULL)";
  }

  $result=$conexion->query($query);

  $entradas=array();
  while($row = mysqli_fetch_assoc($result)){
    $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
    $queryBenefactor .= "id = '". $row['institucion'] ."'";
    $resultBenefactor=$conexion->query($queryBenefactor);

    while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      $benefactor=$rowBenefactor['benefactor'];
      $codBenefactor=$rowBenefactor['codBenefactor'];
    }
    $row['benefactor']=$benefactor;
    $row['codBenefactor']=$codBenefactor;
    array_push($entradas,$row);
  }

  $lotes=array();
  $newEntradas=array();

  foreach ($entradas as $entrada){

    $where = "";
    $query="SELECT * FROM lote WHERE id_entrada='". $entrada['id'] ."'";

    if(isset($_POST['cantidad']) && $_POST['cantidad']!=""){
      $where .= " AND cantidad >= '".$_POST['cantidad']."'";
    }
    if(isset($_POST['unidad']) && $_POST['unidad']!=""){
      $where .= " AND unidad LIKE '".$_POST['unidad']."'";
    }
    if(isset($_POST['categoria']) && $_POST['categoria']!=""){
      $where .= " AND categoria LIKE '".$_POST['categoria']."'";
    }
    if(isset($_POST['lote']) && $_POST['lote']!=""){
      $where .= " AND lote LIKE '".$_POST['lote']."'";
    }
    if(isset($_POST['producto']) && $_POST['producto']!=""){
      $where .= " AND producto LIKE '%".$_POST['producto']."%'";
    }
    if(isset($_POST['vencimiento']) && $_POST['vencimiento']!=""){
      $where .= " AND vencimiento <= '".$_POST['vencimiento']."'";
    }

    if($where != ""){
      $query.= " ". $where;
    }

    $result=$conexion->query($query);

    $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
    $queryBenefactor .= "id = '". $entrada['institucion'] ."'";
    $resultBenefactor=$conexion->query($queryBenefactor);

    while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      $benefactor=$rowBenefactor['benefactor'];
      $codBenefactor=$rowBenefactor['codBenefactor'];
    }

    $lotesExistentes=false;
    $existencia=0;

    while($row = mysqli_fetch_assoc($result)){
      $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
      $query2 .= "id_lote = '". $row['id'] ."'";
      $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
      $result2=$conexion->query($query2);

      $row['total']=mysqli_fetch_assoc($result2)['total'];

      if($row['cantidad']>$row['total']){
      // if($row['cantidad']>$row['total'] && $lotesExistentes==false){
        $lotesExistentes=true;
        array_push($lotes,$row);
      }
      $existencia=$existencia+($row['cantidad']-$row['total']);
      $row['benefactor']=$benefactor;
      $row['codBenefactor']=$codBenefactor;
      // array_push($lotes,$row);
    }
    $entrada['existencia']=$existencia;

    if($existencia<=0){
      // $entrada= "UPDATE entrada SET estado= '2' WHERE id=".$entrada['id'];
      // $conexion->query($entrada);
    }else{
      array_push($newEntradas,$entrada);
    }
  }
  // echo var_dump($newEntradas);
  $busqueda['entradas']=$newEntradas;
  // include "../configuracion/completarEntradas.php";
  // echo file_exists(dirname(__FILE__)."../controllers/configuracion/completarEntradas.php");

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
  require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';

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
  if($_POST['tipo']==1){
    foreach ($newEntradas as $entrada){
      $query = "SELECT e.factura, l.producto, l.cantidad, l.id ,l.unidad, l.categoria, l.lote, tp.nombre as nombreCategoria, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
      FROM lote l
      INNER JOIN tipo_producto tp ON l.categoria = tp.codigo
      INNER JOIN entrada e  ON e.id = l.id_entrada
      INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
      WHERE e.id = ".$entrada['id'];

      // echo $query;
      $result=$conexion->query($query);

      $objWorkSheet = $objPHPExcel->createSheet($i);

      $j=2;

      $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega')
      ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
      ->setCellValueByColumnAndRow(1,2, 'RIONEGRO')
      ->setCellValueByColumnAndRow(2,1, 'Nombre Línea')
      ->setCellValueByColumnAndRow(3,1, 'Referencia')
      ->setCellValueByColumnAndRow(4,1, 'Descripción')
      ->setCellValueByColumnAndRow(5,1, 'Unidad Compra')
      ->setCellValueByColumnAndRow(6,1, 'Factura')
      ->setCellValueByColumnAndRow(7,1, 'Inicial')
      ->setCellValueByColumnAndRow(8,1, 'Existencia')
      ->setCellValueByColumnAndRow(9,1, 'Dcto')
      ->setCellValueByColumnAndRow(10,1, 'd/m/a')
      ->setCellValueByColumnAndRow(11,1, 'Cantidad')
      ->setCellValueByColumnAndRow(12,1, 'Nit')
      ->setCellValueByColumnAndRow(13,1, 'Insitucion');

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

      $objWorkSheet->setTitle($entrada["factura"]);
      $i++;

    }
  }

  if($_POST['tipo']==2){
    foreach ($lotes as $entrada){
      $query = "SELECT e.factura, l.producto, l.cantidad, l.id ,l.unidad, l.categoria, l.lote, tp.nombre as nombreCategoria, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
      FROM lote l
      INNER JOIN tipo_producto tp ON l.categoria = tp.codigo
      INNER JOIN entrada e  ON e.id = l.id_entrada
      INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
      WHERE l.id = ".$entrada['id'];

      // echo $query;

      $result=$conexion->query($query);
      $lote=mysqli_fetch_assoc($result);

      if($result && isset($lote["id"])){


        $objWorkSheet = $objPHPExcel->createSheet($i);

        // Write cells
        $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega')
        ->setCellValueByColumnAndRow(0,2, '5')
        ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
        ->setCellValueByColumnAndRow(1,2, 'RIONEGRO')
        ->setCellValueByColumnAndRow(2,1, 'Nombre Línea')
        ->setCellValueByColumnAndRow(2,2, $lote["categoria"]." - ".$lote["nombreCategoria"])
        ->setCellValueByColumnAndRow(3,1, 'Referencia')
        ->setCellValueByColumnAndRow(3,2, $lote["categoria"].$lote["lote"].$lote["codBenefactor"])
        ->setCellValueByColumnAndRow(4,1, 'Descripción')
        ->setCellValueByColumnAndRow(4,2, $lote["producto"])
        ->setCellValueByColumnAndRow(5,1, 'Unidad Compra')
        ->setCellValueByColumnAndRow(5,2, $lote["unidad"])
        ->setCellValueByColumnAndRow(6,1, 'Factura')
        ->setCellValueByColumnAndRow(6,2, $lote["factura"])
        ->setCellValueByColumnAndRow(7,1, 'Inicial')
        ->setCellValueByColumnAndRow(7,2, $lote["cantidad"])
        ->setCellValueByColumnAndRow(8,1, 'Existencia')
        ->setCellValueByColumnAndRow(8,2, $lote["cantidad"])

        ->setCellValueByColumnAndRow(9,1, 'Dcto')
        ->setCellValueByColumnAndRow(10,1, 'd/m/a')
        ->setCellValueByColumnAndRow(11,1, 'Cantidad')
        ->setCellValueByColumnAndRow(12,1, 'Nit')
        ->setCellValueByColumnAndRow(13,1, 'Insitucion');


        $query2 = "SELECT ls.cantidad, s.factura, s.fecha, tb.nombre as beneficiado, tb.nit  FROM lote_salida ls
        INNER JOIN salida s  ON ls.id_salida = s.id
        INNER JOIN tipo_beneficiado tb ON s.institucion = tb.id ";
        $query2 .= "WHERE ls.id_lote = '". $entrada['id'] ."'";
        $query2 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";
        $result2=$conexion->query($query2);
        $j=2;
        $cant=$lote["cantidad"];
        $cant2=0;
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
        $objWorkSheet->setCellValueByColumnAndRow(8,2, strval($cant-$cant2));
        $objWorkSheet->getStyle('I2')->getNumberFormat()->setFormatCode('#,##0.00');
        // echo $lote["categoria"].$lote["lote"].$lote["codBenefactor"];
        // echo "\n";
        $objWorkSheet->setTitle($lote["categoria"].$lote["lote"].$lote["codBenefactor"]);
        $i++;
      }
    }
  }

  if($_POST['tipo']==3){

    $j=2;
    $objWorkSheet = $objPHPExcel->createSheet($i);

    $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega')
    ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
    ->setCellValueByColumnAndRow(1,2, 'RIONEGRO')
    ->setCellValueByColumnAndRow(2,1, 'Nombre Línea')
    ->setCellValueByColumnAndRow(3,1, 'Referencia')
    ->setCellValueByColumnAndRow(4,1, 'Descripción')
    ->setCellValueByColumnAndRow(5,1, 'Unidad')
    ->setCellValueByColumnAndRow(6,1, 'Factura')
    ->setCellValueByColumnAndRow(7,1, 'Inicial')
    ->setCellValueByColumnAndRow(8,1, 'Existencia')
    ->setCellValueByColumnAndRow(9,1, 'Dcto')
    ->setCellValueByColumnAndRow(10,1, 'd/m/a')
    ->setCellValueByColumnAndRow(11,1, 'Cantidad')
    ->setCellValueByColumnAndRow(12,1, 'Nit')
    ->setCellValueByColumnAndRow(13,1, 'Insitucion');


    foreach ($lotes as $entrada){
      $query = "SELECT e.factura, l.producto, l.cantidad, l.id ,l.unidad, l.categoria, l.lote, tp.nombre as nombreCategoria, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
      FROM lote l
      INNER JOIN tipo_producto tp ON l.categoria = tp.codigo
      INNER JOIN entrada e  ON e.id = l.id_entrada
      INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
      WHERE l.id = ".$entrada['id'];

      // echo $query;

      $result=$conexion->query($query);
      $lote=mysqli_fetch_assoc($result);


      if($result && isset($lote["id"])){

        // Write cells
        $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega')
        ->setCellValueByColumnAndRow(0,$j, '5')
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
        $query2 .= "WHERE ls.id_lote = '". $entrada['id'] ."'";
        $query2 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";
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

        // echo $lote["categoria"].$lote["lote"].$lote["codBenefactor"];
        // echo "\n";
      }
      $objWorkSheet->setTitle("Lista de chequeo");
    }
  }

  if($_POST['tipo']==4){

    $j=2;
    $objWorkSheet = $objPHPExcel->createSheet($i);

    $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega')
    ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
    ->setCellValueByColumnAndRow(1,2, 'RIONEGRO')
    ->setCellValueByColumnAndRow(2,1, 'Nombre Línea')
    ->setCellValueByColumnAndRow(3,1, 'Referencia')
    ->setCellValueByColumnAndRow(4,1, 'Descripción')
    ->setCellValueByColumnAndRow(5,1, 'Unidad')
    ->setCellValueByColumnAndRow(6,1, 'Factura')
    ->setCellValueByColumnAndRow(7,1, 'Inicial')
    ->setCellValueByColumnAndRow(8,1, 'Existencia')
    ->setCellValueByColumnAndRow(9,1, 'Dcto')
    ->setCellValueByColumnAndRow(10,1, 'd/m/a')
    ->setCellValueByColumnAndRow(11,1, 'Cantidad')
    ->setCellValueByColumnAndRow(12,1, 'Nit')
    ->setCellValueByColumnAndRow(13,1, 'Insitucion');


    foreach ($lotes as $entrada){
      $query = "SELECT e.factura, l.producto, l.cantidad, l.id ,l.unidad, l.categoria, l.lote, tp.nombre as nombreCategoria, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
      FROM lote l
      INNER JOIN tipo_producto tp ON l.categoria = tp.codigo
      INNER JOIN entrada e  ON e.id = l.id_entrada
      INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
      WHERE l.id = ".$entrada['id'];

      // echo $query;

      $result=$conexion->query($query);
      $lote=mysqli_fetch_assoc($result);


      if($result && isset($lote["id"])){

        // Write cells
        $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega')
        ->setCellValueByColumnAndRow(0,$j, '5')
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
        $query2 .= "WHERE ls.id_lote = '". $entrada['id'] ."'";
        $query2 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";
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

        // echo $lote["categoria"].$lote["lote"].$lote["codBenefactor"];
        // echo "\n";
      }
      $objWorkSheet->setTitle("Lista de chequeo");
    }
  }

  $sheetIndex = $objPHPExcel->getIndex(
    $objPHPExcel->getSheetByName('Worksheet')
  );
  $objPHPExcel->removeSheetByIndex($sheetIndex);

  $objPHPExcel->setActiveSheetIndex(0);

  if($_POST['tipo']==1){
    $nameFile="Inventario_Por_Entrada_Actual_".date("Y-m-d-h-i-sa");
  }
  if($_POST['tipo']==2){
    $nameFile="Inventario_Por_Lotes_Actual_".date("Y-m-d-h-i-sa");
  }
  if($_POST['tipo']==3){
    $nameFile="Inventario_Lista_de_chequeo_".date("Y-m-d-h-i-sa");
  }
  if($_POST['tipo']==4){
    $nameFile="Inventario_Lista_Vencimiento_".date("Y-m-d-h-i-sa");
  }

  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
      foreach ($worksheet->getColumnIterator() as $column) {
          $worksheet
              ->getColumnDimension($column->getColumnIndex())
              ->setAutoSize(true);
      }
  }

  // $nameFile="Inventario_Por_Lotes_Actual_".date("Y-m-d-h-i-sa");
  $callStartTime = microtime(true);
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

  if (!file_exists(realpath("../../").'/soportes/informes')) {
    mkdir(realpath("../../").'/soportes/informes', 0777, true);
  }  

  $objWriter->save(str_replace(__FILE__,realpath("../../").'/soportes/informes/'.$nameFile.'.xlsx',__FILE__));

  $data = new stdClass();
  $data->file=$nameFile;

  $response["data"]=$data;

  echo json_encode($response,true);
  mysqli_close($conexion);

?>
