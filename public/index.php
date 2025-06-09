<?php 
  require __DIR__.'/security/init.php';
  include __DIR__ . '/partials/header.php'; 
?>
<link href="./styles/entradas.css?v=1.70" rel="stylesheet">
<script src="./javascript/includes/selectize.min.js" ></script>
<link rel="stylesheet" href="./styles/includes/selectize.bootstrap3.min.css" />
<style>
html, body {margin: 0; padding: 0; overflow: hidden}
section {position: relative; width: 100%; height: 100vh; overflow: hidden}
.index {position: relative; z-index: 2}
.index-content img {display: block; max-width: 100%; height: auto}
.shapes-container {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  z-index: 1;
  pointer-events: none;
}

.shape {
  position: absolute;
  background: transparent;
  box-sizing: border-box;
  opacity: 0;
  border-width: 1px;
  border-style: solid;
  will-change: transform, opacity;
}

/* Formas */
.circle {border-radius: 50%}
.square {}
.triangle {
  width: 0;
  height: 0;
  border: none;
  background: none;
  clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
  -webkit-clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
}

/* Animaciones */
@keyframes float1 {
  0%   {transform: translate(0, 0) scale(1); opacity: 0}
  50%  {transform: translate(20px, -30px) scale(1.1); opacity: 0.25}
  100% {transform: translate(0, 0) scale(1); opacity: 0}
}
@keyframes float2 {
  0%   {transform: translate(0, 0) scale(1); opacity: 0}
  50%  {transform: translate(-30px, -20px) scale(1.1); opacity: 0.3}
  100% {transform: translate(0, 0) scale(1); opacity: 0}
}
@keyframes float3 {
  0%   {transform: translate(0, 0) scale(1); opacity: 0}
  50%  {transform: translate(10px, 20px) scale(1.2); opacity: 0.1}
  100% {transform: translate(0, 0) scale(1); opacity: 0}
}
@keyframes float4 {
  0%   {transform: translate(0, 0) scale(1); opacity: 0}
  50%  {transform: translate(-15px, 15px) scale(0.9); opacity: 0.2}
  100% {transform: translate(0, 0) scale(1); opacity: 0}
}
@keyframes float5 {
  0%   {transform: translate(0, 0) scale(1); opacity: 0}
  50%  {transform: translate(30px, 10px) scale(1.3); opacity: 0.15}
  100% {transform: translate(0, 0) scale(1); opacity: 0}
}
</style>
</head>
<body>
<section>
  <div class="index">
    <div class="index-content">
      <img title="<?= htmlspecialchars($bankName) ?>" src="<?= htmlspecialchars($logoPath) ?>" />
    </div>
  </div>
  <div class="shapes-container"></div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
  const colores = ['#fecd00','#59bd48','#f36f20'];
  const tipos = ['circle','square','triangle'];
  const animaciones = ['float1', 'float2', 'float3', 'float4', 'float5'];
  const numFormas = 180;
  const $contenedor = $('.shapes-container');
  const contW = $(window).width();
  const contH = $(window).height();

  function setupShape($el) {
    const tipo = tipos[Math.floor(Math.random() * tipos.length)];
    const tam = Math.floor(Math.random() * 15) + 10;
    const posX = Math.floor(Math.random() * (contW - tam));
    const posY = Math.floor(Math.random() * (contH - tam));
    const color = colores[Math.floor(Math.random() * colores.length)];
    const duracion = (Math.random() * 7 + 5).toFixed(2); // 5 - 12 seg
    const retraso = (Math.random() * 3).toFixed(2); // 0 - 3 seg
    const animacion = animaciones[Math.floor(Math.random() * animaciones.length)];

    $el.removeClass('circle square triangle').css({
      width: '', height: '', border: '', top: posY+'px', left: posX+'px',
      opacity: 0
    });

    if (tipo === 'triangle') {
      $el.addClass('triangle');
      const borde = Math.floor(tam/2);
      $el.css({
        borderLeft: borde + 'px solid transparent',
        borderRight: borde + 'px solid transparent',
        borderBottom: tam + 'px solid ' + color,
        width: '0',
        height: '0'
      });
    } else {
      $el.addClass(tipo);
      $el.css({
        width: tam + 'px',
        height: tam + 'px',
        borderColor: color
      });
    }

    $el.css({
      animation: `${animacion} ${duracion}s ease-in-out ${retraso}s forwards`
    });

    setTimeout(() => {
      $el.stop().fadeTo(800, 0.2);
    }, parseFloat(retraso) * 1000);

    attachAnimationEnd($el, parseFloat(duracion) + parseFloat(retraso));
  }

  function attachAnimationEnd($el, totalTime) {
    setTimeout(function(){
      $el.animate({opacity: 0}, 800, function(){
        setupShape($el);
      });
    }, totalTime * 1000);
  }

  for(let i = 0; i < numFormas; i++){
    const $forma = $('<div class="shape"></div>');
    setupShape($forma);
    $contenedor.append($forma);
  }
});
</script>
<script src="./javascript/index.js?v=1.70"></script>

<?php include __DIR__ . '/partials/footer.php';?>
