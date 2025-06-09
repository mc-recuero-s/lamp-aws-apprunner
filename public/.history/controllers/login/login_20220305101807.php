<?php
require("../../includes/dsn_open.php");

$response = array();
$response['success'] = true;
$response['message'] = 'Hecho.';

mysqli_autocommit($conexion,FALSE);

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuario WHERE usuario= '".$usuario."' AND contrasena='".$contrasena."'";
$ejecutar = mysqli_query($conexion,$sql);


if (!$ejecutar) {
  $response['success'] = false;
  $response['message'] = 'Ha ocurrido un error, intente nuevamente.';
}else{
  $user=mysqli_fetch_assoc($ejecutar);
  if(isset($user['id'])){
    $response['data'] = $user['id'] ;
    session_start();
    // error_reporting(0);
    $_SESSION['user']=$user['id'] ;
    $_SESSION['tipo']=$user['tipo'] ;
  }else{
    $response['success'] = false;
    $response['message'] = 'Usuario y contraseña incorrectos.';
  }
}
echo json_encode($response);

?>
