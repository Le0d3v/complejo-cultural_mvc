<input type="hidden" value="<?php echo $pag;?>" id="pag">
<h1 class="admin-titulo">Ponentes</h1>
<div class="admin-boton">
  <a href="/organizadores/crear" class="boton-azul">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#eee" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
      <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
      <path d="M9 12h6" />
      <path d="M12 9v6" />
    </svg>
    Nuevo Ponente
  </a>
</div>
<?php 
  if($resultado) {
    $mensaje = mostrarMensaje(intval($resultado));
    if($mensaje) { ?>
      <p class="alerta exito"><?php echo s($mensaje); ?></p>
    <?php 
    }
  }
  if($numero === 0) { ?>
    <p class="alerta error">Actualmente no hay eventos registrados</p>
    <?php 
  }
?>
<div class="tabla-sombra">
  <table class="admin-tabla">
    <thead class="ponente-tabla-cabecera">
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>E-mail</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody class="ponente-tabla-cuerpo">
      <?php 
        foreach($organizadores as $organizador) {?>
          <tr>
            <td><?php echo $organizador->id;?></td>
            <td><?php echo $organizador->nombre_o;?></td>
            <td><?php echo $organizador->apellido;?></td>
            <td><?php echo $organizador->telefono;?></td>
            <td><?php echo $organizador->correo;?></td>
            <td class="botones-acciones">
              <div class="btn-accion-pos">
                <a href="/organizadores/actualizar?id=<?php echo $organizador->id;?>" class="boton-actualizar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="40" height="40"  viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                  </svg>
                </a>
              </div>
              <div class="eliminar">
                <button class="mostrar-modal">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 7h16" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    <path d="M10 12l4 4m0 -4l-4 4" />
                  </svg>
                </button>
                <dialog class="modal">
                  <p>¿Estas seguro que deseas eliminar este registro?</p>
                  <b>Una vez eliminado, no habrá marcha atrás</b>
                  <div class="botones-eliminar">
                    <button class="boton-azul cerrar-modal">Cerrar</button>
                    <a href="/organizadores/eliminar?id=<?= $organizador->id?>" class="boton-rojo">Eliinar</a>
                  </div>
                </dialog>
              </div>
            </td>
          </tr> 
          
        <?php 
        }
      ?>
    </tbody>
  </table>
  <br><br><br><br>
</div>
