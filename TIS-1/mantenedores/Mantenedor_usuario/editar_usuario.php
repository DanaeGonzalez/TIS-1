<?php
    include '../conexion.php';
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
    <!-- Header/Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="btn btn-outline border d-lg-none" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <img width="180px" height="auto" src="../ikat.png" alt="">

            <button class="navbar-toggler border" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" 
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg" 
                                 alt="User Image" class="user-avatar me-2">
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
                        <button class="accordion-button" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#mantenedoresLinks" 
                                aria-expanded="true" aria-controls="mantenedoresLinks">
                            Mantenedores
                        </button>
                    </h4>
                    <div id="mantenedoresLinks" class="accordion-collapse collapse show" 
                         aria-labelledby="headingMantenedores" data-bs-parent="#accordionSidebar">
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
            <div class="row">
                <div class="col-12 p-4">
                    <?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM usuario WHERE id_usuario = $id";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                        }
                    ?>
                    <h1 class="text-center pb-4">Editar Usuario</h1>
                    <form action="actualizar_usuario.php" method="post">
                        <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">
                        Nombre: <input class="form-control" type="text" name="nombre_usuario" value="<?php echo $row['nombre_usuario']; ?>"><br>
                        Apellido: <input class="form-control" type="text" name="apellido_usuario" value="<?php echo $row['apellido_usuario']; ?>"><br>
                        RUN: <input class="form-control" type="text" name="run_usuario" value="<?php echo $row['run_usuario']; ?>"><br>
                        Correo: <input class="form-control" type="email" name="correo_usuario" value="<?php echo $row['correo_usuario']; ?>"><br>
                        Teléfono: <input class="form-control" type="text" name="numero_usuario" value="<?php echo $row['numero_usuario']; ?>"><br>
                        Dirección: <input class="form-control" type="text" name="direccion_usuario" value="<?php echo $row['direccion_usuario']; ?>"><br>
                        Tipo de Usuario:
                        <select name="tipo_usuario" class="form-control">
                            <option value="Administrador" <?php if ($row['tipo_usuario'] == 'Administrador') echo 'selected'; ?>>Administrador</option>
                            <option value="Registrado" <?php if ($row['tipo_usuario'] == 'Registrado') echo 'selected'; ?>>Registrado</option>
                        </select><br>
                        <input class="form-control btn btn-primary d-block" type="submit" value="Actualizar Usuario">
                        <a href="mostrar_usuario.php" class="btn btn-primary mt-3 d-block">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
