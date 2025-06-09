<?php

  require_once __DIR__ . '/dsn_open.php';

  function require_bearer_token() {
      
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['success'=>false,'message'=>'No autorizado (sin header)']);
        exit;
    }
    list($type, $token) = explode(" ", $headers['Authorization'], 2);
    if ($type !== 'Bearer' || empty($token)) {
        http_response_code(401);
        echo json_encode(['success'=>false,'message'=>'Formato de token inválido']);
        exit;
    }

    $stmt = $GLOBALS['conexion']->prepare(
      "SELECT id, tipo FROM usuario WHERE token = ?"
    );
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($user_id, $user_tipo);
    if (!$stmt->fetch()) {
        http_response_code(401);
        echo json_encode(['success'=>false,'message'=>'Token no reconocido']);
        exit;
    }
    $stmt->close();

    $banco=0;
    $banco2=null;
    $bodega=null;

    if (!isset($headers['Type'])) {
      if($headers['type'] == "banco"){
        $banco= $headers['id'];
      }
      if ($headers['type'] === 'bodega') {
        $bodega  = intval($headers['id']);
        $stmt = $GLOBALS['conexion']->prepare("SELECT banco FROM bodegas WHERE id = ?");
        $stmt->bind_param('i', $bodega);
        $stmt->execute();
        $stmt->bind_result($banco2);
        $stmt->fetch();
        $stmt->close();
      }
    }

    return [
      'id' => $user_id, 
      'tipo' => $user_tipo,
      'banco' => $banco,
      'banco2' => $banco2,
      'bodega' => $bodega,
    ];
  }
  
?>