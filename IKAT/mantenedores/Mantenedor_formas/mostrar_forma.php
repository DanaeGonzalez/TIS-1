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
    <title>Mantenedor de formas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<<<<<<< Updated upstream
  <link rel="stylesheet" href="..\..\assets\css\styles.css">
=======
<link rel="stylesheet" href="../../assets/css/styles.css">
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                        <a href="../../views/menu_rol/menu_adm.php">
                <img width="180px" height="auto" src="../../assets/Images/ikat.png" alt="">
            </a>
=======
            <img width="180px" height="auto" src="../../assets/images/ikat.png" alt="">
>>>>>>> Stashed changes

            <button class="navbar-toggler border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                <!-- Título: Mantenedores -->
                <div class="accordion-item">
                    <h4 class="accordion-header" id="headingMantenedores">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mantenedoresLinks" aria-expanded="true" aria-controls="mantenedoresLinks">
                            Mantenedores
                        </button>
                    </h4>
                    <!-- Enlaces de Mantenedores -->
                    <div id="mantenedoresLinks" class="accordion-collapse collapse show" aria-labelledby="headingMantenedores"
                         data-bs-parent="#accordionSidebar">
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

            <h1 class="text-center p-4">Mantenedor de formas</h1>
            <div class="table-responsive">
                <?php
                    $sql = "SELECT * FROM forma";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table class='table table-bordered table-striped'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id_forma"] . "</td>
                                    <td>" . $row["nombre_forma"] . "</td>
                                    <td>
                                        <a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarFormaModal" . $row["id_forma"] . "'>Editar</a> |
                                        <a href='borrar_forma.php?id=" . $row["id_forma"] . "' class='btn btn-danger btn-sm'>Borrar</a>
                                    </td>
                                  </tr>";

                            echo "
                            <div class='modal fade' id='editarFormaModal" . $row["id_forma"] . "' tabindex='-1' aria-labelledby='editarFormaModal' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='editarFormaModal'>Editar Producto</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <form action='actualizar_forma.php' method='post'>
                                                <input type='hidden' name='id_forma' value='" . $row['id_forma'] ."'>
                                                Nombre: <input type='text' class='form-control' required name='nombre_forma' value='" . $row['nombre_forma'] . "'><br>

                                                <input class='form-control btn btn-primary d-block' type='submit' value='Actualizar forma'>
                                                <a href='mostrar_forma.php' class='btn btn-primary mt-3 d-block'>Volver</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                        echo "</tbody></table>";
                        echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarFormaModal'>Agregar forma</a>";
                    } else {
                        echo "<p class='text-center'>No hay formas registradas.</p>";
                        echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarFormaModal'>Agregar forma</a>";
                        echo "<a href='../menu/menu.html' class='btn btn-primary mt-3 d-block'>Volver al menú</a>";
                    }
                ?>
            </div>

            <div class="modal fade" id="agregarFormaModal" tabindex="-1" aria-labelledby="agregarFormaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="agregarFormaModalLabel">Agregar forma</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="insertar_forma.php" method="post">
                                Nombre: <input class="form-control" type="text" name="nombre_forma" required><br><br>

                                <input class="form-control btn btn-primary d-block" type="submit" value="Crear forma">
                                <a href='mostrar_forma.php' class='btn btn-primary mt-3 d-block'>Volver</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
</body>
</html>
