<?php
require_once __DIR__ . "/../Models/AgendaModel.php";

class AgendaController
{
  private $agendaModel;
  private $conexion;

  public function __construct()
  {
    $this->agendaModel = new AgendaModel();
    $this->conexion = ConexionModel::connect();
  }

  public function obtenerContactos()
  {
    return $this->agendaModel->obtenerContactos();
  }

  public function insertarContacto($nombre, $email, $telefono, $direccion)
  {
    $this->conexion->begin_transaction();
    try {
      $id = $this->agendaModel->obtenerIdMasAlto()[0][0] + 1;
      $this->agendaModel->insertarContacto($id, $nombre, $email, $telefono, $direccion);
      $this->conexion->commit();
      return "Contacto añadido con éxito.";
    } catch (Exception $ex) {
      $this->conexion->rollback();
      return "Error al añadir contacto: " . $ex->getMessage();
    }
  }

  public function eliminarContacto($id)
  {
    $this->conexion->begin_transaction();
    try {
      $this->agendaModel->eliminarContacto($id);
      $this->agendaModel->reordenarIds();
      $this->conexion->commit();
      return "Contacto eliminado con éxito.";
    } catch (Exception $ex) {
      $this->conexion->rollback();
      return "Error al eliminar contacto: " . $ex->getMessage();
    }
  }

  public function obtenerContactoPorId($id)
  {
    return $this->agendaModel->obtenerContactoPorId($id);
  }

  public function actualizarContacto($id, $nombre, $email, $telefono, $direccion)
  {
    $this->conexion->begin_transaction();
    try {

      $numeroFilasAfectadas = $this->agendaModel->actualizarContacto($id, $nombre, $email, $telefono, $direccion);

      if ($numeroFilasAfectadas != 1) {

        echo "Error. Más de 1 fila iba a ser afectada.";
        throw new Exception("Error. Más de 1 fila iba a ser afectada.");

      }

      $this->conexion->commit();
      return "Contacto actualizado con éxito.";
    } catch (Exception $ex) {
      $this->conexion->rollback();
      return "Error al actualizar contacto: " . $ex->getMessage();
    }
  }
}
?>