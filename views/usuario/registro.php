<div class="admin-titulo">
  <h1>Registro</h1>
</div>
<div class="boton-volver">
  <a href="/home/eventos" class="boton-verde">Volver</a>
</div>
<div class="registro-evento">
  <div class="registro-derecha">
    <h1><?= $evento->nombre ?></h1>
    <img src="/img/<?= $evento->imagen?>" alt="">
  </div>
  <div class="registro-izquierda">
    <h2>Tu registro</h2>
    <form class="formulario" method="post">
      <fieldset>
        <legend class="legend">Llena el siguiente formulario para continuar</legend>
        <div class="campo-registro no-margin-top">
          <label for="nombre">Nombre</label>
          <input 
            type="text" 
            value="<?= $usuario->nombre . " " . $usuario->apellido?>" 
            class="disabled"
            disabled
            name="usuario">
        </div>
        <div class="campo-registro">
          <label for="nombre">Evento</label>
          <input 
            type="text" 
            value="<?= $evento->nombre?>" 
            class="disabled"
            disabled
            name="nombre">
        </div>
        <div class="campo-registro">
          <label for="nombre">Reservar lugar de estacionamiento</label>
          <select name="espacio" id="">
            <option value="0" disabled select> -- Seleccione -- </option>
            <?php foreach($espacios as $espacio) {?>
                <option value="<?= $espacio->id?>"> Espacio No°<?= $espacio->numero ?></option>
                <?php 
                }
              ?>
          </select>
        </div>
        <div class="boton-guardar">
          <input type="submit" value="Finalizar Registro" class="boton-azul">
        </div>
      </fieldset>
    </form>
  </div>
</div>