<?php 
namespace Controller;
use MVC\Router;
use Model\Organizador;
use Model\Evento;
use Model\Categoria;
use Model\Espacio;
use Model\Lugar;
use Model\Usuario;

class AdminController {

  /** Controlador de la sección principoal 
   * @param Router $router
  */
  public static function index(Router $router) : void {
    $pag = 1;
    $num_eventos = Evento::get(3, "DESC");
    $num_usuarios = Usuario::get(3, "DESC");
    $usuarios = Usuario::all();
    $nombre_admin = $_SESSION["nombre"]??null;
    $organizadores = Organizador::all();
    $eventos = Evento::all();
    $router->render("admin_MP", "admin/index", [
      "organizadores" => $organizadores,
      "eventos" => $eventos,
      "nombre_admin" => $nombre_admin,
      "pag" => $pag,
      "usuarios" => $usuarios,
      "num_eventos" => $num_eventos,
      "num_usuarios" => $num_usuarios
    ]);
  }

  /** Controlador de la sección de eventos 
   * @param Router $router
  */
  public static function eventos(Router $router) {
    $pagina = 2;
    $nombre_admin = $_SESSION["nombre"]??null;
    $eventos = Evento::all();
    $organizador = Evento::inner("organizador", "id_organizador");
    $lugar = Evento::inner("lugar", "id_lugar");
    $categoria = Evento::inner("categoria", "id_categoria");
    $resultado = $_GET["resultado"] ?? null;
    $numero = count($eventos);

    $router->render("admin_MP", "/admin/eventos/eventos", [
      "eventos" => $eventos,
      "resultado" => $resultado,
      "numero" => $numero,
      "organizador" => $organizador,
      "lugar" => $lugar,
      "categoria" => $categoria,
      "nombre_admin" => $nombre_admin,
      "pagina" => $pagina
    ]);
  }

  /** Controlador para la sección de usuarios
   * @param Router $router
   */
  public static function usuarios(Router $router) {
    $pag = 4;
    $nombre_admin = $_SESSION["nombre"]??null;
    $usuarios = Usuario::all();

    // Importar la vista
    $router->render("admin_MP", "admin/usuarios", [
      "nombre_admin" => $nombre_admin,
      "pag" => $pag,
      "usuarios" => $usuarios,
      "resultado" => $_GET["resultado"] ?? null
    ]);
  }

  /** Controlador de la sección de ponentes 
   * @param Router $router
  */
  public static function organizadores(Router $router) {
    $pag = 3;
    $nombre_admin = $_SESSION["nombre"]??null;
    $organizadores = Organizador::all();
    $resultado = $_GET["resultado"] ?? null;
    $numero = count($organizadores);
    $router->render("admin_MP", "admin/organizadores/organizadores", [
      "organizadores" => $organizadores,
      "resultado" => $resultado,
      "numero" => $numero,
      "nombre_admin" => $nombre_admin,
      "pag" => $pag
    ]);
  }

  /** Controlador de la sección de estacionamiento 
   * @param Router $router
  */
  public static function estacionamiento(Router $router) {
    $pag = 5;
    $nombre_admin = $_SESSION["nombre"]??null;
        
    $router->render("admin_MP", "admin/estacionamiento/estacionamiento", [
      "nombre_admin" => $nombre_admin,
      "pag" => $pag,
    ]);
  }

  /** Controlador de la sección de configuración 
   * @param Router $router
  */
  public static function config(Router $router) {
    $pag = 6;
    $nombre_admin = $_SESSION["nombre"]??null;
    $router->render("admin_MP", "admin/config", [
      "nombre_admin" => $nombre_admin,
      "pag" => $pag
    ]);
  }

  /** Controlador para el cierre de sesión */
  public static function logout() {
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      $_SESSION = [];
      header("Location: /");
    }
  }

  public static function contactar(Router $router) {
    $id = valOred("/admin/usuarios");
    $router->render("admin_MP", "/admin/usuario/contactar", [
      "usuario" => Usuario::find($id),
      "pag" => 4
    ]);
  }

  public static function eliminarUsuario() {
    $id = valOred("/admin/usuarios");
    if($id) {
      $usuario = Usuario::find($id);
      $usuario->eliminar("/admin/usuarios");
    }
  }
}
?>  