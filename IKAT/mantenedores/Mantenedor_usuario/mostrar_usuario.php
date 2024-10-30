<?php
include '../../config/conexion.php';
session_start();

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenedor de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="..\..\assets\css\styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
            <button class="navbar-toggler border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <h4 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mantenedoresLinks">
                            Mantenedores
                        </button>
                    </h4>
                    <div id="mantenedoresLinks" class="accordion-collapse collapse show">
                        <div class="accordion-body p-0">
                            <a href="../categoria/mostrar_categoria.php" class="sidebar-link">Categorías</a>
                            <a href="../Mantenedor_subcategorias/mostrar_subcategoria.php" class="sidebar-link">Subcategorías</a>
                            <a href="../Mantenedor_metodo_pago/mostrar_metodo_pago.php" class="sidebar-link">Métodos de pago</a>
                            <a href="../Mantenedor_producto/mostrar_producto.php" class="sidebar-link">Productos</a>
                            <a href="../Mantenedor_reseña/mostrar_resenia.php" class="sidebar-link">Reseñas</a>
                            <a href="../Mantenedor_top_ventas/mostrar_top_ventas.php" class="sidebar-link">Ventas</a>
                            <a href="../Mantenedor_usuario/mostrar_usuario.php" class="sidebar-link">Usuarios</a>
                            <a href="../Mantenedor_n_asientos/mostrar_n_asientos.php" class="sidebar-link">N°Asientos</a>
                            <a href="../Mantenedor_n_cajones/mostrar_n_cajones.php" class="sidebar-link">N°Cajones</a>
                            <a href="../Mantenedor_n_plazas/mostrar_n_plazas.php" class="sidebar-link">N°Plazas</a>
                            <a href="../Mantenedor_colores/mostrar_color.php" class="sidebar-link">Colores</a>
                            <a href="../Mantenedor_firmezas/mostrar_firmeza.php" class="sidebar-link">Firmeza</a>
                            <a href="../Mantenedor_materiales/mostrar_material.php" class="sidebar-link">Materiales</a>
                            <a href="../Mantenedor_ambientes/mostrar_ambiente.php" class="sidebar-link">Ambientes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area flex-grow-1 p-5 col-4 col-md-10">

            <?php if ($mensaje): ?>
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <h1 class="text-center p-4">Mantenedor de Usuarios</h1>
            
            <div class="table-responsive">
                <?php
                    $sql = "SELECT * FROM usuario";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table class='table table-bordered table-striped'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>RUN</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Tipo</th>
                                        <th>Puntos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id_usuario']}</td>
                                    <td>{$row['nombre_usuario']}</td>
                                    <td>{$row['apellido_usuario']}</td>
                                    <td>{$row['run_usuario']}</td>
                                    <td>{$row['correo_usuario']}</td>
                                    <td>{$row['numero_usuario']}</td>
                                    <td>{$row['direccion_usuario']}</td>
                                    <td>{$row['tipo_usuario']}</td>
                                    <td>{$row['puntos_totales']}</td>
                                    <td>   
                                        <a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarUsuarioModal" . $row["id_usuario"] . "'>Editar</a> |
                                        <a href='borrar_usuario.php?id={$row['id_usuario']}' class='btn btn-danger btn-sm'>Borrar</a>
                                    </td>
                                  </tr>";

                            echo "
                            <div class='modal fade' id='editarUsuarioModal" . $row["id_usuario"] . "' tabindex='-1' aria-labelledby='editarUsuarioModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='editarUsuarioModalLabel'>Editar Producto</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <form action='actualizar_usuario.php' method='post'>
                                                <input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>

                                                Nombre: <input class='form-control' type='text' name='nombre_usuario' value='" . $row['nombre_usuario'] . "'><br>

                                                Apellido: <input class='form-control' type='text' name='apellido_usuario' value='" . $row['apellido_usuario'] . "'><br>

                                                RUN: <input class='form-control' type='text' name='run_usuario' value='" . $row['run_usuario'] . "'><br>

                                                Correo: <input class='form-control' type='email' name='correo_usuario' value='" . $row['correo_usuario'] . "'><br>

                                                Teléfono: <input class='form-control' type='text' name='numero_usuario' value='" . $row['numero_usuario'] . "'><br>

                                                Dirección: <input class='form-control' type='text' name='direccion_usuario' value='" . $row['direccion_usuario'] . "'><br>

                                                Tipo de Usuario:
                                                <select name='tipo_usuario' class='form-control'>
                                                    <option value='Admin' " . ($row['tipo_usuario'] === 'Admin' ? 'selected' : '') . ">Admin</option>
                                                    <option value='Registrado' " . ($row['tipo_usuario'] === 'Registrado' ? 'selected' : '') . ">Registrado</option>
                                                    <option value='Superadmin' " . ($row['tipo_usuario'] === 'Superadmin' ? 'selected' : '') . ">Superadmin</option>
                                                </select><br>

                                                <input class='form-control btn btn-primary d-block' type='submit' value='Actualizar Usuario'>

                                                <a href='mostrar_usuario.php' class='btn btn-primary mt-3 d-block'>Volver</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                        echo "</tbody></table>";
                        echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarUsuarioModal'>Agregar Usuario</a>";
                        echo "<a href='../Mantenedor_puntos/modificar_puntos_usuario.php' class='btn btn-primary mt-3 d-block'>Mantenedor Puntos</a>";
                    } else {
                        echo "<p class='text-center'>No hay usuarios registrados.</p>";
                        echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarUsuarioModal'>Agregar Usuario</a>";
                        echo "<a href='../menu/menu.html' class='btn btn-primary mt-3 d-block'>Volver al menú</a>";
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="agregarUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarUsuarioModalLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="insertar_usuario.php" method="post">

                        Nombre: <input class="form-control" type="text" name="nombre_usuario" placeholder="Nombre" required><br>

                        Apellido: <input class="form-control" type="text" name="apellido_usuario" placeholder="Apellido" required><br>

                        Run: <input class="form-control" type="text" name="run_usuario" placeholder="RUN" required><br>

                        Correo: <input class="form-control" type="email" name="correo_usuario" placeholder="Correo" required><br>

                        Numero: <input class="form-control" type="text" name="numero_usuario" placeholder="Teléfono" required><br>

                        Contrasenia: <input class="form-control" type="password" name="contrasenia_usuario" placeholder="Contraseña" required><br>

                        Direccion: <input class="form-control" type="text" name="direccion_usuario" placeholder="Dirección" required><br>

                        <select class="form-control" name="tipo_usuario" required>
                            <option value="Admin">Administrador</option>
                            <option value="Registrado">Registrado</option>
                            <option value="Superadmin">Superadmin</option>
                        </select><br>

                        <input class="form-control btn btn-primary d-block" type="submit" value="Crear Usuario">

                        <a href="mostrar_usuario.php" class="btn btn-primary mt-3 d-block">Volver</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
