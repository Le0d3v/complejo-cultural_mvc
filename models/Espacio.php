<?php 
namespace Model;

class Espacio extends ActiveRecord {
  public static $columnasDB = ["id", "numero", "ocupado", "id_estacionamiento"];
  public static $tabla = "espacio";
  public $id;
  public $numero;
  public $ocupado;
  public $id_estacionamiento;

  public function __construct($args = []) {
    $this->id = $args["id"] ?? null;
    $this->numero = $args["numero"] ?? null;
    $this->ocupado = $args["ocupado"] ?? null;
    $this->id_estacionamiento = $args["id_estacionamiento"] ?? null;
  }
}
?>