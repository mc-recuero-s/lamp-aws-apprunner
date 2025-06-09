
<?php 
  require __DIR__.'../../../security/init.php';
  // authorize('crear_entrada');
  include __DIR__ . '../../../partials/header.php';
?>
<script src="<?= BASE_URL ?>javascript/includes/selectize.min.js" ></script>
<link rel="stylesheet" href="<?= BASE_URL ?>styles/includes/selectize.bootstrap3.min.css" />
<link href="<?= BASE_URL ?>styles/actual.css?v=1.70" rel="stylesheet">
<section class="actual">
  <div class="grid">
    <section>
      <div class="grid-item grid-item--width4 inventarioActual" >
        <?php include __DIR__ . '/include/actual.php'; ?>
      </div>
      <div class="grid-item grid-item--width4 vencimiento">
        <?php include __DIR__ . '/include/vencimiento.php'; ?>
      </div>
    </section>
    <div class="grid-item grid-item--width4 benefactores">
      <?php include __DIR__ . '/include/benefactores.php'; ?>
    </div>
    <div class="grid-item grid-item--width4 beneficiados">
      <?php include __DIR__ . '/include/beneficiados.php'; ?>
    </div>
  </div>
  <div id="customModal" style="
      position: absolute;
      background: #d48404;
      color: white;
      padding: 10px;
      border-radius: 5px;
      display: none;
  "></div>
</section>

<script type="text/javascript" src="<?= BASE_URL ?>javascript/includes/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>styles/includes/daterangepicker.css" />
<script src="<?= BASE_URL ?>javascript/includes/packery.pkgd.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="<?= BASE_URL ?>javascript/actual.js?v=1.70"></script>

<?php include __DIR__ . '/partials/footer.php'; ?>
