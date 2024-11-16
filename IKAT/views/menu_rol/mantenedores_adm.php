<?php 
  include '../menu_registro/auth.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IKAT - Mantenedor Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="..\..\assets\css\styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


</head>

<body>
  <!-- Header -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/templates/header.php';?>

  <div class="d-flex">

    <div id="sidebar" class="collapse show d-lg-block bg-light" style="width: 250px;">
        <div class="accordion" id="accordionSidebar">
            <!-- Botón Básico -->
            <div class="accordion-item">
                <h4 class="accordion-header" id="headingBasico">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#basicoLinks" aria-expanded="false" aria-controls="basicoLinks">
                        Básico
                    </button>
                </h4>
                <div id="basicoLinks" class="accordion-collapse collapse" aria-labelledby="headingBasico" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body p-0">
                        <ul class="list-unstyled">
                            <li><a href="../../mantenedores/categoria/mostrar_categoria.php" class="sidebar-link d-block py-2 px-3">Categorías</a></li>
                            <li><a href="../../mantenedores/Mantenedor_subcategorias/mostrar_subcategoria.php" class="sidebar-link d-block py-2 px-3">Subcategorías</a></li>
                            <li><a href="../../mantenedores/Mantenedor_metodo_pago/mostrar_metodo_pago.php" class="sidebar-link d-block py-2 px-3">Métodos de Pago</a></li>
                            <li><a href="../../mantenedores/Mantenedor_n_asientos/mostrar_n_asientos.php" class="sidebar-link d-block py-2 px-3">N° Asientos</a></li>
                            <li><a href="../../mantenedores/Mantenedor_n_cajones/mostrar_n_cajones.php" class="sidebar-link d-block py-2 px-3">N° Cajones</a></li>
                            <li><a href="../../mantenedores/Mantenedor_n_plazas/mostrar_n_plazas.php" class="sidebar-link d-block py-2 px-3">N° Plazas</a></li>
                            <li><a href="../../mantenedores/Mantenedor_colores/mostrar_color.php" class="sidebar-link d-block py-2 px-3">Colores</a></li>
                            <li><a href="../../mantenedores/Mantenedor_firmezas/mostrar_firmeza.php" class="sidebar-link d-block py-2 px-3">Firmeza</a></li>
                            <li><a href="../../mantenedores/Mantenedor_materiales/mostrar_material.php" class="sidebar-link d-block py-2 px-3">Materiales</a></li>
                            <li><a href="../../mantenedores/Mantenedor_ambientes/mostrar_ambiente.php" class="sidebar-link d-block py-2 px-3">Ambientes</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <!-- Botón Producto -->
            <div class="accordion-item">
                <h4 class="accordion-header" id="headingProducto">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#productoLinks" aria-expanded="false" aria-controls="productoLinks">
                        Producto
                    </button>
                </h4>
                <div id="productoLinks" class="accordion-collapse collapse" aria-labelledby="headingProducto" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body p-0">
                        <ul class="list-unstyled">
                            <li><a href="../../mantenedores/Mantenedor_producto/mostrar_producto.php" class="sidebar-link d-block py-2 px-3">Productos</a></li>
                            <li><a href="../../mantenedores/Mantenedor_reseña/mostrar_resenia.php" class="sidebar-link d-block py-2 px-3">Reseñas</a></li>
                            <li><a href="../../mantenedores/Mantenedor_top_ventas/mostrar_top_ventas.php" class="sidebar-link d-block py-2 px-3">Ventas</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <!-- Botón Usuario -->
            <div class="accordion-item">
                <h4 class="accordion-header" id="headingUsuario">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#usuarioLinks" aria-expanded="false" aria-controls="usuarioLinks">
                        Usuario
                    </button>
                </h4>
                <div id="usuarioLinks" class="accordion-collapse collapse" aria-labelledby="headingUsuario" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body p-0">
                        <ul class="list-unstyled">
                            <?php if ($_SESSION['tipo_usuario'] == 'Superadmin'): ?>
                                <li><a href="../../mantenedores/Mantenedor_usuario/mostrar_usuario.php" class="sidebar-link d-block py-2 px-3">Usuarios</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">
      <h1></h1>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>