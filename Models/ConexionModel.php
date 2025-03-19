<?php
class ConexionModel
{
  private static $conexion = null;

  public static function connect()
  {
    if (self::$conexion === null) {
      try {
        self::$conexion = new mysqli("localhost", "root", "", "agenda");
      } catch (Exception $ex) {
        die("Error de conexion: " . $ex->getMessage());
      }
    }
    return self::$conexion;
  }
}
?>