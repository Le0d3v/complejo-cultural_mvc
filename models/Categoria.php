<?php 
namespace Model;

class Categoria extends ActiveRecord {
  public static $columnasDB = ["id", "categoria"];
  public static $tabla = "categoria";
  public $id;
  public $categoria;
  public function __construct($args = []) {
    $this->id = $args["id"] ?? null;
    $this->categoria = $args["categoria"] ?? null;
  }
}
?>