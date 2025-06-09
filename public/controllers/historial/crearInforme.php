<?php

  require("../../includes/auth.php");
  $user = require_bearer_token();
  require("../trazabilidad1/functionTrazabilidad.php");  

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';

  error_reporting(E_ERROR);
  ini_set('display_errors', FALSE);
  ini_set('display_startup_errors', FALSE);
  ini_set('memory_limit', '2G');
  date_default_timezone_set('Europe/London');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');


  if (!is_dir('../../trazabilidad')) {      
    if (mkdir('../../trazabilidad', 0777, true)) {          
    } 
  }

  if (!is_dir('../../trazabilidad/pdf')) {      
    if (mkdir('../../trazabilidad/pdf', 0777, true)) {          
    } 
  }

  if (!is_dir('../../trazabilidad/individual')) {      
    if (mkdir('../../trazabilidad/individual', 0777, true)) {          
    } 
  }

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
  if(isset($_POST["entradas"])){
    foreach ($_POST["entradas"] as $entrada){
      $query = "SELECT e.factura, bos.id as idBodega, bos.nombre as nombreBodega, l.producto, l.cantidad, l.id ,l.unidad, l.categoria, l.lote, tp.nombre as nombreCategoria, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
      FROM lote l
      INNER JOIN tipo_producto tp ON l.categoria = tp.codigo
      INNER JOIN entrada e  ON e.id = l.id_entrada
      INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
      LEFT JOIN bodega_lote bl ON bl.id_lote = l.id 
      LEFT JOIN bodega bo ON bo.id = bl.id_bodega 
      LEFT JOIN bodegas bos ON bos.id = bo.id_bodegas 
      WHERE l.id = ".$entrada;


      $result=$conexion->query($query);
      $lote=mysqli_fetch_assoc($result);

      // echo $lote["categoria"]."".$lote["lote"]."".$lote["codBenefactor"];
      trazabilidadLote($lote["categoria"],$lote["lote"],$lote["codBenefactor"],"../../trazabilidad/individual/", "trazabilidad/individual/"); 

      if($result && isset($lote["id"])){


        $objWorkSheet = $objPHPExcel->createSheet($i);

        /*
        $lote["idBodega"])
        ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
        ->setCellValueByColumnAndRow(1,2, $lote["nombreBodega"])
        */ 
        //Write cells
        $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega')
        ->setCellValueByColumnAndRow(0,2, $lote["idBodega"])
        ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
        ->setCellValueByColumnAndRow(1,2, $lote["nombreBodega"])
        ->setCellValueByColumnAndRow(2,1, 'Nombre Línea')
        ->setCellValueByColumnAndRow(2,2, $lote["categoria"]." - ".$lote["nombreCategoria"])
        ->setCellValueByColumnAndRow(3,1, 'Referencia')
        ->setCellValueByColumnAndRow(3,2, $lote["categoria"].$lote["lote"].$lote["codBenefactor"])
        ->setCellValueByColumnAndRow(4,1, 'Descripción')
        ->setCellValueByColumnAndRow(4,2, $lote["producto"])
        ->setCellValueByColumnAndRow(5,1, 'Unidad')
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


        $query2 = "SELECT e.bodega, bos.id as idBodega, bos.nombre as nombreBodega, ls.cantidad, s.factura, s.fecha, tb.nombre as beneficiado, tb.nit  FROM lote_salida ls
        INNER JOIN salida s  ON ls.id_salida = s.id
        INNER JOIN tipo_beneficiado tb ON s.institucion = tb.id 
        INNER JOIN lote l ON ls.id_lote = l.id
        INNER JOIN entrada e ON e.id = l.id_entrada
        LEFT JOIN bodega_lote bl ON bl.id_lote = l.id
        LEFT JOIN bodega bo  ON bo.id = bl.id_bodega
        LEFT JOIN bodegas bos ON bos.id = bo.id_bodegas ";
        $query2 .= "WHERE ls.id_lote = '". $entrada ."'";
        $query2 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";

        /*
        INNER JOIN bodegas bo  ON bo.id = e.bodega
      bo.id as idBodega, bo.nombre as nombreBodega,
        */ 
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

        // $objWorkSheet->setCellValueByColumnAndRow(9,1, $cant2);
        $objWorkSheet->setCellValueByColumnAndRow(8,2, strval($cant-$cant2));
        $objWorkSheet->getStyle('I2')->getNumberFormat()->setFormatCode('#,##0.00');
        // $objPHPExcel->getActiveSheet()->getStyle('J2:J2')->getNumberFormat()->setFormatCode (PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        // echo $lote["categoria"].$lote["lote"].$lote["codBenefactor"];
        // echo "\n";
        $objWorkSheet->setTitle($lote["categoria"].$lote["lote"].$lote["codBenefactor"]);
        $i++;
      }
    }
  }


  if(isset($_POST["salidas"])){
    foreach ($_POST["salidas"] as $salida){
      $objWorkSheet = $objPHPExcel->createSheet($i);
      $objWorkSheet->setCellValueByColumnAndRow(0,1, 'Bodega')
                   ->setCellValueByColumnAndRow(0,2, $salida["lotes"][0]["bodega"])
                   ->setCellValueByColumnAndRow(1,1, 'Nombre Bodega')
                   ->setCellValueByColumnAndRow(1,2, $salida["lotes"][0]["nombreBodega"])
                   ->setCellValueByColumnAndRow(2,1, 'NIT')
                   ->setCellValueByColumnAndRow(2,2, $salida["nit"])
                   ->setCellValueByColumnAndRow(3,1, 'Institución Beneficiada')
                   ->setCellValueByColumnAndRow(3,2, $salida["beneficiario"])
                   ->setCellValueByColumnAndRow(4,1, 'Total')
                   ->setCellValueByColumnAndRow(4,2, $salida["total"].'Ex')
                   ->setCellValueByColumnAndRow(5,1, 'fecha')
                   ->setCellValueByColumnAndRow(5,2, $salida["fecha"])
  
                   ->setCellValueByColumnAndRow(6,1, 'Benefactor')
                   ->setCellValueByColumnAndRow(7,1, 'Lote')
                   ->setCellValueByColumnAndRow(8,1, 'Producto')
                   ->setCellValueByColumnAndRow(9,1, 'Cantidad')
                   ->setCellValueByColumnAndRow(10,1, 'Unidad');
                 //  ->setCellValueByColumnAndRow(11,1, 'Bodega')
                  // ->setCellValueByColumnAndRow(12,1, 'Nombre Bodega');
  
      $salidas=array();
      $j=2;
      foreach ($salida["lotes"] as $lote){
  
        $objWorkSheet->setCellValueByColumnAndRow(6,$j, $lote["benefactor"])
                    ->setCellValueByColumnAndRow(7,$j, $lote["categoria"].$lote["lote"].$lote["codBenefactor"])
                    ->setCellValueByColumnAndRow(8,$j, $lote["producto"])
                    ->setCellValueByColumnAndRow(9,$j, $lote["cantidad"])
                    ->setCellValueByColumnAndRow(10,$j, $lote["unidad"]);
                    //->setCellValueByColumnAndRow(11,$j, $lote["bodega"])
                    //->setCellValueByColumnAndRow(12,$j, $lote["nombreBodega"]);
        $j++;
      }
  
      $objWorkSheet->setTitle('S-'.$salida["factura"]);
  
      $i++;
    }
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

  $nameFile="Informe_".date("Y-m-d-h-i-sa");

  $callStartTime = microtime(true);
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

  if (!file_exists(realpath("../../").'/soportes/informes')) {
    mkdir(realpath("../../").'/soportes/informes', 0777, true);
  }

  $objWriter->save(str_replace(__FILE__,realpath("../../").'/soportes/informes/'.$nameFile.'.xlsx',__FILE__));

  $data = array();
  $data["file"]=$nameFile;

  $response["data"]=$data;

  echo json_encode($response,true);
  mysqli_close($conexion);

?>
