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
    <title>IKAT - Mantenedor de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

            <h1 class="text-center p-4">Mantenedor de Compras</h1>
            <div class="table-responsive">
                <?php
                $sql = "SELECT * FROM compra JOIN compra_producto USING(id_compra)";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-bordered table-striped'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th>ID Compra</th>
                                    <th>ID Producto</th>
                                    <th>Fecha Compra</th>
                                    <th>Estado</th>
                                    <th>ID Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id_compra"] . "</td>
                                <td>" . $row["id_producto"] . "</td>
                                <td>" . $row["fecha_compra"] . "</td>
                                <td>" . $row["tipo_estado"] . "</td>
                                <td>" . $row["id_usuario"] . "</td>
                                <td>
                                    <a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarCompraModal" . $row["id_compra"] . "_" . $row["id_producto"] . "'>Editar</a> |
                                    <a href='borrar_compra.php?id=" . $row["id_compra"] . "' class='btn btn-danger btn-sm'>Borrar</a>
                                </td>
                              </tr>";
                    
                        // Modal para editar el estado de la compra
                        echo "
                        <div class='modal fade' id='editarCompraModal" . $row["id_compra"] . "_" . $row["id_producto"] . "' tabindex='-1' aria-labelledby='editarCompraModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='editarCompraModalLabel'>Editar Estado de Compra</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <form action='actualizar_compra.php' method='post'>
                                            <input type='hidden' name='id_compra' value='" . $row['id_compra'] . "'>
                                            <input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>
                                            <input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>
                                            <label for='tipo_estado'>Estado:</label>
                                            <select name='tipo_estado' class='form-select' required>
                                                <option value='Preparando pedido' " . ($row['tipo_estado'] == 'Preparando pedido' ? 'selected' : '') . ">Preparando pedido</option>
                                                <option value='En reparto' " . ($row['tipo_estado'] == 'En reparto' ? 'selected' : '') . ">En reparto</option>
                                                <option value='Devuelto a origen' " . ($row['tipo_estado'] == 'Devuelto a origen' ? 'selected' : '') . ">Devuelto a origen</option>
                                                <option value='Intento de entrega fallido' " . ($row['tipo_estado'] == 'Intento de entrega fallido' ? 'selected' : '') . ">Intento de entrega fallido</option>
                                                <option value='Entregado' " . ($row['tipo_estado'] == 'Entregado' ? 'selected' : '') . ">Entregado</option>
                                            </select><br>

                                            <input class='btn btn-primary w-100' type='submit' value='Actualizar Estado'>
                                            <a href='mostrar_compra.php' class='btn btn-secondary mt-3 d-block'>Cancelar</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                    echo "</tbody></table>";
                } else {
                    echo "<p class='text-center'>No hay compras registradas.</p>";
                }
                ?>
            </div>


        </div>
    </div>
    
</body>
</html>
