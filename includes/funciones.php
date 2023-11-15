<?php 
/** CONSTANTES */
define("TEMPLATES_URL", __DIR__."/templates");
define("FUNCIONES_URL", __DIR__."funciones.php");
    
  /** Función para visualizar resultados formateados. La función muestra un resultado y detiene toda la ejecución del programa.
  * @return void
  */
  function debuguear(mixed $var) : void {
    echo "<pre>";
    var_dump($var);
    echo "<pre>";
    exit;
  }

  /** Función que sanitiza el HTML y retorna datos sanitizados
   * @param string $html
   * @return string 
  */
  function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
  }

  /** Valida alguna entrada de id por metodo get y redirecciona en caso de no pasar la validación
   * @param string $url
   * @return int 
   */
  function valOred(string $url) : int {
    // Filtrar el id por dato entero
    $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);

    // Validación del id
    if(!$id) {
      header("Location: $url");
    }
    return $id;
  }

  /** Muestra mensajes de ejecución de acciones dentro del crud
   * @return string
   * @param int $code
  */
  function mostrarMensaje(int $codigo) : string {
    $mensaje = "";
    switch($codigo) {
        case 1:
            $mensaje = "Creado Correctamente";
            break;
        case 2:
            $mensaje = "Actualizado Correctamente";
            break;
        case 3:
            $mensaje = "Eliminado Correctamente";
            break;
        default:
            $mensaje = false;
            break;                
    }
    return $mensaje;
  }
?>