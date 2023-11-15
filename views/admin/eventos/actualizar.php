<input type="hidden" value="<?php echo $pag;?>" id="pag">
<div class="admin-titulo">
  <h1>Actualizar Evento</h1>
</div>
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
    <div class="admin-boton-derecha">
      <input type="submit" value="Guardar Cambios" class="boton-verde">
    </div>
  </form>
</div>