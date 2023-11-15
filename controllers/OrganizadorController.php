<?php 
namespace Controller;

use Model\Organizador;
use MVC\Router;

class OrganizadorController {
  /** Controlador para la creación de ponentes
   * @param Router $router
   */
  public static function crear(Router $router) {
    // Requerimientos
    $organizador = new Organizador;
    $errores = Organizador::getErrores();
    
    // Procedimiento de creación (Metodo: $_POST[])
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $organizador = new Organizador($_POST["organizador"]);

      // Validar el formulario de ponente
      $errores = $organizador->validar();
      if(empty($errores)) {
        // Guardar en la BD
        $organizador->guardar("/admin/organizadores");
      }

    }

    // Importar la vista
    $router->render("admin_MP", "/admin/organizadores/crear", [
      "organizador" => $organizador,
      "errores" => $errores,
    ]);
  }

  /** Controlador para la creación de ponentes
   * @param Router $router
   */
  public static function actualizar(Router $router) {
    // Requerimientos 
    $id = valOred("/admin/organizadores");
    $organizador = Organizador::find($id);
    $errores = Organizador::getErrores();
    
    // Proceimiento de actualización (Metodo: $_POST[])
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $args = $_POST["organizador"];
      $organizador->sincronizar($args);

      // Validación del formulario de ponentes
      $errores = $organizador->validar();
      if(empty($errores)) {
        // Guardar en la BD
        $organizador->guardar("/admin/organizadores");
      }
    }

    // Importar la vista
    $router->render("admin_MP", "/admin/organizadores/actualizar", [
      "organizador" => $organizador,
      "errores" => $errores
    ]);
  }

  /** Controlador para la creación de ponentes
   * @param Router $router
   */
  public static function eliminar() {
    // Procedimiento de eliminación (Metodo: $_POST[])
    $id = valOred("/admin/organizadores");
    if($id) {
      $organizador = Organizador::find($id);
      $organizador->eliminar("/admin/organizadores");
    }
  }
}
?>