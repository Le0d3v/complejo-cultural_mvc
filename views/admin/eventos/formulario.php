<fieldset>
  <legend>Datos Generales</legend>
  <div class="campo">
    <label for="nombre">Nombre del evento</label>
    <input type="text" name="evento[nombre]" value="<?php echo s($evento->nombre); ?>">
  </div>
  <div class="form-2sec">
    <div class="campo">
      <label for="cupo">Cupo del evento (Lugares)</label>
      <input type="number" name="evento[cupo]" min="1" value="<?php echo s($evento->cupo); ?>">
    </div>
    <div class="campo">
      <div>
        <label for="categoria">Categoría del evento</label>
      </div>
      <select name="evento[id_categoria]" value="<?php echo s($evento->id_categoria); ?>">
        <option value="0" disabled selected > -- Seleccione -- </option>
        <?php 
          foreach($categorias as $categoria) {?>
            <option 
              <?php echo  $evento->id == $categoria->id  ? "selected"  : "" ?>
              value="<?php echo s($categoria->id);?>"><?php echo $categoria->categoria;?>
            </option>
          <?php 
          }
        ?>
      </select>
    </div>
  </div>
  <div class="campo">
    <label for="descripcion">Descripción del evento</label>
    <textarea 
      name="evento[descripcion]" 
      id="descripcion" 
      cols="50" 
      rows="5"">
      <?php echo s($evento->descripcion); ?>
    </textarea>
  </div>
  <div class="campo">
    <label for="imagen">Imagen del evento (Encabezado)</label>
    <input 
      type="file" 
      id="imagen"
      name="evento[imagen]"
      accept="image/jpeg, image/png">
      <?php if($evento->imagen) {?>
        <img 
            src="/img/<?php echo $evento->imagen;?>" 
            alt="imagen-evento" 
            class="imagen-small"
          >
          <?php 
        }
      ?>
  </div>
</fieldset>
<fieldset>
  <legend>Datos de fecha y hora</legend>
  <div class="campo">
    <label for="fecha">Fecha del evento</label>
    <input 
      type="date" 
      name="evento[fecha]" 
      value="<?php echo ($evento->fecha)?>" 
      min="<?php echo date("Y-m-d", strtotime("+1 day"))?>">
  </div>
  <div class="form-2sec">
    <div class="campo">
      <label for="hora_i">Hora de inicio del evento</label>
      <input type="time" 
        name="evento[hora_inicio]" 
        value="<?php echo s($evento->hora_inicio);?>">
    </div>
    <div class="campo">
      <label for="hora_f">Hora de fin del evento</label>
      <input type="time" name="evento[hora_fin]" value="<?php echo s($evento->hora_fin); ?>">
    </div>
  </div>
</fieldset>
<fieldset>
  <legend>Datos adicionales</legend>
    <div class="form-2sec">
      <div class="campo">
        <label for="lugar">Lugar de el evento</label>
        <select name="evento[id_lugar]" id=""  value="<?php echo s($evento->id_lugar); ?>">
          <option value="0" disabled selected> -- Seleccione -- </option>
          <?php
            foreach($lugares as $lugar) { ?>
              <option 
                <?php echo  $evento->id == $lugar->id  ? "selected"  : "" ?>
                value="<?php echo s($lugar->id);?>"><?php ?><?php echo $lugar->lugar;?>
              </option>
              <?php 
            }
          ?>
        </select>
      </div>
      <div class="campo">        
        <label for="">Encargado del evento</label>
        <select name="evento[id_organizador]" id=""  value="<?php echo s($evento->id_organizador); ?>">
          <option value="0" disabled selected> -- Seleccione --</option>
          <?php 
            foreach($organizadores as $organizador) { ?>
              <option 
                <?php echo  $evento->id == $organizador->id  ? "selected"  : "" ?>
                value="<?php echo s($organizador->id);?>">
                <?php echo $organizador->nombre_o . " " . $organizador->apellido?>
              </option>
            <?php 
            }
          ?>
        </select>
      </div>  
    </div>
</fieldset>