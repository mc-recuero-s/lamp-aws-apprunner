<?php 
  require __DIR__.'../../../security/init.php';
  authorize('crear_salida');
  include __DIR__ . '../../../partials/header.php';
?>
<link href="<?= BASE_URL ?>styles/salidas.css?v=1.70" rel="stylesheet">
<script src="<?= BASE_URL ?>javascript/includes/selectize.min.js" ></script>
<link rel="stylesheet" href="<?= BASE_URL ?>styles/includes/selectize.bootstrap3.min.css" />

<div class="factura-main">

</div>
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
<section>
  <div class="info">
    <div class="titulo" title="Salidas">
      <h2><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16 10v-5l8 7-8 7v-5h-8v-4h8zm-16-8v20h14v-2h-12v-16h12v-2h-14z"/></svg></h2>
    </div>
    <div class="fecha">
      <div class="groupForm">
        <label>Fecha</label>
        <input disabled class="input-field check-in fechaInput" id="fecha" type="text" name="Fecha de Salida" placeholder="Fecha de Salida"/>
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
        <input disabled class="facturaNumber" placeholder="Factura"/>
        <?php
        $sql="SELECT * FROM salida ORDER BY id DESC LIMIT 1";
        $sql="SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = 'salida'";
        $result = $conexion->query($sql);
        if (mysqli_num_rows($result) > 0 ) {
          echo '<p>'.date("Y").'-'. mysqli_fetch_assoc($result)["AUTO_INCREMENT"].'</p>';
        }
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
        <div class="groupForm cantidad">
          <div>
            <label>Unidad</label>
            <input type="checkbox" name="hidden">
          </div>
          <div>
            <label>Cantidad</label>
            <input class="decimal" />
          </div>
        </div>
      </div>
      <div>
        <div class="groupForm unidad1">
          <label title="kg - lt - un">Medida</label>
          <select class="unidad" name="unidad" placeholder="Seleccione...">
            <option value=""></option>
            <option value="kg">Kilogramos</option>
            <option value="lt">Litros</option>
            <option value="un">Unidades</option>
          </select>
        </div>
      </div>
      <div>
        <div class="groupForm categoria">
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
        <div class="groupForm lote1">
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
        <div class="groupForm benefactor">
          <label>Benefactor</label>
          <input disabled/>
        </div>
      </div>
      <div>
        <div class="groupForm producto">
          <label>Producto</label>
          <input/>
        </div>
      </div>
      <div>
        <div class="groupForm vencimiento">
          <label>Vencimiento</label>
          <input class="check-in vencimiento"/>
        </div>
      </div>
      <div>
        <div class="groupForm ubicacion">
          <label>Ubicación</label>
          <p></p>
          <div class="article-info"><ul>
            <?php

              $sql = "SELECT * FROM bodega";
              $result = $conexion->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                   echo '<li data-id="'.$row["id"].'">'.$row["ubicacion"].'</li>';
                  }
              }
            ?>
          </ul></div>
        </div>
      </div>
      <div class="btns">
        <div class="groupForm">
          <div class="btn buscar" title="Buscar"></div>
        </div>
      </div>
    </div>
    <ul>
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
      <div class="btn crear" title="Crear Salida"></div>
      <div class="btn imprimir" title="Imprimir"></div>
      <div class="btn limpiar" title="Limpiar Contenido"></div>
    </div>
  </div>
</section>
<!-- <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script> -->
<script src="<?= BASE_URL ?>javascript/includes/ckeditor.js"></script>
<script src="<?= BASE_URL ?>javascript/salida.js?v=1.70"></script>


<?php include __DIR__ . '/partials/footer.php'; ?>
