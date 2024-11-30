<?php
include '../../config/conexion.php';
session_start();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $id_usuario = $_POST['id_usuario'];
    $id_producto = $_POST['id_producto'];

    $sql = "INSERT INTO resenia (calificacion, comentario, activo, id_usuario, id_producto)
            VALUES ($calificacion, '$comentario',1, $id_usuario, $id_producto)";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Nueva reseña creada exitosamente";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
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
    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/templates/header.php';?>
    
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
        <div class="content-area flex-grow-1 p-5">
            <div class="container p-4">
                <div class="row">
                    <div class="col-12">

                        <h1 class="text-center">Agregar Reseña</h1>

                        <?php if ($mensaje != ''): ?>
                            <p class="text-center"><?php echo $mensaje; ?></p>
                        <?php endif; ?>

                        <form action="" method="post">
                            Calificación (1-5): <input class="form-control" type="number" step="1" min="1" max="5" name="calificacion" required><br>
                            Comentario: <input class="form-control" type="text" name="comentario"><br>

                            <select class="form-select mb-4" name="id_usuario" required>
                                <option value="" disabled selected>Selecciona un usuario</option>
                                <?php
                                    $sqlUsuario = "SELECT id_usuario, nombre_usuario FROM usuario";
                                    $resultUsuario = $conn->query($sqlUsuario);
                                    while($usuario = $resultUsuario->fetch_assoc()) {
                                        echo "<option value='" . $usuario['id_usuario'] . "'>" . $usuario['nombre_usuario'] . "</option>";
                                    }
                                ?>
                            </select>
                                
                            <select class="form-select mb-4" name="id_producto" required>
                                <option value="" disabled selected>Selecciona un producto</option>
                                <?php
                                    $sqlProducto = "SELECT id_producto, nombre_producto FROM producto";
                                    $resultProducto = $conn->query($sqlProducto);
                                    while($producto = $resultProducto->fetch_assoc()) {
                                        echo "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre_producto'] . "</option>";
                                    }
                                ?>
                            </select>
                                
                            <input class="form-control btn btn-primary d-block" type="submit" value="Crear Reseña">
                            <a href="mostrar_resenia.php" class='btn btn-primary mt-3 d-block'>Volver</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
