<div class="index-cabecera">
  <h1>Login</h1>
  <h2>Inicia Sesión con tus credenciales</h2>
  <?php include_once __DIR__ . "/../templates/errores-crear-cuenta.php"?>
  <?php if($resultado == 2) { ?>
    <div class="alerta exito alerta-pequeña">Cambio realizado exitosamente</div>
    <?php 
    }
  ?>
</div>
<form class="formulario-login" method="post">
  <fieldset>
    <div class="campo">
      <label for="">E-mail</label>
      <input type="email" name="email">
    </div>
    <div class="campo">
      <label for="">Password</label>
      <input type="password" name="password">
    </div>
    <div class="boton-guardar">
      <input type="submit" value="Iniciar Sesión" class="boton-azul">
    </div>
    <div class="login-enlace">
      <a href="/crear-cuenta" class="e-1">¿No tienes cuenta? Crear una</a>
      <a href="/recuperar-password" class="e-2">¿Olvidaste tu password?</a>
    </div>
  </fieldset>
</form>