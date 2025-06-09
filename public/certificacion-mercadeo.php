<?php include __DIR__ . '/partials/header.php'; ?>

<?php
  $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
  $ejecutar = mysqli_query($conexion,$sql);
  $user=mysqli_fetch_assoc($ejecutar);

  if($user['tipo']!="102"){
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
    <h2>Solicitud Certificado de Donación en especie</h2>
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
  <section class="certificacion-1">
    <article>
      <h4>Información Benefactor</h4>
      <div>
        <div class="benefactor">
          <label>Benefactor</label>
          <select id="benefactor" placeholder="Buscar un benefactor...">
            <option value="">Seleccione un benefactor...</option>

          </select>
        </div>
        <div class="benefactor">
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
      <!-- <div class="benefactor-info">
        <div class="correo">
          <label>Correo Electrónico</label>
          <input name="correo_electronico" placeholder="Correo Electrónico" disabled/>
        </div>
        <div class="celular">
          <label>Celular</label>
          <input name="celular" placeholder="Celular" class="entero" disabled/>
        </div>
      </div>       -->
    </article>
    <article class="benefactor-info2">
      <h4>Información Donación</h4>
      <section class="especie">
        <div>
          <div class="especie_valor">
            <label>Valor de la donación</label>
            <input name="valor_donacion" placeholder="Valor de la donación" />
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
    </article>
    <article class="efectivo benefactor-info2">
      <h4>Archivo de Donación</h4>
      <section>
        <div>
          <div class="facturas">
            <label>Factura</label>
              <input id="file" type="file" accept=".pdf" />
            </div>
          </div>
        </div>
      </section>
    </article>

    <!-- <article class="efectivo benefactor-info3">
      <p>Si el benefactor no existe, puedes crearlo <a href="./benefactores-efectivo.php">Aqui</a></p>
    </article> -->

    <footer class="benefactor-info2">
      <button class="button" id="crear-especie">Crear Solicitud</button>
    </footer>

  </section>

</main>
<script src="./javascript/includes/ckeditor.js"></script>
<script src="./javascript/certificacion/certificacion-mercadeo.js?v=1.70"></script>

<?php include __DIR__ . '/partials/footer.php'; ?>
