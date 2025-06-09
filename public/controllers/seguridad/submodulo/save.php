<?php
    header('Content-Type: application/json; charset=utf-8');
    require("../../../includes/auth.php");
    $user = require_bearer_token();
    $id = intval($_POST['id'] ?? 0);
    $nombre = $_POST['nombre'] ?? '';
    $abre = $_POST['abreviatura'] ?? '';
    $elem = $_POST['elemento'] ?? '';
    $parent = intval($_POST['modulo'] ?? 0);
    if($id > 0) {
    $stmt = $conexion->prepare("UPDATE modulo SET nombre=?, abreviatura=?, elemento=?, modulo=? WHERE id=?");
    $stmt->bind_param('sssii', $nombre, $abre, $elem, $parent, $id);
    $stmt->execute();
    } else {
    $stmt = $conexion->prepare("INSERT INTO modulo(nombre, abreviatura, elemento, modulo, creado, por) VALUES(?,?,?,?,NOW(),0)");
    $stmt->bind_param('sssi', $nombre, $abre, $elem, $parent);
    $stmt->execute();
    $id = $conexion->insert_id;
    }
    echo json_encode(['success'=>true,'message'=>'','data'=>['id'=>$id]]);
?>