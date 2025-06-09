<?php
  session_start();
  error_reporting(0);
  if(isset($_SESSION['user'])){
    header('location:./index.php');
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta property="og:image" content="https://abaco.org.co/wp-content/uploads/2022/03/AbacoFaviconColor.svg">
    <link rel="icon" type="image/svg+xml" href="https://abaco.org.co/wp-content/uploads/2022/03/AbacoFaviconColor.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="https://abaco.org.co/wp-content/uploads/2022/03/AbacoFaviconColor.png">
    <link rel="icon" type="image/x-icon" href="https://abaco.org.co/wp-content/uploads/2022/03/AbacoFaviconColor.ico">

    <title>Saciar</title>

    <link href="./styles/includes/material-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="./styles/includes/font-awesome.min.css" rel="stylesheet">
    <link href="./styles/includes/custom.css?v=1.70" rel="stylesheet">


    <script src="./javascript/includes/jquery.min.js"></script>
    <script src="./javascript/includes/jquery-ui.min.js"></script>
    <script src="./javascript/includes/sweetalert2@9.js"></script>
    <script src="./javascript/includes/moment.min.js"></script>

    <link href="./styles/login.css?v=1.70" rel="stylesheet">
</head>
<body>
  <div class="loading">
    <div class="loadingio-spinner-double-ring-mntd5rqz5xa"><div class="ldio-dbco6f934ub">
      <div></div>
      <div></div>
      <div><div></div></div>
      <div><div></div></div>
    </div></div>
  </div>

  <section class="login-content">
    <article>
      <div class="login">
        <div class="login-img">
          <div class="logo"><img title="Saciar" src="./images/abaco small.jpg"/></div>
        </div>
        <h2>Iniciar Sesión</h2>
        <!-- <h4>Para iniciar seseión debe tener una cuenta registrada.</h4> -->
        <div class="login-form">
          <div class="form-group">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="username" value="">
          </div>
          <div class="form-group">
            <label for="usuario">Contraseña</label>
            <input type="password" id="contrasena" name="password" value="">
          </div>
          <div class="form-group btns">
            <div class="btn btn-login">
              Ingresar
            </div>
            <!-- <div class="btn btn-login2">
              Ingresar como usuario
            </div> -->
          </div>
        </div>
      </div>
    </article>
  </section>

  <footer>
  </footer>
  <script src="./javascript/login.js?v=1.70"></script>
</body>
