<?php
include '../menu_registro/auth.php';
?>

<!doctype php>
<php lang="es">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKAT - Página de Inicio </title>
    <link rel="stylesheet" href="..\..\assets\css\styles.css">
    <link rel="stylesheet" href="../../assets\css\barra_busqueda_index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../../assets/js/barraBusquedaIndex.js"></script>
  </head>

  <body>
    <!-- Header/Navbar -->
    <?php include '../../templates/header.php'; ?>
    <!-- Main -->
    <div class="main">
      <!-- Modal para la barra de búsqueda -->
      <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="searchModalLabel">Buscar productos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Escribe lo que estés buscando: mesa, cama, silla..."
                    aria-label="Buscar productos">
                  <button class="btn btn-dark" type="submit">
                    Buscar
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Contenedor de la barra de búsqueda sobre el carrusel -->
      <div class="search-bar-container d-none d-lg-flex">
          <input id="buscarInputIndex" class="form-control d-inline w-75" type="text"
            placeholder="Escribe lo que estés buscando: mesa, cama, silla..."
            onfocus="barraBusquedaIndex()" oninput="barraBusquedaIndex()">
          <div id="listaIndex" class="list-group position-absolute d-none"></div>

          <div class="explore-button">
            <a href="../catalogo.php" class="btn btn-dark text-white fw-medium rounded-pill" role="button">Explorar
              productos</a>
          </div>
        </div>

      <!-- Carousel -->
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://images.pexels.com/photos/1743226/pexels-photo-1743226.jpeg" alt="...">
            <div class="carousel-caption mx-auto bg-dark bg-opacity-50">
              <h5>Muebles ideales para tu hogar</h5>
              <p>Transforma cada espacio en un rincón único y acogedor.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="https://images.pexels.com/photos/6969995/pexels-photo-6969995.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=5"
              class="d-block w-100 img-fluid" alt="...">
            <div class="carousel-caption mx-auto bg-dark bg-opacity-50">
              <h5>Diseños excepcionales para tu hogar</h5>
              <p>Convierte cada habitación en un lugar lleno de estilo y confort.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="https://images.pexels.com/photos/1571463/pexels-photo-1571463.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2   "
              class="d-block w-100 img-fluid" alt="...">
            <div class="carousel-caption mx-auto bg-dark bg-opacity-50">
              <h5>Encuentra el mueble perfecto</h5>
              <p>Diseños exclusivos que se adaptan a tu estilo y necesidades.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!-- Contenedor inicio -->
      <div class="container inicio mt-5">
        <div class="row justify-content-center text-center">
          <div class="col-10 col-md-5 col-lg-4 mb-4 inicio-categoria">
            <a href="../catalogo.php">
              <img src="../../assets/images/categoria_silla.png" class="img-fluid categoria-img" alt="Imagen 1">
              <p class="text-overlay">Sillas</p>
            </a>
          </div>
          <div class="col-10 col-md-5 col-lg-4 mb-4 inicio-categoria">
            <a href="../catalogo.php">
              <img src="../../assets/images/categoria_mesa.png" class="img-fluid categoria-img" alt="Imagen 2">
              <p class="text-overlay">Mesas</p>
            </a>
          </div>
          <div class="col-10 col-md-5 col-lg-4 mb-4 inicio-categoria">
            <a href="../catalogo.php">
              <img src="../../assets/images/categoria_sillon.png" class="img-fluid categoria-img" alt="Imagen 3">
              <p class="text-overlay">Sillones</p>

            </a>
          </div>
        </div>

        <div class="row justify-content-center text-center">
          <div class="col-10 col-md-6 col-lg-6 mb-4 inicio-categoria">
            <a href="../catalogo.php">
              <img src="../../assets/images/categoria_organizacion.png" class="img-fluid categoria-img" alt="Imagen 4">
              <p class="text-overlay">Organización</p>
            </a>
          </div>
          <div class="col-10 col-md-6 col-lg-6 mb-4 inicio-categoria">
            <a href="../catalogo.php">
              <img src="../../assets/images/categoria_cama.png" class="img-fluid categoria-img" alt="Imagen 5">
              <p class="text-overlay">Camas</p>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include '../../templates/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  </body>

</php>