<?php 
namespace Model;
class Lugar extends ActiveRecord {
  public static $columasDB = ["id", "lugar"];
  public static $tabla = "lugar";
  public $id;
  public $lugar;

  public function __construct($args = []) {
    $this->id = $args["id"] ?? null;
    $this->lugar = $args["lugar"] ?? null;
  }
}
?>