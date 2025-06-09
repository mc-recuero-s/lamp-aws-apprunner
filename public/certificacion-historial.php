<?php include __DIR__ . '/partials/header.php'; ?>

<?php
  $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
  $ejecutar = mysqli_query($conexion,$sql);
  $user=mysqli_fetch_assoc($ejecutar);
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

<main class="certificacion" data-tipo="<?php echo $user['tipo']; ?>">
  <header>
    <h2>Mis solicitudes</h2>
    <h3></h3>
    <p></p>
  </header>

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
                <th style="width: 40px">ID</th>
                <th style="width: 100px">ID</th>
                <th>Benefactor</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Archivos</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Estado2</th>
                <th>Fecha de donación</th>
                <th>Fecha de envio</th>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas de datos se agregarán aquí -->
        </tbody>
    </table>
  </section>


</main>
<script src="./javascript/includes/ckeditor.js"></script>
<?php
  if($user['tipo'] =="101"){
?>
  <script src="./javascript/certificacion/certificacion-historial.js?v=1.70"></script>
<?php
  }
?>
<?php
  if($user['tipo'] =="102"){
?>
  <script src="./javascript/certificacion/certificacion-historial-mercadeo.js?v=1.70"></script>
<?php
  }
?>

<?php include __DIR__ . '/partials/footer.php'; ?>
