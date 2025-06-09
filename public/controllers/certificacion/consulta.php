<?php

  require("../../includes/dsn_open.php");


  $response = array();
  $response['success'] = true;
  $response['message'] = 'Hecho.';


  
  

  session_start();
  error_reporting(0);

  if(isset($_SESSION['user'])){
    $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
    $ejecutar = mysqli_query($conexion,$sql);

    $user=mysqli_fetch_assoc($ejecutar);
    unset($user['contrasena']);
    $response['usuario']=$user;
  }

  echo json_encode($response,true);
  mysqli_close($conexion);

?>
