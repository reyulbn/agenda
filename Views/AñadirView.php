<?php

require_once __DIR__ . "/../Controllers/AgendaController.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['botonAñadir'])) {
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $telefono = $_POST['telefono'];
  $direccion = $_POST['direccion'];
  $agendaController = new AgendaController();
  $agendaController->insertarContacto($nombre, $email, $telefono, $direccion);
  header('Location: ../Index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Añadir</title>
  <link rel="stylesheet" href="../Estilos/Estilo.css">
</head>

<body>
  <h2>Nuevo contacto</h2>
  <form method="POST">
    <label>Nombre: <input type="text" name="nombre" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Teléfono: <input type="text" name="telefono" pattern="[0-9]{3,}" title="Solo dígitos, mínimo tres"
        required></label><br>
    <label>Dirección: <input type="text" name="direccion" required></label><br>
    <div class="button-container">
      <a href="../Index.php"><button type="button" class="btn-cancelar">Atrás</button></a>
      <button type="submit" name="botonAñadir">Añadir</button>
    </div>
  </form>
</body>

</html>