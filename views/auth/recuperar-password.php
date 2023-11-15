<div class="index-cabecera">
  <h1>¿Olvidaste tu password?</h1>
  <h2>Reestablece tu password escribiendo tu email a continuación</h2>
</div>
<?php include_once __DIR__ . "/../templates/errores-crear-cuenta.php"?>
<form class="formulario-olvide" method="post">
  <div class="campo">
    <label for="email">E-mail</label>
    <input type="email" id="email" name="email" placeholder="Tu e-mail">
  </div>
  <div class="boton-guardar">
    <input type="submit" value="Enviar Instrucciones" class="boton-azul">
  </div>
  <div class="login-enlace">
    <a href="/iniciar-sesion" class="e-1">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta" class="e-1">¿No tienes cuenta? Crear una</a>
  </div>
</form>
