<input type="hidden" value="<?php echo $pag;?>" id="pag">
<div class="admin-titulo">
  <h1>Tu boleto</h1>
</div>
<div class="boton-volver">
    <a href="/home/mis-eventos" class="boton-verde">Volver</a>
  </div>
<div class="boleto">
  <div class="boleto-info">
    <h1><?= $evento->nombre ?></h1>
    <p>Invitado: <span><?= $user->nombre . " " . $user->apellido?></span></p>
    <p>Código de acceso:</p>
    <p class="boleto-clave"><?= $registro[0]->clave ?></p>
    <p>Fecha: <span class="boleto-span"><?= $evento->fecha ?></span></p>
    <p>Hora: <span class="boleto-span"><?= $evento->hora_inicio ?></span></p>
  </div>
  <div class="boleto-codigos">
    <div class="code-bar">
      <img src="/img.png" alt="">
    </div>
    <div class="qr-code">
      <img src="/qrcode.png" alt="">
    </div>
  </div>
</div>