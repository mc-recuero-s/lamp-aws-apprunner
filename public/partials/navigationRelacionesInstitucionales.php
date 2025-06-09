<?php
  session_start();
  error_reporting(0);
 ?>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="./images/favicon-32x32.png">

    <title>Saciar</title>



    <title>Saciar</title>
    <link href="./styles/includes/material-icons.css" rel="stylesheet">
    <link href="./styles/includes/custom2.css?v=1.70" rel="stylesheet">

    <script src="./javascript/includes/jquery.min.js"></script>
    <script src="./javascript/includes/jquery-ui.min.js"></script>
    <script src="./javascript/includes/moment.min.js"></script>
    <script src="./javascript/includes/custom.js?v=1.70"></script>
    <script src="./javascript/scripts.js?v=1.70"></script>


</head>
<header>
  <div class="header">
    <div class="header-config">
      <?php
        if(isset($_SESSION['user'])){
          $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
          $ejecutar = mysqli_query($conexion,$sql);

          $user=mysqli_fetch_assoc($ejecutar);
          if(isset($user['id'])){
            echo '<div class="user">
              <h4>'.$user['nombre'].' '.$user['apellido'].'</h4>
              <ul>
                <li><a title="Editar perfil" class="header-btn" href="./editarPerfil.php" >Editar perfil</a></li>
                <li><a title="Cerrar Sesión" href="./logout.php" class="header-btn header-out">Cerrar Sesión</a></li>
              </ul>
            </div>';
          }else{
            echo '<a title="Iniciar Sesión" href="./login.php" class="header-btn header-user"></a>';
          }
        }else{
          echo '<a title="Iniciar Sesión" href="./login.php" class="header-btn header-user"></a>';
        }
      ?>
      <a title="Configuración" href="./configuracion.php" class="header-btn header-config">
      </a>
    </div>
  </div>
  <div class="nav">
    <div class="logo"><img title="Saciar" src="./images/abaco small.jpg"/></div>
    <nav>
      <?php
      $actual_link = basename($_SERVER['PHP_SELF']);
      if($actual_link == "estadoActual.php"){
        echo '<a class="tab active" href="./agregarBeneficiado">Agregar beneficiado</a>';
      }else{
        echo '<a class="tab" href="./agregarBeneficiado.php">Agregar beneficiado</a>';
      }
      if($actual_link == "crearEntrada.php"){
        echo '<a class="tab active" href="./crearEntrada.php">Reporte población/a>';
      }else{
        echo '<a class="tab" href="./crearEntrada.php">Reporte población</a>';
      }
      ?>
    </nav>
  </div>
</header>
