<?php
include '../conexion.php';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $query_divisa = "SELECT id_divisa FROM divisa WHERE codigo_divisa = 'CLP'";
    $result = $conn->query($query_divisa);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_divisa = $row['id_divisa'];  

        $nombre = $_POST['nombre_usuario'];
        $apellido = $_POST['apellido_usuario'];
        $run = $_POST['run_usuario'];
        $correo = $_POST['correo_usuario'];
        $numero = $_POST['numero_usuario'];
        $contrasenia = password_hash($_POST['contrasenia_usuario'], PASSWORD_BCRYPT);
        $direccion = $_POST['direccion_usuario'];
        $tipo = $_POST['tipo_usuario'];
        $puntos_totales = 0;

        $sql = "INSERT INTO usuario (nombre_usuario, apellido_usuario, run_usuario, correo_usuario, numero_usuario, contrasenia_usuario, direccion_usuario, tipo_usuario, puntos_totales, id_divisa)
                VALUES ('$nombre', '$apellido', '$run', '$correo', '$numero', '$contrasenia', '$direccion', '$tipo', $puntos_totales, $id_divisa)";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Nuevo usuario creado exitosamente";
        } else {
            $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $mensaje = "Error: No se encontró la divisa 'CLP'";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenedor de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../menu/styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <button class="btn btn-outline border d-lg-none" type="button" data-bs-toggle="collapse" 
                data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <img width="180px" height="auto" src="../ikat.png" alt="">

        <button class="navbar-toggler border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg" alt="User Image" class="user-avatar me-2"> 
                        Usuario
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
      </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="collapse d-lg-block">
            <div class="accordion" id="accordionSidebar">
                <div class="accordion-item">
                    <h4 class="accordion-header" id="headingMantenedores">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mantenedoresLinks" aria-expanded="true" aria-controls="mantenedoresLinks">
                            Mantenedores
                        </button>
                    </h4>
                    <div id="mantenedoresLinks" class="accordion-collapse collapse show" aria-labelledby="headingMantenedores"
                         data-bs-parent="#accordionSidebar">
                        <div class="accordion-body p-0">
                        <a href="../categoria/mostrar_categoria.php" class="sidebar-link">Categorías</a>
                            <a href="../Mantenedor_metodo_pago/mostrar_metodo_pago.php" class="sidebar-link">Métodos de pago</a>
                            <a href="../Mantenedor_producto/mostrar_producto.php" class="sidebar-link">Productos</a>
                            <a href="../Mantenedor_reseña/mostrar_resenia.php" class="sidebar-link">Reseñas</a>
                            <a href="../Mantenedor_top_ventas/mostrar_top_ventas.php" class="sidebar-link">Ventas</a>
                            <a href="../Mantenedor_usuario/mostrar_usuario.php" class="sidebar-link">Usuarios</a>
                            <a href="../Mantenedor_divisas/mostrar_divisa.php" class="sidebar-link">Divisas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area flex-grow-1 p-5">
            <div class="container p-4">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center pb-3">Agregar Usuario</h1>

                        <?php if ($mensaje != ''): ?>
                            <p class="text-center"><?php echo $mensaje; ?></p>
                        <?php endif; ?>

                        <form action="" method="post">
                            <input class="form-control" type="text" name="nombre_usuario" placeholder="Nombre" required><br>
                            <input class="form-control" type="text" name="apellido_usuario" placeholder="Apellido" required><br>
                            <input class="form-control" type="text" name="run_usuario" placeholder="RUN" required><br>
                            <input class="form-control" type="email" name="correo_usuario" placeholder="Correo" required><br>
                            <input class="form-control" type="text" name="numero_usuario" placeholder="Teléfono" required><br>
                            <input class="form-control" type="password" name="contrasenia_usuario" placeholder="Contraseña" required><br>
                            <input class="form-control" type="text" name="direccion_usuario" placeholder="Dirección" required><br>
                            <select class="form-control" name="tipo_usuario" required>
                                <option value="Administrador">Administrador</option>
                                <option value="Registrado">Registrado</option>
                            </select><br>
                            <input class="form-control btn btn-primary d-block" type="submit" value="Crear Usuario">
                            <a href="mostrar_usuario.php" class="btn btn-primary mt-3 d-block">Volver</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>