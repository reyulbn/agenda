<?php

require_once __DIR__ . "/../Controllers/AgendaController.php";

$agendaController = new AgendaController();
$contactos = $agendaController->obtenerContactos();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['botonEliminar'])) {
  $id = $_POST['botonEliminar'];
  $agendaController->eliminarContacto($id);
  header('Location: ../Index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['botonEditar'])) {
  $id = $_POST['botonEditar'];
  header("Location: EditarView.php?id=$id");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['botonAñadir'])) {
  header('Location: AñadirView.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agenda</title>
  <link rel="stylesheet" href="../Estilos/Estilo.css">
</head>

<body>

  <h2>Contactos</h2>
  <form method="POST">
    <?php if (!empty($contactos)) { ?>

      <table border="1">
        <tr>
          <th style="color: #848484">Acciones</th>
          <th>Nombre</th>
          <th>E-Mail</th>
          <th>Teléfono</th>
          <th>Dirección</th>
        </tr>

        <?php foreach ($contactos as $contacto) {
          $id = $contacto['id_contacto'];
          $nombre = $contacto['nombre'];
          $email = $contacto['email'];
          $telefono = $contacto['tlf'];
          $direccion = $contacto['direccion'];
          ?>
          <tr>
            <td>
              <button class="btn-eliminar" type="submit" name="botonEliminar" value="<?php echo $id; ?>">X</button>
              <button type="submit" name="botonEditar" value="<?php echo $id; ?>">Editar</button>
            </td>
            <td data-label="Nombre"><?php echo $nombre; ?></td>
            <td data-label="E-Mail"><?php echo $email; ?></td>
            <td data-label="Teléfono"><?php echo $telefono; ?></td>
            <td data-label="Dirección"><?php echo $direccion; ?></td>
          </tr>
        <?php } ?>

      </table>

    <?php } else {
      echo "<br><h2>No hay contactos.</h2><br>";
    } ?>
    <br>
    <div class="button-container">
      <button type="submit" name="botonAñadir">Nuevo contacto</button>
    </div>

  </form>

</body>

</html>