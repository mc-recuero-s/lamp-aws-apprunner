<div class="content">
  <div class="titulo">
    <h4>Inventario Actual</h4>
    <aside>
      <div class="descargar descargarPorEntrada" title="Descargar por entradas">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M15.744 16.683l.349-.199v1.717l-.349.195v-1.713zm3.414-.227l.342-.196v-1.717l-.343.195v1.718zm-1.429.813l.343-.195v-1.717l-.343.195v1.717zm.578-.329l.349-.199v-1.717l-.349.199v1.717zm-1.152.656l.343-.196v-1.717l-.343.196v1.717zm-.821.467l.343-.195v-1.717l-.343.195v1.717zm6.666-11.122v11.507l-9.75 5.552-12.25-6.978v-11.507l9.767-5.515 12.233 6.941zm-12.236-4.643l-2.106 1.19 8.891 5.234-.002.003 2.33-1.256-9.113-5.171zm1.236 10.59l-9-5.218v8.19l9 5.126v-8.098zm3.493-3.056l-8.847-5.208-2.488 1.405 8.86 5.138 2.475-1.335zm5.507-.696l-7 3.773v8.362l7-3.985v-8.15z"/></svg>
      </div>
      <div class="descargar descargarPorLote" title="Descargar por lotes">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18 10.031v-6.423l-6.036-3.608-5.964 3.569v6.499l-6 3.224v7.216l6.136 3.492 5.864-3.393 5.864 3.393 6.136-3.492v-7.177l-6-3.3zm-1.143.036l-4.321 2.384v-4.956l4.321-2.539v5.111zm-4.895-8.71l4.272 2.596-4.268 2.509-4.176-2.554 4.172-2.551zm-10.172 12.274l4.778-2.53 4.237 2.417-4.668 2.667-4.347-2.554zm4.917 3.587l4.722-2.697v5.056l-4.722 2.757v-5.116zm6.512-3.746l4.247-2.39 4.769 2.594-4.367 2.509-4.649-2.713zm9.638 6.323l-4.421 2.539v-5.116l4.421-2.538v5.115z"/></svg>
      </div>
      <div class="descargar descargarCheck" title="Crear Check list">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23.334 11.96c-.713-.726-.872-1.829-.393-2.727.342-.64.366-1.401.064-2.062-.301-.66-.893-1.142-1.601-1.302-.991-.225-1.722-1.067-1.803-2.081-.059-.723-.451-1.378-1.062-1.77-.609-.393-1.367-.478-2.05-.229-.956.347-2.026.032-2.642-.776-.44-.576-1.124-.915-1.85-.915-.725 0-1.409.339-1.849.915-.613.809-1.683 1.124-2.639.777-.682-.248-1.44-.163-2.05.229-.61.392-1.003 1.047-1.061 1.77-.082 1.014-.812 1.857-1.803 2.081-.708.16-1.3.642-1.601 1.302s-.277 1.422.065 2.061c.479.897.32 2.001-.392 2.727-.509.517-.747 1.242-.644 1.96s.536 1.347 1.17 1.7c.888.495 1.352 1.51 1.144 2.505-.147.71.044 1.448.519 1.996.476.549 1.18.844 1.902.798 1.016-.063 1.953.54 2.317 1.489.259.678.82 1.195 1.517 1.399.695.204 1.447.072 2.031-.357.819-.603 1.936-.603 2.754 0 .584.43 1.336.562 2.031.357.697-.204 1.258-.722 1.518-1.399.363-.949 1.301-1.553 2.316-1.489.724.046 1.427-.249 1.902-.798.475-.548.667-1.286.519-1.996-.207-.995.256-2.01 1.145-2.505.633-.354 1.065-.982 1.169-1.7s-.135-1.443-.643-1.96zm-12.584 5.43l-4.5-4.364 1.857-1.857 2.643 2.506 5.643-5.784 1.857 1.857-7.5 7.642z"/></svg>
      </div>
    </aside>
  </div>
  <?php
    $kilos=0;
    $litros=0;
    $unidades=0;

    $query="SELECT * FROM entrada WHERE ((estado <> 3 AND estado <> 4 AND estado <> 2) OR estado Is NULL)";
    $result=$conexion->query($query);

    $entradas=array();
    $salidas=array();
    while($row = mysqli_fetch_assoc($result)){
      array_push($entradas,$row);
    }

    foreach ($entradas as $entrada){
      $query="SELECT * FROM lote WHERE id_entrada='". $entrada['id'] ."' AND ((estado <> 3 AND estado <> 4) OR estado Is NULL) AND unidad = 'kg'";
      $result=$conexion->query($query);
      while($row = mysqli_fetch_assoc($result)){
        $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
        $query2 .= "id_lote = '". $row['id'] ."'";
        $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
        $result2=$conexion->query($query2);
        $kilos+=($row['cantidad']-mysqli_fetch_assoc($result2)['total']);
      }

      $query="SELECT * FROM lote WHERE id_entrada='". $entrada['id'] ."' AND ((estado <> 3 AND estado <> 4) OR estado Is NULL) AND unidad = 'lt'";
      $result=$conexion->query($query);
      while($row = mysqli_fetch_assoc($result)){
        $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
        $query2 .= "id_lote = '". $row['id'] ."'";
        $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
        $result2=$conexion->query($query2);
        $litros+=($row['cantidad']-mysqli_fetch_assoc($result2)['total']);
      }

      $query="SELECT * FROM lote WHERE id_entrada='". $entrada['id'] ."' AND ((estado <> 3 AND estado <> 4) OR estado Is NULL) AND unidad = 'un'";
      $result=$conexion->query($query);
      while($row = mysqli_fetch_assoc($result)){
        $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
        $query2 .= "id_lote = '". $row['id'] ."'";
        $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
        $result2=$conexion->query($query2);
        $unidades+=($row['cantidad']-mysqli_fetch_assoc($result2)['total']);
      }
    }

    echo '<div class="info" data-kg="'.$kilos.'" data-un="'.$unidades.'" data-lt="'.$litros.'">';
  ?>

    <div id="chart" style="height:400px;width:550px; margin: auto;"></div>
  </div>
</div>
