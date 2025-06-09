<?php include __DIR__ . '/partials/header.php'; ?>
<link href="./styles/perfil.css?v=1.70" rel="stylesheet">

<section class="perfil">
  <div>
  <?php
    if(isset($_SESSION['user'])){
      $sql = "SELECT * FROM usuario WHERE id= '".$_SESSION['user']."'";
      $ejecutar = mysqli_query($conexion,$sql);

      $user=mysqli_fetch_assoc($ejecutar);
      if(isset($user['id'])){
        echo '<h3> Editar Perfil de '.$user['nombre'].' '.$user['apellido'].'</h3>';
      }
    }
   ?>
    <div class="b1">
      <div>
        <img class="imgPer" src="images/perfil.png" alt="">
      </div>

      <div class="editarPerfil">
        <div class="nombr">
          <div class="groupForm">
            <label >Nombre</label>
            <input type="text" class="nomb" id="" name="nomb"  value="<?php echo $user['nombre'];?>" >
          </div>
        </div>
        <div class="apellid">
          <div class="groupForm">
            <label >Apellido</label>
            <input type="text" class="apell" id="" name="apell"  value="<?php echo $user['apellido'];?>" >
          </div>
        </div>
        <div class="corre">
          <div class="groupForm">
            <label >Correo</label>
            <input type="text" class="corr" id="" name="corre"  value="<?php echo $user['correo']; ?>" disabled >
          </div>
        </div>
        <div class=" usuari">
          <div class="groupForm">
            <label >Usuario</label>
            <input type="text" class="usua" id="" name="usua"  value="<?php echo $user['usuario'];?>" disabled >
          </div>
        </div>
        <div class="contrasen">
          <div class="groupForm">
            <label >Contraseña</label>
            <input type="text" class="contra" id="" name="contra"  value="<?php echo $user['contrasena'];?>" >
          </div>
        </div>
        <!-- <div class="groupForm">
        <label >Contraseña</label>
        <input type="password" class="" id="">
      </div> -->
      <!-- <div class="btn actualizar" title="Actualizar">Actualizar</div> -->
      <button class="btn-xs actualizar">Actualizar</button>
    </div>

    </div>

  </div>

</section>
<script src="./javascript/perfil.js?v=1.70"></script>

<?php include __DIR__ . '/partials/footer.php';?>
