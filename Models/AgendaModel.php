<?php
require_once "ConexionModel.php";

class AgendaModel
{
  private $conexion;

  public function __construct()
  {
    $this->conexion = ConexionModel::connect();
  }

  public function obtenerContactos()
  {
    $stmt = $this->conexion->prepare("SELECT * FROM contactos");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function insertarContacto($id, $nombre, $email, $telefono, $direccion)
  {
    $stmt = $this->conexion->prepare("INSERT INTO contactos VALUES (?,?,?,?,?)");
    $stmt->bind_param("issss", $id, $nombre, $email, $telefono, $direccion);
    $stmt->execute();
  }

  public function eliminarContacto($id)
  {
    $stmt = $this->conexion->prepare("DELETE FROM contactos WHERE id_contacto = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
  }

  public function obtenerIdMasAlto()
  {
    $stmt = $this->conexion->prepare("SELECT MAX(id_contacto) FROM contactos");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_NUM);
  }

  public function actualizarContacto($id, $nombre, $email, $telefono, $direccion)
  {
    $stmt = $this->conexion->prepare("UPDATE contactos SET nombre=?, email=?, tlf=?, direccion=? WHERE id_contacto=?");
    $stmt->bind_param("ssssi", $nombre, $email, $telefono, $direccion, $id);
    $stmt->execute();
    return $stmt->affected_rows;
  }

  public function obtenerContactoPorId($id)
  {
    $stmt = $this->conexion->prepare("SELECT * FROM contactos WHERE id_contacto = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

  public function reordenarIds()
  {
    $stmt = $this->conexion->prepare("SELECT id_contacto FROM contactos ORDER BY id_contacto");
    $stmt->execute();
    $ids = $stmt->get_result()->fetch_all(MYSQLI_NUM);

    $newId = 1;
    foreach ($ids as $id) {
      $stmt = $this->conexion->prepare("UPDATE contactos SET id_contacto = ? WHERE id_contacto = ?");
      $stmt->bind_param("ii", $newId, $id[0]);
      $stmt->execute();
      $newId++;
    }
  }

}
?>