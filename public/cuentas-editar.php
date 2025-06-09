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
  <?php
    if(isset($_GET['id'])){
      $sql = "SELECT * FROM cuentas WHERE id= '".$_GET['id']."'";
      $ejecutar = mysqli_query($conexion,$sql);
      $cuenta = mysqli_fetch_assoc($ejecutar);
    }
  ?>
  <div class="info" data-id="<?php echo $_GET['id']; ?>">
    <div class="titulo">
      <h2>
        <?php 
          if(isset($_GET['id'])){
            echo "Editar Cuenta";
          }else{
            echo "Crear Cuenta";
          }
        ?>  
      </h2>
    </div>
  </div>
  <div class="content">
    <div class="listas">
      <section class="cuentas">
        <header>
          <div class="button" id="regresar-cuentas"> <a href="./cuentas.php">Regresar</a></div>
        </header>
        <section>
          <div>
            <div class="nombre">
              <label>Nombre de la Cuenta</label>
              <input name="nombre" placeholder="Nombre de la Cuenta" />
            </div>
          </div>
          <div>
            <div class="tipo">
              <label>Tipo de Cuenta</label>
              <select id="tipo" name="tipo_cuenta">
                <option value="0" selected disabled>Seleccione...</option>
                <option value="Ahorros">Ahorros</option>
                <option value="Corriente">Corriente</option>
              </select>
            </div>
            <div class="numero">
              <label>Número de Cuenta</label>
              <input name="numero_cuenta" placeholder="Número de Cuenta"/>
            </div>
          </div>
          <div>
            <div class="banco">
              <label>Banco</label>
              <input name="banco" placeholder="Banco"/>
            </div>
            <div class="saldo">
            </div>
          </div>
        </section>
        <footer>
          <button class="button" id="guardar-cuenta">Guardar Cuenta</button>
        </footer>
      </section>
    </div>
  </div>
</section>

<script src="./javascript/datos/cuentas-editar.js?v=1.70"></script>

<?php include __DIR__ . '/partials/footer.php'; ?>
