<?php 
namespace Model;

class ActiveRecord {
  // Base de Datos
  protected static $db;
  protected static $columasDB = []; //Para identificar la forma de los datos
  protected static $tabla = "";

  // Errores para validacion
  protected static $errores = [];

  /** Asignar conexión a Base de Datos
   * @param $databse
   * @return void
   */
  public static function setDB($database) : void { 
    self::$db = $database;
  }

  /** METODOS DE OBTENCIÓN DE DATOS **/

  /** Lista todos registros existentes en la tabla de la base de datos y las devuelve en forma de un arreglo de objetos
   *  @return array
  */
  public static function all() : array {
    $query = "SELECT * FROM " . static::$tabla;
    $resultado = self::consultarSQL($query);
    return $resultado;
  }

  /** Busca una registro en la base de datos a traves de su id y lo retorna como un objeto
  * @return object
  */
  public static function find(int $id) {
    $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
    $resultado = self::consultarSQL($query);
    return array_shift($resultado); // Remover el id
  }

  /** Busca una registro en la base de datos a traves una condición where y lo retorna como un objeto
  * @return object
  */
  public static function where(string $columna, string $valor) {
    $query = "SELECT * FROM " . static::$tabla . " WHERE $columna = '$valor'";
    
    $resultado = self::consultarSQL($query);
    return array_shift($resultado); // Remover el id
  }

  
  /** Obtener un numero especifico de registros de la base de datos
   *  @param int $cantidad
   */
  public static function get(int $cantidad, $orden = "ASC") {
    $query = "SELECT * FROM " . static::$tabla . " ORDER BY id " . $orden . " LIMIT " . $cantidad;
    $resultado = self::consultarSQL($query);
    return $resultado;
  }

  /** Obtener registros de una tabla relacionada 
   *  @param string $tabla
   *  @param string $columna
   *  @param int $id
   */
  public static function inner(string $tabla, string $columna, $id = 15) {
    $query = "SELECT * FROM " . static::$tabla . " INNER JOIN " . $tabla . " ON " . static::$tabla . "." . $columna . " = " . $tabla . ".id AND " . static::$tabla . ".id = " . $id. " LIMIT 1;";
    
    
    $resultado = self::consultarSQL($query);
    
    return array_shift($resultado);
  }

  /** METODOS DE CREACIÓN,EDICIÓN Y ELIMNACIÓN **/

  /** Función reutilizable para crear un registro nuevo o editar uno existente en la base de datos. Si existe un id de algun registro, se actualizará el registro que contiene este id. Si el id no existe, se crea un nuevo registro.
  * @return void
  */
  public function guardar($view) {
    if(!is_null($this->id)) {
      // Actualizar un registro
      $this->actualizar($view);
    } else {
      // Crear un nuevo Registro
      $this->crear($view);
      }
  }

  /** Inserta un regirstro en la Base de Datos. Primero se sanitizan los datos y despues se crea un registro nuevo en la base de datos con los datos recibidos en el formulario.
   * @param string $view
  * @return void
  */
  public function crear($view) : void { 
    // Sanitizacion de entrada de datos
    $datos = $this->sanitizarDatos(); 

    // Consulta para insertar
    $query = "INSERT INTO " . static::$tabla . " (";
    $query .= join(', ', array_keys($datos)); // Crear string con las keys del arreglo sanitizado
    $query .= " ) VALUES (' ";  
    $query .= join("', '", array_values($datos)); // Crear string con los valores del arreglo sanitizado
    $query .= " '); ";

    // Ejecución del query
    $resultado = self::$db->query($query);

    // Redirección con mensaje de comprobación
    if($resultado) {
      header("Location: $view?resultado=1");
    }
  }

  /** Proceso de actualización de datos de un registro. Primero se sanitizan los datos ingresados en el formulario y despues se realiza la consulta de actualización con estos datos. Una vez realizada la consulta, redirecciona al usuario al inicio con un mensaje de confirmación.
  * @return void
  */
  public function actualizar($view) {
    // Saitizar los datos
    $atributos = $this->sanitizarDatos();
    $valores = [];

    // Asignar los valores sanitizados a un arreglo para la consulta 
    foreach($atributos as $key => $value) {
      $valores[] = "$key='$value'";
    }

    // Consulta para actualizar los datos de la propiedad
    $query = "UPDATE " . static::$tabla . " SET ";
    $query .= join(', ', $valores );
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1;";

    // Ejecución del query
    $resultado = self::$db->query($query);

    // Redireccion al usuario tras registrar propiedad
    if($resultado) {
      header("Location: $view?resultado=2");
    }        
  }

  /** Elimina un registro en la base de datos
  * @return void
  */
  public function eliminar($view) {
    // Consulta para eliminar el registro
    $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id);
    $resultado = self::$db->query($query);

    // Redireccionamiento tras la ejecución de la consulta SQL
    if($resultado) {
      $this->borrarImagen();
      header("Location: $view?resultado=3");
    }
  }

  /** METODOS PARA IMAGENES **/

  /** Metodo para para asignar una imagen a la propiedad. Si se elimina una propiedad este metodo ejecuta un segundo metodo para eliminar la imagen ligada a la propiedad que se elimina. Ocurre lo mismo si se actualiza una propiedad con una imagen nueva. La imagen nueva remplaza a la anterior. Las imagenes son almacenadas en el servidor y la referencia se almacena en la base de datos.
   * @return void
   */
  public function setImage(string $imagen) : void {
    // Elimina la imagen previa
    if(!is_null($this->id)) {
      $this->borrarImagen();
    }

    // Asignar nombre de imagen al atributo de imagen
    if($imagen) {
      $this->imagen = $imagen;
    }
  }

  /** Elimina la imagen del la propiedad almacenada en el servidor
  * @return void
  */
  public function borrarImagen() {
    // Comprobar si existe archivo
    $archivo = file_exists("../public/img/" . $this->imagen);
    if($archivo) {
      unlink("../public/img/". $this->imagen);
    }
  }

    /** METODOS DE VALIDACIÓN **/

    /** Valida que todos los campos del formulario se encuentren llenos y si no lo estan retorna un arreglo con mensajes de errores.
    * @return array
    */
  public function validar() : array { 
    static::$errores = [];
    return static::$errores;
  }
     
  /** Obtener errores de validación y devolverlos dentro de un arreglo.
  * @return array
  */
  public static function getErrores() : array {
    return static::$errores;
  }

  /** METODOS DE SANITIZACIÓN **/

  /** Sanitiza la entrada de datos a traves de un ciclo foreach
  * @return array
  */
  public function sanitizarDatos() : array { 
    // Mapeo de columnas y datos de la BD
    $atributos = $this->atributios();
    $sanitizado = [];

    // Sanitización de cada elemento del arreglo (Propiedades del objeto)
    foreach ($atributos as $key => $value) {
      $sanitizado[$key] = self::$db->escape_string($value); // Proceso de sanitización de atributos
    }
    return $sanitizado;
  }

  /** METODOS DE APOLLO **/

  /** Formateo de los datos de la tabla de la base de datos relacionada al objeto. Los datos son formateados en forma de arreglo asociativo.
  * @return array
  */
  public function atributios() : array { 
    $atributos = array();

    // Formateo de datos
    foreach(static::$columasDB as $columna) {
      if($columna === "id") continue; // Ignorar el Id en el arrglo de atributos
        $atributos[$columna] = $this->$columna;
      }
      return $atributos;
  }         

  /** Crea un arreglo de objetos a partir de los registros de la Base de Datos y lo retorna
  * @return array
  */
  public static function consultarSQL(string $query) : array {
    // Consultar la BD
    $resultado = self::$db->query($query);

    // Iterar resultados (Llena en arreglo con objetos)
    $array = [];
    while($registro = $resultado->fetch_assoc()) {
      $array[] = static::crearObjeto($registro); 
    }

    // Liberar memoria
    $resultado->free();

    // retornar resultados (arreglo de objetos)
    return $array;
  }

  /** Crea un objeto a partir de un arreglo asociativo y lo retorna
   *  @return object
   */
  protected static function crearObjeto($registro) : object {
    // Instancia nueva (Propiedad)
    $objeto = new static;
    // Asignar valores a las propiedades del objeto con base a los valores del arreglo asociativo
    foreach($registro as $key => $value) {
      if(property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }
    // Retorna el objeto con propiedades y valores
    return $objeto;
  }

  /** Sincroniza el objeto en memoria con los cambios realizados por el usuario y reescribe los datos de objeto por datos recibidos a traves de $_POST[]
   * @param array $datosNuevos
   * @return void
   */
  public function sincronizar($args = []) : void {
    foreach($args as $key => $value) { 
      if(property_exists($this, $key) && !is_null($value)) { // Revisar si existe una propiedad que coincida entre el objeto y el arreglo recibido por $_POST[]
        $this->$key = $value;
      }
    }
  }
}
?>