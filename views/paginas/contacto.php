<div class="index-cabecera">
  <h1>Contacto</h1>
  <h2>¡Contáctanos y Organiza el Evento de tus Sueños!</h2>
  <div class="formulario-contacto-selector">
    <form class="formulario-contacto">
      <fieldset>
        <legend>Datos Personales</legend>
        <div class="campo">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" placeholder="Tu nombre">
        </div>
        <div class="campo">
          <label for="apellidos">Apellidos</label>
          <input type="text" name="apellido" id="apellidos" placeholder="Tus Apellidos">
        </div>
        <div class="campo">
          <label for="telefono">Teléfono</label>
          <input type="tel" name="telefono" id="telefono" placeholder="000-000-00">
        </div>
        <div class="campo">
          <label for="email">E-mail</label>
          <input type="email" name="email" id="email" placeholder="email@gmail.com">
        </div>
      </fieldset>
      <fieldset>
        <legend>Datos sobre su Evento</legend>
        <div class="campo">
          <label for="cantidad">Capacidad de su evento (Personas)</label>
          <input type="number" min="1" name="cantidad" id="cantiad" placeholder="Cantidad en números">
        </div>
        <div class="campo">
          <label for="fecha">Fecha de su evento</label>
          <input type="date" min="<?php echo date("Y/m/d")?>" name="fecha" id="fecha">
        </div>
        <div class="campos">
          <div class="campo">
            <label for="tipo">Tipo de evento</label>
            <select name="tipo" id="tipo">
              <option value="0" disabled select> -- Seleccione -- </option>
              <?php 
                foreach($categorias as $categoria) { ?>
                  <option value="<?php echo $categoria->id?>"><?php echo $categoria->categoria?></option>
                <?php 
                }
              ?>
            </select>
          </div>
          <div class="campo">
            <label for="lugar">Lugar del evento</label>
            <select name="lugar" id="lugar">
              <option value="0" disabled select> -- Seleccione -- </option>
              <?php 
                foreach($lugares as $lugar) { ?>
                  <option value="<?php echo $lugar->id?>"><?php echo $lugar->lugar?></option>
                <?php 
                }
              ?>
            </select>
          </div>
        </div>
        <div class="boton-guardar">
          <input type="submit" class="boton-azul" value="Enviar">
        </div>
      </fieldset>
    </form>
  </div>
</div>