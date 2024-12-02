<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKAT - IkatPoints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/scss/delete.scss">
    <link rel="stylesheet" href="../assets/scss/cartPequeño.scss">
    <link rel="stylesheet" href="../assets/scss/cart.scss">
    <link rel="stylesheet" href="../assets/css/cofeButton.css">
</head>

<body>
    <div class="container-f">
        <!-- Header/Navbar -->
        <?php include '../templates/header.php'; ?>

        <!-- Main -->
        <div class="main d-flex flex-column align-items-center justify-content-center text-center py-5">
            
            <div class="d-flex justify-content-center">
                <div class="col-md-10 mb-10 p-5 border bg-light rounded shadow-sm">
                
                    <img src="../assets/images/ikat.png" alt="Promoción IKAT Points"
                        class="img-fluid" style="max-height: 300px;">
                
                
                    <!-- Texto promocional -->
                    <div class="text-content">
                    <h1 class="fw-bold mb-3">¡Descubre el poder de tus IKAT Points!</h1>
                    <p class="fs-5 mb-4">
                        Cada compra suma IKAT Points a tu cuenta, y estos puntos pueden ser usados como
                        <span class="text-secondary fw-bold">descuentos increíbles</span> en tus próximas compras.
                        ¡Es fácil, rápido y totalmente beneficioso para ti!
                    </p>
                    <a href="catalogo.php"><button class="btn btn-outline-primary btn-lg">Empieza a ganar puntos ahora</button></a>
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

</html>
