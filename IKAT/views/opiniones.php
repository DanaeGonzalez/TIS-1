<?php
session_start();
$id_usuario = $_SESSION['id_usuario'] ?? null; // Asigna el valor o null si no está definido
?>

<!doctype php>
<php lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Mis opiniones</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/opiniones.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>

            <!-- Main -->
            <div class="main">
                <div class="container mt-4">
                    <h1 class="text-center mb-3">Mis Opiniones</h1>
                    <hr><br>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="opinionesTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pendientes-tab" data-bs-toggle="tab" data-bs-target="#pendientes" type="button" role="tab" aria-controls="pendientes" aria-selected="true">Pendientes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="realizadas-tab" data-bs-toggle="tab" data-bs-target="#realizadas" type="button" role="tab" aria-controls="realizadas" aria-selected="false">Realizadas</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Pendientes Tab -->
                        <div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">
                            <!-- Seccion superior -->
                            <div class="highlight-box">
                                <i class="bi bi-star-fill" style="font-size: 2rem; color: #ffc107;"></i>
                                <div>
                                    <h5 class="mb-0">Sección Opiniones</h5>
                                    <p class="mb-0">Día a día, miles de personas leen opiniones antes de decidir su compra. ¡Comparte las tuyas!</p>
                                </div>
                            </div>
                            
                            <!-- Producto -->
                            <div class="d-flex border rounded p-3 mb-3 bg-light">
                                <div class="row align-items-center w-100">
                                    <div class="col-3 d-flex align-items-center">
                                        <img src="../assets/images/productos/1732820938-sillon rojo.jpg" alt="Producto" width="50" height="50" class="rounded me-3">
                                        <div>
                                            <p class="mb-1 fw-bold">Sillón rojo</p>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <div class="star-rating">
                                            <i class="bi bi-star" data-value="1"></i>
                                            <i class="bi bi-star" data-value="2"></i>
                                            <i class="bi bi-star" data-value="3"></i>
                                            <i class="bi bi-star" data-value="4"></i>
                                            <i class="bi bi-star" data-value="5"></i>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex align-items-center">
                                        <small class="text-muted">Comprado el 08 de nov.</small>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <button type="button" class="btn btn-outline-secondary btn-sm">Escribir mi reseña</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Producto -->
                            <div class="d-flex border rounded p-3 mb-3 bg-light">
                                <div class="row align-items-center w-100">
                                    <div class="col-3 d-flex align-items-center">
                                        <img src="../assets/images/productos/1732821050-sillon_amarillo.jpg" alt="Producto" width="50" height="50" class="rounded me-3">
                                        <div>
                                            <p class="mb-1 fw-bold">Sillón Amarillo</p>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <div class="star-rating">
                                            <i class="bi bi-star" data-value="1"></i>
                                            <i class="bi bi-star" data-value="2"></i>
                                            <i class="bi bi-star" data-value="3"></i>
                                            <i class="bi bi-star" data-value="4"></i>
                                            <i class="bi bi-star" data-value="5"></i>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex align-items-center">
                                        <small class="text-muted">Comprado el 08 de nov.</small>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <button type="button" class="btn btn-outline-secondary btn-sm">Escribir mi reseña</button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Realizadas Tab -->
                        <div class="tab-pane fade" id="realizadas" role="tabpanel" aria-labelledby="realizadas-tab">
                            <!-- Seccion superior -->
                            <div class="d-flex justify-content-between highlight-box">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="bi bi-star-fill" style="font-size: 2rem; color: #ffc107;"></i>
                                    <div>
                                        <h5 class="mb-0">Sección Opiniones</h5>
                                        <p class="mb-0">¡Gracias por contribuir con la comunidad!</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="text-secondary m-0">1 - 3 de 3 opiniones realizadas</p>
                                </div>
                            </div>

                            <!-- Producto -->
                            <div class="d-flex border rounded p-3 mb-3 bg-light">
                                <div class="row align-items-center w-100">
                                    <div class="col-3 d-flex align-items-center">
                                        <img src="../assets/images/productos/1732821050-sillon_amarillo.jpg" alt="Producto" width="50" height="50" class="rounded me-3">
                                        <div>
                                            <p class="mb-1 fw-bold">Sillón Amarillo</p>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <div class="star-rating">
                                            <i class="bi bi-star" data-value="1"></i>
                                            <i class="bi bi-star" data-value="2"></i>
                                            <i class="bi bi-star" data-value="3"></i>
                                            <i class="bi bi-star" data-value="4"></i>
                                            <i class="bi bi-star" data-value="5"></i>
                                        </div>
                                    </div>
                                    <div class="col-3 d-flex align-items-center">
                                        <small class="text-muted">Realizada el 08 de nov.</small>
                                    </div>
                                    <div class="col-3 d-flex justify-content-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm">Editar mi reseña</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include '../templates/footer.php'; ?>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

</php>