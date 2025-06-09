<?php include __DIR__ . '/partials/header2.php'; ?>
<link href="./styles/salidas.css?v=1.70" rel="stylesheet">
<!-- <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js" ></script> -->
<script src="./javascript/includes/selectize.min.js" ></script>
<link rel="stylesheet" href="./styles/includes/selectize.bootstrap3.min.css" />

<div class="factura-main">

</div>
<?php
  $query="SELECT * FROM salida WHERE ";
  $query .= "id = '".$_GET["id"]."'";
  $row ="";
  $result=$conexion->query($query);
  if (mysqli_num_rows($result) > 0 ) {

    $salidas=array();
    $row = mysqli_fetch_assoc($result);
    $queryBeneficiario = "SELECT nombre AS beneficiario, nit, municipio, poblacion FROM tipo_beneficiado WHERE ";
    $queryBeneficiario .= "id = '". $row['institucion'] ."'";
    $resultBeneficiario=$conexion->query($queryBeneficiario);

    while($rowBeneficiario = mysqli_fetch_assoc($resultBeneficiario)){
      $beneficiario=$rowBeneficiario['beneficiario'];
      $nit=$rowBeneficiario['nit'];
      $poblacion=$rowBeneficiario['poblacion'];
      $municipio=$rowBeneficiario['municipio'];
    }
    $row['beneficiario']=$beneficiario;
    $row['nit']=$nit;
    $row['beneficiado']='1&897987099&10 adultos&Marinilla';
    $row['beneficiado']=$row['institucion'].'&'.$nit.'&'.$poblacion.'&'.$municipio;


    $newSalidas=array();

    $salida=$row;
    $lotes=array();
    $where = "";
    // $query="SELECT * FROM lote_salida WHERE id_salida='". $salida['id'] ."'";
    $query = "SELECT ls.id, l.producto, ls.cantidad, l.cantidad AS loteCantidad, l.unidad, l.categoria, l.lote, ls.id_lote, ls.cantidad AS cantidad, tb.codigo AS codBenefactor, tb.nombre AS benefactor , l.vencimiento, e.factura
    FROM lote_salida ls
    INNER JOIN lote l  ON l.id = ls.id_lote
    INNER JOIN entrada e  ON e.id = l.id_entrada
    INNER JOIN tipo_benefactor tb  ON tb.id = e.institucion
    WHERE ls.id_salida = ".$salida['id'];

    $result=$conexion->query($query);
    $total=0;
    while($row1 = mysqli_fetch_assoc($result)){

      $total=$total+$row1['cantidad'];
      array_push($lotes,$row1);

    }
    $salida['total']=$total;
    $salida['lotes']=$lotes;

    // echo json_encode($salida);
    // echo $salida["beneficiado"];
?>
<div class="modalSaciar">
  <div class="modalSaciar-main">
    <div class="modalSaciar-header">
      <h4></h4>
      <div class="modalSaciar-close" title="cerrar"></div>
    </div>
    <div class="modalSaciar-contenido">
      <div class="modalSaciar-print">
        <textarea id="editor"></textarea>
      </div>
      <div class="modalSaciar-editar-justificar">
        <div>
          <label for="causa" >Causa</label>
          <input type="text" id="causa" name="causa" value="">
        </div>
        <div>
          <label for="descripcion">Descripción</label>
          <textarea noresize id="descripcion" name="descripcion" rows="8" cols="80"></textarea>
        </div>
        <div>
          <div class="btn" id="crear-edicion" title="Unidad">Confirmar</div>
        </div>
      </div>
    </div>
  </div>
</div>
<header class="secondMain">
  <div class="btns">
    <div class="back btn" title="Regresar"></div>
    <div class="guardarEntradas btn" title="Guardar"></div>
  </div>
  <div class="filters">
    <div class="btn active" title="Cantidad"></div>
    <div class="btn" title="Unidad"></div>
    <div class="btn" title="Producto"></div>
    <div class="btn" title="Benefactor"></div>
    <div class="btn" title="Vencimiento"></div>
  </div>
</header>
<?php
 echo '<section class="editarSalida" data-id="'.$salida["id"].'" data-beneficiado="'.$salida["beneficiado"].'" data-documento="'.$salida["documento"].'" data-fecha="'.$salida["fecha"].'">';
?>
  <div class="info">
    <div class="reset-busqueda">
    </div>
    <div class="titulo" title="Salidas">
      <h2><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 10v-5l8 7-8 7v-5h-8v-4h8zm-16-8v20h14v-2h-12v-16h12v-2h-14z"/></svg></h2>
    </div>
    <div class="fecha">
      <div class="groupForm">
        <label>Fecha</label><?php
          echo '<input disabled value="'.$row['fecha'] .'" class="input-field check-in fechaInput" id="fecha" type="text" name="Fecha de Salida" placeholder="Fecha de Salida"/>';
        ?>
      </div>
      <div class="groupForm">
        <div class="formFIle">
          <input id="file" type="file"/>
        </div>
      </div>
      <ul class="listFiles"></ul>
    </div>
    <div class="institucion">
      <div class="groupForm">
        <label>Institución Beneficiada
          <div class="info-globo">
            <p></p>
          </div>
        </label>
        <select id="beneficiado" placeholder="Seleccione..." name="beneficiado">
          <option value="">Seleccione...</option>
          <?php
            $sql = "SELECT * FROM tipo_beneficiado";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<option value="'.$row["id"].'&'.$row["nit"].'&'.$row["poblacion"].'&'.$row["municipio"].'">'.$row["nombre"].'</option>';
                }
            }
          ?>
        </select>
        <input placeholder="NIT" disabled/>
      </div>
    </div>
    <div class="recibido">
      <div class="groupForm">
        <label>Recibido por</label>
        <select id="recibido" placeholder="Seleccione...">
           <option value="">Seleccione...</option>
           <?php

             $sql = "SELECT * FROM recibido WHERE tipo=2";
             $result = $conexion->query($sql);

             if ($result->num_rows > 0) {
               // output data of each row
               while ($row = $result->fetch_assoc()) {
                 echo "<option value=" . $row["documento"] . ">" . $row["nombre"] . "</option>";
               }
             } else {
               echo "<option value='NHB'>No hay registros</option>";
             }
           ?>
        </select>
        <input placeholder="Documento" class="number" disabled/>
      </div>
    </div>
    <div class="factura">
      <div class="groupForm">
        <label>Factura</label>
        <?php
          echo '<input disabled class="facturaNumber" placeholder="Factura" value="'.$salida["factura"].'"/>';
        ?>
      </div>
    </div>
  </div>
  <div class="resultados">
    <div class="titulo">
      <h2>Resultados</h2>
    </div>
    <div class="fecha">
      <div class="groupForm">
        <label>Fecha</label>
        <input class="input-field check-in" type="text" name="Fecha de Salida" placeholder="Fecha de Salida"/>
      </div>
    </div>
    <div class="institucion">
      <div class="groupForm">
        <label>Institución Beneficiada</label>
        <input placeholder="Instirución Beneficiada"/>
        <input placeholder="NIT"/>
      </div>
    </div>
    <div class="recibido">
      <div class="groupForm">
        <label>Recibido por</label>
        <input placeholder="Nombre"/>
        <input placeholder="Documento" class="number"/>
      </div>
    </div>
    <div class="factura">
      <div class="groupForm">
        <label>Factura</label>
        <input placeholder="Factura"/>
      </div>
    </div>
  </div>
  <div class="content-lote">
    <div class="busqueda">
      <div>
        <div class="groupForm">
          <label>Cantidad</label>
          <input class="decimal"/>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label title="kg - lt - un">Unidad</label>
          <input class="unidad"/>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Categoria</label>
          <select id="categoria" placeholder="Seleccione..." name="categoria">
            <option value="">Ninguno</option>
            <?php
              $sql = "SELECT * FROM tipo_producto";
              $result = $conexion->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo '<option value="'.$row["id"].'-'.$row["codigo"].'">'.$row["nombre"].'</option>';
                  }
              }
            ?>
          </select>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Lote</label>
          <input class="lote" data-date-end-date="0d" onfocus="this.value=''"/>
        </div>
      </div>
      <div class="benefactor-form">
        <div class="groupForm selectize-control single">
          <label>Benefactor</label>
          <select id="benefactor" placeholder="Seleccione..." name="benefactores">
            <option value="">Ninguno</option>
            <?php

              $sql = "SELECT * FROM tipo_benefactor";
              $result = $conexion->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo "<option value=".$row["codigo"]."-".$row["id"]."-".$row["nit"].">" . $row["nombre"]. "</option>";
                  }
              } else {
                  echo "<option value='NHB'>No hay Benefactores</option>";
              }
            ?>
          </select>
        </div>
      </div>
      <div class="hide">
        <div class="groupForm">
          <label>Benefactor</label>
          <input disabled/>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Producto</label>
          <input/>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Vencimiento</label>
          <input class="check-in vencimiento"/>
        </div>
      </div>
      <div class="btns">
        <div class="groupForm">
          <div class="btn buscar" title="Buscar"></div>
        </div>
      </div>
    </div>
    <ul>
      <?php
        $con=1;
        foreach ($salida['lotes'] as $lote) {
          $slqEntrada="SELECT cantidad FROM lote
          WHERE id=".$lote['id_lote'];
          $resultEntrada=$conexion->query($slqEntrada);
          $cantidad=mysqli_fetch_assoc($resultEntrada)['cantidad'];
          // echo $slqEntrada;

          $query2 = "SELECT SUM(cantidad) AS total FROM lote_salida WHERE ";
          $query2 .= "id_lote = '". $lote['id_lote'] ."'";
          $query2 .= " AND ((estado <> 3 AND estado <> 4) OR estado Is NULL)";
          // echo $query2;
          $result2=$conexion->query($query2);

          // $total=$cantidad-(mysqli_fetch_assoc($result2)['total']-$lote['cantidad']);

          $total1=mysqli_fetch_assoc($result2)['total'];
          $total=$cantidad - $total1;

          echo '<li data-id="'.$lote['id_lote'].'" data-id2="'.$lote['id'].'" data-total="'.$total.'" data-cantidad="'.$cantidad.'"
          class="ui-sortable-handle" style="">
            <div>
              <p>'.$con.'</p>
              <p>'.$lote['cantidad'].'</p>
            </div>
            <div>
              <p>'.$lote['unidad'].'</p>
            </div>
            <div>
              <p>'.$lote['categoria'].'</p>
            </div>
            <div>
              <p>'.$lote['lote'].'</p>
            </div>
            <div>
              <p>'.$lote['codBenefactor'].'-'.$lote['benefactor'].'</p>
            </div>
            <div>
              <p>'.$lote['benefactor'].'</p>
            </div>
            <div>
              <p>'.$lote['producto'].'</p>
            </div>
            <div>
              <p>'.$lote['vencimiento'].'</p>
            </div>
            <div class="btns">
              <div class="hide btn edit" title="Editar"></div>
              <div class="btn delete" title="Eliminar"></div>
              <div class="hide btn duplicate" title="Duplicar"></div>
              <div class="hide btn reactivar" title="Reactivar"></div>
            </div>
            </li>';
          $con++;
        }
      ?>
    </ul>
    <div class="entradas">
      <div class="listaEntradas">
        <ul>
          <li>
            <h3>Todos</h3>
            <h4> </h4>
            <h5></h5>
          </li>
        </ul>
      </div>
      <ol>
      </ol>
    </div>
    <div class="acciones">
      <div class="btn subir" title="Subir"></div>
      <div class="btn crear" title="Completar la edición de la salida"></div>
      <div class="btn imprimir" title="Imprimir"></div>
      <div class="btn limpiar" title="Limpiar Contenido"></div>
      <div class="btn editado" style="display: none" title="Limpiar Contenido"></div>
    </div>
  </div>
</section>
<!-- <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script> -->
<script src="./javascript/includes/ckeditor.js"></script>

<script src="./javascript/editarSalida.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    selectBeneficiado[0].selectize.setValue($(".editarSalida").data("beneficiado"));
    selectRecibido[0].selectize.setValue($(".editarSalida").data("documento"));
    $(".fecha .fechaInput").val(moment($(".editarSalida").data("fecha")).format("DD MMMM YYYY"));
  })
  <?php
    echo "let salidaActual= '".$_GET["id"]."'";
   ?>
</script>


<?php
}else{
  echo "Ha ocurrido un problema y no se encuentra esta salida, intente nuevamente.";
?>

<script src="./javascript/editarSalida.js?v=1.70"></script>

<?php
}
include __DIR__ . '/partials/footer.php';
?>
