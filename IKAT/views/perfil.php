<!doctype php>
<php lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Perfil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\assets\css\styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>
        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>

            <!-- Sección Perfil del Usuario -->
            <div class="container mt-4 mb-3">
                <h2 class="text-center mb-4">Perfil de Usuario</h2>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Puntos Totales</label>
                                <input type="number" class="form-control bg-light" value="150" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre</label>
                                <input type="text" class="form-control" value="Juan" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Apellido</label>
                                <input type="text" class="form-control" value="Pérez" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">RUN</label>
                                <input type="text" class="form-control bg-light" value="12345678-9" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control bg-light" value="juan.perez@gmail.com" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Número de Teléfono</label>
                                <input type="tel" class="form-control" value="+56912345678" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dirección</label>
                                <input type="text" class="form-control" value="Av. Siempre Viva 742" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Contraseña</label>
                                <input type="password" class="form-control" value="123456" required>
                            </div>

                            <!-- Botón Guardar Cambios -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark w-50">Guardar Cambios</button>
                            </div>
                        </form>
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