<!doctype php>
<php lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Catálogo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\assets\css\styles.css">
        <script src="../assets/js/filtros.js"></script>
        <script src="../assets/js/etiquetas.js"></script>
        <?php include '../assets/php/dropdowns.php'; ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>

    <body>

        <div class="container-f">
            <!-- Header -->
            <?php include '../templates/header.php'; ?>

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
                                <form id="searchForm" onsubmit="return buscarProductos()">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="buscarInputModal"
                                            placeholder="Buscar productos..." aria-label="Buscar productos">
                                        <button class="btn btn-dark" type="submit">Buscar</button>
                                    </div>
                                </form>
                                <div id="resultadosBusqueda" class="mt-3"></div>
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
                            <input type="text" class="form-control p-2" id="buscarInputMain"
                                placeholder="Buscar productos..." aria-label="Buscar productos..."
                                aria-describedby="search-addon">
                            <button class="input-group-text" id="search-addon" type="button"
                                onclick="buscarProductos()">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Contenedor de filtros -->
                <div class="container mt-3">
                    <form id="form-filtros" method="GET" action="javascript:void(0);"
                        onsubmit="return filtrarProductos()"> <!-- Añadimos el formulario -->
                        <div class="row justify-content-center">
                            <h1 class="text-center mb-3">Productos</h1>
                            <hr class="mb-4">

                            <!-- Filtro de Subcategoría -->
                            <div class="col-auto mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                        id="dropdownSubcategory" data-bs-toggle="dropdown" aria-expanded="false">
                                        Subcategoría
                                    </button>
                                    <div class="dropdown-menu p-2" aria-labelledby="dropdownSubcategory">
                                        <?php generarDropdown('Subcategoria', 'subcategoria', 'id_subcategoria', 'nombre_subcategoria'); ?>
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
                                        <?php generarDropdown('color', 'color', 'id_color', 'nombre_color'); ?>
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
                                        <?php generarDropdown('material', 'material', 'id_material', 'nombre_material'); ?>
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
                                        <?php generarDropdown('Forma', 'forma', 'id_forma', 'nombre_forma'); ?>
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
                                        <?php generarDropdown('Ambiente', 'ambiente', 'id_ambiente', 'nombre_ambiente'); ?>
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
                                        <?php generarDropdown('N° de asientos', 'n_asientos', 'id_n_asientos', 'cantidad_asientos'); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón para aplicar los filtros -->
                            <div class="col-auto mb-3">
                                <button type="submit" class="btn btn-dark rounded-pill">Aplicar filtros</button>
                            </div>

                        </div>
                    </form> <!-- Fin del formulario -->
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
                // Conectar a la base de datos
                include_once '../config/conexion.php';

                // Configuración de paginación
                $productosPorPagina = 6;
                $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
                $offset = ($paginaActual - 1) * $productosPorPagina;

                // Consulta con LIMIT y OFFSET
                $sql = "SELECT * FROM producto WHERE activo = 1  AND id_subcategoria IN 
                (SELECT id_subcategoria FROM subcategoria JOIN categoria USING (id_categoria) 
                WHERE nombre_categoria = 'Sillon') LIMIT $productosPorPagina OFFSET $offset";
                $result = $conn->query($sql);

                // Consulta para contar el total de productos activos
                $sqlTotal = "SELECT COUNT(*) as total FROM producto WHERE activo = 1";
                $totalProductosResult = $conn->query($sqlTotal);
                $totalProductos = $totalProductosResult->fetch_assoc()['total'];

                // Calcular el total de páginas
                $totalPaginas = ceil($totalProductos / $productosPorPagina);

                // Verificar si hay resultados
                if ($result->num_rows > 0):
                    ?>

                    <!-- Alerta de éxito -->
                    <div id="alertCarritoSuccess" class="alert alert-success alert-dismissible fade show mt-4"
                        style="display: none; position: fixed; top: 20px; right: 20px; z-index: 1050;">
                        Producto agregado al carrito.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <div id="alertDeseosSuccess" class="alert alert-success alert-dismissible fade show mt-4"
                        style="display: none; position: fixed; top: 20px; right: 20px; z-index: 1050;">
                        Producto agregado a la lista de deseos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                    <!-- Alerta de error -->
                    <div id="alertCarritoError" class="alert alert-danger alert-dismissible fade show mt-4"
                        style="display: none; position: fixed; top: 20px; right: 20px; z-index: 1050;">
                       No hay suficiente stock.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <div id="alertDeseosError" class="alert alert-danger alert-dismissible fade show mt-4"
                        style="display: none; position: fixed; top: 20px; right: 20px; z-index: 1050;">
                        El producto ya se encuentra en la lista de deseados.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>

                    <!-- Contenedor catálogo -->
                    <div class="container mt-4">
                        <div id="product-container" class="row justify-content-center">
                            <?php while ($producto = $result->fetch_assoc()): ?>
                                <div class="col-6 col-md-4 mb-4">
                                    <div class="card d-flex flex-column h-100">
                                        <a href="producto.php?id=<?= $producto['id_producto'] ?>" class="text-decoration-none">
                                            <!-- Contenedor de la imagen con altura dinámica -->
                                            <div class="card-img-container d-flex justify-content-center align-items-center">
                                                <img src="<?= $producto['foto_producto'] ?>" class="card-img-top img-fluid h-100" alt="Imagen del producto" style="object-fit: cover; width: 100%; height: auto;" 
                                                    id="product-image-<?= $producto['id_producto'] ?>">
                                            </div>
                                        </a>
                                        <div class="card-body d-flex flex-column">
                                            <!-- Contenedor del título con altura mínima -->
                                            <div class="title-container">
                                                <h5 class="card-title text-truncate"><?= htmlspecialchars($producto['nombre_producto']) ?></h5>
                                            </div>
                                            <h6 class="card-text mb-3">$<?= number_format($producto['precio_unitario'], 0, ',', '.') ?></h6>

                                            <?php $usuarioAutenticado = isset($_SESSION['id_usuario']); ?>
                                            <div class="mt-auto d-flex align-items-center">
                                                <!-- Botón Agregar al carrito -->
                                                <button type="button" class="btn btn-secondary me-2 carrito-btn" 
                                                        <?php if (!$usuarioAutenticado) echo 'disabled'; ?> 
                                                        onclick="agregarAlCarrito(<?= $producto['id_producto'] ?>)">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                                <!-- Botón Agregar a la lista de deseos -->
                                                <button type="button" class="btn btn-secondary lista-deseos-btn" 
                                                        <?php if (!$usuarioAutenticado) echo 'disabled'; ?> 
                                                        onclick="agregarAListaDeDeseos(<?= $producto['id_producto'] ?>)">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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
                        <?php if ($paginaActual > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?= $paginaActual - 1 ?>">Previous</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <a class="page-link">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                            <li class="page-item <?= $i === $paginaActual ? 'active' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($paginaActual < $totalPaginas): ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?= $paginaActual + 1 ?>">Next</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <a class="page-link">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>

            <!-- Footer -->
            <?php include '../templates/footer.php'; ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>

        <script>
            function agregarAlCarrito(productId) {
                fetch('../assets/php/agregaralCarrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id_producto: productId, cantidad: 1 })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('alertCarritoSuccess').style.display = 'block';
                            setTimeout(() => document.getElementById('alertCarritoSuccess').style.display = 'none', 3000);
                        } else {
                            document.getElementById('alertCarritoError').style.display = 'block';
                            setTimeout(() => document.getElementById('alertCarritoError').style.display = 'none', 3000);
                        }
                    })
                    .catch((error) => console.error('Error:', error));
            }
        </script>
        <script>
            function agregarAListaDeDeseos(productId) {
                fetch('../assets/php/agregarAdeseos.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id_producto: productId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('alertDeseosSuccess').style.display = 'block';
                            setTimeout(() => document.getElementById('alertDeseosSuccess').style.display = 'none', 3000);
                        } else {
                            document.getElementById('alertDeseosError').style.display = 'block';
                            setTimeout(() => document.getElementById('alertDeseosError').style.display = 'none', 3000);
                        }
                    })
                    .catch((error) => console.error('Error:', error));
            }

        </script>

    </body>

</php>