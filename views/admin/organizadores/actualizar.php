<div class="admin-titulo">
  <h1>Actulizar Ponente</h1>
</div>
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
    <div class="admin-boton-derecha">
      <input type="submit" value="Actualizar organizador" class="boton-azul">
    </div>
  </form>
</div>
