<?php
  
  error_reporting(0);

  $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
  $ejecutar = mysqli_query($conexion,$sql);
  $user=mysqli_fetch_assoc($ejecutar);

 ?>
<header>
  <div class="header">
    <div class="logo"><img title="<?= htmlspecialchars($bankName) ?>" src="<?= htmlspecialchars($logoPath) ?>" /></div>
    <div class="nav-fix"></div>
    <div class="header-config">
      <?php
        if(isset($_SESSION['user'])){
          $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
          $ejecutar = mysqli_query($conexion,$sql);

          $user=mysqli_fetch_assoc($ejecutar);
          if(isset($user['id'])){
            echo '<div class="user" data-id="'. $_SESSION['user'] .'">
              <h4>'. htmlspecialchars($user['nombre'], ENT_QUOTES, 'UTF-8') 
                        .' '. htmlspecialchars($user['apellido'], ENT_QUOTES, 'UTF-8') .'</h4>
              <ul>
                <li>
                  <a title="Editar perfil" class="header-btn" href="'. BASE_URL .'editarPerfil.php">
                    Editar perfil
                  </a>
                </li>
                <li>
                  <a title="Relaciones Institucionales" class="header-btn" href="'. BASE_URL .'loginRelacionesInstitucionales.php">
                    Relaciones Institucionales
                  </a>
                </li>
                <li class="toggle-mode">
                  <label class="switch">
                    <input type="checkbox" id="editToggle">
                    <span class="slider"></span>
                  </label>
                    <span class="label-text">Modo edición</span>
                </li>
                <li>
                  <a title="Informe trazabilidad" class="header-btn" href="'. BASE_URL .'trazabilidad.php">
                    Trazabilidad
                  </a>
                </li>
                <li>
                  <a title="Cerrar Sesión" class="header-btn header-out" href="'. BASE_URL .'logout.php">
                    Cerrar Sesión
                  </a>
                </li>
              </ul>
            </div>';
          }else{
            echo '<a title="Iniciar Sesión" href="<?= BASE_URL ?>login.php" class="header-btn header-user"></a>';
          }
        }else{
          echo '<a title="Iniciar Sesión" href="<?= BASE_URL ?>login.php" class="header-btn header-user"></a>';
        }
      ?>
      <div class="profile">
        <div class="circle-button" id="profile-toggle"></div>
        <ul class="profile-list" id="profile-list"></ul>
      </div>

    </div>
  </div>
  <div class="nav">
  <?php
    define('BASE_URL','/miapp/');

    $sql = "
      SELECT DISTINCT
        sm.id             AS sub_id,
        sm.nombre         AS sub_name,
        sm.abreviatura    AS sub_abbr,
        sm.modulo         AS parent_id
      FROM perfil p
      JOIN perfil_rol pr  ON p.id = pr.perfil
      JOIN rol_modulo rm  ON pr.rol    = rm.rol
      JOIN modulo sm      ON rm.modulo = sm.id
      WHERE p.codigo = ?
        AND sm.modulo IS NOT NULL
      ORDER BY sm.modulo, sm.id
    ";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $cp['type']);
    $stmt->execute();
    $subs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $byParent = [];
    $parents  = [];
    foreach ($subs as $r) {
      $byParent[$r['parent_id']][] = $r;
      $parents[$r['parent_id']] = true;
    }

    if ($parents) {
      $in   = implode(',', array_keys($parents));
      $sqlP = "SELECT id, nombre, abreviatura FROM modulo WHERE id IN ($in) ORDER BY id";
      $resP = $conexion->query($sqlP);
      $padres = [];
      while ($p = $resP->fetch_assoc()) {
        $padres[$p['id']] = $p;
      }
    }

    $currentPath = ltrim(str_replace(BASE_URL,'',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)),'/');

    $inicioPid = null;
    foreach ($padres as $pid => $p) {
      if (strtolower($p['abreviatura']) === 'inicio') {
        $inicioPid = $pid;
        break;
      }
    }

    $orderedParents = [];
    if ($inicioPid !== null) {
      $orderedParents[] = $inicioPid;
    }
    foreach (array_keys($padres) as $pid) {
      if ($pid !== $inicioPid) {
        $orderedParents[] = $pid;
      }
    }

    echo '<nav class="tabs"><ul>';
    foreach ($orderedParents as $pid) {
      if (empty($byParent[$pid])) continue;
      $padre = $padres[$pid];
      $pName = htmlspecialchars($padre['nombre'], ENT_QUOTES);
      echo "<li class=\"accordion\"><span class=\"tab\">{$pName}</span><ol>";
      foreach ($byParent[$pid] as $sub) {
        $path   = "{$padre['abreviatura']}/{$sub['sub_abbr']}";
        $active = strpos($currentPath, $path) !== false ? ' active' : '';
        $sName  = htmlspecialchars($sub['sub_name'], ENT_QUOTES);
        echo "<li><a class=\"tab{$active}\" href=\"".BASE_URL."{$path}\">{$sName}</a></li>";
      }
      echo '</ol></li>';
    }
    echo '</ul></nav>';
  ?>
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);

      $profile    = trim($profile ?? '');
      $profile_id = intval($profile_id ?? 0);

      function getBancoNombre($conexion, int $id): string {
          $sql  = "SELECT nombre FROM banco WHERE id = ?";
          $stmt = $conexion->prepare($sql);
          $stmt->bind_param('i', $id);
          $stmt->execute();
          $stmt->bind_result($nombre);
          $stmt->fetch();
          $stmt->close();
          return $nombre ?: 'Banco desconocido';
      }

      function getBodegaConBanco($conexion, int $id): string {
          $sql  = "SELECT nombre, banco FROM bodegas WHERE id = ?";
          $stmt = $conexion->prepare($sql);
          $stmt->bind_param('i', $id);
          $stmt->execute();
          $stmt->bind_result($nombreBodega, $bancoId);
          $stmt->fetch();
          $stmt->close();
          $nombreBanco = getBancoNombre($conexion, $bancoId);
          return $nombreBanco . ' - ' . ($nombreBodega ?: 'Bodega desconocida');
      }

      echo '<div><h5>';
      if ($profile === 'superadmin') {
          echo 'ABACO - Administrador';
      } elseif ($profile === 'banco') {
          echo htmlspecialchars(getBancoNombre($conexion, $profile_id));
      } elseif ($profile === 'bodega') {
          echo htmlspecialchars(getBodegaConBanco($conexion, $profile_id));
      } else {
          echo htmlspecialchars($profile) . ' – ID: ' . htmlspecialchars($profile_id);
      }
      echo '</h5></div>';
    ?>
  </div>
</header>


