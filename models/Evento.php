<?php 
namespace Model;
class Evento extends ActiveRecord {
  public static $columasDB = [ "id", "nombre", "cupo", "imagen",  "fecha", "hora_inicio", "hora_fin", "descripcion", "disponibles", "id_categoria", "id_lugar", "id_organizador"];
  public static $tabla = "evento";
  public $id;
  public $nombre;
  public $cupo; 
  public $imagen; 
  public $fecha;
  public $hora_inicio;
  public $hora_fin;
  public $descripcion;
  public $disponibles;
  public $id_categoria;
  public $id_lugar;
  public $id_organizador;


  // Atributos para relaciones con otras tablas
  public $categoria;
  public $lugar;

  // Atributos del organizador del evento
  public $nombre_o;
  public $apellido;
  public $telefono;
  public $correo;



  public function __construct($args = []) {
    $this->id = $args["id"] ?? null;
    $this->nombre = $args["nombre"] ?? null;
    $this->cupo = $args["cupo"] ?? null;
    $this->imagen = $args["imagen"] ?? null;
    $this->fecha = $args["fecha"] ?? null;
    $this->hora_inicio = $args["hora_inicio"] ?? null;
    $this->hora_fin = $args["hora_fin"] ?? null;
    $this->descripcion = $args["descripcion"] ?? null;
    $this->disponibles = $args["cupo"] ?? null;
    $this->id_categoria = $args["id_categoria"] ?? null;
    $this->id_lugar = $args["id_lugar"] ?? null;
    $this->id_organizador = $args["id_organizador"] ?? null;
  }

  /** Metodo para validación de formularios 
   * @return array
  */
  public function validar() : array {
    if(!$this->nombre || !$this->cupo || !$this->fecha || !$this->hora_inicio || !$this->hora_fin || !$this->descripcion || !$this->id_categoria || !$this->id_lugar || !$this->id_organizador) {
      self::$errores[] = "Todos los campos son Obligatorios";
    }
    if(!$this->imagen) {
      self::$errores[] = "Debe de agregar una imagen";
    }
    return self::$errores;
  }
}

?>