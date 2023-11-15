<input type="hidden" value="<?php echo $pag?>" id="pag">
<h1 class="admin-titulo">Espacio número <?php echo $espacio->numero;?></h1>
<div class="boton-volver">
  <a href="/admin/estacionamiento" class="boton-verde">Volver</a>
</div>  
<?php 
  if($espacio->ocupado === "0") { ?>
    <div class="espacio-libre">
      <p>Estado: Disponible</p>
      <p>Éste espacio aun se encuentra disponible para ser ocupado</p>
    </div>
  <?php 
  } else { ?>
    <div class="espacio-ocupado">
      <p>Estado: Ocupado</p>
    </div>
  <?php 
  }
?>