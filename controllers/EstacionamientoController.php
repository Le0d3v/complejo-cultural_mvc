<?php 
namespace Controller;

use Model\Espacio;
use MVC\Router;

class EstacionamientoController {
  public static function espacio(Router $router) {
    $id = valOred("/estacionamiento/espacio");
    
    $router->render("admin_MP", "/admin/estacionamiento/espacio", [
      "espacio" => Espacio::find($id),
      "pag" => 5
    ]);
  }
}
?>