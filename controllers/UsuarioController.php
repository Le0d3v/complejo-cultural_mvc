<?php 
namespace Controller;

use Model\Evento;
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
    $router->render("user-MP", "/usuario/registro", [
      "pag" => 3
    ]);
  }
}
?>