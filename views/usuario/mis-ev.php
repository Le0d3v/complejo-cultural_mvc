<input type="hidden" value="<?php echo $pag;?>" id="pag">
<h1 class="admin-titulo">Mi registro</h1>
<div class="usuario-boton">
  <a href="/home/eventos" class="boton-azul">Asistir a un Evento</a>
</div>
<div class="usuario-registro">
  <?php if($num_eventos === 0) {?>
    <div class="alerta error">
      <p>Actualmente no estás registrado a nungún evento</p>
    </div>
    <?php 
    } else { ?>
      <div class="alerta exito">
        <p>Actualmente cuentas con registro en los siguientes eventos</p>
      </div>
      <div class="usuario-registro-eventos">
        <?php foreach($registro as $evento) { ?>
          <div class="evento-ficha-horizontal">
            <div class="ficha-h-foto">
              <img src="/img/<?= $evento->imagen?>" alt="imagen-evento" width="300" height="500">
            </div>
            <div class="ficha-h-info">
              <h1><?= $evento->nombre ?></h1>
              <hr> 
              <br>
              <p>Tipo de Evento: <?= $evento->categoria ?></p>
              <p>Lugar: <?= $evento->lugar ?></p>
              <p>Inicia: <?= $evento->hora_inicio;?></p>
              <p>Termina: <?= $evento->hora_fin ?></p>
              <br>
              <hr> <br>
              <div class="ficha-h-btns">
                <a href="/home/evento?id=<?= $evento->evento_id?>&registro=1" class="boton boton-azul">Ver Más</a>
              </div>
            </div>
          </div>
          <?php 
          }
        ?>
      </div>
    <?php 
    }
  ?>
</div>