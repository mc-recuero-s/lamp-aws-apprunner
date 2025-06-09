<?php include __DIR__ . '/partials/header.php'; ?>
<link href="./styles/datos2.css?v=1.70" rel="stylesheet">

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

<section>
  <div class="info">
    <div class="titulo">
      <h2>Benefactores Efectivo</h2>
    </div>
  </div>
  <div class="content">
    <div class="listas">
      <section class="table-content">
        <header>
          <div class="button" id="crear-benefactor"><a href="./benefactores-efectivo-editar.php">Crear Nuevo</a></div>
        </header>
        <table id="table" class="display" style="width:100%">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Benefactor</th>
                  <th>Tipo</th>
                  <th>Documento</th>
                  <th>Correo</th>
                  <th>Celular</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
              <!-- Las filas de datos se agregarán aquí -->
          </tbody>
        </table>
      </section>
      <section class="benefactores_efectivo">
        <header>
          <div class="button" id="regresar-benefactor">Regresar</div>
        </header>
        <section>
          <div>
            <div class="nombre">
              <label>Nombre Benefactor (Nombres y Apellidos completos)</label>
              <input name="nombre" placeholder="Nombre Benefactor" />
            </div>
            <div class="codigo">
              <!-- <label>Código Benefactor</label>
              <input name="codigo" placeholder="Código de Benefactor" /> -->
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
      </section>
    </div>
  </div>
</section>

<script src="./javascript/datos/benefactores-efectivo.js?v=1.70"></script>


<?php include __DIR__ . '/partials/footer.php'; ?>

