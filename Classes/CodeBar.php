<?php 
namespace Classes;
use \Com\Tecnick\Barcode\Barcode;

class CodeBar {
  public static function crearCodeBar($codigo) {
    $barcade = new Barcode();
    
    $qr = $barcade->getBarcodeObj(
      "C39",
      "$codigo",
      "-8",
      "100",
      "black",
      array(0, 0, 0, 0,)
    );

    $png = $qr->getPngData();
    return $png;
  }
}
?>