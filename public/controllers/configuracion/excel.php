<?php

require("../../includes/dsn_open.php");

$response = array();
$response['success'] = true;
$response['message'] = 'Hecho.';


$query="SELECT * FROM entrada ";

$result=$conexion->query($query);

?>

<?php
  // $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
   error_reporting(E_ERROR);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('Europe/London');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';

  // Create new PHPExcel object
  echo date('H:i:s') , " Create new PHPExcel object" , EOL;
  $objPHPExcel = new PHPExcel();

  // Set document properties
  echo date('H:i:s') , " Set document properties" , EOL;
  $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
  							 ->setLastModifiedBy("Maarten Balliauw")
  							 ->setTitle("PHPExcel Test Document")
  							 ->setSubject("PHPExcel Test Document")
  							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
  							 ->setKeywords("office PHPExcel php")
  							 ->setCategory("Test result file");


  // Add some data
  echo date('H:i:s') , " Add some data" , EOL;
  $sheet = $objPHPExcel->getActiveSheet();

    //Start adding next sheets
    $i=0;
    while ($i < 10) {

      // Add new sheet
      $objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating

      //Write cells
      $objWorkSheet->setCellValue('A1', 'Hello'.$i)
                   ->setCellValue('B2', 'world!')
                   ->setCellValue('C1', 'Hello')
                   ->setCellValue('D2', 'world!');

      // Rename sheet
      $objWorkSheet->setTitle("$i");

      $i++;
    }

  // Miscellaneous glyphs, UTF-8
  $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A4', 'Miscellaneous glyphs')
              ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');


  $objPHPExcel->getActiveSheet()->setCellValue('A8',"Hello\nWorld");
  $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);


  $value = "-ValueA\n-Value B\n-Value C";
  $objPHPExcel->getActiveSheet()->setCellValue('A10', $value);
  $objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(-1);
  $objPHPExcel->getActiveSheet()->getStyle('A10')->getAlignment()->setWrapText(true);
  $objPHPExcel->getActiveSheet()->getStyle('A10')->setQuotePrefix(true);



  // Rename worksheet
  echo date('H:i:s') , " Rename worksheet" , EOL;
  $objPHPExcel->getActiveSheet()->setTitle('Simple');


  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);


  // Save Excel 2007 file
  echo date('H:i:s') , " Write to Excel2007 format" , EOL;
  $callStartTime = microtime(true);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
  // Echo memory usage
  echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


  // Save Excel 95 file
  echo date('H:i:s') , " Write to Excel5 format" , EOL;
  $callStartTime = microtime(true);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save(str_replace('.php', '.xls', __FILE__));
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
  echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
  // Echo memory usage
  echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


  // Echo memory peak usage
  echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

  // Echo done
  echo date('H:i:s') , " Done writing files" , EOL;
  echo 'Files have been created in ' , getcwd() , EOL;





  // $nombreArchivo = 'ExcelEntradas.xls';
  // header("Content-Type: application/vnd.ms-excel");
  // header("Content-Disposition: attachment; filename=" . "$nombreArchivo");
  // $handle = fopen($nombreArchivo,'w+');
  // $handle = fopen($nombreArchivo,'w+');
  //     fwrite($handle,$return);

  // if(!fclose($handle)){
  //   $response['success'] = false;
  //     $response['message'] = 'Ha ocurrido un error, intente nuevamente.';
  //     http_response_code(500);
  //     echo json_encode($response);
  //     exit();
  //   }else{
  //     http_response_code(200);
  //   }
?>
