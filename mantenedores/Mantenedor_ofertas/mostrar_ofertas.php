<?php
include '../conexion.php';
session_start();

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenedor de Ofertas</title>
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
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg" 
                                 alt="User Avatar" class="user-avatar me-2"> Usuario
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

    <!-- Main Layout -->
    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="collapse d-lg-block">
            <div class="accordion" id="accordionSidebar">
                <div class="accordion-item">
                    <h4 class="accordion-header" id="headingMantenedores">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mantenedoresLinks" aria-expanded="true">
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

            <h1 class="text-center p-4">Mantenedor de Ofertas</h1>

            <div class="table-responsive">
                <?php
                    $query = "SELECT o.id_oferta, o.porcentaje_descuento, p.id_producto, p.nombre_producto
                              FROM oferta o
                              JOIN producto p ON o.id_producto = p.id_producto";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        echo "<table class='table table-bordered table-striped'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID Oferta</th>
                                        <th>Producto</th>
                                        <th>Porcentaje de Descuento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id_oferta"] . "</td>
                                    <td>" . $row["nombre_producto"] . "</td>
                                    <td>" . $row["porcentaje_descuento"] . "%</td>
                                    <td>
                                        <form action='borrar_oferta.php' method='post' style='display:inline;'>
                                            <input type='hidden' name='id_oferta' value='" . $row["id_oferta"] . "'>
                                            <button class='btn btn-danger btn-sm' type='submit'>Eliminar</button>
                                        </form>
                                        <a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarOfertaModal" . $row["id_oferta"] . "'>Editar</a> |
                                    </td>
                                  </tr>";
                        
                            echo "
                            <div class='modal fade' id='editarOfertaModal" . $row["id_oferta"] . "' tabindex='-1' aria-labelledby='editarOfertaModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='editarOfertaModalLabel'>Editar Producto</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <form action='actualizar_oferta.php' method='post'>
                                                <input type='hidden' name='id_oferta' value='" . $row['id_oferta'] . "'>
                                                <div class='mb-3'>
                                                    <label for='idProducto' class='form-label'>ID Producto</label>
                                                    <input type='text' id='idProducto' class='form-control' value='" . $row['id_producto'] . "' disabled>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='porcentajeDescuento' class='form-label'>Porcentaje de Descuento (0 a 1)</label>
                                                    <input type='number' step='0.01' min='0' max='1' id='porcentajeDescuento' 
                                                           name='porcentaje_descuento' class='form-control' 
                                                           value='" . $row['porcentaje_descuento'] . "' required>
                                                </div>
                                                <button type='submit' class='btn btn-primary d-block w-100'>Actualizar Descuento</button>
                                                <a href='mostrar_ofertas.php' class='btn btn-primary mt-3 d-block w-100'>Volver</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                        echo "</tbody></table>";
                        echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarOfertaModal'>Agregar Oferta</a>";
                        echo "<a href='../Mantenedor_producto/mostrar_producto.php' class='btn btn-primary mt-3 d-block'>Volver</a>";
                    } else {
                        echo "<p class='text-center'>No hay ofertas disponibles.</p>";
                        echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarOfertaModal'>Agregar Oferta</a>";
                        echo "<a href='../Mantenedor_producto/mostrar_producto.php' class='btn btn-primary mt-3 d-block'>Volver</a>";
                    }
                ?>
            </div>

        </div>
    </div>

    <div class="modal fade" id="agregarOfertaModal" tabindex="-1" aria-labelledby="agregarOfertaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarOfertaModalLabel">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="agregar_ofertas.php" method="post">
                        <label for="id_producto" class="form-label">Selecciona el producto por ID:</label>

                        <select class="form-select" name="id_producto" required>
                            <option value="" disabled selected>Selecciona un producto</option>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <option value="<?php echo $row['id_producto']; ?>">
                                    <?php echo $row['nombre_producto']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                        <label for="porcentaje_descuento" class="form-label mt-3">Porcentaje de descuento (0 a 1):</label>

                        <input class="form-control" type="number" step="0.01" min="0" max="1" name="porcentaje_descuento" required>

                        <input class="form-control btn btn-primary d-block mt-4" type="submit" value="Agregar oferta">

                        <a href="mostrar_ofertas.php" class="btn btn-primary mt-3 d-block">Volver</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
