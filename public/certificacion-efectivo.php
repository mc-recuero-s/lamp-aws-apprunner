<?php include __DIR__ . '/partials/header.php'; ?>

<?php
  $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
  $ejecutar = mysqli_query($conexion,$sql);
  $user=mysqli_fetch_assoc($ejecutar);

  if($user['tipo']!="101"){
    $currentDir = dirname($_SERVER['PHP_SELF']);
    $indexUrl = $currentDir . '/index.php';

    header('Location: ' . $indexUrl);
    exit();
  }
?>
<link href="./styles/certificacion.css?v=1.70" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/selectize@0.12.6/dist/js/standalone/selectize.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectize@0.12.6/dist/css/selectize.default.css">
<link rel="stylesheet" href="./styles/includes/selectize.bootstrap3.min.css" />
<div class="factura-main">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


<style>
    table.dataTabl {
        width: 100%;
        border-collapse: collapse;
    }
    .dataTabl th, .dataTabl td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .dataTabl th {
        background-color: #f2f2f2;
    }

</style>

</div>

<main class="certificacion">
  <header>
    <?php
      if($user['tipo'] =="101"){
    ?>
      <h2>Solicitud Certificado de Donación en Efectivo</h2>
    <?php
      }
    ?>
    <?php
      if($user['tipo'] =="102"){
    ?>
      <h2>Solicitud Certificado de Donación en especie</h2>
    <?php
      }
    ?>
    <?php
      if($user['tipo'] =="103"){
    ?>
      <h2>Solicitudes Certificado de Donación</h2>
    <?php
      }
    ?>
    <?php
      if($user['tipo'] =="104"){
    ?>
      <h2>Solicitudes Certificado de Donación</h2>
    <?php
      }
      ?>


    <?php
      if(isset($_GET['id'])){
        $sql = "SELECT * FROM certificacion WHERE id= '".$_GET['id']."'";
        $ejecutar = mysqli_query($conexion,$sql);
        $certificacion=mysqli_fetch_assoc($ejecutar);
    ?>
      <h3 class="editando-certificado" data-id="<?php echo $_GET['id']; ?>" data-estado="<?php echo $certificacion['estado']; ?>">Editando el certificado <?php echo $_GET['id']; ?></h3>
    <?php
      }
    ?>


    <p></p>
  </header>

  <?php
    if($user['tipo'] =="1" || $user['tipo'] =="101" || $user['tipo'] =="102") {
  ?>

  <section class="certificacion-1">
    <?php
      if($user['tipo'] =="101"){
    ?>
    <article>
      <h4>Información Benefactor</h4>
      <div>
        <div class="benefactor">
          <label>Benefactor</label>
          <select id="benefactor" placeholder="Buscar un benefactor...">
            <option value="">Seleccione un benefactor...</option>

          </select>
        </div>
      </div>
      <div class="benefactor-info">
        <div class="tipo_documento">
          <label>Tipo de documento</label>
          <select id="tipo_identificacion" name="tipo_identificacion" disabled>
            <option value="0" selected disabled>Seleccione...</option>
            <option value="cedula">CEDULA</option>
            <option value="nit">NIT</option>
            <option value="tarjeta_extranjera">TARJETA DE EXTRANJERIA</option>
          </select>
        </div>
        <div class="numero_documento">
          <label>Número de documento</label>
          <input name="documento" placeholder="Número de documento" class="entero" disabled/>
        </div>
      </div>
      <div class="benefactor-info">
        <div class="correo">
          <label>Correo Electrónico</label>
          <input name="correo_electronico" placeholder="Correo Electrónico" disabled/>
        </div>
        <div class="celular">
          <label>Celular</label>
          <input name="celular" placeholder="Celular" class="entero" disabled/>
        </div>
      </div>
    </article>
    <?php
      }
    ?>
    <article class="benefactor-info2">
      <h4>Información Donación</h4>
      <?php
        if($user['tipo'] =="1"){
      ?>
      <div>
        <div class="donacion">
          <label>Tipo de Donación</label>
          <select id="tipo_donacion" name="tipo_donacion">
            <option value="0" selected disabled>Seleccione...</option>
            <option value="efectivo">Efectivo</option>
            <option value="especie">Especie</option>
          </select>
        </div>
      </div>
      <?php
        }
      ?>
      <?php
        if($user['tipo'] =="1" || $user['tipo'] =="101"){
      ?>
      <section class="efectivo">
        <div>
          <div class="efectivo_valor">
            <label>Valor de la donación</label>
            <input name="valor_donacion" placeholder="Valor de la donación" />
          </div>
          <div class="destinatario">
            <label>Número de cuenta donde se hizo la donación <a href="./cuentas.php">Administrar</a></label>
            <?php
                $sql = "SELECT id, nombre, tipo, banco, numero FROM cuentas ORDER BY id";
                $result = mysqli_query($conexion, $sql);

                echo '<select id="numero_destino" name="numero_destino">';
                echo '  <option value="0" selected disabled>Seleccione...</option>';

                while ($row = mysqli_fetch_assoc($result)) {                    
                  $optionValue = "Cuenta de {$row['tipo']} {$row['banco']} {$row['numero']}";                    
                  echo '<option value="' . $optionValue . '">' . $row['nombre'] . '</option>';
                }

                echo '</select>';
              ?>
          </div>
        </div>
        <div>
          <div class="dia_donacion">
            <label>Día de donación</label>
            <input name="donacion" class="fecha-donacion" placeholder="Fecha de donación"/>
          </div>
          <div class="remitente">
            <label>Número de cuenta remitente</label>
            <input name="numero_remitente" placeholder="Número de cuenta remitente" class="entero"/>
          </div>
        </div>
        <div>
          <div class="efectivo_asignacion">
            <label>Destinación de la donación</label>
            <select id="asignacion_donacion" name="asignacion_donacion">
              <option value="0" selected disabled>Seleccione...</option>
              <option value="DESARROLLO OPERACIONAL DEL BANCO DE ALIMENTOS">DESARROLLO OPERACIONAL DEL BANCO DE ALIMENTOS</option>
              <option value="TEMPLOS COMEDOR Y COMEDORES DEL CORAZON">TEMPLOS COMEDOR Y COMEDORES DEL CORAZON</option>
              <option value="REAGRO">REAGRO</option>
              <option value="ALIMENTACION PREPARADA">ALIMENTACION PREPARADA</option>
              <option value="PLAN PADRINO">PLAN PADRINO</option>
          </select>
          </div>
          <div class="anio_expedicion">
            <label>Año se Expedición</label>
            <select id="anio_expedicion" name="anio_expedicion">
              <option value="0" selected disabled>Seleccione...</option>
            </select>
          </div>
        </div>
      </section>
      <?php
        }
      ?>
      <?php
        if($user['tipo'] =="1" || $user['tipo'] =="102"){
      ?>
      <section class="especie">
        <div>
          <div class="especie_valor">
            <label>Valor de la donación</label>
            <input name="valor_donacion" placeholder="Valor de la donación"/>
          </div>
          <div class="descripcion">
            <label>Descripción</label>
            <input name="descripcion" placeholder="Descripción"/>
          </div>
        </div>
        <div>
          <div class="factura">
            <label>Factura</label>
            <input name="factura" placeholder="Factura"/>
          </div>
          <div class="expedicion_factura">
            <label>Expedición de la factura</label>
            <input name="expedicion_factura" class="fecha-factura" placeholder="Fecha de expedición de la factura"/>
          </div>
        </div>
        <div>
          <div class="especie_asignacion">
            <label>Destinación de la donación</label>
            <select id="asignacion_donacion" name="asignacion_donacion">
              <option value="0" selected disabled>Seleccione...</option>
              <option value="desarrollo_operacional">DESARROLLO OPERACIONAL DEL BANCO DE ALIMENTOS</option>
              <option value="templos_comedor">TEMPLOS COMEDOR Y COMEDORES DEL CORAZON</option>
              <option value="reagro">REAGRO</option>
              <option value="alimentacion_preparada">ALIMENTACION PREPARADA</option>
          </select>
          </div>
          <div class="dia_expedicion">
          </div>
        </div>
      </section>
      <?php
        }
      ?>
    </article>
    <?php
      if($user['tipo'] =="1" || $user['tipo'] =="101"){
    ?>
    <article class="efectivo benefactor-info2">
      <h4>Archivos Donación</h4>
      <section>
        <div>
          <div class="soporte">
            <label>Soporte de la donación</label>
              <input id="file" type="file" accept=".pdf" />
            </div>
            <div class="informe">
              <label>Informe de débitos automáticos </label>
              <input id="file" type="file" accept=".pdf" />
            </div>
          </div>
        </div>
      </section>
    </article>



    <article class="efectivo benefactor-info3">
      <p>Si el benefactor no existe, puedes crearlo <a href="./benefactores-efectivo.php">Aqui</a></p>
    </article>

    <footer class="benefactor-info2">
      <?php
        if($user['tipo'] =="1" || $user['tipo'] =="101"){
      ?>
        <button class="button" id="crear-efectivo">Crear Solicitud</button>
      <?php
        }
      ?>
      <?php
        if($user['tipo'] =="1" || $user['tipo'] =="102"){
      ?>
        <button class="button" id="crear-especie">Crear Solicitud</button>
      <?php
        }
      ?>
    </footer>


    <?php
      }
    ?>

  </section>

  <?php
    }
  ?>


  <?php
    if($user['tipo'] =="103" || $user['tipo'] =="104"){
  ?>

  <style>
      table.dataTabl {
          width: 100%;
          border-collapse: collapse;
      }
      .dataTabl th, .dataTabl td {
          border: 1px solid #ddd;
          padding: 8px;
      }
      .dataTabl th {
          background-color: #f2f2f2;
      }
      .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
        background: transparent !important;
        border: none !important
      }

      table.dataTable>thead .sorting_asc:before, table.dataTable>thead .sorting_desc:after,
      table.dataTable>thead .sorting:after, table.dataTable>thead .sorting_asc:after,
      table.dataTable>thead .sorting:before{
        display: none !important
      }
      .dataTables_wrapper .dataTables_paginate .paginate_button{
        padding: .2em 0
      }
      .page-item:not(:first-child) .page-link{
        margin: 0
      }
  </style>
  <section class="certificacion-2">
    <table id="table" class="display" style="width:100%">
        <thead>
            <tr>
                <th style="width: 100px">ID</th>
                <th>Benefactor</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Archivos</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas de datos se agregarán aquí -->
        </tbody>
    </table>
  </section>

  <?php
    }
  ?>


</main>
<script src="./javascript/includes/ckeditor.js"></script>
<script src="./javascript/certificacion/certificacion.js?v=1.70"></script>


<?php
  if($user['tipo'] =="103"){
?>
  <script src="./javascript/certificacion/certificacion-contabilidad.js?v=1.70"></script>
<?php
  }
?>

<?php
  if($user['tipo'] =="104"){
?>
  <script src="./javascript/certificacion/certificacion-revisoria.js?v=1.70"></script>
<?php
  }
?>


<?php include __DIR__ . '/partials/footer.php'; ?>
