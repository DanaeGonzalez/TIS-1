<!doctype php>
<php lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Nombre del Producto</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\assets\css\styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>

        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>


            <!-- Main -->
            <div class="main">
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

                <!-- Sección del producto -->
                <?php
                include_once '..\config\conexion.php';
                if (isset($_GET['id'])) {
                    $id_producto = (int) $_GET['id'];


                    $sql = "SELECT * FROM producto WHERE id_producto = ? AND activo = 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_producto);
                    $stmt->execute();
                    $resultado = $stmt->get_result();


                    if ($resultado->num_rows > 0) {
                        $producto = $resultado->fetch_assoc();
                    } else {
                        echo "<p>Producto no encontrado.</p>";
                        exit();
                    }
                } else {
                    echo "<p>Falta el ID del producto.</p>";
                    exit();
                }
                ?>

                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <img width="90%" src="<?= $producto['foto_producto'] ?>"
                                class="img-fluid rounded product-image" style="border: 1px solid #f0f0f0;"
                                alt="Imagen del Producto">
                        </div>

                        <div class="col-md-6">
                            <h1><?= htmlspecialchars($producto['nombre_producto']) ?></h1>
                            <h2 class="text-dark mt-2">$<?= number_format($producto['precio_unitario'], 0, ',', '.') ?>
                            </h2>
                            <hr>
                            <h5>Características</h5>
                            <ul>
                                <li>Falta esto ---------</li>
                                <li>Característica 1</li>
                                <li>Característica 2</li>
                                <li>Característica 3</li>
                            </ul>
                            <hr>
                            <h5>Cantidad</h5>
                            <div class="input-group" style="width: 130px;">
                                <button class="btn btn-outline-dark" type="button"
                                    onclick="this.nextElementSibling.stepDown()">-</button>
                                <input type="number" value="1" min="1" class="form-control text-center custom-input">
                                <button class="btn btn-outline-dark" type="button"
                                    onclick="this.previousElementSibling.stepUp()">+</button>
                            </div>
                            <button class="btn btn-dark mt-3 w-100 p-2">Añadir al carrito</button>
                            <hr>
                            <h5>Descripción del producto</h5>
                            <p><?= htmlspecialchars($producto['descripcion_producto']) ?></p>
                        </div>
                    </div>

                    <div class="row mt-4 mb-3">
                        <div class="col-12">
                            <h2>Reseñas del Producto</h2>
                            <div class="mb-3">
                                <strong>Usuario 1</strong>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                            <div class="mb-3">
                                <strong>Usuario 2</strong>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $conn->close();
                ?>

            </div>

            <!-- Footer -->
            <?php include '../templates/footer.php'; ?>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

</php>