<?php 
  include '../menu_registro/auth.php';
  $nombre_usuario = isset($_SESSION['nombre_usuario']) ? $_SESSION['nombre_usuario'] : 'Usuario';
?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IKAT - Mantenedor Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="..\..\assets\css\styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    .nombre-usuario {
      color: #8C5C32;
    }
  </style>

</head>

<body>
  <!-- Header -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/templates/header.php';?>

  <div class="d-flex">
    <!-- Sidebar -->
    <?php include '../../mantenedores/sidebar-mantenedores.php';?>

    <!-- Content Area -->
    <div class="content-area flex-grow-1 d-flex flex-column justify-content-center align-items-center text-center">
      <img src="../../assets/images/cat_blanco.jpg" alt="Logo IKAT" class="mb-4" style="max-width: 200px; height: auto;">
      <h1 class="display-4">
        Bienvenido al panel de administración IKAT
        <br>
        <span class="nombre-usuario"><?php echo htmlspecialchars($nombre_usuario); ?></span>
      </h1>
      <p class="mt-3 text-muted" style="font-size: 0.9rem;">
        Seleccione una de las opciones de la barra lateral para poder empezar.
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>