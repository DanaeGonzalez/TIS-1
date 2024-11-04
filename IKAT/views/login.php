<?php
include '..\config\conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ikat - Inicio Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\assets\css\styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <?php
    require('..\config\conexion.php');
    session_start();
    if (isset($_POST['identificador']) or isset($_POST['run'])) {
        $identificador = stripslashes($_REQUEST['identificador']);
        $identificador = mysqli_real_escape_string($conn, $identificador);

        $contrasenia = stripslashes($_REQUEST['contrasenia']);
        $contrasenia = mysqli_real_escape_string($conn, $contrasenia);

        $query = "SELECT * FROM usuario WHERE correo_usuario='$identificador' OR run_usuario='$identificador' AND contrasenia_usuario='" . md5($contrasenia) . "'";
        $result = mysqli_query($conn, $query) or die(mysql_error());

        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['identificador'] = $identificador;
            $user_type = "SELECT tipo_usuario FROM usuario WHERE correo_usuario='$identificador' OR run_usuario='$identificador'";
            if ($user_type == 'Registrado') {
                header("Location: ../menu/menu_reg.html");
            } else {
                header("Location: ../menu/menu_adm.html");
            }
        } else {
            echo "
            <div class='container-fluid d-flex justify-content-center align-items-center bg-light' style='height: 100vh;'>
                <div class='alert alert-danger text-center shadow-lg p-5 rounded-3' role='alert' style='max-width: 500px;'>
                    <h3 class='fw-bold'>Usuario o Contraseña Incorrectos</h3>
                    <p>Por favor, verifica tus datos e inténtalo nuevamente.</p>
                    <a href='login.php' class='btn btn-dark mt-3'>Iniciar Sesión</a>
                </div>
            </div>";
        }
    } else {
        ?>
        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>

            <!-- Main -->
            <div class="container mt-4 mb-5">
                <h1 class="text-center">¡Bienvenido de nuevo a IKAT!</h1>
                <hr>
                <div class="row mt-5 d-flex justify-content-center">
                    <!-- Formulario de inicio de sesión -->
                    <div class="col-md-6 border rounded-3 shadow-lg p-5 bg-light">
                        <h2 class="text-center mb-4 fw-bold">Inicia Sesión</h2>
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
                                class="text-decoration-none text-secondary fw-semibold">
                                Regístrate aquí</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php
    }
    ?>

        <!-- Footer -->
        <?php include '../templates/footer.php'; ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>