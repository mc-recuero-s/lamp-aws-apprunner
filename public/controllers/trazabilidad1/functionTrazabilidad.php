<?php

function eliminarCarpeta2($carpeta) {    
    if (is_dir($carpeta)) {      
        $archivos = glob($carpeta . '/*');      
        foreach ($archivos as $archivo) {          
            if (is_dir($archivo)) {                              
                eliminarCarpeta2($archivo);
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

function buscarYCopiarArchivo($nombreArchivo, $directorioOrigen, $directorioDestino) {    
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directorioOrigen));

    foreach ($iterator as $file) {
        if ($file->isDir()) {
            continue; 
        }
        if ($file->getFilename() === $nombreArchivo) {            
            $rutaDestino = $directorioDestino . DIRECTORY_SEPARATOR . $nombreArchivo;
            if (copy($file->getPathname(), $rutaDestino)) {
                return false;
            } else {
                return "Error al copiar el archivo.";
            }
            return; 
        }
    }

    return "El archivo pdf no se encontró en ninguna carpeta dentro del directorio origen.";
}

function trazabilidadLote($b1,$b2,$b3,$ruta, $ruta2){    
    error_reporting(E_ERROR);
    require("../../includes/dsn_open.php");
    $temp_array = array();

    
    
    $query = "SELECT e.id as id, l.id as id2 FROM entrada e INNER JOIN lote l ON l.id_entrada = e.id INNER JOIN tipo_benefactor b ON b.id = e.institucion WHERE l.categoria= '".$b1."' AND l.lote= '".$b2."' AND b.codigo= '".$b3."'";          

    $result=$conexion->query($query);
    $id=mysqli_fetch_assoc($result);

    
    
    if(isset($loteOriginal) && is_dir($ruta.$loteOriginal)){
        eliminarCarpeta2($ruta.$loteOriginal);
    }
    
    
    $loteResult = array();
    if($result && isset($id["id"])){
        $loteResult['success'] = true;
        $loteResult['lote'] = $b1."/".$b2."/".$b3."-".$id["id2"];
        $loteResult['message'] = $b1."/".$b2."/".$b3."-".$id["id2"];
        if (!is_dir($ruta.$b1."".$b2."".$b3)) {          
            if (mkdir($ruta.$b1."".$b2."".$b3, 0777, true)) {

                 error_reporting(E_ERROR);
                ini_set('display_errors', FALSE);
                ini_set('display_startup_errors', FALSE);
                ini_set('memory_limit', '2G');
                date_default_timezone_set('Europe/London');

                define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
                $objPHPExcel2 = new PHPExcel();

                // Set document properties
                $objPHPExcel2->getProperties()->setCreator("Saciar")
                ->setLastModifiedBy("Saciar - 05")
                ->setTitle("Saciar Informe Trazabilidad")
                ->setSubject("Saciar Informe Trazabilidad")
                ->setDescription("Saciar Informe Trazabilidad")
                ->setKeywords("Saciar Informe Trazabilidad")
                ->setCategory("Saciar Informe Trazabilidad");

                $query = "SELECT e.factura, bos.id as idBodega, bos.nombre as nombreBodega, l.producto, l.cantidad, l.id ,l.unidad, l.categoria, l.lote, tp.nombre as nombreCategoria, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
                FROM lote l
                INNER JOIN tipo_producto tp ON l.categoria = tp.codigo
                INNER JOIN entrada e  ON e.id = l.id_entrada
                INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
                LEFT JOIN bodega_lote bl ON bl.id_lote = l.id 
                LEFT JOIN bodega bo ON bo.id = bl.id_bodega 
                LEFT JOIN bodegas bos ON bos.id = bo.id_bodegas 
                WHERE l.id = ".$id["id2"];
                

                $result=$conexion->query($query);
                $lote=mysqli_fetch_assoc($result);

                if($result && isset($lote["id"])){


                    $objWorkSheet = $objPHPExcel2->createSheet($i);

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
                    $query2 .= "WHERE ls.id_lote = '". $id["id2"] ."'";
                    $query2 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";
                    
                    /*
                    INNER JOIN bodegas bo  ON bo.id = e.bodega
                bo.id as idBodega, bo.nombre as nombreBodega,
                    */ 
                    $result2=$conexion->query($query2);
                    $j=2;
                    $cant=$lote["cantidad"];
                    $cant2=0;

                    $loteResult2 = array();
                    $success=true;
                    
                    while($row = mysqli_fetch_assoc($result2)){
                    
                        $objWorkSheet->setCellValueByColumnAndRow(9,$j, $row["factura"])
                        ->setCellValueByColumnAndRow(10,$j, $row["fecha"])
                        ->setCellValueByColumnAndRow(11,$j, $row["cantidad"])
                        ->setCellValueByColumnAndRow(12,$j, $row["nit"])
                        ->setCellValueByColumnAndRow(13,$j, $row["beneficiado"]);
                        
                        

                        $fechaInvertida = date('m-d-Y', strtotime($row["fecha"]));
                        $partes = explode('-', $row["factura"]);      
                        
                        if (count($partes) >= 2) {                    
                            $segundoNumero = $partes[1];

                            $resultBuscar= buscarYCopiarArchivo($fechaInvertida."-".$segundoNumero.".pdf", "../../trazabilidad/pdf", $ruta.$b1."".$b2."".$b3);
                            if(!$resultBuscar){

                            }else{
                                array_push($loteResult2,$resultBuscar);
                                $success=false;
                            }
                            //     array_push($loteResult2,$resultBuscar);
                            // }
                            // if (file_exists("../../trazabilidad/pdf/".$fechaInvertida."-".$segundoNumero.".pdf")) {
                            //     if (copy("../../trazabilidad/pdf/".$fechaInvertida."-".$segundoNumero.".pdf", $ruta.$b1."".$b2."".$b3."/".  $fechaInvertida."-".$segundoNumero.".pdf")) {                          
                            //     } else {
                            //         $success=false;
                            //         array_push($loteResult2,$b1."".$b2."".$b3." - ".$row["factura"]." - ".$fechaInvertida."-".$segundoNumero.".pdf"." - error al copiar el pdf.");  
                            //     }
                            // }else{
                            //     $success=false;
                            //     array_push($loteResult2,$b1."".$b2."".$b3." - ".$row["factura"]." - ".$fechaInvertida."-".$segundoNumero.".pdf"." - el pdf no existe.");  
                            // }
                        } else {
                            $success=false;
                            array_push($loteResult2,$b1."".$b2."".$b3." - ".$row["factura"]." - La factura no tiene el consecutivo.");
                        }
                        $cant2+=$row["cantidad"];
                        $j++;
                    }
                    $loteResult['success'] = $success;
                    $loteResult['data']=$loteResult2;


                    // $objWorkSheet->setCellValueByColumnAndRow(9,1, $cant2);
                    $objWorkSheet->setCellValueByColumnAndRow(8,2, strval($cant-$cant2));
                    $objWorkSheet->getStyle('I2')->getNumberFormat()->setFormatCode('#,##0.00');
                    // $objPHPExcel->getActiveSheet()->getStyle('J2:J2')->getNumberFormat()->setFormatCode (PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

                    // echo $lote["categoria"].$lote["lote"].$lote["codBenefactor"];
                    // echo "\n";
                    $objWorkSheet->setTitle($b1."".$b2."".$b3);
                    $i++;
                }

                foreach ($objPHPExcel2->getWorksheetIterator() as $worksheet) {
                    foreach ($worksheet->getColumnIterator() as $column) {
                    $worksheet
                        ->getColumnDimension($column->getColumnIndex())
                        ->setAutoSize(true);
                    }
                }
                

                $sheetIndex = $objPHPExcel2->getIndex(
                    $objPHPExcel2->getSheetByName('Worksheet')
                );
                $objPHPExcel2->removeSheetByIndex($sheetIndex);

                $objPHPExcel2->setActiveSheetIndex(0);            

                $callStartTime = microtime(true);
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel2, 'Excel2007');            
                $objWriter->save(str_replace(__FILE__,realpath("../../")."/".$ruta2.$b1."".$b2."".$b3."/".$b1."".$b2."".$b3.".xlsx",__FILE__));
                
                
            } else {
                $loteResult['success'] = false;
                $loteResult['message'] = $b1."".$b2."".$b3." - Error creando la carpeta en el sistema";            
            }
        }

    }else{
        $loteResult['success'] = false;
        $loteResult['message'] = $b1."".$b2."".$b3." - No se encontró en la entrada en base de datos.";
        // array_push($temp_array,$b1."/".$b2."/".$b3);        
    }    
    
    return $loteResult;
}

?>