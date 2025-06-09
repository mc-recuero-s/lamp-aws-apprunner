<?php
header('Content-Type: application/json; charset=utf-8');
require '../../../includes/auth.php';
$user = require_bearer_token();

// ——————————————————————
// 1) Capturar y sanitizar entrada
// ——————————————————————
$rawInput   = file_get_contents('php://input');
$input      = json_decode($rawInput, true);

$id         = isset($input['id'])    ? intval($input['id']) : 0;
$nombre     = $conexion->real_escape_string($input['nombre'] ?? '');

// ——————————————————————
// 2) Preparar JSON (sin usar real_escape_string aquí)
// ——————————————————————
$coloresJson = json_encode($input['colores'] ?? [], JSON_UNESCAPED_UNICODE);
$estilosJson = json_encode($input['estilos'] ?? '', JSON_UNESCAPED_UNICODE);

// ——————————————————————
// 3) Carpeta de uploads (ya dejaste esto funcionando)
// ——————————————————————
$uploadDir = __DIR__ . '/../../../images/uploads/bancos/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// ——————————————————————
// 4) Procesar logo si viene en Base64
// ——————————————————————
$logoName = null;
if (!empty($input['logoBase64'])) {
    $data = base64_decode($input['logoBase64']);
    if ($data === false) {
        echo json_encode(['success'=>false,'message'=>'Base64 inválido.']); exit;
    }
    $logoName = uniqid('bank_') . '.png';
    if (file_put_contents($uploadDir . $logoName, $data) === false) {
        echo json_encode(['success'=>false,'message'=>'No se pudo guardar el logo.']); exit;
    }
}

// ——————————————————————
// 5) Armar consulta (INSERT vs UPDATE)
// ——————————————————————
if ($id > 0) {
    // UPDATE
    if ($logoName) {
        // borrar logo antiguo
        $old = $conexion
            ->query("SELECT logo FROM banco WHERE id = {$id}")
            ->fetch_assoc()['logo'] ?? '';
        if ($old && file_exists($uploadDir . $old)) {
            unlink($uploadDir . $old);
        }

        $sql    = "UPDATE banco
                   SET nombre = ?, logo = ?, colores = ?, estilos = ?
                   WHERE id = ?";
        $types  = 'ssssi';
        $params = [$nombre, $logoName, $coloresJson, $estilosJson, $id];
    } else {
        $sql    = "UPDATE banco
                   SET nombre = ?, colores = ?, estilos = ?
                   WHERE id = ?";
        $types  = 'sssi';
        $params = [$nombre, $coloresJson, $estilosJson, $id];
    }
    $message = 'Banco actualizado.';
} else {
    // INSERT
    $sql    = "INSERT INTO banco
               (nombre, logo, colores, estilos, creado, por)
               VALUES (?, ?, ?, ?, NOW(), 0)";
    $types  = 'ssss';
    $params = [$nombre, $logoName, $coloresJson, $estilosJson];
    $message = 'Banco creado.';
}

// ——————————————————————
// 6) Ejecutar y responder
// ——————————————————————
$stmt = $conexion->prepare($sql);
if ( ! $stmt ) {
    echo json_encode(['success'=>false,'message'=>'Error prepare: '.$conexion->error]);
    exit;
}

$stmt->bind_param($types, ...$params);
if ( ! $stmt->execute() ) {
    echo json_encode(['success'=>false,'message'=>'Error execute: '.$stmt->error]);
    exit;
}

if ($id === 0) {
    $id = $conexion->insert_id;
}

echo json_encode([
    'success' => true,
    'message' => $message,
    'data'    => ['id' => $id]
]);
?>