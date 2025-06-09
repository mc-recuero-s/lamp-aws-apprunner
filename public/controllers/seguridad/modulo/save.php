<?php
    header('Content-Type: application/json; charset=utf-8');
    require("../../../includes/auth.php");
    $user = require_bearer_token();
    $response=['success'=>true,'message'=>'Hecho.'];
    $id=intval($_POST['id']??0);
    $nombre=$_POST['nombre']??'';
    $abreviatura=$_POST['abreviatura']??'';
    $elemento=$_POST['elemento']??'';
    if($id>0){
        $stmt=$conexion->prepare("UPDATE modulo SET nombre=?,abreviatura=?,elemento=? WHERE id=?");
        $stmt->bind_param('sssi',$nombre,$abreviatura,$elemento,$id);
        $stmt->execute();
    } else {
        $stmt=$conexion->prepare("INSERT INTO modulo(nombre,abreviatura,elemento) VALUES(?,?,?)");
        $stmt->bind_param('sss',$nombre,$abreviatura,$elemento);
        $stmt->execute();
        $id=$conexion->insert_id;
    }
    $response['data']=['id'=>$id];
    echo json_encode($response);
    exit;
?>
