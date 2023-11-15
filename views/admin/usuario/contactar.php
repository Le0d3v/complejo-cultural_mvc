<input type="hidden" value="<?php echo $pag;?>" id="pag">
<h1 class="admin-titulo"> Contáctar a <?php echo $usuario->nombre . " " . $usuario->apellido?></h1>
<div class="boton-volver">
  <a href="/admin/usuarios" class="boton-verde">Volver</a>
</div>
<div class="user-contacto">
  <h2>Número de Teléfono:</h2>
  <div class="tel-enlace">
    <a href="https://api.whatsapp.com/send?phone=<?php echo $usuario->telefono;?>"><?php echo ($usuario->telefono)?></a>
  </div>
  <h2>O redacta un E-mail</h2>
  <form method="post" action="">
    <div class="campo">
      <label for="mensaje">Mensaje:</label>
      <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea>
    </div>
    <div class="boton-guardar">
      <input type="submit" class="boton-azul" value="Envia Mensaje">
    </div>
  </form>
</div>