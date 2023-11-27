<?php 
namespace Model;

class Registro extends ActiveRecord {
  public static $tabla = "registro";
  public static $columnasDB = ["id", "usuario_id", "evento_id", "clave"];

  public $id;
  public $usuario_id;  
  public $evento_id;  
  public $clave;

  // Atributos para tablas relacionadas
  public $nombre;  
  public $fecha;
  public $hora_inicio;
  public $hora_fin;
  public $imagen;
  public $lugar;
  public $categoria;

  public function __construct($args = []) {
    $this->usuario_id = $args["usuario_id"] ?? null;
    $this->evento_id = $args["evento_id"] ?? null;
  }
}
?>