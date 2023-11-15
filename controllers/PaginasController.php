<?php 
namespace Controller;
use MVC\Router;
use Model\Evento;
use Model\Organizador;
use Model\Categoria;
use Model\Lugar;


class PaginasController {

  /** Controlador de la sección principal 
   * @param Router $router
  */
  public static function index(Router $router) {
    $eventos = Evento::get(3, "DESC");
    $router->render("MasterPage", "/paginas/index", [
    "eventos" => $eventos
    ]);
  }

  /** Controlador de la sección de nosotros 
   * @param Router $router
  */
  public static function nosotros(Router $router) {
    $pag = 1;
    $router->render("MasterPage", "/paginas/nosotros", [
      "pag" => $pag
    ]);
  }

  /** Controlador de la sección de servicios 
   * @param Router $router
  */
  public static function servicios(Router $router) {
    $pag = 2;
    $router->render("MasterPage", "/paginas/servicios", []);
  }

  /** Controlador de la sección eventos 
   * @param Router $router
  */
  public static function eventos(Router $router) {
    $pag = 3;
    $eventos = Evento::all();
    $router->render("MasterPage", "/paginas/eventos", [
      "eventos" => $eventos,
      "pag" => $pag
    ]);
  }

  /** Controlador de la sección un evento 
   * @param Router $router
  */
  public static function evento(Router $router) {
    $id = valOred("/eventos");
    $categoria = Evento::inner("categoria", "id_categoria", $id);  
    $organizador = Evento::inner("organizador", "id_organizador", $id);
    $lugar = Evento::inner("lugar", "id_lugar", $id);
    $evento = Evento::find($id);
    

    $router->render("MasterPage", "/paginas/evento", [
      "evento" => $evento,
      "organizador" => $organizador,
      "categoria" => $categoria,
      "lugar" => $lugar
    ]);
  }

  /** Controlador de la sección de ubicación 
   * @param Router $router
  */
  public static function ubicacion(Router $router) {
    $pag = 4;
    $router->render("MasterPage", "/paginas/ubicacion", [
      "pag" => $pag
    ]);
  }

  /** Controlador de la sección de contacto 
   * @param Router $router
  */
  public static function contacto(Router $router) {
    $pag = 5;
    $categorias = Categoria::all();
    $lugares = Lugar::all();
    $router->render("MasterPage", "/paginas/contacto", [
      "lugares" => $lugares,
      "categorias" => $categorias,
      "pag" => $pag
    ]);
  }

  /** Controlador de la sección de redireccionamiento 
   * @param Router $router
  */
  public static function error(Router $router) {
    $router->render("MasterPage", "/paginas/eggog", []);
  }
}
?>