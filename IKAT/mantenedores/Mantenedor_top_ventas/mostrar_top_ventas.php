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
    <title>IKAT - Mantenedor de Ventas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\..\assets\css\styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/templates/header.php';?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include '../sidebar-mantenedores.php';?>

        <!-- Content Area -->
        <div class="content-area flex-grow-1 p-5 col-4 col-md-10">

            <?php if ($mensaje): ?>
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <h1 class="text-center p-4">Mantenedor de Ventas</h1>
            
            <div class="table-responsive">
                <?php
                    $query = "SELECT * FROM producto WHERE top_venta = true";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        echo "<table class='table table-bordered table-striped'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID Producto</th>
                                        <th>Nombre</th>
                                        <th>Precio Unitario</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id_producto"] . "</td>
                                    <td>" . $row["nombre_producto"] . "</td>
                                    <td>" . $row["precio_unitario"] . "</td>
                                    <td>
                                        <form action='borrar_top_ventas.php' method='post'>
                                            <input type='hidden' name='id_producto' value='" . $row["id_producto"] . "'>
                                            <input type='submit' name='accion' value='Borrar' class='btn btn-danger btn-sm'>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                        echo "</tbody></table>";
                        echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarTopVentasModal'>Agregar top ventas</a>";
                    } else {
                        echo "<p class='text-center'>No hay productos en top ventas.</p>";
                        echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarTopVentasModal'>Agregar top ventas</a>";
                    }
                ?>
            </div>
        </div>

        <div class="modal fade" id="agregarTopVentasModal" tabindex="-1" aria-labelledby="agregarTopVentasModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarTopVentasModalLabel">Agregar Top Ventas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="agregar_top_ventas.php" method="post">

                            <label>Agregar producto a top ventas:</label>

                            <select class="form-select" name="id_producto" required>
                            <option value="" disabled selected>Selecciona un producto</option>
                            <?php
                                $sqlProducto = "SELECT id_producto, nombre_producto FROM producto";
                                $resultProducto = $conn->query($sqlProducto);
                                while($producto = $resultProducto->fetch_assoc()) {
                                    echo "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre_producto'] . "</option>";
                                }
                            ?>
                            </select>

                            <input class="form-control btn btn-primary d-block mt-4" type="submit" value="Agregar">
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>