<input type="hidden" value="<?php echo $pag;?>" id="pag">
<h1 class="admin-titulo">Complejo Cultural</h1>
<div class="usuario-boton">
  <a href="/home/eventos" class="boton-azul">Asistir a un Evento</a>
</div>
<div class="user-index-botones">
  <div class="user-btn1">
    <div>
      <h3>Próximos eventos:</h3>
        <div class="index-listado">
          <?php 
            foreach($pila as $evento) { ?>
              <a href="/home/evento?id=<?= $evento->id?>">
                - <?= $evento->nombre?> 
                - <?= $evento->fecha?>
                [ <?= $evento->hora_inicio?>
                - <?= $evento->hora_fin?> ]
              </a>
              <?php 
            }
          ?>
      </div>
    </div>
  </div>
  <div class="user-btn2">
    <div>
      <h3>Mi registro</h3>
    </div>
  </div>
</div>