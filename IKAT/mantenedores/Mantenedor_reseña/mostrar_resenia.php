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
    <title>IKAT - Mantenedor de Reseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\..\assets\css\styles.css">

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
                            <li><a class="dropdown-item" href="../../views/perfil.php">Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../../views/menu_registro/logout.php">Cerrar Sesión</a></li>
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
                            <?php if ($_SESSION['tipo_usuario'] == 'Superadmin'): ?>
                                <a href="../Mantenedor_usuario/mostrar_usuario.php" class="sidebar-link">Usuarios</a> <?php
                            endif; ?>
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

            <h1 class="text-center p-4">Mantenedor de Reseñas</h1>
            
            <div class="table-responsive">
            <?php
                $sql = "SELECT * FROM resenia";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-bordered table-striped'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th>ID</th>
                                    <th>Calificación</th>
                                    <th>Comentario</th>
                                    <th>ID Usuario</th>
                                    <th>ID Producto</th>
                                    <th>Activo</th>
                                    <th>Razon</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>";
                    while($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>" . $row["id_resenia"] . "</td>
                                <td>" . $row["calificacion"] . "</td>
                                <td>" . $row["comentario"] . "</td>
                                <td>" . $row["id_usuario"] . "</td>
                                <td>" . $row["id_producto"] . "</td>
                                <td>" . ($row["activo"] ? "Sí" : "No") . "</td>
                                <td>" . $row["razon"] . "</td>
                                <td>" .
                                    ($_SESSION['tipo_usuario'] == 'Superadmin' ? 
                                        "<a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarModal" . $row["id_resenia"] . "'>Editar</a> | " 
                                        : "") .
                                    ($row['activo'] == 1 
                                        ? "<button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#banModal{$row['id_resenia']}'>Banear</button>" 
                                        : "<form action='desbanear_resenia.php' method='POST' class='d-inline'>
                                               <input type='hidden' name='id_resenia' value='{$row['id_resenia']}'>
                                               <button type='submit' class='btn btn-success btn-sm'>Desbanear</button>
                                           </form>") . 
                                "</td>
                            </tr>";
                    
                        echo "
                        <div class='modal fade' id='editarModal" . $row['id_resenia'] . "' tabindex='-1' aria-labelledby='editarModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='editarModalLabel'>Editar Reseña</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <form action='actualizar_resenia.php' method='POST'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='id_resenia' value='" . $row['id_resenia'] . "'>

                                            <div class='mb-3'>
                                                <label for='calificacion' class='form-label'>Calificación</label>
                                                <input type='number' class='form-control' name='calificacion' id='calificacion' value='" . $row['calificacion'] . "' required>
                                            </div>

                                            <div class='mb-3'>
                                                <label for='comentario' class='form-label'>Comentario</label>
                                                <textarea class='form-control' name='comentario' id='comentario' rows='3' required>" . $row['comentario'] . "</textarea>
                                            </div>

                                            <div class='mb-3'>
                                                <label for='activo' class='form-label'>Activo</label>
                                                <select class='form-control' name='activo' id='activo' required>
                                                    <option value='1' " . ($row['activo'] == 1 ? 'selected' : '') . ">Sí</option>
                                                    <option value='0' " . ($row['activo'] == 0 ? 'selected' : '') . ">No</option>
                                                </select>
                                            </div>

                                            <div class='mb-3'>
                                                <label for='id_usuario' class='form-label'>ID Usuario</label>
                                                <input type='number' class='form-control' name='id_usuario' id='id_usuario' value='" . $row['id_usuario'] . "' required>
                                            </div>

                                            <div class='mb-3'>
                                                <label for='id_producto' class='form-label'>ID Producto</label>
                                                <input type='number' class='form-control' name='id_producto' id='id_producto' value='" . $row['id_producto'] . "' required>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                            <button type='submit' class='btn btn-primary'>Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        ";
                        
                        echo "
                        <div class='modal fade' id='banModal{$row['id_resenia']}' tabindex='-1' aria-labelledby='banModalLabel{$row['id_resenia']}' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Razón de Baneo</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <form action='banear_resenia.php' method='POST'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='id_resenia' value='{$row['id_resenia']}'>
                                            <label for='razon' class='form-label'>Ingrese la razón del baneo:</label>
                                            <textarea class='form-control' name='razon' id='razon' rows='3' required></textarea>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancelar</button>
                                            <button type='submit' class='btn btn-danger'>Banear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
                    }
                    echo "</tbody></table>";
                    if ($_SESSION['tipo_usuario'] == 'Superadmin') {
                        echo "<a class='btn btn-primary mt-3 d-block' href='insertar_resenia.php'>Agregar Reseña</a>";
                    }
                } else {
                    echo "<p class='text-center'>No hay reseñas registradas.</p>";
                    if ($_SESSION['tipo_usuario'] == 'Superadmin') {
                        echo "<a class='btn btn-primary mt-3 d-block' href='insertar_resenia.php'>Agregar Reseña</a>";
                    }
                }
            ?>

            </div>
        </div>
    </div>
    
</body>
</html>
