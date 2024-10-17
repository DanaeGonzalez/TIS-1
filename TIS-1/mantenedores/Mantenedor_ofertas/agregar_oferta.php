<?php
include '../conexion.php';
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id_producto"];
    $porcentaje_descuento = $_POST["porcentaje_descuento"];

    $query = "INSERT INTO oferta (id_producto, porcentaje_descuento) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("id", $id_producto, $porcentaje_descuento);

    if ($stmt->execute()) {
        $mensaje = "Oferta agregada con éxito.";
    } else {
        $mensaje = "Error al agregar la oferta.";
    }
}

$query = "SELECT id_producto, nombre_producto FROM producto";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenedor de Ofertas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader&family=Chango&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../menu/styles.css">

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="btn btn-outline border d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
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
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
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
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="collapse d-lg-block">
            <div class="accordion" id="accordionSidebar">
                <div class="accordion-item">
                    <h4 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#mantenedoresLinks">
                            Mantenedores
                        </button>
                    </h4>
                    <div id="mantenedoresLinks" class="accordion-collapse collapse show">
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

        <!-- Content Area -->
        <div class="content-area flex-grow-1 p-5">
            <div class="container p-4">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">Agregar Oferta</h1>

                        <?php if ($mensaje != ''): ?>
                            <p class="text-center"><?php echo $mensaje; ?></p>
                        <?php endif; ?>

                        <form method="post" action="">
                            <label for="id_producto" class="form-label">Selecciona el producto por ID:</label>
                            <select class="form-select" name="id_producto" required>
                                <option value="" disabled selected>Selecciona un producto</option>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <option value="<?php echo $row['id_producto']; ?>">
                                        <?php echo $row['nombre_producto']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>

                            <label for="porcentaje_descuento" class="form-label mt-3">Porcentaje de descuento (0 a 1):</label>
                            <input class="form-control" type="number" step="0.01" min="0" max="1" name="porcentaje_descuento" required>

                            <input class="form-control btn btn-primary d-block mt-4" type="submit" value="Agregar oferta">
                            <a href="mostrar_ofertas.php" class="btn btn-primary mt-3 d-block">Volver</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
