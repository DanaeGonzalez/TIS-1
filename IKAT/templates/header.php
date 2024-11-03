<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/xampp/IKAT/views/menu_registro/auth.php';
?>

<!-- Header/Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <?php
            // Verifica si el tipo de usuario está establecido en la sesión
            if (isset($_SESSION['tipo_usuario'])) {         
            // Define la URL del enlace según el tipo de usuario
                if ($_SESSION['tipo_usuario'] === 'Superadmin') { ?>
                <a href="/xampp/IKAT/views/menu_rol/menu_supadm.php">
                    <img width="180px" height="auto" src="/xampp/IKAT/assets/images/ikat.png" alt="Ikat">
                </a> 
                <?php
                } elseif ($_SESSION['tipo_usuario'] === 'Admin') { ?>
                <a href="../views/menu_rol/menu_adm.php">
                    <img width="180px" height="auto" src="/xampp/IKAT/assets/images/ikat.png" alt="Ikat">
                </a> 
                <?php
                } elseif ($_SESSION['tipo_usuario'] === 'Registrado') { ?>
                <a href="../views/menu_rol/menu_reg.php">
                    <img width="180px" height="auto" src="/xampp/IKAT/assets/images/ikat.png" alt="Ikat">
                </a> 
                <?php
                } 
            } else { ?>
                <a href="../index.php">
                    <img width="180px" height="auto" src="/xampp/IKAT/assets/images/ikat.png" alt="Ikat">
                </a> 
            <?php
            }
            ?>


        <div class="d-flex align-items-center justify-content-end gap-3 ms-auto">

            <!-- Botón de búsqueda -->
            <button class="btn btn-link d-lg-none p-0" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="bi bi-search fs-4  text-secondary"></i>
            </button>

            <!-- Botón de catálogo -->
            <a href="../views/catalogo.php" class="btn btn-link d-lg-none p-0">
                <i class="bi bi-bag fs-4 text-secondary"></i>
            </a>

            <!-- Botón de lista de deseos -->
            <a href="../views/deseados.php" class="btn btn-link p-0 d-lg-none d-flex">
                <i class="bi bi-heart fs-4 text-secondary"></i>
            </a>

            <!-- Botón del carrito -->
            <a href="../views/carrito.php" class="btn btn-link p-0 d-lg-none d-flex">
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
                    <a href="/xampp/IKAT/views/catalogo.php" class="btn btn-link d-none d-lg-flex p-0">
                        <i class="bi bi-bag fs-4 text-secondary"></i>
                    </a>

                    <!-- Botón de lista de deseos -->
                    <a href="/xampp/IKAT/views/deseados.php" class="btn btn-link p-0 d-none d-lg-flex">
                        <i class="bi bi-heart fs-4 text-secondary"></i>
                    </a>

                    <!-- Botón del carrito -->
                    <a href="/xampp/IKAT/views/carrito.php" class="btn btn-link p-0 d-none d-lg-flex">
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
                        <?php if (isset($_SESSION['tipo_usuario'])) {
                            if ($_SESSION['tipo_usuario'] === 'Superadmin') { ?>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/compras.php">Mis Compras</a></li>
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/perfil.php">Mi Perfil</a></li>
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/menu_rol/mantenedores_supadm.php">Mantenedores</a></li>
                                    <li>
                                      <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/menu_registro/logout.php">Cerrar Sesión</a></li>
                                  </ul>
                            <?php } elseif ($_SESSION['tipo_usuario'] === 'Admin') { ?>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/compras.php">Mis Compras</a></li>
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/perfil.php">Mi Perfil</a></li>
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/menu_rol/mantenedores_adm.php">Mantenedores</a></li>
                                    <li>
                                      <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/menu_registro/logout.php">Cerrar Sesión</a></li>
                                  </ul>
                            <?php } elseif ($_SESSION['tipo_usuario'] === 'Registrado') { ?>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/compras.php">Mis Compras</a></li>
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/perfil.php">Mi Perfil</a></li>
                                    <li>
                                      <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/xampp/IKAT/views/menu_registro/logout.php">Cerrar Sesión</a></li>
                                  </ul>
                            <?php } ?>
                        <?php } else { ?>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/xampp/IKAT/views/menu_registro/registro.php">Registrarse</a></li>
                                <li><a class="dropdown-item" href="/xampp/IKAT/views/menu_registro/login.php">Iniciar sesión</a></li>
                            </ul>
                        <?php } ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
