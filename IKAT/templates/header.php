<?php 
  include 'menu_registro/auth.php';
?>

<!-- Header/Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a href="..\index.php">
            <img width="180px" height="auto" src="..\assets\images\ikat.png" alt="Ikat">
        </a>

        <div class="d-flex align-items-center justify-content-end gap-3 ms-auto">

            <!-- Botón de búsqueda -->
            <button class="btn btn-link d-lg-none p-0" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="bi bi-search fs-4  text-secondary"></i>
            </button>

            <!-- Botón de catálogo -->
            <a href="..\views\catalogo.php" class="btn btn-link d-lg-none p-0">
                <i class="bi bi-bag fs-4 text-secondary"></i>
            </a>

            <!-- Botón de lista de deseos -->
            <a href="..\views\deseados.php" class="btn btn-link p-0 d-lg-none d-flex">
                <i class="bi bi-heart fs-4 text-secondary"></i>
            </a>

            <!-- Botón del carrito -->
            <a href="..\views\carrito.php" class="btn btn-link p-0 d-lg-none d-flex">
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
                    <a href="..\views\catalogo.php" class="btn btn-link d-none d-lg-flex p-0">
                        <i class="bi bi-bag fs-4 text-secondary"></i>
                    </a>

                    <!-- Botón de lista de deseos -->
                    <a href="..\views\deseados.php" class="btn btn-link p-0 d-none d-lg-flex">
                        <i class="bi bi-heart fs-4 text-secondary"></i>
                    </a>

                    <!-- Botón del carrito -->
                    <a href="..\views\carrito.php" class="btn btn-link p-0 d-none d-lg-flex">
                        <i class="bi bi-cart fs-4 text-secondary"></i>
                    </a>

                    <!-- Menú de usuario -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg"
                                alt="User Image" class="user-avatar me-2">
                            <span> <?php echo $_SESSION['nombre_usuario'];?> </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="..\views\compras.php">Mis Compras</a></li>
                            <li><a class="dropdown-item" href="..\views\perfil.php">Mi Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="..\views\menu_registro\logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>