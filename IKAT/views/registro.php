<?php
include '..\config\conexion.php';
?>

<!DOCTYPE php>
<php lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ikat - Registro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\assets\css\styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                <?php
                require('..\config\conexion.php');
                require('verificar_recaptcha.php');
                if (isset($_POST['correo'])) {
                    // Validar si se completó el captcha
                    if (empty($_POST['g-recaptcha-response'])) {
                        echo "
                <div class='container-fluid d-flex justify-content-center align-items-center bg-light' style='height: 100vh;'>
                    <div class='alert alert-danger text-center shadow-lg p-5 rounded-3' role='alert' style='max-width: 500px;'>
                        <h3 class='fw-bold'>Error de reCAPTCHA</h3>
                        <p>Por favor, completa el captcha para continuar.</p>
                        <a href='registro.php' class='btn btn-dark mt-3'>Volver a Intentar</a>
                    </div>
                </div>";
                    } else {
                        // Validar el reCAPTCHA
                        $isCaptchaValid = validateCaptcha($_POST['g-recaptcha-response']);

                        if (!$isCaptchaValid) {
                            echo "
                    <div class='container-fluid d-flex justify-content-center align-items-center bg-light' style='height: 100vh;'>
                        <div class='alert alert-danger text-center shadow-lg p-5 rounded-3' role='alert' style='max-width: 500px;'>
                            <h3>Error de reCAPTCHA</h3>
                            <p>Por favor, inténtalo de nuevo.</p>
                            <a href='login.php' class='btn btn-dark mt-3'>Iniciar Sesión</a>
                        </div>
                    </div>";

                        } else {
                            $nombre = stripslashes($_REQUEST['nombre']);
                            $nombre = mysqli_real_escape_string($conn, $nombre);

                            $apellido = stripslashes($_REQUEST['apellido']);
                            $apellido = mysqli_real_escape_string($conn, $apellido);

                            $run = stripslashes($_REQUEST['run']);
                            $run = mysqli_real_escape_string($conn, $run);

                            $numero = stripslashes($_REQUEST['numero']);
                            $numero = mysqli_real_escape_string($conn, $numero);

                            $correo = stripslashes($_REQUEST['correo']);
                            $correo = mysqli_real_escape_string($conn, $correo);

                            $contrasenia = stripslashes($_REQUEST['contrasenia']);
                            $contrasenia = mysqli_real_escape_string($conn, $contrasenia);

                            $query = "INSERT INTO usuario (nombre_usuario, apellido_usuario, run_usuario, correo_usuario, numero_usuario, contrasenia_usuario, tipo_usuario, puntos_totales, id_divisa)
            VALUES ('$nombre', '$apellido', '$run', '$correo', '$numero', '" . md5($contrasenia) . "', 'Registrado', '0', '1')";

                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                echo "
                        <div class='container-fluid d-flex justify-content-center align-items-center bg-light' style='height: 100vh;'>
                            <div class='alert alert-success text-center shadow-lg p-5 rounded-3' role='alert' style='max-width: 500px;'>
                                <h3 class='fw-bold'>¡Te has registrado correctamente!</h3>
                                <p>Haz clic aquí para <a href='login.php' class='alert-link'>Iniciar sesión</a></p>
                            </div>
                        </div>";

                            } else {
                                echo "
                        <div class='container-fluid d-flex justify-content-center align-items-center bg-light' style='height: 100vh;'>
                            <div class='alert alert-danger text-center shadow-lg p-5 rounded-3' role='alert' style='max-width: 500px;'>
                                <h3>Error al registrarse</h3>
                                <p>Inténtalo más tarde.</p>
                            </div>
                        </div>";
                            }
                        }
                    }
                } else {
                    ?>
                    <div class="container mt-4">
                        <h1 class="text-center">Únete a la familia IKAT</h1>
                        <hr>
                        <div class="row mt-5">
                            <div class="col-md-6 border rounded-3 shadow-lg p-5 bg-light mb-5">
                                <h2 class="text-center mb-4 fw-bold">Regístrate aquí</h2>
                                <form name="registro" action="" method="post">
                                    <div class="mb-4">
                                        <label for="nombre" class="form-label ms-1 fw-semibold">Nombre</label>
                                        <input type="text" id="nombre" name="nombre" class="form-control border-dark"
                                            placeholder="Nombre" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="apellido" class="form-label ms-1 fw-semibold">Apellido</label>
                                        <input type="text" id="apellido" name="apellido" class="form-control border-dark"
                                            placeholder="Apellido" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="run" class="form-label ms-1 fw-semibold">RUT</label>
                                        <input type="text" id="run" name="run" class="form-control border-dark"
                                            placeholder="123456789" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="numero" class="form-label ms-1 fw-semibold">Número de Teléfono</label>
                                        <input type="number" id="numero" name="numero" class="form-control border-dark"
                                            placeholder="+569" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="correo" class="form-label ms-1 fw-semibold">Correo Electrónico</label>
                                        <input type="email" id="correo" name="correo" class="form-control border-dark"
                                            placeholder="micorreo@gmail.com" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="contrasenia" class="form-label ms-1 fw-semibold">Contraseña</label>
                                        <input type="password" id="contrasenia" name="contrasenia"
                                            class="form-control border-dark" placeholder="Contraseña" required>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input border-dark" id="terminos" required>
                                        <label class="form-check-label" for="terminos">Acepto términos y condiciones</label>
                                    </div>

                                    <div class="g-recaptcha mb-4 d-flex justify-content-center"
                                        data-sitekey="6LdqJ28qAAAAABqwd78ZwDJJupT5-qFk6IzGCxcb"></div>
                                    <button type="submit" class="btn btn-dark w-100 py-2">Registrarse</button>
                                </form>
                                <p class="text-center mt-4">¿Ya tienes una cuenta en IKAT? <br><a
                                        class="text-decoration-none text-secondary fw-semibold" href="login.php">Inicia
                                        sesión</a>
                                </p>
                            </div>


                            <div class="col-md-6 d-flex justify-content-center">
                                <div class="col-8">
                                    <h2 class="mb-4 mt-4">Beneficios IKAT</h2>
                                    <h5>Acumula y canjea IKAT Points</h5>
                                    <p>Nuestro sistema de puntos: IKAT Points premia tu fidelidad.</p>
                                    <h5>¡Ofertas y Promociones!</h5>
                                    <p>Sé el primero en enterarte cuando tus productos favoritos bajan de precio.</p>
                                    <h5>¡Vuelve cuando quieras!</h5>
                                    <p>Al registrarte podemos hacer seguimiento de los productos que guardas en tu carrito o
                                        agregas
                                        a favoritos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <!-- Footer -->
            <?php include '../templates/footer.php'; ?>

        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>

</php>