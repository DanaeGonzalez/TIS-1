<?php
include '../../config/conexion.php';
session_start();

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']);

$sqlProductos = "SELECT id_producto, nombre_producto FROM producto";
$resultProductos = $conn->query($sqlProductos);

$productos = [];

if ($resultProductos->num_rows > 0) {
    while($rowProducto = $resultProductos->fetch_assoc()) {
        $productos[] = $rowProducto;
    }
}
$opcionesProducto = "";
foreach ($productos as $producto) {
    $opcionesProducto .= "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre_producto'] . "</option>";
}


$sqlUsuarios = "SELECT id_usuario, nombre_usuario FROM usuario";
$resultUsuarios = $conn->query($sqlUsuarios);
$usuarios = [];

if ($resultUsuarios->num_rows > 0) {
    while($rowUsuario = $resultUsuarios->fetch_assoc()) {
        $usuarios[] = $rowUsuario;
    }
}

$opcionesUsuario = "";
foreach ($usuarios as $usuario) {
    $opcionesUsuario .= "<option value='" . $usuario['id_usuario'] . "'>" . $usuario['nombre_usuario'] . "</option>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKAT - Mantenedor de Reseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\..\assets\css\styles.css">

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

            <h1 class="text-center p-4">Mantenedor de Reseñas</h1>

            <?php
                if ($_SESSION['tipo_usuario'] == 'Superadmin') {
                            echo '<div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearResenaModal">
                        <i class="bi bi-file-earmark-plus"></i>
                    </a>
                </div>';
                        }
            ?>
            
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
                                            <button type='submit' class='btn btn-primary'>Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        ";
                        echo "
                        <div class='modal fade' id='crearResenaModal' tabindex='-1' aria-labelledby='crearResenaModalLabel' aria-hidden='true'>
                            <div class='modal-dialog'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='crearResenaModalLabel'>Crear Reseña</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <form action='insertar_resenia.php' method='POST'>
                                            <label for='calificacion' class='form-label'>Calificación (1-5):</label>
                                            <input class='form-control' type='number' step='1' min='1' max='5' name='calificacion' required><br>

                                            <label for='comentario' class='form-label'>Comentario:</label>
                                            <input class='form-control' type='text' name='comentario'><br>

                                            <label for='id_usuario' class='form-label'>Usuario:</label>
                                            <select class='form-select mb-4' name='id_usuario' required>
                                                <option value='' disabled selected>Selecciona un usuario</option>
                                                $opcionesUsuario
                                            </select>

                                            <label for='id_producto' class='form-label'>Producto:</label>
                                            <select class='form-select mb-4' name='id_producto' required>
                                                <option value='' disabled selected>Selecciona un producto</option>
                                                $opcionesProducto
                                            </select>

                                            <input class='form-control btn btn-primary d-block' type='submit' value='Crear Reseña'>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";


                        
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

                } 
            ?>

            </div>
        </div>
    </div>
    
</body>
</html>
