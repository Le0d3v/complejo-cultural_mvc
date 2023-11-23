<?php 
namespace Model;

class Registro extends ActiveRecord {
  public static $columasDB = ["usuario_id", "evento_id"];
  public static $tabla = "registro";

  public $usuario_id;
  public $evento_id;

  public function __construct($args = []) {
    $this->usuario_id = $args["usuario_id"];
    $this->evento_id = $args["evento_id"];
  }
}
?>
