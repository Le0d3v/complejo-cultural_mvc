<?php 
namespace Controller;

use Model\Evento;
use Model\Evento_usuario;
use Model\Registro;
use MVC\Router;

class UsuarioController {
  public static function index(Router $router) {
    $pag = 1;
    $nombreUsuario = $_SESSION["nombre"]??null;

    $num_eventos = Evento::get(5, "ASC"); 

    $pila = new \SplStack();
    
    foreach($num_eventos as $evento) {
      $pila->push($evento);
    }
    
    // Importar la vista
    $router->render("user-MP", "/usuario/home", [
      "pag" => $pag,
      "nombreUsuario" => $nombreUsuario,
      "pila" => $pila
    ]);
  }

  public static function eventos(Router $router) {
    $pag = 2;
    $router->render("user-MP", "usuario/eventos", [
      "pag" => $pag,
      "eventos" => Evento::all()
    ]);
  }

  public static function evento(Router $router) {
    $id = valOred("/eventos");
    $categoria = Evento::inner("categoria", "id_categoria", $id);  
    $organizador = Evento::inner("organizador", "id_organizador", $id);
    $lugar = Evento::inner("lugar", "id_lugar", $id);
    $evento = Evento::find($id);
    

    $router->render("user-MP", "/usuario/evento", [
      "evento" => $evento,
      "organizador" => $organizador,
      "categoria" => $categoria,
      "lugar" => $lugar,
      "pag" => 2
    ]);
  }

  public static function misEv(Router $router) {
    $query = "SELECT 
    usuario.nombre,
    evento.nombre, evento.fecha, evento.hora_inicio, evento.hora_fin
    FROM evento_usuario
    INNER JOIN usuario ON evento_usuario.usuario_id = usuario.id
    INNER JOIN evento ON evento_usuario.evento_id = evento.id;";

    $eventos= Registro::consultarSQL($query);

    debuguear($eventos);


    $router->render("user-MP", "/usuario/registro", [
      "pag" => 3
    ]);
  }
}
?>