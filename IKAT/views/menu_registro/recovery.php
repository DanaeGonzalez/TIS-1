<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ikat - Recuperación de Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\..\assets\css\styles.css">
    <script src="..\..\assets\js\tooltips.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-f">
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
                    <a href="login.php" class="btn btn-link p-0 d-lg-none d-flex">
                        <i class="bi bi-heart fs-4 text-secondary"></i>
                    </a>

                    <!-- Botón del carrito -->
                    <a href="login.php" class="btn btn-link p-0 d-lg-none d-flex">
                        <i class="bi bi-cart fs-4 text-secondary"></i>
                    </a>

                    <!-- Botón de menú -->
                    <button class="btn btn-link d-lg-none p-0" data-bs-toggle="collapse"
                        data-bs-target="#navbarContent">
                        <i class="bi bi-list fs-4  text-secondary"></i>
                    </button>
                </div>

                <!-- Menú de navegación colapsable -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto align-items-center text-center">

                        <!-- Botones de lista de deseos y carrito al lado del usuario -->
                        <li class="nav-item d-flex align-items-center gap-3">

                            <!-- Botón de catálogo -->
                            <a href="../catalogo.php"
                                class="btn btn-link d-none d-lg-flex p-0 button-style-header catalogo-btn"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Ir al catálogo">
                                <div class="px-1">
                                    <i class="bi bi-bag fs-4 text-white"></i>
                                </div>
                            </a>

                            <!-- Botón de lista de deseos -->
                            <a href="login.php"
                                class="btn btn-link p-0 d-none d-lg-flex button-style-header wishlist-btn"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Lista de deseos">
                                <div class="px-1">
                                    <i class="bi bi-heart fs-4 text-white"></i>
                                </div>
                            </a>

                            <!-- Botón del carrito -->
                            <a href="login.php"
                                class="btn btn-link p-0 d-none d-lg-flex button-style-header cart-btn"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Ver carrito">
                                <div class="px-1">
                                    <i class="bi bi-cart fs-4 text-white"></i>
                                </div>
                            </a>

                            <!-- Menú de usuario -->
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="/xampp/TIS-1/IKAT/assets/images/profile/01.webp" alt="User Image"
                                        class="user-avatar me-2">
                                    Usuario
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="..\menu_registro\registro.php">Registrarse</a>
                                    </li>
                                    <li><a class="dropdown-item" href="..\menu_registro\login.php">Iniciar sesión</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main -->
        <div class="container mt-4">
            <h1 class="text-center">Recupera tu contraseña</h1>
            <hr>
            <div class="row mt-5 d-flex justify-content-center align-content-center">
                <!-- Formulario de inicio de sesión -->
                <div class="col-md-6 border rounded-3 shadow-lg px-5 pt-3 pb-3 bg-light">
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger text-center"><?= $error_message; ?></div>
                    <?php endif; ?>
                    <form action="../../assets/php/recovery.php" method="post">
                        <div class="mb-4">
                            <label for="identificador" class="form-label ms-1 fw-semibold">Correo</label>
                            <input type="email" id="identificador" name="email" class="form-control border-dark"
                                placeholder="nombre@ejemplo.com" required />
                        </div>
                        <button type="submit" name="submit" class="btn btn-dark w-100 py-2">Recuperar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>