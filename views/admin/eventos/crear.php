<input type="hidden" value="<?php echo $pag;?>" id="pag">
<div>
  <h1 class="admin-titulo">Nuevo Evento</h1>
  <div class="boton-volver">
    <a href="/admin/eventos" class="boton-verde">Volver</a>
  </div>
  <?php   
    foreach($errores as $error) { ?>
      <div class="alerta error">
        <?php echo $error?>
      </div>
    <?php 
    }
  ?>
  <div class="formulario-sombra">
    <form method="post" class="formulario-evento" enctype="multipart/form-data">
      <?php include "formulario.php"?>
      <div class="boton-guardar">
        <input type="submit" value="Crear evento" class="boton-azul">
      </div>
    </form>
  </div>
</div>
