<!DOCTYPE html>
<html lang="es">
  
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta property="og:image" content="https://abaco.org.co/wp-content/uploads/2022/03/AbacoFaviconColor.svg">
    <link rel="icon" type="image/svg+xml" href="https://abaco.org.co/wp-content/uploads/2022/03/AbacoFaviconColor.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="https://abaco.org.co/wp-content/uploads/2022/03/AbacoFaviconColor.png">
    <link rel="icon" type="image/x-icon" href="https://abaco.org.co/wp-content/uploads/2022/03/AbacoFaviconColor.ico">


    <title>Abaco</title>
    <link href="<?= BASE_URL ?>styles/includes/material-icons.css?v=1.69" rel="stylesheet">
    <link href="<?= BASE_URL ?>styles/includes/custom.css?v=1.69" rel="stylesheet">

    <script src="<?= BASE_URL ?>javascript/includes/jquery.min.js?v=1.69"></script>
    <script src="<?= BASE_URL ?>javascript/includes/jquery-ui.min.js?v=1.69"></script>
    <script src="<?= BASE_URL ?>javascript/includes/sweetalert2@9.js?v=1.69"></script>
    <script src="<?= BASE_URL ?>javascript/includes/moment.min.js?v=1.69"></script>
    <script src="<?= BASE_URL ?>javascript/includes/custom.js?v=1.69"></script>
    <script src="<?= BASE_URL ?>javascript/scripts.js?v=1.69"></script>

    <?php
      $profiles = $_SESSION['profiles'];
    ?>
    <script>
      var profiles = <?= json_encode($profiles) ?>;
      const currentProfile = <?= json_encode($_SESSION['current_profile']) ?>;
      console.log(currentProfile);
    </script>

    <?php
      $cp = $_SESSION['current_profile'];
      $profile_id = $cp['id'];

      if ($cp['type'] === 'superadmin') {
          $colores = [
              'primario'   => '#d48404',
              'secundario' => '#DBDC00',
              'iconos'     => '#333333',
              'fondos'     => '#FFFFFF',
              'textos'     => '#333333',
          ];
          $logoPath = BASE_URL . 'images/abaco small.jpg';
          $bankName = 'Abaco';
      } else {
          if ($cp['type'] === 'bodega') {
              $sql = "
                SELECT b.colores, b.logo, b.nombre
                  FROM bodegas bo
                  JOIN banco b ON bo.banco = b.id
                WHERE bo.id = ?
              ";
          } else {
              $sql = "SELECT colores, logo, nombre FROM banco WHERE id = ?";
          }
          $stmt = $conexion->prepare($sql);
          $stmt->bind_param('i', $profile_id);
          $stmt->execute();
          $stmt->bind_result($coljson, $logoFile, $bankName);
          $stmt->fetch();
          $stmt->close();
          $colores = json_decode($coljson, true);
          $logoPath = BASE_URL . 'images/uploads/bancos/' . $logoFile;
      }

      echo "<style>:root{";
      foreach ($colores as $k => $v) {
          echo "--{$k}:{$v};";
      }
      echo "}</style>";
    ?>
</head>
<body>
  <div class="loading">
    <div class="loadingio-spinner-double-ring-mntd5rqz5xa"><div class="ldio-dbco6f934ub">
      <div></div>
      <div></div>
      <div><div></div></div>
      <div><div></div></div>
    </div></div>
  </div>
  <div class="modal">
    <div class="modal-bg">
      <div class="modal-close" title="Cerrar">
      </div>
      <div class="modal-content">
        <iframe id="myiframe" src=''></iframe>
      </div>
    </div>
  </div>
  <?php
    require_once BASE_PATH . 'includes/dsn_open.php';
    require_once BASE_PATH . 'controllers/configuracion/backup.php';
    include BASE_PATH . '/partials/navigation.php';
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('America/Bogota'));
    if(!(is_file('./soportes/backups/backup-'.$date->format('Ymd').'.sql'))){
      if($date->format('H')>1){
        // $tables = '*';
        // complete_entradas($conexion,$tables);
        // backup_tables($conexion,$tables);
      }
    }
  ?>
  <?php
    if(!(isset($_SESSION['user']))){
      $currentDir = dirname($_SERVER['PHP_SELF']);
      $loginUrl = $currentDir . '/login.php';

      header('Location: ' . $loginUrl);
      exit();
    }
  ?>
