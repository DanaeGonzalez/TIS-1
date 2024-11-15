<!doctype php>
<php lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Mis compras</title>
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

                <!-- Contenedor compras -->
                <div class="container mt-4">
                    <div class="row">
                        <h1 class="text-center mb-3">Productos comprados</h1>
                        <hr>
                        <div class="col-md-12">
                            <div class="list-group me-3">

                                <!-- Producto 1 -->
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center bg-light border mb-4 rounded shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <a href="producto.php">
                                            <img src="https://images.pexels.com/photos/1743226/pexels-photo-1743226.jpeg"
                                                alt="Producto 1" class="me-3 rounded" style="width: 170px;">
                                        </a>
                                        <div>
                                            <h4 class="mb-1 text-dark">Nombre del Producto 1</h4>
                                            <h6 class="text-dark">$777</h6>
                                            <p class="mb-0 text-muted">27 de octubre de 2024</p>
                                        </div>
                                    </div>
                                    <p class="mb-0 fw-bold fs-5 text-dark">$777</p>
                                </div>

                                <!-- Producto 2 -->
                                <div
                                    class="list-group-item d-flex justify-content-between align-items-center bg-light border mb-4 rounded shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <a href="producto.php">
                                            <img src="https://images.pexels.com/photos/1743226/pexels-photo-1743226.jpeg"
                                                alt="Producto 2" class="me-3 rounded" style="width: 170px;">
                                        </a>
                                        <div>
                                            <h4 class="mb-1 text-dark">Nombre del Producto 2</h4>
                                            <h6 class="text-dark">$777</h6>
                                            <p class="mb-0 text-muted">27 de octubre de 2024</p>
                                        </div>
                                    </div>
                                    <p class="mb-0 fw-bold fs-5 text-dark">$777</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include '../templates/footer.php'; ?>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

</php>