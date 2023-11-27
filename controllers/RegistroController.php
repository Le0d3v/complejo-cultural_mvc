<?php 
namespace Controller;

use Model\Espacio;
use Model\Evento;
use Model\Usuario;
use Model\Registro;
use MVC\Router;
class RegistroController {
  public static function registro(Router $router) {
    $id = valOred("/home/eventos");
    $user = $_GET["user"];
    $query = "SELECT * FROM espacio WHERE ocupado = 0";
    
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $evento = Evento::find($_GET["id"]);
      $usuario = Usuario::find($_GET["user"]);
      $lugar = $_POST["espacio"] ?? null;

      $query = "INSERT INTO registro (evento_id, usuario_id) VALUES ";
      $query .= "($evento->id, $usuario->id);";
        
      $resultado = Registro::query($query);
        
      if($resultado) {
        header("Location: /home/mis-eventos");
      }
    }

    $router->render("user-MP", "/usuario/registro", [
      "evento" => Evento::find($id),
      "usuario" => Usuario::find($user),
      "espacios" => Espacio::consultarSQL($query)
    ]);
  }

  public static function eliminar() {
    $id = valOred("/home/eventos");
    $registro = Registro::find($id);
    $registro->eliminar("/home/mis-eventos");
  }
}
?>