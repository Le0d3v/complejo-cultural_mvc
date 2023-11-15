<fieldset>
    <legend>Datos personales</legend>
      <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="organizador[nombre_o]" placeholder="Nombre" value="<?php echo $organizador->nombre_o?>">
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="organizador[apellido]" placeholder="Apellido" value="<?php echo $organizador->apellido;?>">
      </div>
      <div class="campo"> 
        <label for="telefono">Telefono</label>
        <input type="tel" id="telefono" name="organizador[telefono]" placeholder="000-000-00-00" value="<?php echo $organizador->telefono;?>">
        <label for="correo">E-mail</label>
        <input type="email" id="correo" name="organizador[correo]" placeholder="correo@gmail.com" value="<?php echo $organizador->correo;?>">
      </div>
    
</fieldset>