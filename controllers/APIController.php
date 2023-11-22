<?php 
// Namespace de la clase
namespace Controller;

use Model\Espacio;
use Model\Evento;
use Model\Usuario;

class APIController {
  public static function index() {
    // Obtener los datos 
    $espacios = Espacio::all();
    echo json_encode($espacios);
  }

  public static function eventos() {
    $eventos = Evento::all();
    echo json_encode($eventos);
  }

  public static function login() {
    $email = $_GET["email"];
    $pass = $_GET["pass"];
    
    $usuario = Usuario::where("email", $email);
    if($usuario) {
      $resultado = password_verify($pass, $usuario->password);
      if($resultado) {
        echo json_encode($usuario);
      } else {
        echo "puto";
      }
    } else {
      echo "NO";
    }

  }
}
?>