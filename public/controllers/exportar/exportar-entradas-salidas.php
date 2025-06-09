<?php

  require("../../includes/dsn_open.php");

  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once __DIR__ . '/../../vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Csv;

  $spreadsheet = new Spreadsheet();

  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setCellValue('A1', 'Fecha del Documento');
  $sheet->setCellValue('B1', 'Tipo Transacción');
  $sheet->setCellValue('C1', 'Número del Documento');
  $sheet->setCellValue('D1', 'Cliente Acreedor');
  $sheet->setCellValue('E1', 'Bodega');
  $sheet->setCellValue('F1', 'Referencia');
  $sheet->setCellValue('G1', 'Código del Concepto');
  $sheet->setCellValue('H1', 'Documento Destino');
  $sheet->setCellValue('I1', 'Concepto de Pago');
  $sheet->setCellValue('J1', 'Tipo Iva');
  $sheet->setCellValue('K1', 'Cantidad');
  $sheet->setCellValue('L1', 'Precio');
  $sheet->setCellValue('M1', 'Total Descuento');
  $sheet->setCellValue('N1', 'Centro de Costo');

  $fila = 2;

  $inicio= $_POST["inicio"];
  $fin= $_POST["fin"];

  $query="SELECT e.id, e.archivos, e.factura, e.fecha, e.institucion, e.persona, e.documento,
    e.categoria, e.estado, e.placa, e.personaDigitado, e.idCentroCostos, e.tipo,  e.editado, e.certificadoDonacion,
    e.valorCertificadoDonacion, tb.nombre AS benefactor, tb.codigo AS codBenefactor, tb.creacion, tb.nit,
    cc.nombre AS costos
    FROM entrada e
    INNER JOIN tipo_benefactor tb  ON e.institucion = tb.id
    INNER JOIN centrodecostos cc  ON e.idCentroCostos = cc.id
    WHERE ";
    $query .= "fecha >= '".$_POST["inicio"]."'";
    $query .= " AND fecha <= '".$_POST["fin"]."'";
    
    $result=$conexion->query($query);

    $entradas=array();
    $salidas=array();
    while($row = mysqli_fetch_assoc($result)){
      array_push($entradas,$row);
    }
    $newEntradas=array();

    foreach ($entradas as $entrada){
      $lotes=array();
      $where = "";
      $query="SELECT * FROM lote WHERE id_entrada='". $entrada['id'] ."'";
      $query .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";

      $result=$conexion->query($query);

      $total=0;
      $existencia=0;

      $salidas=array();
      $vencimiento=strtotime('01/01/3001');
      while($row = mysqli_fetch_assoc($result)){
        if(strtotime($row['vencimiento']) < $vencimiento){
          $vencimiento=$row['vencimiento'];
        }

        $row['benefactor']=$entrada['benefactor'];
        $row['codBenefactor']=$entrada['codBenefactor'];
        array_push($lotes,$row);

        $query3="SELECT ls.id_lote ,ls.cantidad, s.id as factura, tb.nombre, s.fecha FROM lote_salida ls
        INNER JOIN salida s ON ls.id_salida = s.id
        INNER JOIN tipo_beneficiado tb ON tb.id = s.institucion
        WHERE ls.id_lote='". $row['id'] ."'";
        $query3 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";

        $result3=$conexion->query($query3);

        while($row3 = mysqli_fetch_assoc($result3)){
          array_push($salidas,$row3);
        }

        $sheet->setCellValue("A{$fila}", $entrada['fecha']     ?? 'N/A');
        $sheet->setCellValue("B{$fila}", 16                    ?? 'N/A');
        $sheet->setCellValue("C{$fila}", 0                     ?? 'N/A'); //
        $sheet->setCellValue("D{$fila}", 0                     ?? 'N/A'); //
        $sheet->setCellValue("E{$fila}", $entrada['bodega']    ?? 'N/A'); 
        $sheet->setCellValue("F{$fila}", $row['categoria'] . $row['lote'] .$entrada['codBenefactor']    ?? 'N/A');
        $sheet->setCellValue("G{$fila}", 001                   ?? 'N/A');
        $sheet->setCellValue("H{$fila}", 0                     ?? 'N/A'); //
        $sheet->setCellValue("I{$fila}", 000                   ?? 'N/A');
        $sheet->setCellValue("J{$fila}", 99                    ?? 'N/A');
        $sheet->setCellValue("K{$fila}", $row['cantidad']      ?? 'N/A');
        $sheet->setCellValue("L{$fila}", $row['valorUnitario'] ?? 'N/A');
        $sheet->setCellValue("M{$fila}", "0,00"                ?? 'N/A');
        $sheet->setCellValue("N{$fila}", 0                     ?? 'N/A'); //

        $fila++;
      }
    }
    
    // $datos = [
    //     [
    //         'fecha'         => '2025-04-10',
    //         'tipoTrans'     => 'Venta',
    //         'numeroDoc'     => 'F001-0001',
    //         'cliente'       => 'Empresa X',
    //         'bodega'        => 'Principal',
    //         'referencia'    => 'Ref-001',
    //         'codigoConc'    => 'CONC01',
    //         'docDestino'    => 'D001',
    //         'concepto'      => 'Pago contado',
    //         'tipoIva'       => '21%',
    //         'cantidad'      => 5,
    //         'precio'        => 100,
    //         'descTotal'     => 0,
    //         'centroCosto'   => 'N/A',
    //     ],
    // ];


  $writer = new Csv($spreadsheet);
  $writer->setDelimiter(',');
  $writer->setEnclosure('"');
  $writer->setSheetIndex(0);

  header('Content-Type: text/csv; charset=Windows-1252');
  header('Content-Disposition: attachment; filename="entradas-salidas-'.$inicio." ".$fin.'.csv"');
  header('Cache-Control: max-age=0');

  ob_start();

  $writer->save('php://output');
  $csvOutput = ob_get_clean();

  $csvConverted = mb_convert_encoding($csvOutput, 'Windows-1252', 'UTF-8');
  echo $csvConverted;
  exit;
?>