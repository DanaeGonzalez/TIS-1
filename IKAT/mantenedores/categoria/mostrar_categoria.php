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
    <title>IKAT - Mantenedor de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/templates/header.php'; ?>

    <div class="container-fluid d-flex flex-wrap p-0">
        <!-- Sidebar -->
        <?php include '../sidebar-mantenedores.php'; ?>

        <!-- Content Area -->
        <div class="flex-grow-1 p-4">
            <?php if ($mensaje): ?>
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <h1 class="text-center p-4">Mantenedor de Categorías</h1>

            <div class="table-responsive">
                <?php
                $sql = "SELECT * FROM categoria";
                $result = $conn->query($sql);

                if ($result->num_rows > 0): ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row["id_categoria"] ?></td>
                                    <td><?= htmlspecialchars($row["nombre_categoria"]) ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editarCategoriaModal<?= $row["id_categoria"] ?>">Editar</button>
                                        <a href="borrar_categoria.php?id=<?= $row["id_categoria"] ?>" class="btn btn-danger btn-sm">Borrar</a>
                                    </td>
                                </tr>

                                <!-- Modal para editar -->
                                <div class="modal fade" id="editarCategoriaModal<?= $row["id_categoria"] ?>" tabindex="-1" aria-labelledby="editarCategoriaModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Categoría</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="actualizar_categoria.php" method="post">
                                                    <input type="hidden" name="id_categoria" value="<?= $row['id_categoria'] ?>">
                                                    <div class="mb-3">
                                                        <label for="nombre_categoria" class="form-label">Nombre</label>
                                                        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" value="<?= htmlspecialchars($row['nombre_categoria']) ?>" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center">No hay categorías registradas.</p>
                <?php endif; ?>
            </div>

            <!-- Botón para agregar categoría -->
            <div class="text-center">
                <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#agregarCategoriaModal">Agregar Categoría</button>
            </div>
        </div>
    </div>

    <!-- Modal para agregar categoría -->
    <div class="modal fade" id="agregarCategoriaModal" tabindex="-1" aria-labelledby="agregarCategoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insert_categoria.php" method="post">
                        <div class="mb-3">
                            <label for="nombre_categoria" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Crear Categoría</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
