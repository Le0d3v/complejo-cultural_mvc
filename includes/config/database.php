<?php 
/** Retorna un objeto de tipo Mysqli con la conexión a la base de datos
 * @return mysqli
 */
function conectarDB() : mysqli {
  // Los credenciales de tu base de datos aqui:
  $db = new mysqli(
    $_ENV["DB_HOST"], 
    $_ENV["DB_USER"], 
    $_ENV["DB_PASS"], 
    $_ENV["DB_NAME"]
  );

  if(!$db) {
    echo "Error. Conexion no permitida";
    exit;
  } else {
    return $db;
  }
}
?>