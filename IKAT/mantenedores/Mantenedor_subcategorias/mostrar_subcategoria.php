<?php
include '../../config/conexion.php';
session_start();

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKAT - Mantenedor de Subcategorías</title>
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

            <h1 class="text-center p-4">Mantenedor de Subcategorías</h1>
            <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarSubcategoriaModal">
                        <i class="bi bi-file-earmark-plus"></i>
                    </a>
                </div>
            <div class="table-responsive">
                <?php
                    $sql = "SELECT s.id_subcategoria, s.nombre_subcategoria, c.nombre_categoria 
                            FROM subcategoria s 
                            INNER JOIN categoria c ON s.id_categoria = c.id_categoria";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table class='table table-bordered table-striped'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row["id_subcategoria"] . "</td>
                                    <td>" . $row["nombre_subcategoria"] . "</td>
                                    <td>" . $row["nombre_categoria"] . "</td>
                                    <td>
                                        <a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarSubcategoriaModal" . $row["id_subcategoria"] . "'><i class='bi bi-pen'></i></a> |
                                        <a href='borrar_subcategoria.php?id=" . $row["id_subcategoria"] . "' class='btn btn-danger btn-sm'><i class='bi bi-trash3'></i></a>
                                    </td>
                                  </tr>";

                            echo "
                            <div class='modal fade' id='editarSubcategoriaModal" . $row["id_subcategoria"] . "' tabindex='-1' aria-labelledby='editarSubcategoriaModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='editarSubcategoriaModalLabel'>Editar Subcategoría</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <form action='actualizar_subcategoria.php' method='post'>
                                                <input type='hidden' name='id_subcategoria' value='" . $row['id_subcategoria'] . "'>
                                                Nombre: <input type='text' class='form-control' required name='nombre_subcategoria' value='" . $row['nombre_subcategoria'] . "'><br>
                                                <input class='form-control btn btn-primary d-block' type='submit' value='Actualizar Subcategoría'>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p class='text-center'>No hay subcategorías registradas.</p>";
                    }
                ?>
            </div>

            <div class="modal fade" id="agregarSubcategoriaModal" tabindex="-1" aria-labelledby="agregarSubcategoriaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="agregarSubcategoriaModalLabel">Agregar Subcategoría</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="insertar_subcategoria.php" method="post">
                                Nombre: <input class="form-control" type="text" name="nombre_subcategoria" required><br>
                                Categoría:
                                <select class="form-control" name="id_categoria" required>
                                    <?php
                                        $sqlCategorias = "SELECT id_categoria, nombre_categoria FROM categoria";
                                        $resultCategorias = $conn->query($sqlCategorias);
                                        while($categoria = $resultCategorias->fetch_assoc()) {
                                            echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['nombre_categoria'] . "</option>";
                                        }
                                    ?>
                                </select>
                                <br>
                                <input type="submit" value="Agregar Subcategoría" class="btn btn-primary">
                                <a href="mostrar_subcategoria.php" class="btn btn-secondary">Volver</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
