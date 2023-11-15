<?php 
  use Model\ActiveRecord;
  require __DIR__."/../vendor/autoload.php";

  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->safeLoad();

  require "funciones.php";
  require "config/database.php";

  // Conectarnos a la base de datos
  $db = conectarDB();
  $db->set_charset("utf8");

  // Crear referencia a la Base de Datos para las clases de ActiveRecord
  
  ActiveRecord::setDB($db);
?>