<?php
 
  require("../../includes/dsn_open.php");
  require("./functionTrazabilidad.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  

  error_reporting(E_ERROR);
  ini_set('display_errors', FALSE);
  ini_set('display_startup_errors', FALSE);
  ini_set('memory_limit', '2G');
  date_default_timezone_set('Europe/London');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';

  // Create new PHPExcel object
  $objPHPExcel = new PHPExcel();


  $archivoExcel = '../../trazabilidad/rionegro.xlsx'; 
  
  $objExcel = PHPExcel_IOFactory::load($archivoExcel);
  
  $hoja = $objExcel->getSheet(0);
  
  $ultimaFila = $hoja->getHighestRow();
  $temp_array = array();

  if (!is_dir('../../trazabilidad')) {      
    if (mkdir('../../trazabilidad', 0777, true)) {          
    } 
  } 

  function eliminarCarpeta($carpeta) {    
    if (is_dir($carpeta)) {      
      $archivos = glob($carpeta . '/*');      
      foreach ($archivos as $archivo) {          
          if (is_dir($archivo)) {              
              eliminarCarpeta($archivo);
          } else {     
            if(file_exists($archivo)){         
              unlink($archivo);
            }
          }
      }      
      rmdir($carpeta);      
    } else {      
    }
  }
  
  eliminarCarpeta('../../trazabilidad/result');
  
   
  if (!is_dir('../../trazabilidad/result')) {      
    if (mkdir($nombreDirectorio, 0777, true)) {          
    } 
  } 
  if (!is_dir('../../trazabilidad/pdf')) {      
    if (mkdir($nombreDirectorio, 0777, true)) {          
    } 
  } 

  // for ($fila = 2; $fila <= 10; $fila++) {      
  for ($fila = 2; $fila <= $ultimaFila; $fila++) {      
      $datosFila = $hoja->rangeToArray('E' . $fila . ':' . $hoja->getHighestColumn() . $fila, null, true, false);

      $patron = '/([A-Za-z]+)([0-9]+)([A-Za-z]+)/';
      preg_match_all($patron, $loteOriginal, $coincidencias, PREG_SET_ORDER);
      $b1="";
      $b2="";
      $b3="";
      foreach ($coincidencias as $coincidencia) {        
          $b1 = $coincidencia[1];
          $b2 = $coincidencia[2];
          $b3 = $coincidencia[3];
      }
      
      $loteResult=trazabilidadLote($b1,$b2,$b3,"../../trazabilidad/result/","trazabilidad/result/");      

      array_push($temp_array,$loteResult);
      // print_r($datosFila[0]);
  }
  














  
  $response['data'] = $temp_array;
  http_response_code(200);
  echo json_encode($response);
  
  mysqli_rollback($conexion);

  mysqli_close($conexion);

?>