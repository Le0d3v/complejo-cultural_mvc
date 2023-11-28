<?php 
namespace Controller;

use Classes\CodeBar;
use Classes\QR;
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
      $registro = Registro::query($query);
      $lugar = $_POST["espacio"] ?? null;

      // Crear QR
      $nombreQR = md5(uniqid(rand(), true)) . ".png";
      $nombreCB = md5(uniqid(rand(), true)) . ".png";

      $clave = md5(uniqid(rand(), true));
      
      $pngQR = QR::crearQR($evento->nombre);
      $pngCB = CodeBar::crearCodeBar($clave);

      file_put_contents("$nombreQR", $pngQR);
      file_put_contents("$nombreCB", $pngCB);
        
      $query = "SELECT clave FROM registro INNER JOIN evento ON evento.id = " . $evento->id;
      $query .= " INNER JOIN usuario ON usuario.id = " . $usuario->id . " ;";

      $resultado = Registro::query($query);

      if($resultado) {
        header("Location: /home/mis-eventos?resultado=1");
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

  public static function boleto(Router $router) {
    $evento = Evento::find($_GET["evento"]);
    $user = Usuario::find($_GET["user"]);
    $query = "SELECT * FROM registro WHERE usuario_id = " . $_GET["user"] . " AND evento_id = " . $_GET["evento"];

    $registro = Registro::consultarSQL($query);

    

    $router->render("user-MP", "/usuario/boleto", [
      "evento" => $evento,
      "user" => $user,
      "registro" => $registro, 
      "pag" => 1
    ]);
  }
}
?>