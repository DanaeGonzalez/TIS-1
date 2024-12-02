<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKAT - Métodos de Pago</title>
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
        <div class="main d-flex flex-column align-items-center justify-content-center text-center py-5">
            <div class="d-flex justify-content-center">
                <div class="col-md-10 mb-10 p-5 border bg-light rounded shadow-sm">
                    <img src="../assets/images/ikat.png" alt="Métodos de Pago"
                        class="img-fluid" style="max-height: 250px;">
                    <br>
                    <!-- Texto informativo -->
                    <div class="text-content">
                    <h1 class="fw-bold mb-3">Nuestros Métodos de Pago</h1>
                    <p class="fs-5 mb-4">
                        En IKAT, hacemos que tus compras sean fáciles y seguras. Actualmente, aceptamos los
                        siguientes métodos de pago:
                    </p>
                    <ul class="list-unstyled fs-5 mb-4" style="color: #8c5c32;">
                        <li><i class="bi bi-credit-card me-2"></i> Tarjetas de Crédito</li>
                        <li><i class="bi bi-credit-card-2-back me-2"></i> Tarjetas de Débito</li>
                    </ul>
                    <p class="fs-5">
                        Estamos comprometidos con ofrecerte más opciones para que siempre encuentres el método
                        que mejor se adapte a ti.
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
