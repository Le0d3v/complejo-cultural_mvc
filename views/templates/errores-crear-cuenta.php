<?php 
foreach($errores as $key => $mensajes) {
  foreach($mensajes as $mensaje) { ?>
    <div class="alerta <?php echo $key?> alerta-pequeña"><?php echo $mensaje?></div>
  <?php
  }
}
?>