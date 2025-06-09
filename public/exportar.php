<?php 
  require __DIR__.'/security/init.php';
  $modulo='crear_entrada';
  authorize($modulo);
  include __DIR__ . '/partials/header.php';
?>
<link href="<?= BASE_URL ?>styles/exportar.css?v=1.70" rel="stylesheet">

<section class="exportar">
  <header>
    <div class="titulo">
      <h2>Exportar</h2>
    </div>
  </header> 
  
  <article>
    <div>
      <div>
        <label for="daterange">Rango de fechas</label>
        <input type="text" class="fecha" name="daterange" />
      </div>
      <button id="exportar-entradas">Exportar para I-limitada</button>
    </div>
  </article>
</section>

<script type="text/javascript" src="<?= BASE_URL ?>javascript/includes/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>styles/includes/daterangepicker.css" />
<script src="<?= BASE_URL ?>javascript/exportar.js?v=1.70"></script>


<?php include __DIR__ . '/partials/footer.php'; ?>
