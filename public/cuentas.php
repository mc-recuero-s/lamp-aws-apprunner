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
      <h2>Número de cuentas</h2>
    </div>
  </div>
  <div class="content">
    <div class="listas">
      <section class="table-content">
        <header>
          <div class="button" id="crear-benefactor"><a href="./cuentas-editar.php">Crear Nuevo</a></div>
        </header>
        <table id="table" class="display" style="width:100%">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Banco</th>
                  <th>tipo</th>
                  <th>Número</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
              <!-- Las filas de datos se agregarán aquí -->
          </tbody>
        </table>
      </section>
    </div>
  </div>
</section>

<script src="./javascript/datos/cuentas.js?v=1.70"></script>


<?php include __DIR__ . '/partials/footer.php'; ?>

