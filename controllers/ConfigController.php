<?php 
namespace Controller;

use Model\Usuario;

class ConfigController {
  public static function actualizar() {
    $usuario = Usuario::find($_SESSION["id"]);
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $args = $_POST["usuario"];
      $usuario->sincronizar($args);
      
      $usuario->guardar("/admin/config");
    }
  }
}
?>