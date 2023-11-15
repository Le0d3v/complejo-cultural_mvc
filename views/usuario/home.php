<input type="hidden" value="<?php echo $pag;?>" id="pag">
<h1 class="admin-titulo">Complejo Cultural</h1>
<div class="usuario-boton">
  <a href="/home/eventos" class="boton-azul">Asistir a un Evento</a>
</div>
<div class="admin-index-botones">
  <a class="admin-btn1">
    <div>
      <h3>Últimos eventos:</h3>
        <div class="index-listado">
          <?php 
            foreach($num_eventos as $evento) { ?>
              <p> - <?php echo $evento->nombre?></p>  
              <?php 
            }
          ?>
      </div>
    </div>
  </a>
  <a class="admin-btn3">
    <div>
      <h3>Mi Cuenta</h3>
      <div class="user-logo mini">
        <img src="/build/img/user.png" alt="">
      </div>
      <h2><b><?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido"]?></b></h2>
      <p>Usuario de Complejo Cultural</p>
    </div>
    <br> <hr>
    <h3>Datos personales: </h3>
    <div class="home-datos-personales">
      <div class="datos-key">
        <p>Número de Teléfono</p>
        <p>E-mail: </p>
      </div>
      <div class="datos-valor">
        <p><?php echo $_SESSION["telefono"]?></p>
        <p><?php echo $_SESSION["email"]?></p>
      </div>
    </div>
    
  </a>
  <a class="admin-btn2">
    <div>
      <h3>Mi registro</h3>
    </div>
  </a>
</div>