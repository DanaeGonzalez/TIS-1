<?php 
  include '../menu_registro/auth.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IKAT - Mantenedores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="..\..\assets\css\styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<body>
  <!-- Header/Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a href="..\..\index.php">
        <img width="180px" height="auto" src="..\..\assets\images\ikat.png" alt="Ikat">
      </a>

      <div class="d-flex align-items-center justify-content-end gap-3 ms-auto">

        <!-- Botón de búsqueda -->
        <button class="btn btn-link d-lg-none p-0" data-bs-toggle="modal" data-bs-target="#searchModal">
          <i class="bi bi-search fs-4  text-secondary"></i>
        </button>

        <!-- Botón de catálogo -->
        <a href="..\catalogo.php" class="btn btn-link d-lg-none p-0">
          <i class="bi bi-bag fs-4 text-secondary"></i>
        </a>

        <!-- Botón de lista de deseos -->
        <a href="..\deseados.php" class="btn btn-link p-0 d-lg-none d-flex">
          <i class="bi bi-heart fs-4 text-secondary"></i>
        </a>

        <!-- Botón del carrito -->
        <a href="..\carrito.php" class="btn btn-link p-0 d-lg-none d-flex">
          <i class="bi bi-cart fs-4 text-secondary"></i>
        </a>

        <!-- Botón de menú -->
        <button class="btn btn-link d-lg-none p-0" data-bs-toggle="collapse" data-bs-target="#navbarContent">
          <i class="bi bi-list fs-4  text-secondary"></i>
        </button>
      </div>

      <!-- Menú de navegación colapsable -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto align-items-center text-center">

          <!-- Botones de lista de deseos y carrito al lado del usuario -->
          <li class="nav-item d-flex align-items-center gap-3">

            <!-- Botón de catálogo -->
            <a href="..\catalogo.php" class="btn btn-link d-none d-lg-flex p-0">
              <i class="bi bi-bag fs-4 text-secondary"></i>
            </a>

            <!-- Botón de lista de deseos -->
            <a href="..\deseados.php" class="btn btn-link p-0 d-none d-lg-flex">
              <i class="bi bi-heart fs-4 text-secondary"></i>
            </a>

            <!-- Botón del carrito -->
            <a href="..\carrito.php" class="btn btn-link p-0 d-none d-lg-flex">
              <i class="bi bi-cart fs-4 text-secondary"></i>
            </a>

            <!-- Menú de usuario -->
            <div class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img
                  src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg"
                  alt="User Image" class="user-avatar me-2">
                  <span> <?php echo $_SESSION['nombre_usuario'];?> </span>

              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="..\compras.php">Mis Compras</a></li>
                <li><a class="dropdown-item" href="..\perfil.php">Mi Perfil</a></li>
                <li><a class="dropdown-item" href="mantenedores.php">Mantenedores</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="../menu_registro/logout.php">Cerrar Sesión</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="collapse d-lg-block">
      <div class="accordion" id="accordionSidebar">
        <!-- Título: Mantenedores -->
        <div class="accordion-item">
          <h4 class="accordion-header" id="headingMantenedores">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mantenedoresLinks"
              aria-expanded="true" aria-controls="mantenedoresLinks">
              Mantenedores
            </button>
          </h4>
          <!-- Enlaces de Mantenedores -->
          <div id="mantenedoresLinks" class="accordion-collapse collapse show" aria-labelledby="headingMantenedores"
            data-bs-parent="#accordionSidebar">
            <div class="accordion-body p-0">
              <a href="../../mantenedores/categoria/mostrar_categoria.php" class="sidebar-link">Categorías</a>
              <a href="../../mantenedores/Mantenedor_subcategorias/mostrar_subcategoria.php"
                class="sidebar-link">Subcategorías</a>
              <a href="../../mantenedores/Mantenedor_metodo_pago/mostrar_metodo_pago.php" class="sidebar-link">Métodos
                de pago</a>
              <a href="../../mantenedores/Mantenedor_producto/mostrar_producto.php" class="sidebar-link">Productos</a>
              <a href="../../mantenedores/Mantenedor_reseña/mostrar_resenia.php" class="sidebar-link">Reseñas</a>
              <a href="../../mantenedores/Mantenedor_top_ventas/mostrar_top_ventas.php" class="sidebar-link">Ventas</a>
              <a href="../../mantenedores/Mantenedor_usuario/mostrar_usuario.php" class="sidebar-link">Usuarios</a>
              <a href="../../mantenedores/Mantenedor_n_asientos/mostrar_n_asientos.php"
                class="sidebar-link">N°Asientos</a>
              <a href="../../mantenedores/Mantenedor_n_cajones/mostrar_n_cajones.php" class="sidebar-link">N°Cajones</a>
              <a href="../../mantenedores/Mantenedor_n_plazas/mostrar_n_plazas.php" class="sidebar-link">N°Plazas</a>
              <a href="../../mantenedores/Mantenedor_colores/mostrar_color.php" class="sidebar-link">Colores</a>
              <a href="../../mantenedores/Mantenedor_firmezas/mostrar_firmeza.php" class="sidebar-link">Firmeza</a>
              <a href="../../mantenedores/Mantenedor_materiales/mostrar_material.php"
                class="sidebar-link">Materiales</a>
              <a href="../../mantenedores/Mantenedor_ambientes/mostrar_ambiente.php" class="sidebar-link">Ambientes</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">
      <h1></h1>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>