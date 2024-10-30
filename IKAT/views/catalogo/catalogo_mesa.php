<!doctype php>
<php lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Catálogo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\..\assets\css\styles.css">
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
                        <a href="..\..\views\catalogo.php" class="btn btn-link d-lg-none p-0">
                            <i class="bi bi-bag fs-4 text-secondary"></i>
                        </a>

                        <!-- Botón de lista de deseos -->
                        <a href="..\..\views\deseados.php" class="btn btn-link p-0 d-lg-none d-flex">
                            <i class="bi bi-heart fs-4 text-secondary"></i>
                        </a>

                        <!-- Botón del carrito -->
                        <a href="..\..\views\carrito.php" class="btn btn-link p-0 d-lg-none d-flex">
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
                                <a href="..\..\views\catalogo.php" class="btn btn-link d-none d-lg-flex p-0">
                                    <i class="bi bi-bag fs-4 text-secondary"></i>
                                </a>

                                <!-- Botón de lista de deseos -->
                                <a href="..\..\views\deseados.php" class="btn btn-link p-0 d-none d-lg-flex">
                                    <i class="bi bi-heart fs-4 text-secondary"></i>
                                </a>

                                <!-- Botón del carrito -->
                                <a href="..\..\views\carrito.php" class="btn btn-link p-0 d-none d-lg-flex">
                                    <i class="bi bi-cart fs-4 text-secondary"></i>
                                </a>

                                <!-- Menú de usuario -->
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg"
                                            alt="User Image" class="user-avatar me-2">
                                        Usuario
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="..\..\views\compras.php">Mis Compras</a></li>
                                        <li><a class="dropdown-item" href="..\..\views\perfil.php">Mi Perfil</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="..\..\views\menu_registro\logout.php">Cerrar
                                                Sesión</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main -->
            <div class="nain">
                <!-- Modal para la barra de búsqueda -->
                <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="searchModalLabel">Buscar productos</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Buscar productos..."
                                            aria-label="Buscar productos">
                                        <button class="btn btn-dark" type="submit">
                                            Buscar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenedor de la barra de búsqueda -->
                <div class="d-none d-lg-flex justify-content-center align-items-center mt-4">
                    <div class="search-container col-lg-7 col-10">
                        <div class="input-group">
                            <button class="input-group-text" id="search-addon" type="button">
                                <i class="bi bi-list"></i>
                            </button>
                            <input type="text" class="form-control p-2" placeholder="Buscar productos..."
                                aria-label="Buscar productos..." aria-describedby="search-addon">
                            <button class="input-group-text" id="search-addon" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Contenedor de filtros -->
                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <h1 class="text-center mb-3">Productos</h1>
                        <hr class="mb-4">

                        <!-- Filtro de Categoría -->
                        <div class="col-auto mb-3">
                            <div class="dropdown">
                                <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                    id="dropdownCategory" data-bs-toggle="dropdown" aria-expanded="false">
                                    Categoría
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dropdownCategory">
                                    <label class="dropdown-item"><input type="checkbox" name="categoría" value="Mesa">
                                        Mesa</label>
                                    <label class="dropdown-item"><input type="checkbox" name="categoría" value="Sillas">
                                        Sillas</label>
                                    <label class="dropdown-item"><input type="checkbox" name="categoría" value="Camas">
                                        Camas</label>
                                    <label class="dropdown-item"><input type="checkbox" name="categoría"
                                            value="Sillones">
                                        Sillones</label>
                                    <label class="dropdown-item"><input type="checkbox" name="categoría"
                                            value="Organización">
                                        Organización</label>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de Subcategoría -->
                        <div class="col-auto mb-3">
                            <div class="dropdown">
                                <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                    id="dropdownSubcategory" data-bs-toggle="dropdown" aria-expanded="false">
                                    Subcategoría
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dropdownSubcategory">
                                    <label class="dropdown-item"><input type="checkbox" name="subcategoría" value="A">
                                        A</label>
                                    <label class="dropdown-item"><input type="checkbox" name="subcategoría" value="B">
                                        B</label>
                                    <label class="dropdown-item"><input type="checkbox" name="subcategoría" value="C">
                                        C</label>
                                    <label class="dropdown-item"><input type="checkbox" name="subcategoría" value="D">
                                        D</label>
                                    <label class="dropdown-item"><input type="checkbox" name="subcategoría" value="E">
                                        E</label>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de Color -->
                        <div class="col-auto mb-3">
                            <div class="dropdown">
                                <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                    id="dropdownColor" data-bs-toggle="dropdown" aria-expanded="false">
                                    Color
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dropdownColor">
                                    <label class="dropdown-item"><input type="checkbox" name="color" value="Rojo">
                                        Rojo</label>
                                    <label class="dropdown-item"><input type="checkbox" name="color" value="Negro">
                                        Negro</label>
                                    <label class="dropdown-item"><input type="checkbox" name="color" value="Blanco">
                                        Blanco</label>
                                    <label class="dropdown-item"><input type="checkbox" name="color" value="Gris">
                                        Gris</label>
                                    <label class="dropdown-item"><input type="checkbox" name="color" value="Café">
                                        Café</label>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de Número de Asientos -->
                        <div class="col-auto mb-3">
                            <div class="dropdown">
                                <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                    id="dropdownSeats" data-bs-toggle="dropdown" aria-expanded="false">
                                    Asientos
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dropdownSeats">
                                    <label class="dropdown-item"><input type="checkbox" name="asientos" value="1">
                                        1</label>
                                    <label class="dropdown-item"><input type="checkbox" name="asientos" value="2">
                                        2</label>
                                    <label class="dropdown-item"><input type="checkbox" name="asientos" value="3">
                                        3</label>
                                    <label class="dropdown-item"><input type="checkbox" name="asientos" value="4">
                                        4</label>
                                    <label class="dropdown-item"><input type="checkbox" name="asientos" value="6">
                                        6</label>
                                    <label class="dropdown-item"><input type="checkbox" name="asientos" value="8">
                                        8</label>
                                    <label class="dropdown-item"><input type="checkbox" name="asientos" value="10">
                                        10</label>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de Material -->
                        <div class="col-auto mb-3">
                            <div class="dropdown">
                                <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                    id="dropdownMaterial" data-bs-toggle="dropdown" aria-expanded="false">
                                    Material
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dropdownMaterial">
                                    <label class="dropdown-item"><input type="checkbox" name="material" value="Madera">
                                        Madera</label>
                                    <label class="dropdown-item"><input type="checkbox" name="material" value="Metal">
                                        Metal</label>
                                    <label class="dropdown-item"><input type="checkbox" name="material"
                                            value="Plástico">
                                        Plástico</label>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de Forma -->
                        <div class="col-auto mb-3">
                            <div class="dropdown">
                                <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                    id="dropdownForma" data-bs-toggle="dropdown" aria-expanded="false">
                                    Forma
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dropdownForma">
                                    <label class="dropdown-item"><input type="checkbox" name="forma" value="Cuadrada">
                                        Cuadrada</label>
                                    <label class="dropdown-item"><input type="checkbox" name="forma"
                                            value="Rectangular">
                                        Rectangular</label>
                                    <label class="dropdown-item"><input type="checkbox" name="forma" value="Circular">
                                        Circular</label>
                                </div>
                            </div>
                        </div>

                        <!-- Filtro de Ambiente -->
                        <div class="col-auto mb-3">
                            <div class="dropdown">
                                <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                    id="dropdownAmbiente" data-bs-toggle="dropdown" aria-expanded="false">
                                    Ambiente
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dropdownAmbiente">
                                    <label class="dropdown-item"><input type="checkbox" name="ambiente" value="Cocina">
                                        Cocina</label>
                                    <label class="dropdown-item"><input type="checkbox" name="ambiente" value="Comedor">
                                        Comedor</label>
                                    <label class="dropdown-item"><input type="checkbox" name="ambiente" value="Pieza">
                                        Pieza</label>
                                    <label class="dropdown-item"><input type="checkbox" name="ambiente" value="Baño">
                                        Baño</label>
                                    <label class="dropdown-item"><input type="checkbox" name="ambiente"
                                            value="Exterior">
                                        Exterior</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>



                <!-- Contenedor de la barra de etiquetas -->
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div id="selectedFilters" class="d-flex flex-wrap align-items-center gap-2"></div>
                        </div>
                    </div>
                </div>

                <?php
                // Incluir la conexión
                include_once '..\..\config\conexion.php';

                // Consulta para obtener los productos activos
                $sql = "SELECT * FROM producto WHERE activo = 1";
                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result->num_rows > 0):
                    ?>

                    <!-- Contenedor catálogo -->
                    <div class="container mt-4">
                        <div class="row justify-content-center">
                            <?php while ($producto = $result->fetch_assoc()): ?>
                                <div class="col-6 col-md-4 mb-4">
                                    <a href="producto.php?id=<?= $producto['id_producto'] ?>" class="text-decoration-none">
                                        <div class="card" style="width: 100%;">
                                            <img src="<?= $producto['foto_producto'] ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= htmlspecialchars($producto['nombre_producto']) ?>
                                                </h5>
                                                <h6 class="card-text">
                                                    $<?= number_format($producto['precio_unitario'], 0, ',', '.') ?></h6>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <button type="button" class="btn btn-outline-secondary">
                                                            <i class="bi bi-cart-plus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-secondary">
                                                            <i class="bi bi-heart"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <?php
                else:
                    echo "<p>No se encontraron productos.</p>";
                endif;

                // Cerrar la conexión
                $conn->close();
                ?>

                <!-- Paginación -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link text-black" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-black" href="#">2</a></li>
                        <li class="page-item">
                            <a class="page-link text-black" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Footer -->
            <footer class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                            <h5>¡Únete a la familia IKAT!</h5>
                            <div class="col-md-9 col-12">
                                Regístrate y disfruta de la experiencia completa de IKAT.
                                <div class="text-center">
                                    <a href="..\..\views\registro.php"
                                        class="btn btn-light border-dark btn-sm mt-3 text-black text-decoration-none">
                                        Registrarme
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                            <h5>Servicio</h5>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-black text-decoration-none">Sigue tu pedido</a></li>
                                <li><a href="#" class="text-black text-decoration-none">IKAT Points</a></li>
                                <li><a href="#" class="text-black text-decoration-none">Despacho a domicilio</a></li>
                                <li><a href="#" class="text-black text-decoration-none">Métodos de pago</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                            <h5>Sobre IKAT</h5>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-black text-decoration-none">Quienes somos</a></li>
                                <li><a href="#" class="text-black text-decoration-none">Misión y Visión</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                            <h5>Redes Sociales</h5>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-facebook"></i>
                                        Facebook</a></li>
                                <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-instagram"></i>
                                        Instagram</a></li>
                                <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-threads"></i>
                                        Threads</a></li>
                                <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-twitter-x"></i>
                                        X</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        <script src="..\assets\js\filtros.js"></script>
    </body>

</php>