
<?php 
  require __DIR__.'../../../security/init.php';
  $modulo='crear_entrada';
  authorize($modulo);
  include __DIR__ . '../../../partials/header.php';
?>
<link href="<?= BASE_URL ?>styles/entradas.css?v=1.70" rel="stylesheet">
<script src="<?= BASE_URL ?>javascript/includes/selectize.min.js?v=1.70"></script>
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
<section>
  <div class="info">
    <div class="titulo hide" title="Entradas">
      <h2><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path d="M8 10v-5l8 7-8 7v-5h-8v-4h8zm2-8v2h12v16h-12v2h14v-20h-14z" />
        </svg></h2>
    </div>
    <div class="fecha">
      <?php
        $perm = 'archivo';
        if (hasPermission($modulo, $perm )):
        ?>
        <div class="groupForm" data-per="<?= $perm ?>">
          <label>Fecha</label>
          <input
            class="input-field check-in fechaInput"
            type="text"
            placeholder="Fecha de Entrada"
          />
        </div>
      <?php endif; ?>
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
        <select id="certificado" placeholder="Seleccione...">
          <option value="2">Si</option>
          <option value="3" selected>No</option>
        </select>

        <label>Valor</label><input id="valor" placeholder="Valor" class="decimal2" value="" disabled />
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
      <div class="cantidades groupForm">
        <label title="Unidad * peso = total peso">Unidad / Peso / Total Peso</label>
        <section>
          <div class="groupForm unidad1">
            <input class="entero" />
          </div>
          <div class="groupForm cantidad-unidad">
            <input class="decimal" />
          </div>
          <div class="groupForm cantidad">
            <input class="decimal" />
          </div>
        </section>
      </div>
      <div>
        <div class="groupForm unidad-peso">
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
        <div class="groupForm lote">
          <label>Lote</label>
          <input disabled class="lote" />
        </div>
      </div>
      <div>
        <div class="groupForm producto">
          <label>Producto</label>
          <input />
        </div>
      </div>
      <div>
        <div class="groupForm vencimiento">
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
      <section class="valor-content">
        <div>
          <div class="groupForm valor-unitario">
            <label>Valor unitario</label>
            <input class="decimal"/>
          </div>
        </div>
        <div>
          <div class="groupForm valor-iva">
            <label>Valor IVA</label>
            <select class="select-iva" name="select-iva" placeholder="Seleccione...">
              <option value="-1" disabled selected>Seleccione...</option>
              <option value="0"> 0%</option>
              <option value="5"> 5%</option>
              <option value="8"> 8%</option>
              <option value="10">10%</option>
              <option value="16">16%</option>
              <option value="19">19%</option>
            </select>
          </div>
        </div>
        <div>
          <div class="groupForm valor-unitario-total">
            <label>Total unitario</label>
            <input disabled/>
          </div>
        </div>
      </section>
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
        <section class="valor-content">
          <div>
            <div class="groupForm valor-unitario">
              <label>Valor unitario</label>
              <input class="decimal"/>
            </div>
          </div>
          <div>

          </div>
          <div>
            <div class="groupForm valor-unitario-total">
              <label>Total unitario</label>
              <input disabled/>
            </div>
          </div>
        </section>
        <div class="btns">
          <div class="btn edit" title="Editar"></div>
          <div class="btn delete" title="Eliminar"></div>
          <div class="btn duplicate" title="Duplicar"></div>
        </div>
      </li>
    </ul>
    <article class="valor-total-total"><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
      <div></div>
      <div>
        <!-- <article>
          <label>Subtotal</label>
          <p>$100.000</p>
        </article>
        <article>
          <label>Valor IVA</label>
          <select class="unidad" name="unidad" placeholder="Seleccione...">
            <option value="" disabled selected>Seleccione...</option>
            <option value="5">5%</option>
            <option value="10">10%</option>
            <option value="15">15%</option>
          </select>
        </article> -->
        <article class="total-certificado">
          <label>Total</label>
          <p>$0</p>
        </article>
      </div>
    </article>
    <div class="acciones">
      <div class="btn subir" title="Subir"></div>
      <div class="btn crear" title="Crear Entrada"></div>
      <div class="btn imprimir" title="Imprimir"></div>
      <div class="btn limpiar" title="Limpiar Contenido"></div>
    </div>
  </div>
</section>

<div id="customModal" style="
    position: absolute;
    background: #d48404;
    color: white;
    padding: 10px;
    border-radius: 5px;
    display: none;
    z-index: 1;
"></div>
<script src="<?= BASE_URL ?>javascript/includes/ckeditor.js"></script>
<script src="<?= BASE_URL ?>javascript/entrada.js?v=1.70"></script>

<?php include __DIR__ . '../../../partials/footer.php'; ?>
