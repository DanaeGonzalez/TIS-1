<?php
include '..\..\config\conexion.php'; // Cambia esta línea si la ruta es diferente.
session_start();

if (isset($_POST['identificador'])) {
    $identificador = stripslashes($_REQUEST['identificador']);
    $identificador = mysqli_real_escape_string($conn, $identificador);

    $contrasenia = stripslashes($_REQUEST['contrasenia']);
    $contrasenia = mysqli_real_escape_string($conn, $contrasenia);

    // Consulta para obtener el usuario
    $query = "SELECT * FROM usuario WHERE correo_usuario='$identificador' OR run_usuario='$identificador'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verificación de la contraseña usando password_verify
        if (password_verify($contrasenia, $user['contrasenia_usuario'])) {
            $_SESSION['identificador'] = $identificador;
            $_SESSION['tipo_usuario'] = $user['tipo_usuario'];
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
            $_SESSION['apellido_usuario'] = $user['apellido_usuario'];
            $_SESSION['run_usuario'] = $user['run_usuario'];
            $_SESSION['correo_usuario'] = $user['correo_usuario'];
            $_SESSION['numero_usuario'] = $user['numero_usuario'];
            $_SESSION['direccion_usuario'] = $user['direccion_usuario'];
            $_SESSION['puntos'] = $user['puntos_totales'];

            $_SESSION['id_carrito'] = $user['id_carrito'];


            // Redireccionar según el tipo de usuario
            if ($_SESSION['tipo_usuario'] == 'Registrado') {
                header("Location: ../menu_rol/menu_reg.php");
            } else if ($_SESSION['tipo_usuario'] == 'Admin') {
                header("Location: ../menu_rol/menu_adm.php");
            } else if ($_SESSION['tipo_usuario'] == 'Superadmin') {
                header("Location: ../menu_rol/menu_supadm.php");
            }
            exit(); // Importante para detener la ejecución del script después de redirigir
        } else {
            $error_message = "Usuario o Contraseña incorrectos.";
        }
    } else {
        $error_message = "Usuario o Contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ikat - Inicio Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\..\assets\css\styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-f">
        <!-- Header/Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a href="..\..\index.php">
                    <img width="180px" height="auto" src="..\..\assets\images\ikat.png" alt="Ikat">
                </a>

                <div class="d-flex align-items-center justify-content-end gap-3 ms-auto">

                    <!-- Botón de búsqueda -->
                    <button class="btn btn-link d-lg-none p-0" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="bi bi-search fs-4  text-secondary"></i>
                    </button>

                    <!-- Botón de catálogo -->
                    <a href="..\catalogo.php" class="btn btn-link d-lg-none p-0">
                        <i class="bi bi-bag fs-4 text-secondary"></i>
                    </a>

                    <!-- Botón de menú -->
                    <button class="btn btn-link d-lg-none p-0" data-bs-toggle="collapse"
                        data-bs-target="#navbarContent">
                        <i class="bi bi-list fs-4  text-secondary"></i>
                    </button>
                </div>

                <!-- Menú de navegación colapsable -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ms-auto align-items-center text-center">

                        <!-- Botones de lista de deseos y carrito al lado del usuario -->
                        <li class="nav-item d-flex align-items-center gap-3">

                            <!-- Botón de catálogo -->
                            <a href="..\catalogo.php" class="btn btn-link d-none d-lg-flex p-0">
                                <i class="bi bi-bag fs-4 text-secondary"></i>
                            </a>

                            <!-- Menú de usuario -->
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg"
                                        alt="User Image" class="user-avatar me-2">
                                    Usuario
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="..\menu_registro\registro.php">Registrarse</a>
                                    </li>
                                    <li><a class="dropdown-item" href="..\menu_registro\login.php">Iniciar sesión</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main -->
        <div class="container mt-4 mb-5">
            <h1 class="text-center">¡Bienvenido de nuevo a IKAT!</h1>
            <hr>
            <div class="row mt-5 d-flex justify-content-center">
                <!-- Formulario de inicio de sesión -->
                <div class="col-md-6 border rounded-3 shadow-lg p-5 bg-light">
                    <h2 class="text-center mb-4 fw-bold">Inicia Sesión</h2>
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger text-center"><?= $error_message; ?></div>
                    <?php endif; ?>
                    <form name="login" action="" method="post">
                        <div class="mb-4">
                            <label for="identificador" class="form-label ms-1 fw-semibold">Correo o RUT</label>
                            <input type="text" id="identificador" name="identificador" class="form-control border-dark"
                                placeholder="Correo o RUN" required />
                        </div>
                        <div class="mb-4">
                            <label for="contrasenia" class="form-label ms-1 fw-semibold">Contraseña</label>
                            <input type="password" id="contrasenia" name="contrasenia" class="form-control border-dark"
                                placeholder="Contraseña" required />
                        </div>
                        <button type="submit" name="submit" class="btn btn-dark w-100 py-2">Entrar</button>
                    </form>
                    <p class="text-center mt-4">
                        ¿No estás registrado aún? <br><a href="registro.php"
                            class="text-decoration-none text-secondary fw-semibold">Regístrate aquí</a>
                    </p>
                </div>
            </div>
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
</body>

</html>