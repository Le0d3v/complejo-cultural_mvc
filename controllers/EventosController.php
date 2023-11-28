<?php 
namespace Controller;

use Model\Categoria;
use Model\Evento;
use Model\Lugar;
use Model\Organizador;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class EventosController {
  public static function evento(Router $router) {
    $id = valOred("/eventos");
    $categoria = Evento::inner("categoria", "id_categoria", $id);  
    $organizador = Evento::inner("organizador", "id_organizador", $id);
    $lugar = Evento::inner("lugar", "id_lugar", $id);
    $evento = Evento::find($id);

    $router->render("admin_MP", "/admin/eventos/evento", [
      "evento" => $evento,
      "organizador" => $organizador,
      "categoria" => $categoria,
      "lugar" => $lugar,
      "pag" => 2
    ]);
  }

  /** Controlador para la creación de eventos
   * @param Router $router
   */
  public static function crear(Router $router) {
    // Requerimientos
    $categorias = Categoria::all();
    $organizadores = Organizador::all();
    $evento = new Evento();
    $lugares = Lugar::all();
    $errores = Evento::getErrores();
    $pag = 2;

    // Procedimiento de creación (Metodo: $_POST[])
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $evento = new Evento($_POST["evento"]);

      /** SUBIDA DE ARCHIVOS */
      // Crear nombre único para imagenes dentro del servidor
      $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

      /** Setear la imagen */
      // Realizar un rezise a la imagen con Intervention\Image
      if($_FILES["evento"]["tmp_name"]["imagen"]) {
        $image = Image::make($_FILES["evento"]["tmp_name"]["imagen"])->fit(800, 600);
        $evento->setImage($nombreImagen);
      }

      // Validación del formulario de eventos
      $errores = $evento->validar();

      if(empty($errores)) {
        // Crear carpeta para almacenar las imagenes en el servidor
        if(!is_dir("../public/img")) {
          mkdir("../public/img");
        }
        // Guardar la imagen en el servidor
        $image->save("../public/img/" . $nombreImagen);

        // Guardar en la BD
        $evento->guardar("/admin/eventos");
      }
    }

    // Importar una vista
    $router->render("admin_MP", "/admin/eventos/crear", [
      "evento" => $evento,
      "organizadores" => $organizadores,
      "lugares" => $lugares,
      "errores" => $errores,
      "categorias" => $categorias,
      "pag" => $pag
    ]);
  }

  /** Controlador para la modificación de eventos
   * @param Router $router
   */
  public static function actualizar(Router $router) {
    // Requerimientos
    $pag = 2;
    $id = valOred("/admin/eventos");
    $evento = Evento::find($id);
    $errores = Evento::getErrores();

    $organizadores = Organizador::all();
    $categorias = Categoria::all();
    $lugares = Lugar::all();

    // Procedimiento de modificación (Metodo: $_POST[])
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      
      $args = $_POST["evento"];
      $evento->sincronizar($args);
      // Validar el formulario de eventos

      $errores = $evento->validar();
      
      /** SUBIDA DE ARCHIVOS */
      // Crear nombre unico para imagenes dentro del servidor
      $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
      
      if($_FILES["evento"]["tmp_name"]["imagen"]) {
        $image = Image::make($_FILES["evento"]["tmp_name"]["imagen"])->fit(800, 600);
        $evento->setImage($nombreImagen);
      }
      

      
      if(empty($errores)) {
        // Almacenar la imagen
        if($_FILES["evento"]["tmp_name"]["imagen"]) {
          $image->save("../public/img/" . $nombreImagen);
        }

        // Actualizar en la BD
        $evento->guardar("/admin/eventos");
        
      }
    
    }
  
    // Importar la vista
    $router->render("admin_MP", "/admin/eventos/actualizar", [
      "evento" => $evento,
      "errores" => $errores,
      "organizadores" => $organizadores,
      "lugares" => $lugares,
      "categorias" => $categorias,
      "pag" => $pag
    ]);
  }
  
  /** Controlador para eliminación de eventos */
  public static function eliminar() {
    $id = valOred("admin/eventos");
    if($id) {
      $evento = Evento::find($id);
      $evento->eliminar("/admin/eventos");
    }
  }
}
?>