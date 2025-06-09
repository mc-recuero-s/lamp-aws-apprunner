<?php
header('Content-Type: application/json; charset=utf-8');
require("../../../includes/auth.php");
$user         = require_bearer_token();
$banco        = isset($user['banco']) ? intval($user['banco']) : 0;
$por          = intval($user['id']);
$id           = intval($_POST['id'] ?? 0);
$nombre       = $_POST['nombre']   ?? '';
$apellido     = $_POST['apellido'] ?? '';
$correo       = $_POST['correo']   ?? '';
$usuarioF     = $_POST['usuario']  ?? '';
$contrasena   = $_POST['contrasena'] ?? '';
$tipoUsuario  = $banco > 0 ? 1 : 0;

if ($id > 0) {
    if ($contrasena !== '') {
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("
            UPDATE usuario 
               SET nombre     = ?,
                   apellido   = ?,
                   correo     = ?,
                   usuario    = ?,
                   tipo       = ?,
                   contrasena = ?
             WHERE id = ?
        ");
        $stmt->bind_param('ssssisi', $nombre, $apellido, $correo, $usuarioF, $tipoUsuario, $hash, $id);
    } else {
        $stmt = $conexion->prepare("
            UPDATE usuario 
               SET nombre   = ?,
                   apellido = ?,
                   correo   = ?,
                   usuario  = ?,
                   tipo     = ?
             WHERE id = ?
        ");
        $stmt->bind_param('ssssii', $nombre, $apellido, $correo, $usuarioF, $tipoUsuario, $id);
    }
    $stmt->execute();
} else {
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $stmt = $conexion->prepare("
        INSERT INTO usuario (nombre, apellido, correo, usuario, tipo, contrasena) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param('ssssis', $nombre, $apellido, $correo, $usuarioF, $tipoUsuario, $hash);
    $stmt->execute();
    $id = $conexion->insert_id;

    if ($banco > 0) {
        $ins = $conexion->prepare("
            INSERT INTO usuario_banco (usuario, banco, por) 
            VALUES (?, ?, ?)
        ");
        $ins->bind_param('iii', $id, $banco, $por);
        $ins->execute();
    }
}

$response = [
    'success' => true,
    'message' => 'Hecho.',
    'data'    => ['id' => $id]
];

echo json_encode($response, true);
mysqli_close($conexion);
exit;
?>
