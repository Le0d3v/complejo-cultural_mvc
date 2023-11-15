<div class="index-cabecera">
  <h1>Reestablecer Password</h1>
  <h2>Ingresa tu siguiente password a continuación</h2>
</div>
<?php include_once __DIR__ . "/../templates/errores-crear-cuenta.php"?>
<?php if($error) return;?>
<form method="post" class="formulario-login">
  <div class="campo">
    <label for="password">Nuevo Password</label>
    <input type="password" id="password" name="usuario[password]" placeholder="Tu nuevo password">
  </div>
  <div class="campo">
    <label for="password">Confirma Password</label>
    <input type="password" id="password" name="password" placeholder="Confirma tu nuevo password">
  </div>
  <div class="boton-guardar">
    <input type="submit" class="boton-azul" value="Guardar Nuevo Password">
  </div>
  <div class="login-enlace">
    <a href="/crear-cuenta" class="e-1">¿No tienes cuenta? Crear una</a>
    <a href="/recuperar-password" class="e-2">¿Olvidaste tu password?</a>
  </div>
</form>