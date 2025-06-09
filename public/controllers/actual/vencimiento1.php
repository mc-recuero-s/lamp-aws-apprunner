<div class="content actual-list1">
  <div class="titulo">
    <h4>Vencimiento</h4>
    <aside>
      <div class="senal">
        <div class="type4" title="Ver / Ocultar Vencidos">
          0
        </div>
        <div class="type1" title="Ver / Ocultar">
          15
        </div>
        <div class="type2" title="Ver / Ocultar">
          30
        </div>
        <div class="type3" title="Ver / Ocultar">
          +30
        </div>
      </div>
      <div class="vencidos" title="Ver / Ocultar Vencidos">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 2v22h-24v-22h3v1c0 1.103.897 2 2 2s2-.897 2-2v-1h10v1c0 1.103.897 2 2 2s2-.897 2-2v-1h3zm-2 6h-20v14h20v-14zm-2-7c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-14 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2zm1 11.729l.855-.791c1 .484 1.635.852 2.76 1.654 2.113-2.399 3.511-3.616 6.106-5.231l.279.64c-2.141 1.869-3.709 3.949-5.967 7.999-1.393-1.64-2.322-2.686-4.033-4.271z"/></svg>
      </div>
      <div class="descargar descargarPorVencimiento" title="Descargar por Vencimiento">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M17 3v-2c0-.552.447-1 1-1s1 .448 1 1v2c0 .552-.447 1-1 1s-1-.448-1-1zm-12 1c.553 0 1-.448 1-1v-2c0-.552-.447-1-1-1-.553 0-1 .448-1 1v2c0 .552.447 1 1 1zm13 13v-3h-1v4h3v-1h-2zm-5 .5c0 2.481 2.019 4.5 4.5 4.5s4.5-2.019 4.5-4.5-2.019-4.5-4.5-4.5-4.5 2.019-4.5 4.5zm11 0c0 3.59-2.91 6.5-6.5 6.5s-6.5-2.91-6.5-6.5 2.91-6.5 6.5-6.5 6.5 2.91 6.5 6.5zm-14.237 3.5h-7.763v-13h19v1.763c.727.33 1.399.757 2 1.268v-9.031h-3v1c0 1.316-1.278 2.339-2.658 1.894-.831-.268-1.342-1.111-1.342-1.984v-.91h-9v1c0 1.316-1.278 2.339-2.658 1.894-.831-.268-1.342-1.111-1.342-1.984v-.91h-3v21h11.031c-.511-.601-.938-1.273-1.268-2z"/></svg>
      </div>
    </aside>
  </div>
  <section class="container">
    <header>
      <div class="button-col">
        <button class="btn" name="Add Task"> Add Task </button>
      </div>

      <div class="dates-col">
        <label> Dates </label>
      </div>

      <div class="priority-col">
        <label> Priority </label>
      </div>

      <div class="icon-col">
        <label> Priority </label>
      </div>

    </header>
    <ul class="task-items">

      <?php
        $now = new DateTime("now");

        $query4="SELECT l.id ,e.id as id2, l.cantidad, l.unidad, e.fecha ,e.factura, e.institucion, l.producto, l.vencimiento, l.categoria, l.lote, e.categoria as estado2entrada FROM lote l
        INNER JOIN entrada e ON l.id_entrada = e.id
        WHERE ((l.estado <> 3 AND l.estado <> 4) OR l.estado Is NULL) AND ((e.estado <> 3 AND e.estado <> 4) OR e.estado Is NULL) AND l.vencimiento <= '".$now->format('Y-m-d')."' ORDER BY l.vencimiento ASC";
        $result4=$conexion->query($query4);

        $lotesExistentes=false;
        $existencia=0;
        $lotes=[];
        while($row = mysqli_fetch_assoc($result4)){
          $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
          $query2 .= "id_lote = '". $row['id'] ."'";
          $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
          $result2=$conexion->query($query2);

          $row['total']=mysqli_fetch_assoc($result2)['total'];

          $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
          $queryBenefactor .= "id = '". $row['institucion'] ."'";
          $resultBenefactor=$conexion->query($queryBenefactor);

          while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
            $benefactor=$rowBenefactor['benefactor'];
            $codBenefactor=$rowBenefactor['codBenefactor'];
          }
          $row['benefactor']=$benefactor;
          $row['codBenefactor']=$codBenefactor;

          $row['existencia']=$existencia+($row['cantidad']-$row['total']);
          if($row['cantidad']>$row['total']){
          // if($row['cantidad']>$row['total'] && $lotesExistentes==false){
            // $lotesExistentes=true;
            array_push($lotes,$row);
          }
          // $row['benefactor']=$benefactor;
          // $row['codBenefactor']=$codBenefactor;
          // // array_push($lotes,$row);
          // if($existencia>0){
          //   array_push($newLotes,$row);
          // }
        }

        foreach ($lotes as $row){
          $datetime1 = date_create($row['vencimiento']);
          $d2 = $now->format('Y-m-d');
          $datetime2 = date_create($d2);
          // echo var_dump($datetime2);
          $interval = date_diff($datetime1, $datetime2);
          $day= $interval->format('%a');
          if(!($day==0)){
            $day="-".$day;
          }
          $class='';
          echo '
            <li data-id="'.$row['id'].'" class="item type4 vencido">
              <div class="task">
                <div class="icon">'.$day.'</div>
                <div class="name">'.$row['producto'].'</div>
              </div>

              <div class="status">
                <div class="factura"> '.$factura.' </div>
                <div class="text"> '.$row['categoria'].''.$row['lote'].''.$row['codBenefactor'].' </div>
                <div class="text"> '.$row['benefactor'].' </div>
              </div>

              <div class="dates">
                <div class="unidad"> '.$row['cantidad'].' / '.$row['existencia'].$row['unidad'].' </div>
                <div class="vencimiento"> '.$row['vencimiento'].' </div>
              </div>

              <div class="user">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/></svg>
              </div>
            </li>
          ';
        }
      ?>

      <?php
        $now = new DateTime("now");

        $query3="SELECT l.id ,e.id as id2, l.cantidad, l.unidad, e.fecha ,e.factura, e.institucion, l.producto, l.vencimiento, l.categoria, l.lote, e.categoria as estado2entrada FROM lote l
        INNER JOIN entrada e ON l.id_entrada = e.id
        WHERE ((l.estado <> 3 AND l.estado <> 4) OR l.estado Is NULL) AND l.vencimiento > '".$now->format('Y-m-d')."' ORDER BY l.vencimiento ASC";
        $result=$conexion->query($query3);

        $lotesExistentes=false;
        $existencia=0;
        $lotes=[];
        while($row = mysqli_fetch_assoc($result)){
          $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
          $query2 .= "id_lote = '". $row['id'] ."'";
          $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
          $result2=$conexion->query($query2);

          $row['total']=mysqli_fetch_assoc($result2)['total'];

          $queryBenefactor = "SELECT nombre AS benefactor, codigo AS codBenefactor FROM tipo_benefactor WHERE ";
          $queryBenefactor .= "id = '". $row['institucion'] ."'";
          $resultBenefactor=$conexion->query($queryBenefactor);

          while($rowBenefactor = mysqli_fetch_assoc($resultBenefactor)){
            $benefactor=$rowBenefactor['benefactor'];
            $codBenefactor=$rowBenefactor['codBenefactor'];
          }
          $row['benefactor']=$benefactor;
          $row['codBenefactor']=$codBenefactor;

          $row['existencia']=$existencia+($row['cantidad']-$row['total']);
          if($row['cantidad']>$row['total']){
          // if($row['cantidad']>$row['total'] && $lotesExistentes==false){
            // $lotesExistentes=true;
            array_push($lotes,$row);
          }
          // $row['benefactor']=$benefactor;
          // $row['codBenefactor']=$codBenefactor;
          // // array_push($lotes,$row);
          // if($existencia>0){
          //   array_push($newLotes,$row);
          // }
        }
        // $entrada['existencia']=$existencia;





        foreach ($lotes as $row){

        // while($row = mysqli_fetch_assoc($result)){
          $datetime1 = date_create($row['vencimiento']);
          $d2 = $now->format('Y-m-d');
          $datetime2 = date_create($d2);
          // echo var_dump($datetime2);
          $interval = date_diff($datetime1, $datetime2);
          $day= $interval->format('%a');
          $class='';
          if($day<15){
            $class='type1';
          }
          if($day>=15 && $day<31){
            $class='type2';
          }
          if($day>30){
            $class='type3';
          }
          $factura=$row['factura'];
          if($row['estado2entrada']==2){
            $factura="Traslado - ".$row['factura'];
          }

          echo '
            <li data-id="'.$row['id'].'" class="item '.$class.'">
              <div class="task">
                <div class="icon">'.$day.'</div>
                <div class="name">'.$row['producto'].'</div>
              </div>

              <div class="status">
                <div class="factura"> '.$factura.' </div>
                <div class="text"> '.$row['categoria'].''.$row['lote'].''.$row['codBenefactor'].' </div>
                <div class="text"> '.$row['benefactor'].' </div>
              </div>

              <div class="dates">
                <div class="unidad"> '.$row['cantidad'].' / '.$row['existencia'].$row['unidad'].' </div>
                <div class="vencimiento"> '.$row['vencimiento'].' </div>
              </div>

              <div class="user">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/></svg>
              </div>
            </li>
          ';
        }
      ?>

    </ul>

  </section>
</div>
