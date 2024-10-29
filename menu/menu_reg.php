<?php
    include '../menus_registro/auth.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Sidebar Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    
  </head>
  <body>
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <button class="btn btn-outline border d-lg-none" type="button" data-bs-toggle="collapse" 
                data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <img width="180px" height="auto" src="../ikat.png" alt="">
        <button class="navbar-toggler border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item">
              <a class="nav-link" href="#">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg" 
                     alt="User Image" class="user-avatar me-2"> 
                Usuario
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
                <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../menus_registro/logout.php">Cerrar Sesión</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
  </body>
</html>
