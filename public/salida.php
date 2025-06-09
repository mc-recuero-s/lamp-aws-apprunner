<?php include __DIR__ . '/partials/header2.php'; ?>

<?php

  require("./includes/dsn_open.php");



  $query="SELECT *
  FROM salida
  WHERE id= ".$_GET['id'];


  $ejecutar = $conexion->query($query);
  $salida= mysqli_fetch_object($ejecutar);

  $idSalida=$salida->id;
  

  if($salida){
    // $producto= mysqli_fetch_object($producto);
  }else{
    // echo'<script type="text/javascript">window.location.href="index.php";</script>';
  }

  $queryBeneficiario = "SELECT * FROM tipo_beneficiado WHERE ";
  $queryBeneficiario .= "id = '". $salida->institucion ."'";
  $resultBeneficiario=$conexion->query($queryBeneficiario);

  $institucion= mysqli_fetch_object($resultBeneficiario);
?>

<aside class="salida1">
  <?php

    // if($salida->estado==3){
    //   echo '<div class="entrada-nota">Esta Salida fue editada y la factura real es <a target="_blank" href="./salida.php?id='.$salida2->id.'">'.$salida2->factura.'</a></div>';
    // }
  ?>
  <div class="salida1-content">
    <article class="entrada-head">
      <div class="entrada-cod">
        <?php
         ?>
      </div>
      <div class="entrada-info">
        <h3><?php echo $institucion->nit; ?> </h3>
        <h3><?php echo $institucion->municipio ?></h3>
        <h3><?php echo $institucion->poblacion ?></h3>

      </div>
    </article>
    <article class="entrada-body">
      <div>
        <h3><?php echo $institucion->nombre; ?></h3>
        <h4>factura: <?php echo date("Y", strtotime($salida->fecha))."-".$idSalida; ?></h4>
        <h4>factura Registrada: <?php echo $salida->factura ?></h4>
        <h6><?php
          $date = date_create($salida->fecha);
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

      $query = "SELECT l.producto, ls.cantidad, l.id ,l.unidad, l.categoria, l.lote, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura, e.id as id2
      FROM lote_salida ls
      INNER JOIN lote l  ON l.id = ls.id_lote
      INNER JOIN entrada e  ON e.id = l.id_entrada
      INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
      WHERE ls.id_salida = ".$idSalida." AND ((ls.estado <> 3 AND ls.estado <> 4) OR ls.estado Is NULL)";

      $result=$conexion->query($query);

      $total=0;
      $existencia=0;

      $salidas=array();
      $vencimiento=strtotime('01/01/3001');
      while($row = mysqli_fetch_assoc($result)){

        $total=$total+$row['cantidad'];
        echo '<li data-id="1288">
           <div>
              <p>'.$row['producto'].'</p>
              <p>'.$row['benefactor'].'</p>
              <p>'.$row['cantidad'].' '.$row['unidad'].'</p>
              <p>'.$row['categoria'].''.$row['lote'].''.$row['codBenefactor'].'</p>
              <p><a target="_blank" href="./entrada.php?id='.$row['id2'].'">'.$row['factura'].'</a></p>
              <div class="ico agregarEntrada ico_addFolder" title="Agregar a Informe"></div>
           </div>
        </li>';
      }
      ?>
      </ul>
    </article>
  </div>
</aside>



<?php

include __DIR__ . '/partials/footer.php';
?>
