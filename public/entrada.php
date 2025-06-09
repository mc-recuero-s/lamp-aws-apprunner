<?php include __DIR__ . '/partials/header2.php'; ?>

<?php

  require("./includes/dsn_open.php");



  $query="SELECT *
  FROM entrada
  WHERE id= ".$_GET['id'];


  $ejecutar = $conexion->query($query);
  $entrada= mysqli_fetch_object($ejecutar);

  $query="SELECT *
  FROM tipo_benefactor
  WHERE id= ".$entrada->institucion;


  $ejecutar = $conexion->query($query);
  $institucion= mysqli_fetch_object($ejecutar);

  if($entrada){
    // $producto= mysqli_fetch_object($producto);
  }else{
    echo'<script type="text/javascript">window.location.href="index.php";</script>';
  }

  // echo var_dump($entrada);
  $lotes=array();
  $where = "";
  $query="SELECT * FROM lote WHERE id_entrada='". $entrada->id ."'";

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
    // $row['benefactor']=$entrada->benefactor;
    $row['codBenefactor']=$entrada->institucion;
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
  // $entrada['vencimiento']=$vencimiento;

  // $entrada['existencia']=$existencia;
  // $entrada['total']=$total;

  // $entrada['lotes']=$lotes;
  // $entrada['salidas']=$salidas;

  // array_push($newEntradas,$entrada);

  // echo $entrada->factura;
  $traslado='';
  if($entrada->categoria==2){
    $traslado=' - Traslado';
  }
?>

<aside class="entrada1">
  <article class="entrada-head">
    <div class="entrada-cod">
      <?php echo $institucion->codigo; ?>
    </div>
    <div class="entrada-info">
      <h3><?php echo $total; ?> /</h3>
      <h3><?php echo $existencia ?> Ex</h3>
    </div>
  </article>
  <article class="entrada-body">
    <div>
      <h3><?php echo $institucion->nombre; ?></h3>
      <h4>factura: <?php echo $entrada->factura.$traslado; ?></h4>
      <h6><?php
        $date = date_create($entrada->fecha);
        echo date_format($date, 'd-m-Y');

      ?></h6>
      <p></p>
    </div>
    <div>
      <ul>
        <li>
          <h4></h4>
          <p></p>
        </li>
      </ul>
    </div>
  </article>
  <article class="entrada-lotes article-info">
    <h4>Lotes</h4>
    <ul class="">
    <?php
    $query="SELECT * FROM lote WHERE id_entrada='". $entrada->id ."'";

    $result=$conexion->query($query);

    $total=0;
    $existencia=0;

    $salidas=array();
    $vencimiento=strtotime('01/01/3001');
    while($row = mysqli_fetch_assoc($result)){

      $query3="SELECT ls.id_lote ,ls.cantidad,s.id , s.factura as factura, tb.nombre, s.fecha FROM lote_salida ls
      INNER JOIN salida s ON ls.id_salida = s.id
      INNER JOIN tipo_beneficiado tb ON tb.id = s.institucion
      WHERE ls.id_lote='". $row['id'] ."'";
      $query3 .= " AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";
      $result3=$conexion->query($query3);
      $lote_salida='';
      $total=$row['cantidad'];
      while($row3 = mysqli_fetch_assoc($result3)){
        $total= ( ( floor($total * 100) - floor($row3['cantidad'] * 100) ) / 100 );
        $lote_salida= $lote_salida.'<li>
           <div>
              <p>'.$row3['cantidad'].' '.$row['unidad'].'</p>
              <p>'.$row3['nombre'].'</p>
              <p><a target="_blank" href="./salida.php?id='.$row3['id'].'">'.$row3['factura'].'</a></p>
           </div>
        </li>';
      }

      $date = date_create($row['vencimiento']);
      $class='';
      if($total<=0.1){
        $total=0;
        $class='completed';
      }
      echo '<li data-id="'.$row['id'].'" class="'.$class.'">
         <div>
            <p>'.$row['producto'].'</p>
            <p>'.$row['cantidad'].' '.$row['unidad'].' / '.$total.' '.$row['unidad'].'</p>
            <p>'.$row['categoria'].$row['lote'].$institucion->codigo.'</p>
            <p>'.date_format($date, 'd/m/y').'</p>
            <div class="ico agregarEntrada ico_addFolder" title="Agregar a Informe"></div>
         </div>
         <ol>'.$lote_salida.'</ol>
   </li>';
    }
    ?>
    </ul>
  </article>
</aside>



<?php

include __DIR__ . '/partials/footer.php';
?>
