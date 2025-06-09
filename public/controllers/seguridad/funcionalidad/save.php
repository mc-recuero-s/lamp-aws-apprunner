<?php
    header('Content-Type: application/json; charset=utf-8');
    require("../../../includes/auth.php");
    $user = require_bearer_token();
    $response=['success'=>true,'message'=>'Hecho.'];
    $id = intval($_POST['id']??0);
    $nombre = $_POST['nombre']??'';
    $abreviatura = $_POST['abreviatura']??'';
    $elemento = $_POST['elemento']??'';
    $ver = isset($_POST['ver'])?1:0;
    $editar = isset($_POST['editar'])?1:0;
    $eliminar = isset($_POST['eliminar'])?1:0;
    $modulo = intval($_POST['modulo']??0);
    if($id>0){
        $sql="UPDATE funcionalidad SET nombre=?,abreviatura=?,elemento=?,ver=?,editar=?,eliminar=?,modulo=? WHERE id=?";
        $stmt=$conexion->prepare($sql);
        $stmt->bind_param('sssiiiii',$nombre,$abreviatura,$elemento,$ver,$editar,$eliminar,$modulo,$id);
        $stmt->execute();
    } else {
        $sql="INSERT INTO funcionalidad(nombre,abreviatura,elemento,ver,editar,eliminar,modulo) VALUES(?,?,?,?,?,?,?)";
        $stmt=$conexion->prepare($sql);
        $stmt->bind_param('sssiiii',$nombre,$abreviatura,$elemento,$ver,$editar,$eliminar,$modulo);
        $stmt->execute();
        $id = $conexion->insert_id;
    }
    $response['data']=['id'=>$id];
    echo json_encode($response);
    exit;
?>
