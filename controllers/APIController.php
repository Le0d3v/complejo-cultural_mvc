<?php 
// Namespace de la clase
namespace Controller;

use Model\Espacio;

class APIController {
  public static function index() {
    // Obtener los datos 
    $espacios = Espacio::all();

    echo json_encode($espacios);
  }
}
?>