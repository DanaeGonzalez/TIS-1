<?php
session_start();
$id_usuario = $_SESSION['id_usuario'] ?? null; // Asigna el valor o null si no está definido
include '../config/conexion.php';
include '../assets/php/ver_resenias.php';


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
                <div id="alert-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;"></div>

                <!-- Contenedor compras -->
                <div class="container mt-4">
                    <div class="row">
                        <div class="d-flex gap-5 align-items-center">
                            <h1 class="text-start mb-3">Compras</h1>
                            <!-- Contenedor de la barra de búsqueda -->
                            <div class="d-flex align-items-center flex-grow-1">
                                <div class="position-relative w-100">
                                    <input id="search-bar" placeholder="Buscar en mis compras" type="search"
                                        class="form-control ps-5">
                                    <svg id="search-icon"
                                        class="position-absolute top-50 start-0 translate-middle-y ms-3"
                                        aria-hidden="true" viewBox="0 0 24 24"
                                        style="width: 1.2rem; height: 1.2rem; cursor: pointer;">
                                        <g>
                                            <path
                                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>

                            </div>
                            <!-- Filtro y enlace -->
                            <div class="d-flex align-items-center gap-3">
                                <!--  
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        id="dropdownFiltro" data-bs-toggle="dropdown" aria-expanded="false">
                                        Todas
                                    </button>
                                    
                                    <ul class="dropdown-menu" aria-labelledby="dropdownFiltro">
                                        <li><a class="dropdown-item" href="#">Esta semana</a></li>
                                        <li><a class="dropdown-item" href="#">Este Mes</a></li>
                                        <li><a class="dropdown-item" href="#">Este año</a></li>
                                    </ul>
                                    
                                </div>
                                -->
                                <span id="total-compras" class="text-secondary">0 compras</span>
                            </div>
                        </div>

                        <hr>
                        <!-- Productos por opinar -->
                        <div class="container mt-2">
                            <div class="d-flex align-items-center justify-content-between p-3 border rounded shadow-sm mb-5"
                                style="background-color: #f2f2f2;">
                                <?php
                                $pendientes = obtenerReseniasPendientes($conn, $id_usuario);
                                $productosPendientesCount = count($pendientes);
                                $primerProductoPendiente = !empty($pendientes) ? $pendientes[0] : null; // Obtener el primer producto pendiente
                                ?>

                                <!-- Contenedor con las imágenes -->
                                <div class="d-flex">
                                    <!-- Imagen fija o de decoración -->
                                    <img src="../assets/images/estrellita.png" alt="Estrellita"
                                        class="rounded-circle me-2" width="50" height="50">

                                    <!-- Imagen del primer producto pendiente o una imagen por defecto -->
                                    <?php if ($primerProductoPendiente): ?>
                                        <?php $rutaImagen = str_replace("../../", "../", $primerProductoPendiente['foto_producto']); ?>
                                        <img src="<?= htmlspecialchars($rutaImagen, ENT_QUOTES, 'UTF-8'); ?>"
                                            alt="<?= htmlspecialchars($primerProductoPendiente['nombre_producto'], ENT_QUOTES, 'UTF-8'); ?>"
                                            class="rounded-circle image-contour" width="50" height="50">
                                    <?php else: ?>
                                        <img src="../assets/images/ikat.png" alt="Sin productos pendientes"
                                            class="rounded-circle image-contour" width="50" height="50">
                                    <?php endif; ?>
                                </div>

                                <!-- Texto -->
                                <div>
                                    <span id="productos-opinion" style="font-size: 18px;">
                                        <?php
                                        if ($productosPendientesCount > 0) {
                                            echo "Tienes $productosPendientesCount producto/s esperando tu reseña.";
                                        } else {
                                            echo "No tienes productos pendientes de reseñar.";
                                        }
                                        ?>
                                    </span>
                                </div>


                                <!-- Botón -->
                                <div>
                                    <a href="opiniones.php">
                                        <button class="btn btn-cafe-opinar btn-outline-thick fs-6">Opinar</button>
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 mx-auto">
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
            const idUsuario = <?php echo json_encode($id_usuario); ?>;
        </script>
    </body>

</php>