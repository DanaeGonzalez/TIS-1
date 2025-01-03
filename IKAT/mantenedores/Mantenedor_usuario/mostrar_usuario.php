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
    <title>IKAT - Mantenedor de Usuarios</title>
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

            <h1 class="text-center p-4">Mantenedor de Usuarios</h1>

            <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-success" data-bs-toggle='modal' data-bs-target='#agregarUsuarioModal'>
                        <i class="bi bi-file-earmark-plus"></i>
                    </a>
                </div>
            
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
                                        <th>Activo</th>
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
                                    <td>{$row['activo']}</td>
                                    <td>   
                                        <div class='d-flex justify-content-center flex-wrap gap-1'>
                                            <div class='btn-group d-block d-sm-none'> <!-- Dropdown para pantallas pequeñas -->
                                                <button type='button' class='btn btn-secondary btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                                                    <i class='bi bi-gear'></i>
                                                </button>
                                                <ul class='dropdown-menu'>
                                                    <li><a class='dropdown-item' data-bs-toggle='modal' data-bs-target='#editarUsuarioModal" . $row["id_usuario"] . "'>
                                                        <i class='bi bi-pen'></i> Editar
                                                    </a></li>
                                                    <li><a class='dropdown-item' data-bs-toggle='modal' data-bs-target='#modificarPuntosModal" . $row["id_usuario"] . "'>
                                                        <i class='bi bi-plus-circle'></i> Modificar puntos
                                                    </a></li>
                                                    <li><a class='dropdown-item' href='cambiar_estado_producto.php?id=" . $row["id_usuario"] . "'>
                                                        <i class='bi bi-trash3'></i> Cambiar estado
                                                    </a></li>
                                                </ul>
                                            </div>
                                            <div class='d-none d-sm-flex flex-wrap gap-1'> <!-- Botones normales para pantallas grandes -->
                                                <a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarUsuarioModal" . $row["id_usuario"] . "'>
                                                    <i class='bi bi-pen'></i>
                                                </a>
                                                <a class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modificarPuntosModal" . $row["id_usuario"] . "'>
                                                    <i class='bi bi-plus-circle'></i>
                                                </a>
                                                <a href='cambiar_estado_producto.php?id=" . $row["id_usuario"] . "' class='btn btn-danger btn-sm'>
                                                    <i class='bi bi-trash3'></i>
                                                </a>
                                            </div>
                                        </div>
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

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                            echo "
                            <div class='modal fade' id='modificarPuntosModal" . $row["id_usuario"] . "' tabindex='-1' aria-labelledby='modificarPuntosModalLabel" . $row["id_usuario"] . "' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='modificarPuntosModalLabel" . $row["id_usuario"] . "'>Modificar Puntos de Usuario</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <form action='modificar_puntos_usuario.php' method='post'>
                                                <input type='hidden' name='id_usuario' value='" . $row['id_usuario'] . "'>
                                                    
                                                <label for='cantidad_modificar' class='form-label mt-3'>Cantidad a modificar (Negativo para descontar):</label>
                                                <input class='form-control' type='number' name='cantidad_modificar' id='cantidad_modificar" . $row["id_usuario"] . "' required>

                                                <input class='form-control btn btn-primary d-block mt-3' type='submit' value='Actualizar puntos'>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";

                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p class='text-center'>No hay usuarios registrados.</p>";
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
