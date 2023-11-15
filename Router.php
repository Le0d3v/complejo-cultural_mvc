<?php 
namespace MVC;
class Router {
  // Rutas con metodos $_POST[] y $_GET[] 
  public $rutasGET = [];
  public $rutasPOST = array();

  /** Método para definir funciones que se realicen en las URL's que lleven metodo $_GET.
  * @param string $url
  * @param array $funcion
  */
  public function get(string $url, array $fn) {
    $this->rutasGET[$url] = $fn;
  }

  /** Método para definir funciones que se realicen en las URL's que lleven metodo $_POST.
  * @param string $url
  * @param array $fn
  */
  public function post(string $url, array $fn) {
    $this->rutasPOST[$url] = $fn;
  }

  /** Comrpueba si una URL existe dentro de la aplicación. Si la URL existe ejecuta la función asociada a esa ruta. Si la ruta no existe, manda un mensaje de error 404
   * @return void
   */
  public function comprobarRutas() : void {
    session_start();
    $auth = $_SESSION["login"] ?? null;

    // Arreglo de rutas protegidas
    $rutas_protegidas = [
      // Tus rutas privadas aqui:

      // Admin
      "/admin",
      "/admin/eventos",
      "/admin/organizadores",
      "/admin/usuarios",
      "/admin/estacionamiento",
      "/admin/config",
    
      // Eventos
      "/eventos/crear",
      "/eventos/actualizar",
      "/eventos/eliminar",

      // Prganizadores
      "/organizadores/crear",
      "/organizadores/actualizar",
      "/organizadores/eliminar"
      
    ];

    $urlActual = strtok($_SERVER["REQUEST_URI"], "?") ?? "/";
    $metodo = $_SERVER["REQUEST_METHOD"];


    // Acceder a la función de la url visitada en ese momento
    if($metodo === "GET") {
      $fn = $this->rutasGET[$urlActual] ?? null;
    } else {
      $fn = $this->rutasPOST[$urlActual] ?? null;
    }

    // Proteger las rutas
    if(in_array($urlActual, $rutas_protegidas) && !$auth ) {
      header("Location: /");
    }
    
    // Comprobar si la URL existe y hay una función asociada
    if($fn) {
      // Llamar una función cuando no conocemos su nombre
      call_user_func($fn, $this);
    } else {
      header("Location: /error");
      
    }
  }

  /** Llamar a una vista para mostrarla a través de un controlador. Esta función ya lleva incluida un Layout Principal. Primero, almacena la vista que colocamos en la memoria, despues la asigna a una variable llamada $contenido y limpia la memoria, y finalemte incluye la pagina principal. (En la pagina principal ya va incluida la impresion de la vista almacenada en la variable $contenido). Así mismo, la funcipón nos crea una variable con contenido visual que podemos mostrar en la vista
   * @param string $view
   * @param array $datos
   * @return void
   */
  public function render(string $masterPage, string $view, $datos = []) : void {
    // Generar vatriables con los nombres de los keys de los arreglos que pasamos a las vistas.
    foreach($datos as $key => $value) {
      $$key = $value; // Variable de variable ($$key)
    }

    // Alamacenar la url en memoria
    ob_start();

    // Incluir la vista que colocamos como argumento
    include __DIR__ . "/views/$view.php";

    // Limpiar la memoria
    $contenido = ob_get_clean();

    // Incluir la pagina meastra
    include __DIR__ . "/views/$masterPage.php";
  }
}
?>