<input type="hidden" value="<?php echo $pag;?>" id="pag">
<h1 class="admin-titulo">Configuración</h1>
<div class="admin-botones-config">
  <div href="" class="admin-conf1">
    Cambiar Datos Personales
    <form method="post" class="form-config">
      <div class="config-campo">
        <label for="">Teléfono: </label>
        <input type="tel" name="usuario[telefono]" value="<?php echo $_SESSION["telefono"]?>">
      </div>
      <div class="config-campo">
        <label for="">E-mail: </label>
        <input type="email" name="usuario[email]" value="<?php echo $_SESSION["email"]?>">
      </div>
      <div class="config-campo">
        <label for="">Password: </label>
        <input type="password" name="usuario[password]">
      </div>
      <div class="boton-guardar">
        <input type="submit" value="Guardar Cambios" class="boton-azul">
      </div>
    </form>
  </div>
  <div href="" class="admin-conf2">
    Agregar Nuevo Administrador
    <form method="post" class="form-config">
      <div class="form-2campos">
        <div class="campos-1">
          <div class="campo">
            <label for="">Nombre:</label>
            <input type="text">
          </div>
          <div class="campo">
            <label for="">Apellido:</label>
            <input type="text">
          </div>
        </div>
        <div class="campos-2">
          <div class="campo">
            <label for="">Telefono:</label>
            <input type="text">
          </div>
          <div class="campo">
            <label for="">E-mail:</label>
            <input type="text">
          </div>
        </div>
      </div>
      <div class="boton-guardar">
        <input type="submit" value="Guardar Cambios" class="boton-verde-lago">
      </div>
    </form>
  </div>
</div>
  
  
  
