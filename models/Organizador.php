<?php 
namespace Model;
class Organizador extends ActiveRecord {
  public static $tabla = "organizador";
  public static $columasDB = ["id", "nombre_o", "apellido", "telefono", "correo"];
  public $id;
  public $nombre_o;
  public $apellido;
  public $telefono;
  public $correo;

  public function __construct($args = []) {
    $this->id = $args["id"] ?? null;
    $this->nombre_o = $args["nombre_o"] ?? null;
    $this->apellido = $args["apellido"] ?? null;
    $this->telefono = $args["telefono"] ?? null;
    $this->correo = $args["correo"] ?? null;
  }

  /** Metodo para validación de formularios
   * @return array
   */
  public function validar() : array {
    if(!$this->nombre_o || !$this->apellido || !$this->telefono || !$this->correo || !preg_match("/[0-9]{10}/", $this->telefono)) {
      self::$errores[] = "Todos los campos son Obligatorios";
    }
    return self::$errores;
  }
}
?>