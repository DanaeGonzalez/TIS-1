<!doctype php>
<php lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Catálogo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\assets\css\styles.css">
        <link rel="stylesheet" href="..\assets\css\barra_busqueda.css">
        <link rel="stylesheet" href="..\assets\css\rating.css">
        <script src="../assets/js/filtros.js"></script>
        <script src="../assets/js/carritoDeseos.js"></script>
        <script src="../assets/js/etiquetas.js"></script>
        <script src="../assets/js/stars.js"></script>
        <?php
        include '../assets/php/dropdowns.php';
        include '../assets/php/generar_carta_producto.php';
        ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">

    </head>

    <body>
        <?php
        // Conectar a la base de datos
        include_once '../config/conexion.php';
        include_once '../assets/php/calcular_top_ventas.php'; // Incluir la función para obtener el top de ventas

        // Obtener el top de ventas
        $topVentas = obtenerTopVentas($conn);
        ?>
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
                                            placeholder="Escribe lo que estés buscando: mesa, cama, silla..." aria-label="Buscar productos">
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
                    <div class="search-container col-lg-7 col-10 position-relative">
                        <div class="input-group">
                            <!-- Campo de búsqueda -->
                            <input type="text" class="form-control p-2" id="buscarInputMain"
                                placeholder="Escribe lo que estés buscando: mesa, cama, silla..." aria-label="Escribe lo que estés buscando: mesa, cama, silla..."
                                aria-describedby="search-addon"
                                onfocus="barraBusqueda()" oninput="barraBusqueda()">

                            <!-- Botón buscar -->
                            <button class="input-group-text" id="buscarButton" type="button"
                                onclick="buscarProductos()">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>

                        <!-- Lista de resultados -->
                        <ul class="list-group position-absolute w-100 d-none" id="lista"></ul>
                    </div>
                </div>

                <!-- Contenedor de filtros -->
                <div class="container mt-5">
                    <h1 class="text-center m-0">Productos</h1>
                    <hr class="mb-4 mt-0">
                    <form id="form-filtros" method="GET" action="javascript:void(0);" onsubmit="return filtrarProductos()"> <!-- Añadimos el formulario -->
                        <div class="row justify-content-center">
                            <!-- Filtro de Categoría -->
                            <div class="dropdown d-flex justify-content-center">
                                <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                    id="dropdownCategory" data-bs-toggle="dropdown" aria-expanded="false">
                                    Comienza eligiendo una categoría
                                </button>
                                <div class="dropdown-menu p-2" aria-labelledby="dropdownCategory">
                                    <?php
                                    $sql = "SELECT id_categoria, nombre_categoria FROM categoria";
                                    $result = $conn->query($sql);

                                    if ($result && $result->num_rows > 0) {
                                        while ($fila = $result->fetch_assoc()) {
                                            echo "<button class='dropdown-item' onclick='seleccionarCategoria(" . $fila['id_categoria'] . ")'>" . $fila['nombre_categoria'] . "</button>";
                                        }
                                    }
                                    ?>
                                </div>
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
                $sql = "SELECT * FROM producto WHERE activo = 1 LIMIT $productosPorPagina OFFSET $offset";
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
                                <?php
                                $id_producto = $producto['id_producto'];
                                $esTopVenta = in_array($id_producto, $topVentas); // Verificar si es top venta

                                // Verificar si el producto tiene una oferta
                                $sqlOferta = "SELECT porcentaje_descuento FROM oferta WHERE id_producto = $id_producto";
                                $resultadoOferta = $conn->query($sqlOferta);
                                $tieneOferta = $resultadoOferta->num_rows > 0;
                                $precioOriginal = $producto['precio_unitario'];
                                $precioConDescuento = $precioOriginal;

                                if ($tieneOferta) {
                                    $oferta = $resultadoOferta->fetch_assoc();
                                    $porcentajeDescuento = $oferta['porcentaje_descuento'];
                                    $precioConDescuento = $precioOriginal - ($precioOriginal * $porcentajeDescuento / 100);
                                }

                                // Usar la función para generar la carta
                                echo generarCartaProducto($id_producto, $producto, $esTopVenta, $tieneOferta, $precioOriginal, $precioConDescuento);
                                ?>
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
                                <a class="page-link" href="?pagina=<?= $paginaActual - 1 ?>">Anterior</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <a class="page-link">Anterior</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                            <li class="page-item <?= $i === $paginaActual ? 'active' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($paginaActual < $totalPaginas): ?>
                            <li class="page-item">
                                <a class="page-link" href="?pagina=<?= $paginaActual + 1 ?>">Siguiente</a>
                            </li>
                        <?php else: ?>
                            <li class="page-item disabled">
                                <a class="page-link">Siguiente</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>

            </div>

            <!-- Footer -->
            <?php include '../templates/footer.php'; ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>


    </body>

</php>