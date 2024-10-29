<?php
include '../conexion.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mantenedor de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../menu/styles.css">

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
                    <h4 class="accordion-header" id="headingMantenedores">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#mantenedoresLinks" aria-expanded="true" aria-controls="mantenedoresLinks">
                            Mantenedores
                        </button>
                    </h4>
                    <div id="mantenedoresLinks" class="accordion-collapse collapse show" aria-labelledby="headingMantenedores"
                         data-bs-parent="#accordionSidebar">
                        <div class="accordion-body p-0">
                            <a href="../categoria/mostrar_categoria.php" class="sidebar-link">Categorías</a>
                            <a href="../Mantenedor_subcategorias/mostrar_subcategoria.php" class="sidebar-link">Subcategorías</a>
                            <a href="../Mantenedor_metodo_pago/mostrar_metodo_pago.php" class="sidebar-link">Métodos de pago</a>
                            <a href="../Mantenedor_producto/mostrar_producto.php" class="sidebar-link">Productos</a>
                            <a href="../Mantenedor_reseña/mostrar_resenia.php" class="sidebar-link">Reseñas</a>
                            <a href="../Mantenedor_top_ventas/mostrar_top_ventas.php" class="sidebar-link">Ventas</a>
                            <a href="../Mantenedor_usuario/mostrar_usuario.php" class="sidebar-link">Usuarios</a>
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
            <div class="row">
                <div class="col-12 p-4 d-flex flex-column justify-content-center align-items-center">

                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "DELETE FROM n_cajones WHERE id_n_cajones = $id";
                    
                        if ($conn->query($sql) === TRUE) {
                            echo "Cajones eliminado exitosamente <br>";
                            echo "<a href='mostrar_n_cajones.php' class='btn btn-primary mt-3 d-block'>Volver</a>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>
</html>
