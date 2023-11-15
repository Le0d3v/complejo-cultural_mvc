<input type="hidden" value="<?php echo $pag;?>" id="pag">
<h1 class="admin-titulo">Panel de Administración</h1>
<div class="admin-index-botones">
  <a href="/admin/eventos" class="admin-btn1">
    <div>
      <h3>Total de eventos:<h1/>
      <span> <?php echo count($eventos);?> </span>
    </div>
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
  <a href="/admin/config" class="admin-btn3">
    <h3>Mi cuenta</h3>
    <div class="btn-3-1">
      <div class="user-logo">
        <img src="/build/img/user.png" alt="">
      </div>
      <span><b><?php echo $_SESSION["nombre"] . " " . $_SESSION["apellido"]?></b></span>
      <p>Cuenta de Administración</p>
      <br> <hr> 
    </div>
    <h3>Datos Personales: </h3>
    <div class="btn3-2">
      <div class="admin-info">
        <p>Teléfono: </p>
        <p>Correo Electrónico: </p>
      </div>
      <div class="admin-cont">
        <p><b><?php echo $_SESSION["telefono"]?></b></p>
        <p><b><?php echo $_SESSION["email"]?></b></p>
      </div>
    </div>
    <hr>
  </a>
  <a href="/admin/usuarios" class="admin-btn2">
    <div>
      <h3>Usuarios: </h3>
      <span><?php echo count($usuarios)?></span>
    </div>
    <div>
      <h3>Usuarios nuevos:</h3>
      <div class="index-listado">
        <?php 
          foreach($num_usuarios as $usuario) { ?>
            <p> - <?php echo $usuario->nombre?> : <?php echo $usuario->email?></p>  
            <?php 
          }
        ?>
      </div>
    </div>
  </a>
</div>