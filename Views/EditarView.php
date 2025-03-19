<?php

require_once __DIR__ . "/../Controllers/AgendaController.php";

$agendaController = new AgendaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['botonGuardar'])) {
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $direccion = $_POST['direccion'];
  $agendaController->actualizarContacto($id, $nombre, $email, $telefono, $direccion);
  header('Location: ../Index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $contacto = $agendaController->obtenerContactoPorId($id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar</title>
  <link rel="stylesheet" href="../Estilos/Estilo.css">
</head>

<body>
  <h2>Editar contacto</h2>
  <form method="POST">
    <input type="hidden" name="id" value="<?php echo $contacto['id_contacto']; ?>">
    <label>Nombre: <input type="text" name="nombre" value="<?php echo $contacto['nombre']; ?>" required></label><br>
    <label>Email: <input type="email" name="email" value="<?php echo $contacto['email']; ?>" required></label><br>
    <label>Teléfono: <input type="text" name="telefono" value="<?php echo $contacto['tlf']; ?>" pattern="[0-9]{3,}"
        title="Solo dígitos, mínimo tres" required></label><br>
    <label>Dirección: <input type="text" name="direccion" value="<?php echo $contacto['direccion']; ?>"
        required></label><br>
    <div class="button-container">
      <a href="../Index.php"><button type="button" class="btn-cancelar">Atrás</button></a>
      <button type="submit" name="botonGuardar">Guardar</button>
    </div>
  </form>
</body>

</html>