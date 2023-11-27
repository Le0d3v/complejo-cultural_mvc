<?php 
namespace Controller;

use Model\Usuario;
use MVC\Router;
use Classes\Email;

class LoginController {
  /** Controlador para el inicio de sesión
   * @param Router $router
   */
  public static function login(Router $router) {
    // Requerimientos
    $errores = [];
    $resultado = $_GET["resultado"]??null;

    // Envío de datos en el formulario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      // Crear usuario y validar credenciales
      $auth = new Usuario($_POST);
      $errores = $auth->validarLogin();

      if(empty($errores)) {
        // Obtener el usuario
        $usuario = Usuario::where("email", $auth->email);

        if($usuario) {
          // Verificar el password y la confirmacion del usuario
          if($usuario->verificacion($auth->password)) {
            // Autenticación
            session_start();
            $_SESSION["id"] = $usuario->id;
            $_SESSION["nombre"] = $usuario->nombre;
            $_SESSION["apellido"] = $usuario->apellido;
            $_SESSION["email"] = $usuario->email;
            $_SESSION["telefono"] = $usuario->telefono;
            $_SESSION["login"] = true;

            // Redireccionamientos
            if($usuario->admin === "1") {
              $_SESSION["admin"] = $usuario->admin??null;
              header("Location: /admin");
            } else {
              header("Location: /home");
            }
          } 
        }
      }
      // Errores para mostrar en caso de errores
      $errores = Usuario::getErrores();
    }

    // Importat la vista y pasar los datos
    $router->render("MasterPage", "/auth/login", [
      "errores" => $errores,
      "resultado" => $resultado
    ]);
  }

  /** Controlador para el proceso de registro
   * @param Router $router
   */
  public static function singin(Router $router) {
    // Requerimientos
    $mensaje = $_GET["mensaje"] ?? null;
    $contraseña = $_POST["password"] ?? null;
    $usuario = new Usuario;
    $errores = [];

    // Envío de datos
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      // Sincronizar el usuario con los datos de recibidos
      $usuario->sincronizar($_POST["usuario"]);
      
      // Validación de nueva cuenta
      $errores = $usuario->validarNuevaCuenta($contraseña);
      if(empty($errores)) {

        // Validar si ya existe el usuario
        $resultado = $usuario->validarExistencia();

        if($resultado->num_rows) {
          $errores = Usuario::getErrores();
        } else {
          // Hashear el password del usuario
          $usuario->hashearPassword();

          // Crear Token único para el usuario
          $usuario->crearToken();

          // Enviar e-mail con instrucciones
          $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
          $email->enviarConfirmacion();

          // Guardar en la BD
          $usuario->guardar("/mensaje");
        }
      }
    }

    // Importar la vista
    $router->render("MasterPage", "/auth/crear-cuenta", [
      "usuario" => $usuario,
      "errores" => $errores,
      "mensaje" => $mensaje
    ]);
  }

  /** Controlador para el proceso de reestablecimiento de password
   * @param Router $router
   */
  public static function olvide(Router $router) {
    // Requerimientos
    $errores = [];

    // Envío de datos
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      // Crear un usuario y validar por campos vacíos
      $auth = new Usuario($_POST);
      $errores = $auth->validarEmail();

      if(empty($errores)) {
        // Obtener el usuario
        $usuario = Usuario::where("email", $auth->email);

        // Validar si el usuario existe y se encuentra confirmado
        if($usuario && $usuario->confirmado === "1") {
          // Crear nuevo token para modificar passsword y enviar intrucciones
          $usuario->crearToken();
          $usuario->guardar("/envio-email");

          $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
          $email->enviarInstrucciones();

          $errores["exito"][] = "Instrucciones enviadas a tu de e-mail";

        } else {
          $errores["error"][] = "El usuario no existe o no está confirmado";
        }
      }
    }

    // Importar la vista
    $router->render("MasterPage", "/auth/recuperar-password", [
      "errores" => $errores
    ]);
  }

  /** Controlador para la sección de mensajes de confirmación de cuenta
   * @param Router $router
   */
  public static function mensaje(Router $router) {
    // Requerimientos
    $resultado = s($_GET["resultado"])??null;

    // Importar la vista
    $router->render("MasterPage", "/auth/mensaje", [
      "resultado" => $resultado
    ]);
  }

  /** Controlador para la confirmación de una cuenta
   * @param Router $router
   */
  public static function confirmar(Router $router) {
    // Requerimientos
    $resultado = s($_GET["resultado"]??null);
    $errores = [];
    $token = s($_GET["token"]);
    $usuario = Usuario::where("token", $token);

    // Validar el token del usuario
    if(empty($usuario)) {
      $errores["error"][] = "Token No valido";
    } else {
      // Confirmar al usuario, eliminar su token y guardar cambios en la BD
      $usuario->confirmado = 1;
      $usuario->token = null;
      $usuario->guardar("/mensaje");
    }
    
    // Importar la vista
    $router->render("MasterPage", "/auth/confirmar", [
      "errores" => $errores,
      "resultado" => $resultado
    ]);
  }

  /** Controlador para reestablecer un password
   * @param Router $router
   */
  public static function reestablecer(Router $router) {
    // Requerimientos
    $errores = [];
    $token = $_GET["token"];
    $contraseña = $_POST["password"] ?? null;
    $error = false;

    // Obtener el usuario y validar su token 
    $usuario = Usuario::where("token", $token);
    if(empty($usuario)) {
      $errores["error"][] = "Token no valido";
      $error = true;
    }

    // Proceso de reestablecimiento de password
    if($_SERVER["REQUEST_METHOD"] === "POST") {
      // Crear un usuario nuevo con el password recibido por el usuario
      $password = new Usuario($_POST["usuario"]);

      // Validar por el password ingresado
      $errores = $password->validarPassword();
      if(empty($errores)) {
        // Validar la confirmación de cintraseña en el formulario
        if($password->password != $contraseña) {
          $errores["error"][] = "Los passwords no coinciden";
        } else {
          // Reasignar password, eliminar el token y guardar en la BD
          $usuario->password = null;
          $usuario->password = $password->password;
          $usuario->hashearPassword();
          $usuario->token = null;

          $usuario->guardar("/iniciar-sesion");
        }
      }
    }

    // Importar la Vista
    $router->render("MasterPage", "/auth/reestablecer-password", [
      "errores" => $errores,
      "error" => $error
    ]);
  }

  /** Controlador para la sección de envio de instrucciones (Muestra un template)
   * @param Router $router
   */
  public static function envio(Router $router) {
    // Requerimientos
    $errores["exito"][] = "Instruccones enviadas a tu e-mail";

    // Importar la vista
    $router->render("MasterPage", "/auth/envio-email", [
      "errores" => $errores
    ]);
  }
}
?>