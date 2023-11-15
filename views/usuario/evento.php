<input type="hidden" value="<?php echo $pag;?>" id="pag">
<div class="evento-padding">
<div class="index-cabecera">
  <div class="admin-titulo">
    <h1><?php echo $evento->nombre?></h1>
  </div>
</div>
<div class="evento-vista">
  <div class="evento-vista-foto">
    <img src="/img/<?php echo $evento->imagen?>" alt="Evento-imagen">
  </div>
  <div class="evento-vista-info texto-blanco">
    <p><?php echo $evento->descripcion?></p><br>
    <p>Tipo de Evento: <span><?php echo $categoria->categoria?></span></p>
    <p>Fecha del Evento: <span><?php echo $evento->fecha?></span></p>
    <p>Inicia a las: <span><?php echo $evento->hora_inicio?></span> Termina a las: <span><?php echo $evento->hora_fin?></span></p>
    <p>Lugar del Evento: <span><?php echo $lugar->lugar?></span></p>
    <br><hr>
    <div class="evento-info-organizador">
      <p>Organizador: <span><?php echo $organizador->nombre_o . " " . $organizador->apellido;?></span></p>
      <div class="evento-organizador">
        <p>Telefono: <span><?php echo $organizador->telefono?></span></p>
        <p>Correo Electrónico: <span><?php echo $organizador->correo?></span></p>
      </div>
    </div>
    <div class="eventos-acciones">
      <a href="/home/eventos" class="boton-verde">Volver</a>
      <a href="/iniciar-sesion" class="boton-azul">Asistir al evento</a>
    </div>
  </div>
</div>
</div>