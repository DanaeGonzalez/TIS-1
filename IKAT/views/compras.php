<?php
session_start();
$id_usuario = $_SESSION['id_usuario'] ?? null; // Asigna el valor o null si no está definido
?>

<!doctype php>
<php lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Mis compras</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/smallSearch.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            .btn-outline-thick {
                border-width: 2px !important;
                font-weight: bold;
            }
            .image-contour {
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.4);
            }
        </style>
    </head>

    <body>

        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>

            <!-- Main -->
            <div class="main">

                <!-- Contenedor compras -->
                <div class="container mt-4">
                    <div class="row">
                        <div class="d-flex gap-5">
                            <h1 class="text-start mb-3">Compras</h1>
                            <!-- Contenedor de la barra de búsqueda -->
                            <div class="group">
                                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                                    <g>
                                        <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                                    </g>
                                </svg>
                                <input placeholder="Search" type="search" class="input">
                            </div>
                        </div>
                        <hr>
                        <!-- Productos por opinar -->
                        <div class="container mt-2">
                                <div class="d-flex align-items-center justify-content-between p-3 border rounded shadow-sm mb-5" style="background-color: #f2f2f2;">
                                    <!-- Imágenes circulares -->
                                    <div class="d-flex">
                                        <img src="../assets/images/estrellita.png" alt="Producto 1" class="rounded-circle me-2" width="50" height="50">
                                        <img src="../assets/images/productos/1732821050-sillon_amarillo.jpg" alt="Producto 2" class="rounded-circle image-contour" width="50" height="50">
                                    </div>

                                    <!-- Texto -->
                                    <div>
                                        <span style="font-size: 18px;">2 productos esperan tu opinión</span>
                                    </div>

                                    <!-- Botón -->
                                    <div>
                                        <button class="btn btn-outline-primary btn-outline-thick">Opinar</button>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-8">
                            <!-- Contenedor dinámico -->
                            <div id="historial-compras" class="list-group"></div>
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
        <script src="../assets/js/historialCompras.js"></script>
        <script>
            const idUsuario = <?php echo json_encode($id_usuario); ?>; // Pasar id_usuario a JavaScript
        </script>
    </body>

</php>