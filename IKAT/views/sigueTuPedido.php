<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKAT - Seguimiento de Pedidos</title>
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
            <div class="container py-5">
                <!-- Espacio para la imagen -->
                <div class="mb-5">
                    <img src="../assets/images/ikat.png" alt="Seguimiento de Pedidos"
                        class="img-fluid" style="max-height: 300px;">
                </div>
                
                <!-- Texto informativo -->
                <div class="text-content">
                    <h1 class="fw-bold mb-3">Sigue tu pedido con nosotros</h1>
                    <p class="fs-5 mb-4">
                        En IKAT, queremos que estés siempre informado sobre el estado de tus pedidos. 
                        Por eso, te ofrecemos un sistema de seguimiento fácil y práctico:
                    </p>
                    <ul class="list-unstyled fs-5 mb-4" style="color: #8c5c32;">
                        <li><i class="bi bi-envelope me-2"></i> Recibe actualizaciones en tu correo electrónico</li>
                        <li><i class="bi bi-truck me-2"></i> Conoce el estado de tu pedido en tiempo real</li>
                        <li><i class="bi bi-check-circle me-2"></i> Notificaciones sobre el envío y entrega</li>
                    </ul>
                    <p class="fs-5">
                        Estamos aquí para asegurarnos de que disfrutes de la mejor experiencia de compra,
                        manteniéndote informado en cada paso del proceso.
                    </p>
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
