<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user = require_bearer_token();

$id             = intval($_POST['id'] ?? 0);
$codigo         = $_POST['codigo'];
$nombre         = $_POST['nombre'];
$unidad         = $_POST['unidad'];
$subcategoria   = $_POST['subcategoria'];
$observaciones  = $_POST['observaciones'];
$valor          = floatval($_POST['valor_comercial']);
$etiqueta       = 0;
$tipo           = $_POST['tipo'];
$institucion_id = intval($_POST['institucion'] ?? 0);

$conexion->begin_transaction();

try {
    if ($id) {
        $up = $conexion->prepare("
          UPDATE producto
          SET codigo      = ?,
              nombre      = ?,
              unidad      = ?,
              subcategoria= ?,
              observaciones = ?,
              valor_comercial = ?,
              etiqueta    = ?
          WHERE id = ?
        ");
        $up->bind_param(
            'sssssdsi',
            $codigo,
            $nombre,
            $unidad,
            $subcategoria,
            $observaciones,
            $valor,
            $etiqueta,
            $id
        );
        $up->execute();

        $del = $conexion->prepare("
          DELETE FROM producto_institucion
          WHERE producto_id = ?
        ");
        $del->bind_param('i', $id);
        $del->execute();
    } else {
        $ins = $conexion->prepare("
          INSERT INTO producto
            (codigo, nombre, unidad, subcategoria, observaciones, valor_comercial, etiqueta, por)
          VALUES
            (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $ins->bind_param(
            'sssssdsi',
            $codigo,
            $nombre,
            $unidad,
            $subcategoria,
            $observaciones,
            $valor,
            $etiqueta,
            $user['id']
        );
        $ins->execute();
        $id = $ins->insert_id;
    }

    $ri = $conexion->prepare("
      INSERT INTO producto_institucion
        (producto_id, institucion, tipo, por)
      VALUES
        (?, ?, ?, ?)
    ");
    $ri->bind_param('iisi', $id, $institucion_id, $tipo, $user['id']);
    $ri->execute();

    $conexion->commit();
    echo json_encode([
        'success' => true,
        'message' => $id ? 'Actualizado.' : 'Creado.',
        'data'    => ['id' => $id]
    ]);
} catch(Exception $e) {
    $conexion->rollback();
    echo json_encode(['success' => false, 'message' => 'Error al guardar.']);
}

exit;
?>
