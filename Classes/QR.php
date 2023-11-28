<?php 
namespace Classes;
use Com\Tecnick\Barcode\Barcode;
class QR {
  public $png;
  public static function crearQR($contenido) {
    $barcode = new Barcode();
    $bobj = $barcode->getBarcodeObj(
      'QRCODE,H',                     
      "$contenido",          
      -5,                             // Width 
      -5,                             // Height
      'black',                        // Color del codigo
      array(-2, -2, -2, -2)           // Padding
    )->setBackgroundColor('white'); // Color de fondo
    
    $png = $bobj->getPngData();
    return $png;
  }
}
?>