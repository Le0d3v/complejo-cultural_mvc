<?php 
// Namespace de la clase
namespace Controller;

use Model\Espacio;
use Model\Evento;
use Model\Usuario;
use Model\Organizador;

class APIController {
  public static function index() {
    $espacios = Espacio::all();
    echo json_encode($espacios);
  }

  public static function eventos() {
    $eventos = Evento::all();
    $data["eventos"] = $eventos;
    echo json_encode($data);
  }

  public static function login() {
    $data = [];
    $email = $_GET["email"];
    $pass = $_GET["pass"];
    
    $usuario = Usuario::where("email", $email);
    if($usuario) {
      $resultado = password_verify($pass, $usuario->password);
      if($resultado) {
        $data["usuario"] = $usuario;
        echo json_encode($data);
      } else {
        echo "puto";
      }
    } else {
      echo "NO";
    }
  }
  public static function organizadores() {
    $organizadores = Organizador::get(5, "DESC");
    echo json_encode($organizadores);
  }
}
?>