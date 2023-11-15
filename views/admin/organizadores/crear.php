<h1 class="admin-titulo">Nuevo Ponente</h1>
<div class="boton-volver">
  <a href="/admin/organizadores" class="boton-verde">Volver</a>
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
  <form method="post" class="admin-formulario">
    <?php include "formulario.php"?>
    <div class="boton-guardar">
      <input type="submit" value="Guardar Ponente" class="boton-azul">
    </div>
  </form>
</div>
