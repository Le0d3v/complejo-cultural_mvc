<?php 
namespace Controller;

use Model\Evento;
use Model\Registro;
use Model\Usuario;
use Classes\Ba;
use Classes\CodeBar;
use Classes\QR;
use Com\Tecnick\Barcode\Barcode;
use MVC\Router;

class UsuarioController {
  public static function index(Router $router) {
    $pag = 1;
    $nombreUsuario = $_SESSION["nombre"]??null;
    $num_eventos = Evento::get(5, "ASC"); 
    $pila = new \SplStack();
    
    $query = "SELECT evento.nombre, evento.fecha, registro.evento_id
    FROM registro
    INNER JOIN evento ON evento.id = registro.evento_id
    INNER JOIN usuario ON usuario.id = registro.usuario_id
    WHERE usuario.id = " . $_SESSION["id"] . " ORDER BY fecha ASC;";

    $registro = Registro::consultarSQL($query);

    foreach($num_eventos as $evento) {
      $pila->push($evento);
    }
    
    // Importar la vista
    $router->render("user-MP", "/usuario/home", [
      "pag" => $pag,
      "nombreUsuario" => $nombreUsuario,
      "pila" => $pila,
      "registro" => $registro
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
    $registro = $_GET["registro"] ?? null;

    $router->render("user-MP", "/usuario/evento", [
      "evento" => $evento,
      "organizador" => $organizador,
      "categoria" => $categoria,
      "lugar" => $lugar,
      "pag" => 2,
      "registro" => $registro
    ]);
  }

  public static function misEv(Router $router) {
    $query = " SELECT 
    registro.id, evento_id, evento.nombre, evento.fecha, evento.hora_inicio, evento.hora_fin, evento.imagen,
    lugar.lugar, evento.descripcion,
    categoria.categoria
    FROM registro
    INNER JOIN usuario ON registro.usuario_id = usuario.id
    INNER JOIN evento ON registro.evento_id = evento.id
    INNER JOIN lugar ON evento.id_lugar = lugar.id
    INNER JOIN categoria ON evento.id_categoria = categoria.id
    where usuario.id = " . $_SESSION["id"] . ";";    

    $registro = Registro::consultarSQL($query);

    $router->render("user-MP", "/usuario/mis-ev", [
      "pag" => 3,
      "num_eventos" => count($registro),
      "registro" => $registro
    ]);
  }
}
?>