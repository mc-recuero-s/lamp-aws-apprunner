<?php
require("../../includes/dsn_open.php");
header('Content-Type: application/json');

$response = ['success'=>false,'message'=>'Credenciales inválidas'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit;
}

$usuario    = $_POST['usuario']    ?? '';
$contrasena = $_POST['contrasena'] ?? '';

$stmt = $conexion->prepare("
    SELECT id, tipo, contrasena
      FROM usuario 
     WHERE usuario = ?
");
$stmt->bind_param("s", $usuario);
$stmt->execute();

$stmt->store_result();
$stmt->bind_result($id, $tipo, $hash_contra);

if ($stmt->fetch() && password_verify($contrasena, $hash_contra)) {
    $stmt->free_result();
    $stmt->close();

    $token = bin2hex(random_bytes(32));
    $upd = $conexion->prepare("
        UPDATE usuario 
           SET token = ? 
         WHERE id = ?
    ");
    $upd->bind_param("si", $token, $id);
    $upd->execute();
    $upd->close();

    session_start();
    session_regenerate_id(true);
    $_SESSION['user']  = $id;
    $_SESSION['tipo']  = $tipo;
    $_SESSION['token'] = $token;

    $uid = $id;
    $stmt = $conexion->prepare("
      SELECT 1
        FROM usuario_perfil up
        JOIN perfil p ON up.perfil = p.id
       WHERE up.usuario = ?
         AND p.codigo = 'superadmin'
       LIMIT 1
    ");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['current_profile'] = ['type'=>'superadmin','id'=>null];
    } else {
        $stmt->close();
        $stmt = $conexion->prepare("
          SELECT banco
            FROM usuario_banco
           WHERE usuario = ?
           LIMIT 1
        ");
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $stmt->bind_result($bank_id);
        if ($stmt->fetch()) {
            $_SESSION['current_profile'] = ['type'=>'banco','id'=>$bank_id];
        } else {
            $stmt->close();
            $stmt = $conexion->prepare("
              SELECT bodega
                FROM usuario_bodega
               WHERE usuario = ?
               LIMIT 1
            ");
            $stmt->bind_param("i", $uid);
            $stmt->execute();
            $stmt->bind_result($bodega_id);
            if ($stmt->fetch()) {
                $_SESSION['current_profile'] = ['type'=>'bodega','id'=>$bodega_id];
            }
        }
    }
    $stmt->close();

    $response = [
      'success' => true,
      'message' => 'Login exitoso',
      'data'    => ['id'=>$id,'tipo'=>$tipo,'token'=>$token]
    ];
} else {
    $stmt->close();  
}

echo json_encode($response);
