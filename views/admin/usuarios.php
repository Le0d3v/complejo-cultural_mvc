<input type="hidden" value="<?php echo $pag;?>" id="pag">
<h1 class="admin-titulo">Usuarios</h1>
<?php 
  if($resultado) {
    $mensaje = mostrarMensaje(intval($resultado));
    if($mensaje) { ?>
      <p class="alerta exito"><?php echo s($mensaje); ?></p>
    <?php 
    }
  }
  if(count($usuarios) === 0) {?>
    <div class="alerta error">Actualmente no hay Usuarios registrados en la platafoma</div>
    <?php 
  }
?>
<div>
  <table class="admin-tabla">
    <thead class="admin-tabla-cabecera">
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Fecha de Nacimiento</th>
        <th>Telefono</th>
        <th>E-mail</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody class="admin-tabla-cuerpo">
      <?php 
        foreach($usuarios as $usuario) { ?>
          <tr>
            <td><?php echo $usuario->id?></td>
            <td><?php echo $usuario->nombre?></td>
            <td><?php echo $usuario->apellido?></td>
            <td><?php echo $usuario->fecha_nac?></td>
            <td><?php echo $usuario->telefono?></td>
            <td><?php echo $usuario->email?></td>
            <td class="botones-acciones">
              <div class="btn-accion-pos">
                <a href="/usuarios/contactar?id=<?php echo $usuario->id;?>" class="boton-actualizar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                    <path d="M3 7l9 6l9 -6" />
                  </svg>
                </a>
              </div>
              <a href="/usuarios/eliminar?id=<?php echo $usuario->id;?>">
                <div class="eliminar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 7h16" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    <path d="M10 12l4 4m0 -4l-4 4" />
                  </svg>
                </div>
              </a>
            </td>
          </tr>
          <?php 
        }
      ?>
    </tbody>
  </table>
</div>