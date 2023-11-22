<div class="index-cabecera">
  <h1>Registro</h1>
  <h2>Crea una cuenta y forma parte de nososotros</h2>
</div>
<?php include_once __DIR__ . "/../templates/errores-crear-cuenta.php"?>
<form class="singin-form" method="post">
  <fieldset>
    <legend>Datos personales</legend>
    <div class="campo">
      <label for="">Nombre</label>
      <input type="text" name="usuario[nombre]" value="<?php echo s($usuario->nombre);?>">
    </div>
    <div class="Apellido">
      <label for="">Apellido</label>
      <input type="text" name="usuario[apellido]" value="<?php echo s($usuario->apellido);?>">
    </div>
    <div class="campo">
      <label for="">Fecha de nacimiento</label>
      <input type="date"  name="usuario[fecha_nac]" value="<?php echo s($usuario->fecha_nac);?>">
    </div>
    <div class="campo">
      <label for="">Número de teléfono</label>
      <input type="tel"  name="usuario[telefono]" value="<?php echo s($usuario->telefono);?>">
    </div>
  </fieldset>
  <fieldset>
    <legend>Datos de la cuenta</legend>
    <div class="campo">
      <label for="">E-mail</label>
      <input type="email" name="usuario[email]" value="<?php echo s($usuario->email);?>">
    </div>
    <div class="campo">
      <label for="">Password</label>
      <input type="password" name="usuario[password]">
    </div>
    <div class="campo">
      <label for="">Confirma tu password</label>
      <input type="password" name="password">
    </div>
  </fieldset>
  <div class="formulario-acciones">
    <a href="/iniciar-sesion">¿Ya tienes una cuenta? Iniciar Sesión</a>
    <div class="boton-guardar">
      <input type="submit" value="Crear cuenta" class="boton-azul">
    </div>
  </div>
</form>