<?php
include '/xampp/IKAT/config/conexion.php';
?>

<!DOCTYPE php>
<php lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ikat - Registro</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\..\assets\css\styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>

    <body>

        <div class="container-f">
            <!-- Header -->
            <?php include '/xampp/IKAT/templates/header.php'; ?>

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
                require('..\..\config\conexion.php');
                require('..\..\assets\php\verificar_recaptcha.php');
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

                            // Validar la longitud y espacios de la contraseña
                            if (strlen($contrasenia) >= 8 && strlen($contrasenia) <= 15 && !preg_match('/\s/', $contrasenia)) {
                                $contrasenia = password_hash($contrasenia, PASSWORD_BCRYPT);

                                // Crear un nuevo carrito
                                $query_carrito = "INSERT INTO carrito () VALUES ()"; // Agrega campos si es necesario
                                if (mysqli_query($conn, $query_carrito)) {
                                    // Obtener el id_carrito del carrito creado
                                    $new_id_carrito = mysqli_insert_id($conn);

                                    // Inserción en la tabla usuario
                                    $query_usuario = "INSERT INTO usuario (nombre_usuario, apellido_usuario, run_usuario, correo_usuario, numero_usuario, contrasenia_usuario, tipo_usuario, puntos_totales, activo, ultima_sesion, id_carrito)
                                VALUES ('$nombre', '$apellido', '$run', '$correo', '$numero', '$contrasenia', 'Registrado', '0', '1', NOW(), '$new_id_carrito')";

                                    if (mysqli_query($conn, $query_usuario)) {
                                        echo "
                                    <div class='container-fluid d-flex justify-content-center align-items-center bg-light' style='height: 100vh;'>
                                        <div class='alert alert-success text-center shadow-lg p-5 rounded-3' role='alert' style='max-width: 500px;'>
                                            <h3 class='fw-bold'>¡Te has registrado correctamente!</h3>
                                            <p>Haz clic aquí para <a href='login.php' class='alert-link'>Iniciar sesión</a></p>
                                        </div>
                                    </div>";
                                    } else {
                                        die("Error en la inserción de usuario: " . mysqli_error($conn));
                                    }
                                } else {
                                    die("Error en la creación del carrito: " . mysqli_error($conn));
                                }
                            } else {
                                echo "
                            <div class='container-fluid d-flex justify-content-center align-items-center bg-light' style='height: 100vh;'>
                                <div class='alert alert-danger text-center shadow-lg p-5 rounded-3' role='alert' style='max-width: 500px;'>
                                    <h3>Error en la contraseña</h3>
                                    <p>La contraseña debe tener entre 8 y 15 caracteres y no contener espacios.</p>
                                    <a href='registro.php' class='btn btn-dark mt-3'>Volver a Intentar</a>
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
                                            size="9" placeholder="123456789" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="numero" class="form-label ms-1 fw-semibold">Número de Teléfono</label>
                                        <input type="tel" id="numero" name="numero" class="form-control border-dark"
                                            size="12" placeholder="+569" value="+569" required pattern="^\+569\d{8}$" title="Debe ser un número chileno de 11 dígitos, comenzando con +569" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="correo" class="form-label ms-1 fw-semibold">Correo Electrónico</label>
                                        <input type="email" id="correo" name="correo" class="form-control border-dark"
                                            placeholder="micorreo@gmail.com" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="contrasenia" class="form-label ms-1 fw-semibold">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" id="contrasenia" name="contrasenia"
                                                class="form-control border-dark" placeholder="Contraseña" required>
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="mostrar_ocultar()">
                                                <i id="icono" class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="terms" required>
                                        <label class="form-check-label" for="terms">Acepto los <a href="#"
                                                class="link-dark">términos y condiciones</a></label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="6LdqJ28qAAAAABqwd78ZwDJJupT5-qFk6IzGCxcb">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100 mt-4">Crear Cuenta</button>
                                </form>
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
        </div>

        <!-- Footer -->
        <footer class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                        <h5>¡Únete a la familia IKAT!</h5>
                        <div class="col-md-9 col-12">
                            Regístrate y disfruta de la experiencia completa de IKAT.
                            <div class="text-center">
                                <a href="registro.php"
                                    class="btn btn-light border-dark btn-sm mt-3 text-black text-decoration-none">
                                    Registrarme
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                        <h5>Servicio</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-black text-decoration-none">Sigue tu pedido</a></li>
                            <li><a href="#" class="text-black text-decoration-none">IKAT Points</a></li>
                            <li><a href="#" class="text-black text-decoration-none">Despacho a domicilio</a></li>
                            <li><a href="#" class="text-black text-decoration-none">Métodos de pago</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                        <h5>Sobre IKAT</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-black text-decoration-none">Quienes somos</a></li>
                            <li><a href="#" class="text-black text-decoration-none">Misión y Visión</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 mb-3 text-center text-md-start">
                        <h5>Redes Sociales</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-facebook"></i>
                                    Facebook</a></li>
                            <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-instagram"></i>
                                    Instagram</a></li>
                            <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-threads"></i>
                                    Threads</a></li>
                            <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-twitter-x"></i>
                                    X</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>


        <script>
            function mostrar_ocultar() {
                const passwordInput = document.getElementById("contrasenia");
                const icono = document.getElementById("icono");
                const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);
                icono.classList.toggle("bi-eye");
                icono.classList.toggle("bi-eye-slash");
            }
        </script>
    </body>

    </html>