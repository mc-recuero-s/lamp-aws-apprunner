<?php

function complete_entradas($conexion) {


    $query="SELECT * FROM entrada WHERE ((estado <> 3 AND estado <> 4 AND estado <> 2) OR estado Is NULL)";


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

      if($row['cantidad']>$row['total'] && $lotesExistentes==false){
        $lotesExistentes=true;
      }
      $existencia=$existencia+($row['cantidad']-$row['total']);
      $row['benefactor']=$benefactor;
      $row['codBenefactor']=$codBenefactor;
      array_push($lotes,$row);
    }
    $entrada['existencia']=$existencia;

    if($existencia<=0){
      array_push($newEntradas,$entrada);
      $entrada= "UPDATE entrada SET estado= '2' WHERE id=".$entrada['id'];

      $conexion->query($entrada);
    }else{
      array_push($newEntradas,$entrada);
      $entrada= "UPDATE entrada SET estado= '1' WHERE id=".$entrada['id'];

      $conexion->query($entrada);
    }
  }
}

function backup_tables($conexion, $tables = '*') {
  $link = mysqli_connect($conexion);
  if (mysqli_connect_errno())
  {
      echo "Error al conectarse a MySQL: " . mysqli_connect_error();
      exit;
  }
  mysqli_query($conexion, "SET NAMES 'utf8'");
  if($tables == '*')
  {
      $tables = array();
      $result = mysqli_query($conexion, 'SHOW TABLES');
      while($row = mysqli_fetch_row($result))
      {
          $tables[] = $row[0];
      }
  }
  else
  {
      $tables = is_array($tables) ? $tables : explode(',',$tables);
  }

  $return = '';
  foreach($tables as $table)
  {
      $result = mysqli_query($conexion, 'SELECT * FROM '.$table);
      $num_fields = mysqli_num_fields($result);
      $num_rows = mysqli_num_rows($result);

      $return.= 'DROP TABLE IF EXISTS '.$table.';';
      $row2 = mysqli_fetch_row(mysqli_query($conexion, 'SHOW CREATE TABLE '.$table));
      $return.= "\n\n".$row2[1].";\n\n";
      $counter = 1;

      //Over tables
      for ($i = 0; $i < $num_fields; $i++)
      {   //Over rows
          while($row = mysqli_fetch_row($result))
          {
              if($counter == 1){
                  $return.= 'INSERT INTO '.$table.' VALUES(';
              } else{
                  $return.= '(';
              }

              //Over fields
              for($j=0; $j<$num_fields; $j++)
              {
                  $row[$j] = addslashes($row[$j]);
                  $row[$j] = str_replace("\n","\\n",$row[$j]);
                  if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                  if ($j<($num_fields-1)) { $return.= ','; }
              }

              if($num_rows == $counter){
                  $return.= ");\n";
              } else{
                  $return.= "),\n";
              }
              ++$counter;
          }
      }
      $return.="\n\n\n";
  }


  if (!is_file('./soportes')) {
      mkdir('./soportes', 0777, true);
  }
  if (!is_file('./soportes/backups')) {
      mkdir('./soportes/backups', 0777, true);
  }

  $date2 = new DateTime();
  $date2->setTimezone(new DateTimeZone('America/Bogota'));  
  $nombreArchivo = './soportes/backups/backup-'.$date2->format('Ymd').'.sql';
  $handle = fopen($nombreArchivo,'w+');
  fwrite($handle,$return);
  if(!fclose($handle)){
    // return $return;
  }else{
    // return 0;
  }
}
