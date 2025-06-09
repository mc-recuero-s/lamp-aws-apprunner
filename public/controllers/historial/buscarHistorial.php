<?php

require("../../includes/auth.php");
$user = require_bearer_token();


  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';
  $response['entradas'] = array();
  $response['salidas'] = array();

  // $response['data'] = json_encode();
  if($_POST["entradas"] == "true"){

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
    // $query .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
    echo $query;
    $result=$conexion->query($query);

    $entradas=array();
    $salidas=array();
    while($row = mysqli_fetch_assoc($result)){
      // $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
      // $queryBenefactor .= "id = '". $row['institucion'] ."'";
      // $resultBenefactor=$conexion->query($queryBenefactor);
      //
      // while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
      //   $benefactor=$rowBenefactor['benefactor'];
      //   $codBenefactor=$rowBenefactor['codBenefactor'];
      // }
      // $row['benefactor']=$row['nombre'];
      // $row['codBenefactor']=$row['codigo'];

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
        $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
        $query2 .= "id_lote = '". $row['id'] ."'";
        $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
        // echo $query2;

        $result2=$conexion->query($query2);

        $row['total']=mysqli_fetch_assoc($result2)['total'];

        if(strtotime($row['vencimiento']) < $vencimiento){
          $vencimiento=$row['vencimiento'];
        }

        $total=$total+$row['cantidad'];
        $existencia=$existencia+($row['cantidad']-$row['total']);
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
      }




            $ediciones=array();
            if($entrada["editado"]==2){
              $query2="SELECT * FROM entrada2 WHERE ";
              $query2 .= "id_entrada = '".$entrada["id"]."'";

              $result2=$conexion->query($query2);
              $entradas2=array();
              $id_usuario="";
              while($row2 = mysqli_fetch_assoc($result2)){
                $queryBeneficiario2 = "SELECT nombre AS benefactor, nit FROM tipo_benefactor WHERE ";
                $queryBeneficiario2 .= "id = '". $row2['institucion'] ."'";
                $resultBeneficiario2=$conexion->query($queryBeneficiario2);
                while($rowBeneficiario2 = mysqli_fetch_assoc($resultBeneficiario2)){
                  $benefactor2=$rowBeneficiario2['benefactor'];
                  $nit2=$rowBeneficiario2['nit'];
                }
                $row2['benefactor']=$benefactor2;
                $row2['nit']=$nit2;

                $id_usuario=$row2['id_usuario'];
                $query3="SELECT * FROM usuario WHERE id=".$id_usuario;
                $result3=$conexion->query($query3);
                $user=mysqli_fetch_assoc($result3);
                $row2['user']=$user['nombre']." ".$user['apellido'];

                array_push($entradas2,$row2);
              }



              foreach ($entradas2 as $entrada3){
                $lotes2=array();
                $where = "";
                // $query="SELECT * FROM lote_entrada WHERE id_entrada='". $entrada['id'] ."'";
                $query2 = "SELECT * FROM lote WHERE id_entrada = ".$entrada3['id']." AND (estado = 3 OR estado = 4)";
                // echo $query2;
                $result2=$conexion->query($query2);
                $queryBeneficiario2 = "SELECT nombre AS benefactor, codigo AS codBenefactor , nit FROM tipo_benefactor WHERE ";
                $queryBeneficiario2 .= "id = '". $entrada3['institucion'] ."'";
                $resultBeneficiario2=$conexion->query($queryBeneficiario2);
                while($rowBeneficiario2 = mysqli_fetch_assoc($resultBeneficiario2)){
                  $benefactor2=$rowBeneficiario2['benefactor'];
                  $nit2=$rowBeneficiario2['nit'];
                  $codBenefactor=$rowBeneficiario2['codBenefactor'];
                }
                $entradas2['benefactor']=$benefactor2;
                $entradas2['nit']=$nit2;
                while($row2 = mysqli_fetch_assoc($result2)){
                  $row2['benefactor']=$benefactor2;
                  $row2['codBenefactor']=$codBenefactor;
                  array_push($lotes2,$row2);
                }
                $entrada3['lotes']=$lotes2;
                array_push($ediciones,$entrada3);
              }
            }

      $entrada['ediciones']=$ediciones;

      $entrada['vencimiento']=$vencimiento;

      $entrada['existencia']=$existencia;
      $entrada['total']=$total;

      $entrada['lotes']=$lotes;
      $entrada['salidas']=$salidas;

      array_push($newEntradas,$entrada);

    }

    $response['entradas']=$newEntradas;
  }

  if($_POST["salidas"] == "true"){

    $query="SELECT * FROM salida WHERE ";
    $query .= "fecha >= '".$_POST["inicio"]."'";
    $query .= " AND fecha <= '".$_POST["fin"]."'";

    $result=$conexion->query($query);

    $salidas=array();
    while($row = mysqli_fetch_assoc($result)){
      $queryBeneficiario = "SELECT nombre AS beneficiario, nit, municipio FROM tipo_beneficiado WHERE ";
      $queryBeneficiario .= "id = '". $row['institucion'] ."'";
      $resultBeneficiario=$conexion->query($queryBeneficiario);

      $beneficiario="";
      $nit="";
      $municipio="";

      while($rowBeneficiario = mysqli_fetch_assoc($resultBeneficiario)){
        $beneficiario=$rowBeneficiario['beneficiario'];
        $nit=$rowBeneficiario['nit'];
        $municipio=$rowBeneficiario['municipio'];
      }
      $row['beneficiario']=$beneficiario;
      $row['nit']=$nit;
      $row['municipio']=$municipio;

      // EDICIONES DE LA SALIDA
                      $ediciones=array();
                      if($row["estado"]==3 OR $row["estado"]==4){
                        $query2="SELECT * FROM salida2 WHERE ";
                        $query2 .= "id_salida = '".$row["id"]."'";

                        $result2=$conexion->query($query2);
                        $salidas2=array();
                        $id_usuario="";
                        while($row2 = mysqli_fetch_assoc($result2)){
                          $queryBeneficiario2 = "SELECT nombre AS beneficiario, nit, municipio FROM tipo_beneficiado WHERE ";
                          $queryBeneficiario2 .= "id = '". $row2['institucion'] ."'";
                          $resultBeneficiario2=$conexion->query($queryBeneficiario2);
                          while($rowBeneficiario2 = mysqli_fetch_assoc($resultBeneficiario2)){
                            $beneficiario2=$rowBeneficiario2['beneficiario'];
                            $nit2=$rowBeneficiario2['nit'];
                            $municipio=$rowBeneficiario2['municipio'];
                          }
                          $row2['beneficiario']=$beneficiario2;
                          $row2['nit']=$nit2;
                          $row2['municipio']=$municipio;

                          $id_usuario=$row2['id_usuario'];
                          $query3="SELECT * FROM usuario WHERE id=".$id_usuario;
                          $result3=$conexion->query($query3);
                          $user=mysqli_fetch_assoc($result3);
                          $row2['user']=$user['nombre']." ".$user['apellido'];

                          array_push($salidas2,$row2);
                        }



                        foreach ($salidas2 as $salida){
                          $lotes=array();
                          $where = "";
                          // $query="SELECT * FROM lote_salida WHERE id_salida='". $salida['id'] ."'";
                          $query2 = "SELECT l.producto, ls.cantidad, l.id, ls.estado ,l.unidad, l.categoria, l.lote, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura, e.id as id2
                          FROM lote_salida ls
                          INNER JOIN lote l  ON l.id = ls.id_lote
                          INNER JOIN entrada e  ON e.id = l.id_entrada
                          INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
                          WHERE ls.id_salida = ".$salida['id']." AND (ls.estado = 3 OR ls.estado = 4)";
                          // echo $query2;
                          $result2=$conexion->query($query2);
                          while($row2 = mysqli_fetch_assoc($result2)){
                            array_push($lotes,$row2);
                          }
                          $salida['lotes']=$lotes;

                          array_push($ediciones,$salida);
                        }
                      }



      $row['ediciones']=$ediciones;
      array_push($salidas,$row);
    }

    $newSalidas=array();

    foreach ($salidas as $salida){
      $lotes=array();
      $where = "";
      // $query="SELECT * FROM lote_salida WHERE id_salida='". $salida['id'] ."'";
      $query = "SELECT e.bodega, bos.id as idBodega, bos.nombre as nombreBodega, l.producto, ls.cantidad, l.id ,l.unidad, l.categoria, l.lote, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura, e.id as id2
      FROM lote_salida ls
      INNER JOIN lote l  ON l.id = ls.id_lote
      INNER JOIN entrada e  ON e.id = l.id_entrada
      INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
      LEFT JOIN bodega_lote bl ON bl.id_lote = l.id
      LEFT JOIN bodega bo  ON bo.id = bl.id_bodega
      LEFT JOIN bodegas bos ON bos.id = bo.id_bodegas
      WHERE ls.id_salida = ".$salida['id']." AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";

      // echo $query;
      $result=$conexion->query($query);
      $total=0;
      while($row = mysqli_fetch_assoc($result)){
        $total=$total+$row['cantidad'];
        array_push($lotes,$row);
      }
      $salida['total']=$total;
      $salida['lotes']=$lotes;


      // $ediciones=array();
      // //$query = "SELECT * FROM salida2 WHERE estado2=".$salida['id'];
      // $query = "SELECT * FROM salida WHERE estado2=".$salida['id']." AND (estado = 3 OR estado = 4)";
      // $result=$conexion->query($query);
      // // if($result){
      //   while($row = mysqli_fetch_assoc($result)){
      //     array_push($ediciones,$row);
      //   }
      // // }
      // $salida['ediciones']=$ediciones;

      array_push($newSalidas,$salida);
    }


    $response['salidas']=$newSalidas;

  }

  session_start();
  error_reporting(0);

  if(isset($_SESSION['user'])){
    $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
    $ejecutar = mysqli_query($conexion,$sql);

    $user=mysqli_fetch_assoc($ejecutar);
    unset($user['contrasena']);
    $response['usuario']=$user;
  }

  echo json_encode($response,true);
  mysqli_close($conexion);

?>
