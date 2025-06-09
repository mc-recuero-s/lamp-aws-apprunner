<?php 
  require __DIR__.'../../../security/init.php';
  authorize('datos');
  include __DIR__ . '../../../partials/header.php';
?>
<link href="<?= BASE_URL ?>styles/datos.css?v=1.70" rel="stylesheet">

<section>
  <div class="info">
    <div class="titulo">
      <h2>Datos</h2>
    </div>
  </div>
  <div class="content">
    <ul class="nav">
      <li class="active">
        <h3>Tipos de productos</h3>
      </li>
      <li>
        <h3>Tipos de Benefactores</h3>
      </li>
      <li>
        <h3>Tipos de Beneficiarios</h3>
      </li>
      <li>
        <h3>Entrada Recibido por</h3>
      </li>
      <li>
        <h3>Salida Recibido por</h3>
      </li>
      <li>
        <h3>Digitadores</h3>
      </li>
      <li>
        <h3>Bodega</h3>
      </li>
      <li>
        <h3>Ubicaciones en Bodega</h3>
      </li>
      <li>
        <h3>Placas</h3>
      </li>
      <li>
        <a href="<?= BASE_URL ?>benefactores-efectivo.php">Benefactores Efectivo</a>
      </li>
    </ul>
    <div class="listas">
      <div class="productos">
        <h4>Tipos de productos</h4>
        <ul>
          <div class="nuevo">
            <div class="normalEdit">
              <h4 class="groupForm">
                <label>Nombre</label>
                <input/>
              </h4>
              <h5 class="groupForm">
                <label>Código</label>
                <input/>
              </h5>
              <div class="btns">
                <div class="btn saveProducto"></div>
              </div>
            </div>
          </div>
          <?php

            $sql = "SELECT * FROM tipo_producto ORDER BY nombre ASC";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["nombre"].'</h4><h5>'.$row["codigo"].'</h5><div class="btns"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Código</label><input></h5><div class="btns"><div class="btn save"></div></div></div></li>';
              }
            }
          ?>
        </ul>
      </div>
      <div class="benefactores">
        <h4>Tipos de Benefactores</h4>
        <ul>
          <div class="nuevo">
            <div class="normalEdit">
              <h4 class="groupForm">
                <label>Nombre</label>
                <input/>
              </h4>
              <h5 class="groupForm">
                <label>NIT</label>
                <input/>
              </h5>
              <h6 class="groupForm">
                <label>Código</label>
                <input/>
              </h6>
              <div class="btns">
                <div class="btn saveBenefactor"></div>
              </div>
            </div>
          </div>
          <?php

            $sql = "SELECT * FROM tipo_benefactor ORDER BY nombre ASC";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["nombre"].'</h4><h5>'.$row["nit"].'</h5><h6>'.$row["codigo"].'</h6><div class="btns"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>NIT</label><input></h5><h6 class="groupForm"><label>Código</label><input></h6><div class="btns"><div class="btn save"></div></div></div></li>';
              }
            }
          ?>

        </ul>
      </div>
      <div class="beneficiados">
        <h4>Tipos de Beneficiarios</h4>
        <ul>
          <div class="nuevo">
            <div class="normalEdit">
              <h4 class="groupForm">
                <label>Nombre</label>
                <input/>
              </h4>
              <h5 class="groupForm">
                <label>NIT</label>
                <input/>
              </h5>
              <h6 class="groupForm">
                <label>Municipio</label>
                <input/>
              </h6>
              <p class="groupForm">
                <label>Población</label>
                <input/>
              </p>
              <div class="btns">
                <div class="btn saveBeneficiado"></div>
              </div>
            </div>
          </div>
          <?php

            $sql = "SELECT * FROM tipo_beneficiado ORDER BY nombre ASC";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["nombre"].'</h4><h5>'.$row["nit"].'</h5><h6>'.$row["municipio"].'</h6><p>'.$row["poblacion"].'</p><div class="btns"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>NIT</label><input></h5><h6 class="groupForm"><label>Municipio</label><input></h6><p class="groupForm"><label>Población</label><input></p><div class="btns"><div class="btn save"></div></div></div></li>';
              }
            }
          ?>
        </ul>
      </div>

      <div class="recibidoEntrada">
        <h4>Entrada - Recibido por</h4>
        <ul>
          <div class="nuevo">
            <div class="normalEdit">
              <h4 class="groupForm">
                <label>Nombre</label>
                <input/>
              </h4>
              <h5 class="groupForm">
                <label>Documento</label>
                <input/>
              </h5>
              <div class="btns">
                <div class="btn saveRecibidoEntrada"></div>
              </div>
            </div>
          </div>
          <?php

            $sql = "SELECT * FROM recibido WHERE tipo=1 ORDER BY nombre ASC";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["nombre"].'</h4><h5>'.$row["documento"].'</h5><div class="btns"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Cédula</label><input></h5><div class="btns"><div class="btn save"></div></div></div></li>';
              }
            }
          ?>
        </ul>
      </div>
      <div class="recibidoSalida">
        <h4>Salida - Recibido por</h4>
        <ul>
          <div class="nuevo">
            <div class="normalEdit">
              <h4 class="groupForm">
                <label>Nombre</label>
                <input/>
              </h4>
              <h5 class="groupForm">
                <label>Documento</label>
                <input/>
              </h5>
              <div class="btns">
                <div class="btn saveRecibidoSalida"></div>
              </div>
            </div>
          </div>
          <?php

            $sql = "SELECT * FROM recibido WHERE tipo=2 ORDER BY nombre ASC";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["nombre"].'</h4><h5>'.$row["documento"].'</h5><div class="btns"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Cédula</label><input></h5><div class="btns"><div class="btn save"></div></div></div></li>';
              }
            }
          ?>
        </ul>
      </div>


      <div class="digitadores">
        <h4>Digitadores</h4>
        <ul>
          <div class="nuevo">
            <div class="normalEdit">
              <h4 class="groupForm">
                <label>Nombre</label>
                <input/>
              </h4>
              <h5 class="groupForm">
                <label>Documento</label>
                <input/>
              </h5>
              <div class="btns">
                <div class="btn saveDigitador"></div>
              </div>
            </div>
          </div>
          <?php

            $sql = "SELECT * FROM digitadores ORDER BY nombre ASC";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["nombre"].'</h4><h5>'.$row["cedula"].'</h5><div class="btns"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Cédula</label><input></h5><div class="btns"><div class="btn save"></div></div></div></li>';
              }
            }
          ?>
        </ul>
      </div>


      <div class="bodegas">
        <h4>Bodegas</h4>
        <ul>
          <div class="nuevo hide">
            <div class="normalEdit">
              <h4 class="groupForm">
                <label>Nombre</label>
                <input/>
              </h4>
              <h5 class="groupForm">
                <label>Identificación</label>
                <input/>
              </h5>
              <div class="btns">
                <div class="btn saveBodegas"></div>
              </div>
            </div>
          </div>
          <?php
            $sql = "SELECT * FROM bodegas ORDER BY id ASC";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["nombre"].'</h4><h5>'.$row["id"].'</h5><div class="btns hide"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Cédula</label><input></h5><div class="btns"><div class="btn save"></div></div></div></li>';
                // echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["nombre"].'</h4><h5>'.$row["id"].'</h5><div class="btns"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Nombre</label><input></h4><h5 class="groupForm"><label>Cédula</label><input></h5><div class="btns"><div class="btn save"></div></div></div></li>';
              }
            }
          ?>
        </ul>
      </div>




      <div class="bodega">
        <h4>Ubicación en Bodega</h4>
        <ul>
          <div class="nuevo">
            <div class="normalEdit">
              <h4 class="groupForm">
                <label>Ubicación</label>
                <input/>
              </h4>
              <div class="btns">
                <div class="btn saveBodega"></div>
              </div>
            </div>
          </div>
          <?php
            $sql = "SELECT * FROM bodega ORDER BY ubicacion ASC";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["ubicacion"].'</h4><div class="btns"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>ubicacion</label><input></h4><div class="btns"><div class="btn save"></div></div></div></li>';
              }
            }
          ?>
        </ul>
      </div>




      <div class="placa">
        <h4>Placas</h4>
        <ul>
          <div class="nuevo">
            <div class="normalEdit">
              <h4 class="groupForm">
                <label>PLaca</label>
                <input/>
              </h4>
              <div class="btns">
                <div class="btn savePlaca"></div>
              </div>
            </div>
          </div>
          <?php
            $sql = "SELECT * FROM placas";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<li data-id='.$row["id"].'><div class="normal"><h4>'.$row["placa"].'</h4><div class="btns"><div class="btn edit"></div></div></div><div class="normalEdit"><h4 class="groupForm"><label>Placa</label><input></h4><div class="btns"><div class="btn save"></div></div></div></li>';
              }
            }
          ?>
        </ul>
      </div>

      <div class="benefactores_efectivo">
        <h4>Benefactores Efectivo</h4>
        <section>
          <div>
            <div class="nombre">
              <label>Nombre Benefactor</label>
              <input name="nombre" placeholder="Nombre Benefactor" />
            </div>
            <div class="codigo">
              <label>Código Benefactor</label>
              <input name="codigo" placeholder="Código de Benefactor" />
            </div>
          </div>
          <div>
            <div class="tipo_documento">
              <label>Tipo de documento</label>
              <select id="tipo_identificacion" name="tipo_identificacion">
                <option value="0" selected disabled>Seleccione...</option>
                <option value="cedula">CEDULA</option>
                <option value="nit">NIT</option>
                <option value="tarjeta_extranjera">TARJETA DE EXTRANJERIA</option>
              </select>
            </div>
            <div class="numero_documento">
              <label>Número de documento</label>
              <input name="documento" placeholder="Número de documento" class="entero" />
            </div>
          </div>
          <div>
            <div class="correo">
              <label>Correo Electrónico</label>
              <input name="correo_electronico" placeholder="Correo Electrónico"/>
            </div>
            <div class="celular">
              <label>Celular</label>
              <input name="celular" placeholder="Celular" class="entero"/>
            </div>
          </div>
        </section>
        <footer>
          <button class="button" id="crear-benefator">Crear Benefator</button>
        </footer>
      </div>
    </div>
  </div>
</section>

<script src="<?= BASE_URL ?>javascript/datos.js?v=1.70"></script>


<?php include __DIR__ . '/partials/footer.php'; ?>
