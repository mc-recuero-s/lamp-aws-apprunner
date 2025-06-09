<?php
  session_start();
  if (empty($_SESSION['user'])) {
      header('Location: login.php');
      exit;
  }
  require __DIR__ . '/../includes/dsn_open.php';
  
  if (empty($_SESSION['current_profile'])) {
    echo 'No hay perfil seleccionado';
    exit;
  }
  $cp = $_SESSION['current_profile'];
  $profile = $cp['type'];
  $profile_id   = $cp['id'];

  define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/abaco/');
  define('BASE_URL', '/abaco/');

  if (!isset($_SESSION['profiles'])) {
    $uid = $_SESSION['user'];

    $stmt = $conexion->prepare("
      SELECT 1
        FROM usuario_perfil up
        JOIN perfil p    ON up.perfil = p.id
      WHERE up.usuario  = ?
        AND p.codigo     = 'superadmin'
      LIMIT 1
    ");
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $stmt->store_result();
    $_SESSION['profiles']['superadmin'] = $stmt->num_rows > 0;
    $stmt->close();

    $stmt = $conexion->prepare("
      SELECT ub.banco AS id, b.nombre, b.logo
        FROM usuario_banco ub
        JOIN banco b ON ub.banco = b.id
      WHERE ub.usuario = ?
    ");
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $res = $stmt->get_result();
    $_SESSION['profiles']['banco'] = [];
    while ($row = $res->fetch_assoc()) {
        $_SESSION['profiles']['banco'][] = $row;
    }
    $stmt->close();

    $stmt = $conexion->prepare("
      SELECT ub.bodega AS id, bo.nombre AS nombre, bo.banco AS banco_id, b.nombre AS banco_nombre, b.logo
      FROM usuario_bodega ub
      JOIN bodegas bo ON ub.bodega = bo.id
      JOIN banco b ON bo.banco = b.id
      WHERE ub.usuario = ?
    ");
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $res = $stmt->get_result();
    $_SESSION['profiles']['bodega'] = [];
    while ($row = $res->fetch_assoc()) {
        $_SESSION['profiles']['bodega'][] = $row;
    }
    $stmt->close();
  }
  if (!isset($_SESSION['permissions'])) {
      $uid = $_SESSION['user'];
      $sql = "
        SELECT
          m.abreviatura AS modulo,
          f.abreviatura AS funcionalidad
        FROM perfil p
        JOIN perfil_rol     pr ON p.id = pr.perfil
        JOIN rol_modulo     rm ON pr.rol = rm.rol
        JOIN modulo         m  ON rm.modulo = m.id
        LEFT JOIN funcionalidad f ON f.modulo = m.id
        WHERE p.codigo = ?
          AND m.abreviatura IS NOT NULL
      ";
      $stmt = $conexion->prepare($sql);
      $stmt->bind_param('s', $profile);
      $stmt->execute();
      $res = $stmt->get_result();
      $_SESSION['permissions'] = [];
      while ($row = $res->fetch_assoc()) {
          $_SESSION['permissions'][$row['modulo']][$row['funcionalidad']] = true;
      }
  }

  
  // echo 'Perfil: ' . htmlspecialchars($profile) . ' – ID: ' . htmlspecialchars($profile_id);
  // echo '<div>'.print_r($_SESSION['permissions'], true).'</pre>';
  // echo '<div>'.print_r($_SESSION['profiles'], true).'</pre>';
  // exit;
  function authorize(string $modulo, string $funcionalidad = null): void {
    if ($funcionalidad !== null) {
        $ok = !empty($_SESSION['permissions'][$modulo][$funcionalidad]);
    } else {
        $ok = !empty($_SESSION['permissions'][$modulo])
            && is_array($_SESSION['permissions'][$modulo])
            && count($_SESSION['permissions'][$modulo]) > 0;
    }

    if (!$ok) {
        header('HTTP/1.1 403 Forbidden');
        echo '<h1>403 - Acceso denegado</h1>';
        exit;
    }
  }

  /**
       * Comprueba si el usuario tiene el permiso dado.
       *
       * @param string $modulo        Abreviatura del módulo (p. ej. 'mod1')
       * @param string $funcionalidad Abreviatura de la funcionalidad (p. ej. 'fun1')
       * @return bool                  True si lo tiene, false en caso contrario
  */
  function hasPermission(string $modulo, string $funcionalidad): bool {
      return !empty($_SESSION['permissions'][$modulo][$funcionalidad]);
  }
    

?>