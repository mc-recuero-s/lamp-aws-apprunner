<?php 
  require __DIR__.'../../../security/init.php';
  authorize('historial_salidas');
  include __DIR__ . '../../../partials/header.php';
?>
<link href="<?= BASE_URL ?>styles/historial.css?v=1.70" rel="stylesheet">

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
<section class="historial">
  <div class="filtros">
    <div class="filtros-fecha">
      <label for="daterange">Rango de búsqueda</label>
      <input type="text" class="fecha" name="daterange" />
    </div>
    <div class="filtros-select">
      <div class="filtros-group">
        <input type="checkbox" id="checkEntrada" name="hidden">
        <label for="daterange">Entradas</label>
      </div>
      <div class="filtros-group">
        <input type="checkbox" id="checkSalida" name="hidden">
        <label for="daterange">Salidas</label>
      </div>
    </div>
  </div>
  <aside>
    <section class="historial-entradas">
      <!-- <article class="hide">
        <div class="historial-contenido">
          <div class="article-body_ico hide"></div>
          <h3>feactura</h3>
          <h4>Fecha</h4>
          <h5>Beneficiario</h5>
          <h6>Beneficiario</h6>
          <p>Cantidad</p>
        </div>
        <footer>
          <div class="article_more">
            <div class="ico ico_more"></div>
          </div>
           <div class="article-footer-options">
             <ul class="hide">
               <li>
                 <a>
                   <div class="ico ico_bookmark"></div>
                   <p>Bookmark </p>
                 </a>
               </li>
               <li>
                 <a>
                   <div class="ico ico_share"></div>
                   <p>Share</p>
                 </a>
               </li>

               <li>
                 <a>
                   <div class="ico ico_flag"></div>
                   <p>Flag As Outdated</p>
                 </a>
               </li>
               <li>
                 <a>
                   <div class="ico ico_remove"></div>
                   <p>Remove From History</p>
                 </a>
               </li>
             </ul>
           </div>
           <div class="article-footer_ico"></div>
        </footer>
      </article> -->
    </section>
    <section class="historial-salidas">
    </section>
  </aside>
  <div class="acciones">
    <div class="btn subir" title="Subir"></div>
    <div class="btn crearInforme" data-total="0" title="Crear Informe"></div>
  </div>
</section>

<script type="text/javascript" src="<?= BASE_URL ?>javascript/includes/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>styles/includes/daterangepicker.css" />
<script src="<?= BASE_URL ?>javascript/includes/ckeditor.js"></script>

<!-- <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script> -->

<script src="<?= BASE_URL ?>javascript/historial.js?v=1.70"></script>

<?php include __DIR__ . '/partials/footer.php'; ?>
