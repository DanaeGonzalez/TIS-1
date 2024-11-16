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
    <link rel="stylesheet" href="..\..\assets\css\styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header/Navbar -->
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
                            <li><a class="dropdown-item" href="../../views/perfil.php">Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../../views/menu_registro/logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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

            <h1 class="text-center p-4">Mantenedor de Categorías</h1>
            <div class="table-responsive">
                <?php
                    if (isset($_GET['id_producto'])) {
                        $id_producto = intval($_GET['id_producto']);
                    
                        $sql = "SELECT * FROM control_stock WHERE id_producto = $id_producto ORDER BY fecha DESC";
                        $result = $conn->query($sql);

                        $sql2 = "SELECT nombre_producto FROM producto WHERE id_producto = $id_producto";
                        $query_nombre = $conn->query($sql2);
                    
                        $nombre = "Desconocido";
                        if ($query_nombre && $query_nombre->num_rows > 0) {
                            $row_nombre = $query_nombre->fetch_assoc();
                            $nombre = $row_nombre['nombre_producto'];
                        }
                    
                        echo "<h2>Historial del Producto: $nombre</h2>";
                        
                        if ($result && $result->num_rows > 0) {
                            echo "<table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>ID Control</th>
                                            <th>ID Producto</th>
                                            <th>Cantidad</th>
                                            <th>Motivo</th>
                                            <th>Explicación</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                    
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["id_control"] . "</td>
                                        <td>" . $row["id_producto"] . "</td>
                                        <td>" . $row["cantidad"] . "</td>
                                        <td>" . $row["motivo"] . "</td>
                                        <td>" . $row["explicacion"] . "</td>
                                        <td>" . $row["fecha"] . "</td>
                                      </tr>";
                            }
                            
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No se encontraron registros de historial para este producto.</p>";
                        }
                        echo "<a href='mostrar_producto.php' class='btn btn-primary mt-3 d-block'>Volver</a>";
                    } else {
                        echo "<p>ID de producto no especificado.</p>";
                        echo "<a href='mostrar_producto.php' class='btn btn-primary mt-3 d-block'>Volver</a>";
                    }
                ?>
            </div>

        </div>
    </div>
    
</body>
</html>

