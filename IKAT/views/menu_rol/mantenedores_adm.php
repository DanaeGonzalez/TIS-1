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
    <!-- Sidebar -->
    <div id="sidebar" class="collapse d-lg-block">
      <div class="accordion" id="accordionSidebar">
        <!-- Título: Mantenedores -->
        <div class="accordion-item">
          <h4 class="accordion-header" id="headingMantenedores">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#mantenedoresLinks"
              aria-expanded="true" aria-controls="mantenedoresLinks">
              Mantenedores
            </button>
          </h4>
          <!-- Enlaces de Mantenedores -->
          <div id="mantenedoresLinks" class="accordion-collapse collapse show" aria-labelledby="headingMantenedores"
            data-bs-parent="#accordionSidebar">
            <div class="accordion-body p-0">
              <a href="../../mantenedores/categoria/mostrar_categoria.php" class="sidebar-link">Categorías</a>
              <a href="../../mantenedores/Mantenedor_subcategorias/mostrar_subcategoria.php"
                class="sidebar-link">Subcategorías</a>
              <a href="../../mantenedores/Mantenedor_metodo_pago/mostrar_metodo_pago.php" class="sidebar-link">Métodos
                de pago</a>
              <a href="../../mantenedores/Mantenedor_producto/mostrar_producto.php" class="sidebar-link">Productos</a>
              <a href="../../mantenedores/Mantenedor_reseña/mostrar_resenia.php" class="sidebar-link">Reseñas</a>
              <a href="../../mantenedores/Mantenedor_top_ventas/mostrar_top_ventas.php" class="sidebar-link">Ventas</a>
              <a href="../../mantenedores/Mantenedor_n_asientos/mostrar_n_asientos.php"
                class="sidebar-link">N°Asientos</a>
              <a href="../../mantenedores/Mantenedor_n_cajones/mostrar_n_cajones.php" class="sidebar-link">N°Cajones</a>
              <a href="../../mantenedores/Mantenedor_n_plazas/mostrar_n_plazas.php" class="sidebar-link">N°Plazas</a>
              <a href="../../mantenedores/Mantenedor_colores/mostrar_color.php" class="sidebar-link">Colores</a>
              <a href="../../mantenedores/Mantenedor_firmezas/mostrar_firmeza.php" class="sidebar-link">Firmeza</a>
              <a href="../../mantenedores/Mantenedor_materiales/mostrar_material.php"
                class="sidebar-link">Materiales</a>
              <a href="../../mantenedores/Mantenedor_ambientes/mostrar_ambiente.php" class="sidebar-link">Ambientes</a>
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