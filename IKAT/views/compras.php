<?php
session_start(); // Asegúrate de que la sesión esté iniciada
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>

        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>

            <!-- Main -->
            <div class="main">
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