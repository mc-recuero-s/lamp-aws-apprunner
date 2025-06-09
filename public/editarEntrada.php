<?php include __DIR__ . '/partials/header2.php'; ?>
<link href="./styles/entradas.css?v=1.70" rel="stylesheet">
<script src="./javascript/includes/selectize.min.js"></script>
<link rel="stylesheet" href="./styles/includes/selectize.bootstrap3.min.css" />

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
<?php
 echo '<section class="editarEntrada" data-id="'.$_GET["id"].'">';
?>
  <div class="info">
    <div class="reset-busqueda">
    </div>
    <div class="titulo hide" title="Entradas">
      <h2><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path d="M8 10v-5l8 7-8 7v-5h-8v-4h8zm2-8v2h12v16h-12v2h14v-20h-14z" />
        </svg></h2>
    </div>
    <div class="fecha">
      <div class="groupForm">
        <label>Fecha</label>
        <input class="input-field check-in fechaInput" type="text" placeholder="Fecha de Entrada" />
      </div>
      <div class="groupForm">
        <div class="formFIle">
          <input id="file" type="file" />
        </div>
      </div>
      <ul class="listFiles"></ul>
    </div>
    <div class="institucion">
      <div class="groupForm">
        <label>Benefactor</label>
        <select id="benefactor" placeholder="Seleccione...">
          <option value="">Seleccione...</option>
          <?php

          $sql = "SELECT * FROM tipo_benefactor";
          $result = $conexion->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<option value=" . $row["codigo"] . "-" . $row["id"] . "-" . $row["nit"] . ">" . $row["nombre"] . "</option>";
            }
          } else {
            echo "<option value='NHB'>No hay Benefactores</option>";
          }
          ?>
        </select>
        <input placeholder="NIT" value="" disabled />
      </div>
    </div>
    <div class="recibido">
      <div class="groupForm">
        <label>Recibido por</label>
        <select id="recibido" placeholder="Seleccione...">
          <option value="">Seleccione...</option>
          <?php

          $sql = "SELECT * FROM recibido WHERE tipo=1";
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
        <input placeholder="Documento" class="number" value="" disabled />
      </div>
    </div>
    <div class="placa">
      <div class="groupForm">
        <label>Placa</label>
        <select id="placa" placeholder="Seleccione...">
          <option value="">Seleccione...</option>
          <?php
          $sql = "SELECT * FROM placas";
          $result = $conexion->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<option value=" . $row["id"] . ">" . $row["placa"] . "</option>";
            }
          } else {
            echo "<option value='NHB'>No hay registros</option>";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="digitado">
      <div class="groupForm">
        <label>Digitado por</label>
        <select id="digitado" placeholder="Seleccione...">
          <option value="">Seleccione...</option>
          <?php

          $sql = "SELECT * FROM digitadores ";
          $result = $conexion->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<option value=" . $row["cedula"] . ">" . $row["nombre"] . "</option>";
            }
          } else {
            echo "<option value='NHB'>No hay registros</option>";
          }
          ?>
        </select>
        <input placeholder="Documento" class="number" value="" disabled />
      </div>
    </div>
  </div>

  <div class="info">

    <div class="titulo hide" title="Entradas">

    </div>
    <div class="tipo">
      <div class="groupForm">
        <label>Tipo</label>
        <select id="tipo" placeholder="Seleccione...">
          <option value="">Seleccione...</option>
          <option value="1">Donación</option>
          <option value="2">Compra</option>
        </select>
      </div>

      <ul class="listFiles"></ul>
    </div>
    <div class="cCostos">
      <div class="groupForm">
        <label>Centro de costos</label>
        <select id="cCostos" placeholder="Seleccione...">
          <option value="">Seleccione...</option>
          <?php

          $sql = "SELECT * FROM centrodecostos ";
          $result = $conexion->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<option value=" . $row["id"] . ">" . $row["nombre"] . "</option>";
            }
          } else {
            echo "<option value='NHB'>No hay registros</option>";
          }
          ?>
        </select>
        <input placeholder="Codigo" type="text" name="" id="" disabled>
      </div>
    </div>
    <div class="certificado">
      <div class="groupForm">
        <label>Certificado de donación</label>
        <select id="certificado" placeholder="Seleccione..." onchange="if(this.value=='1' || this.value =='3') {document.getElementById('valor').disabled = true; document.getElementById('valor').value =0 } else {document.getElementById('valor').disabled = false; document.getElementById('valor').value =null} ">
          <option value="">Seleccione...</option>
          <option value="2">Si</option>
          <option value="3">No</option>
        </select>

        <label>Valor $</label><input id="valor" placeholder="Valor" class="number" value="" disabled />
      </div>
    </div>

    <div class="bodega">
      <div class="groupForm">
        <label>Bodega</label>
        <select id="bodega" placeholder="Seleccione...">
          <option value="">Seleccione...</option>
          <?php
          $sql = "SELECT * FROM bodegas";
          $result = $conexion->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo "<option value=" . $row["id"] . ">" . $row["nombre"] . "</option>";
            }
          } else {
            echo "<option value='NHB'>No hay registros</option>";
          }
          ?>
        </select>
      </div>
    </div>


    <div class="factura">
      <div class="groupForm">
        <label>Factura</label>
        <input class="facturaNumber" placeholder="Factura" />
        <?php
        // $sql="SELECT * FROM entrada ORDER BY id DESC LIMIT 1";
        // $result = $conexion->query($sql);
        // if (mysqli_num_rows($result) > 0 ) {
        //   echo '<p>'. mysqli_fetch_assoc($result)["factura"] .'</p>';
        // }
        ?>
      </div>
      <div class="groupForm traslado">
        <input type="checkbox" name="hidden">
        <label>Traslado</label>
      </div>

      <div class="factura">
        <div class="groupForm">

        </div>
      </div>
    </div>
  </div>
  </div>
  </div>


  <div class="content-lote">
    <div class="nuevo">
      <div>
        <div class="groupForm">
          <label>Cantidad</label>
          <input class="decimal" />
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label title="kg - lt - un">Unidad</label>
          <select class="unidad" name="unidad" placeholder="Seleccione...">
            <option value=""></option>
            <option value="kg">Kilogramos</option>
            <option value="lt">Litros</option>
            <option value="un">Unidades</option>
          </select>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Categoria</label>
          <select id="categorias" name="categorias" placeholder="Seleccione...">
            <option value=""></option>

            <?php

            $sql = "SELECT * FROM tipo_producto";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["codigo"] . '">' . $row["nombre"] . '</option>';
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Lote</label>
          <input class="lote" />
        </div>
      </div>
      <div class="hide">
        <div class="groupForm">
          <label>Benefactor</label>
          <select id="cars" ,="," name="cars">
            <option value="NVR">NVR</option>
            <option value="GR">GR</option>
            <option value="IZR">IZR</option>
            <option value="PR">PR</option>
          </select>
        </div>
      </div>
      <div class="hide">
        <div class="groupForm">
          <label>Benefactor</label>
          <input />
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Producto</label>
          <input />
        </div>
      </div>
      <!--
     <div>
       <div class="groupForm">
         <label>Ubicación bodega</label>
         <select id="bodega" name="bodega" placeholder="Seleccione...">
           <option value=""></option>

           <?php

            $sql = "SELECT * FROM bodega";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . $row["ubicacion"] . '</option>';
              }
            }
            ?>
         </select>
       </div>
     </div> -->
      <div>
        <div class="groupForm">
          <label>Vencimiento</label>
          <input class="check-in vencimiento" />
        </div>
      </div>
      <div>
        <div class="groupForm ubicacion">
          <label>Ubicación</label>
          <p></p>
          <div class="article-info">
            <ul>
              <?php

              $sql = "SELECT * FROM bodega";
              $result = $conexion->query($sql);

              if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                  echo '<li data-id="' . $row["id"] . '">' . $row["ubicacion"] . '</li>';
                }
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="btns">
        <div class="groupForm">
          <div class="btn save add" title="Agregar Lote"></div>
          <div class="btn cancel" title="Cancelar"></div>
        </div>
      </div>
    </div>
    <ul>
      <li>
        <div>
          <p>39</p>
          <p>Cantidad</p>
        </div>
        <div>
          <p>Unidad</p>
        </div>
        <div>
          <p>FR</p>
        </div>
        <div>
          <p>030420</p>
        </div>
        <div>
          <p>Label1</p>
        </div>
        <div>
          <p>26 Marzo 2020</p>
        </div>
        <div class="btns">
          <div class="btn edit" title="Editar"></div>
          <div class="btn delete" title="Eliminar"></div>
          <div class="btn duplicate" title="Duplicar"></div>
        </div>
      </li>
    </ul>
    <div class="acciones">
      <div class="btn subir" title="Subir"></div>
      <div class="btn crear" title="Crear Entrada"></div>
      <div class="btn imprimir" title="Imprimir"></div>
    </div>
  </div>
</section>
<script src="./javascript/editarEntrada.js?v=1.70"></script>
