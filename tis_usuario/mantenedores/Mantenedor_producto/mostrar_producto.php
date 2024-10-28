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
    <title>Mantenedor de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../menu/styles.css">
</head>
<body>
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
                        <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
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
        
        <div class="content-area flex-grow-1 p-5 col-4 col-md-10">

        <?php if ($mensaje): ?>
            <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                <?php echo $mensaje; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

            <h1 class="text-center p-4">Mantenedor de Productos</h1>

            <div class="table-responsive">
                <?php
                    $sql = "SELECT * FROM producto";
                    $result = $conn->query($sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            echo "<table class='table table-bordered table-striped'>
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Stock</th>
                                            <th>Descripción</th>
                                            <th>Características</th>
                                            <th>Foto</th>
                                            <th>Cantidad Vendida</th>
                                            <th>Top Venta</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["id_producto"] . "</td>
                                        <td>" . $row["nombre_producto"] . "</td>
                                        <td>" . $row["precio_unitario"] . "</td>
                                        <td>" . $row["stock_producto"] . "</td>
                                        <td>" . $row["descripcion_producto"] . "</td>
                                        <td>" . $row["caracteristicas_producto"] . "</td>
                                        <td><img src='" . $row["foto_producto"] . "' alt='Foto del producto' width='50'></td>
                                        <td>" . $row["cantidad_vendida"] . "</td>
                                        <td>" . ($row["top_venta"] ? "Sí" : "No") . "</td>
                                        <td>
                                            <a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarProductoModal" . $row["id_producto"] . "'>Editar</a> |
                                            <a href='borrar_producto.php?id=" . $row["id_producto"] . "' class='btn btn-danger btn-sm'>Borrar</a>
                                        </td>
                                      </tr>";

                                echo "
                                <div class='modal fade' id='editarProductoModal" . $row["id_producto"] . "' tabindex='-1' aria-labelledby='editarProductoModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editarProductoModalLabel'>Editar Producto</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <form action='actualizar_producto.php' method='post'>
                                                    <input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>
            
                                                    Nombre del Producto: <input class='form-control' type='text' name='nombre_producto' value='" . $row['nombre_producto'] . "' required><br>
            
                                                    Precio Unitario: <input class='form-control' type='number' name='precio_unitario' value='" . $row['precio_unitario'] . "' required><br>
            
                                                    Descripción: <textarea class='form-control' required name='descripcion_producto'>" . $row['descripcion_producto'] . "</textarea><br>
            
                                                    Características: <textarea class='form-control' required name='caracteristicas_producto'>" . $row['caracteristicas_producto'] . "</textarea><br>
            
                                                    Foto del Producto (URL): <input class='form-control' required type='text' name='foto_producto' value='" . $row['foto_producto'] . "'><br>
            
                                                    <button type='submit' class='btn btn-primary'>Actualizar Producto</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            }
                            echo "</tbody></table>";
                            echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarProductoModal'>Agregar Producto</a>";
                            echo "<a href='../Mantenedor_stock/modificar_stock_producto.php' class='btn btn-primary mt-3 d-block'>Mantenedor Stock</a>";
                            echo "<a href='../Mantenedor_ofertas/mostrar_ofertas.php' class='btn btn-primary mt-3 d-block'>Mantenedor Ofertas</a>";
                        } else {
                            echo "<p class='text-center'>No hay productos registrados.</p>";
                            echo "<button type='button' class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarProductoModal'>
                                    Agregar Producto
                                  </button>";
                        }
                    } else {
                        echo "<p class='text-danger'>Error en la consulta: " . $conn->error . "</p>";
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="insertar_producto.php" method="post">
                        Nombre del Producto: <input class="form-control" type="text" name="nombre_producto" required><br>

                        Precio Unitario: <input class="form-control" type="number" name="precio_unitario" required><br>

                        Descripción: <textarea class="form-control" name="descripcion_producto" required></textarea><br>

                        Características: <textarea class="form-control" name="caracteristicas_producto" required></textarea><br>

                        Foto (URL): <input class="form-control" type="text" name="foto_producto" required><br>

                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>



