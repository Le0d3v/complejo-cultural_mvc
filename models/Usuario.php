<?php 
namespace Model;

class Usuario extends ActiveRecord {
  public static $columasDB = ["id", "nombre", "apellido", "fecha_nac", "telefono", "email", "password", "admin", "confirmado", "token"];
  public static $tabla = "usuario";

  // Propiedades del objeto
  public $id;
  public $nombre;
  public $apellido;
  public $fecha_nac;
  public $telefono;
  public $email;
  public $password;
  public $admin;
  public $confirmado;
  public $token;
  
  public function __construct($args = []) {
    $this->nombre = $args["nombre"] ?? null;
    $this->apellido = $args["apellido"] ?? null;
    $this->fecha_nac = $args["fecha_nac"] ?? null;
    $this->telefono = $args["telefono"] ?? null;
    $this->email = $args["email"] ?? null;
    $this->password = $args["password"] ?? null;
    $this->admin = $args["admin"] ?? 0;
    $this->confirmado = $args["confirmado"] ?? 0;
    $this->token = $args["token"] ?? null;
  }

  /** Metodo de validación para validar el formulario de creación de cuentas
   * @param string $passsword
   * @return array
   */
  public function validarNuevaCuenta(string $contraseña) : array {
    if(!$this->nombre) {
      self::$errores["error"][] = "El nombre es obligatorio";
    }
    if(!$this->apellido) {
      self::$errores["error"][] = "El apellido es obligatorio";
    }
    if(!$this->email) {
      self::$errores["error"][] = "El email es obligatorio";
    }
    if(!$this->fecha_nac) {
      self::$errores["error"][] = "La fecha de nacimiento es obligatoria";
    }
    if(!$this->telefono) {
      self::$errores["error"][] = "El telefono es obligatorio";
    }
    if(!$this->password) {
      self::$errores["error"][] = "El password es obligatorio";
    }
    if(strlen($this->password) < 8) {
      self::$errores["error"][] = "El password debe contener al menos 8 caracteres";
    }
    if($this->password != $contraseña) {
      self::$errores["error"][] = "Las contraseñas no coinciden";
    }
    return self::$errores;
  }

  /** Metodo para validar cuentas registradas previamente 
  */
  public function validarExistencia() {
    $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1;";
    $resultado = self::$db->query($query);
    if($resultado->num_rows) {
      self::$errores["error"][] = "El email que has ingresado ya existe en otra cuenta";
    }
    return $resultado;
  }

  /** Metodo de validación para la sección del login
   * @return array
   */
  public function validarLogin() : array {
    if(!$this->email) {
      self::$errores["error"][] = "El e-mail es obligatorio";
    }
    if(!$this->password) {
      self::$errores["error"][] = "El password es obligatorio";
    }

    return self::$errores;
  }

  /** Metodo de validación para el proceso de reestablecimiento de contraseña
   * @return array
  */
  public function validarPassword() : array {
    if(!$this->password) {
      self::$errores["error"][] = "Coloca tu password para continuar";
    }
    if(strlen($this->password) < 8) {
      self::$errores["error"][] = "El password debe contener mínimo 8 caracteres";
    }

    return self::$errores;
  }

  /** Metodo pde validación para la seccipón de envío de instrucciones
   * @return array
   */
  public function validarEmail() : array {
    if(!$this->email) {
      self::$errores["error"][] = "Coloca tu e-mail para continuar";
    }

    return self::$errores;
  }

  /** Metodo para verificar el password y la confirmación de cuenta de un usuario cuando inicia sesión */
  public function verificacion($password) {
    $resultado = password_verify($password, $this->password);
    if(!$resultado || !$this->confirmado) {
      self::$errores["error"][] = "Password incorrecto o cuenta no confirmada";
    } else {
      return true;
    }
  }

  /** Metodo para hashear los password de los usuarios 
   * @return void
  */
  public function hashearPassword() : void {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  /** Metodo de creacón de token para un usuario
   * @return void
   */
  public function crearToken() : void {
    $this->token = uniqid();
  }
}
?>