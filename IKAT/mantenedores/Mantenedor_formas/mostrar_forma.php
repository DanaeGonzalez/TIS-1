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
    <title>IKAT - Mantenedor de Formas</title>
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
