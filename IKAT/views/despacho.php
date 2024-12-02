<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKAT - Envíos a Domicilio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap.min.css">
</head>

<body>
    <div class="container-f">
        <!-- Header/Navbar -->
        <?php include '../templates/header.php'; ?>

        <!-- Main -->
        <div class="main d-flex flex-column align-items-center justify-content-center text-center py-5">
            <div class="container py-5">
                <div class="mb-5">
                        <img src="../assets/images/despacho.JPEG" alt="Envíos a Domicilio"
                            class="img-fluid" style="max-height: 200px;">
                </div>
                <div class="d-flex justify-content-center">
                <div class="col-md-10 mb-10 p-5 border bg-light rounded shadow-sm">
                    <!-- Texto informativo -->
                    <div class="text-content">
                        <h1 class="fw-bold mb-3">Envíos de muebles a domicilio en tiempo récord</h1>
                        <p class="fs-5 mb-4">
                            En IKAT, sabemos que la rapidez importa. Por eso, ofrecemos un servicio de 
                            <span class="fw-bold" style="color: #8c5c32;">envíos a domicilio</span> que garantiza que tus muebles 
                            lleguen a tu hogar en tiempo récord y en perfectas condiciones.
                        </p>
                        <ul class="list-unstyled fs-5 mb-4" style="color: #8c5c32;">
                            <li><i class="bi bi-truck"></i> Envíos rápidos y seguros</li>
                            <li><i class="bi bi-door-open"></i> Entrega directa hasta tu puerta</li>
                            <li><i class="bi bi-calendar-check"></i> Tiempo de entrega garantizado</li>
                        </ul>
                        <p class="fs-5">
                            Nos aseguramos de que cada entrega sea una experiencia inolvidable.
                            <br>
                            ¡Confía en nosotros para llevar tus muebles a donde los necesites!
                        </p>
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
