<!doctype php>
<php lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKAT - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets\css\styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  </head>

  <body>

    <div class="container-f">
      <!-- Header/Navbar -->
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a href="index.php">
            <img width="180px" height="auto" src="assets\images\ikat.png" alt="Ikat">
          </a>

          <div class="d-flex align-items-center justify-content-end gap-3 ms-auto">

            <!-- Botón de búsqueda -->
            <button class="btn btn-link d-lg-none p-0" data-bs-toggle="modal" data-bs-target="#searchModal">
              <i class="bi bi-search fs-4  text-secondary"></i>
            </button>

            <!-- Botón de catálogo -->
            <a href="views\catalogo.php" class="btn btn-link d-lg-none p-0">
              <i class="bi bi-bag fs-4 text-secondary"></i>
            </a>

            <!-- Botón de lista de deseos -->
            <a href="..\deseados.php" class="btn btn-link p-0 d-lg-none d-flex">
              <i class="bi bi-heart fs-4 text-secondary"></i>
            </a>

            <!-- Botón del carrito -->
            <a href="..\carrito.php" class="btn btn-link p-0 d-lg-none d-flex">
              <i class="bi bi-cart fs-4 text-secondary"></i>
            </a>

            <!-- Botón de menú -->
            <button class="btn btn-link d-lg-none p-0" data-bs-toggle="collapse" data-bs-target="#navbarContent">
              <i class="bi bi-list fs-4  text-secondary"></i>
            </button>
          </div>

          <!-- Menú de navegación colapsable -->
          <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-center text-center">

              <li class="nav-item d-flex align-items-center gap-3">

                <!-- Botón de catálogo -->
                <a href="..\catalogo.php" class="btn btn-link d-none d-lg-flex p-0">
                  <i class="bi bi-bag fs-4 text-secondary"></i>
                </a>

                <!-- Botón de lista de deseos -->
                <a href="..\deseados.php" class="btn btn-link p-0 d-none d-lg-flex">
                  <i class="bi bi-heart fs-4 text-secondary"></i>
                </a>

                <!-- Botón del carrito -->
                <a href="..\carrito.php" class="btn btn-link p-0 d-none d-lg-flex">
                  <i class="bi bi-cart fs-4 text-secondary"></i>
                </a>
                <!-- Menú de usuario -->
                <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img
                      src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg"
                      alt="User Image" class="user-avatar me-2">
                    Usuario
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href=" views\menu_registro\registro.php">Registrarse</a></li>
                    <li><a class="dropdown-item" href="views\menu_registro\login.php">Iniciar sesión</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>

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
                    <input type="text" class="form-control" placeholder="Buscar productos..."
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
          <input class="form-control d-inline w-75" type="text" placeholder="Buscar productos...">
          <button class="btn btn-dark d-inline" type="submit">
            <i class="bi bi-search"></i>
          </button>

          <!-- Boton de busqueda -->
          <div class="explore-button">
            <a href="views\catalogo.php" class="btn btn-dark text-white fw-medium rounded-pill" role="button">Explorar
              productos</a>
          </div>
        </div>

        <!-- Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide">
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
              <div class="carousel-caption">
                <h5>Muebles ideales para tu hogar</h5>
                <p>Transforma cada espacio en un rincón único y acogedor.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img
                src="https://images.pexels.com/photos/6969995/pexels-photo-6969995.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=5"
                class="d-block w-100 img-fluid" alt="...">
              <div class="carousel-caption">
                <h5>Muebles ideales para tu hogar</h5>
                <p>Transforma cada espacio en un rincón único y acogedor.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img
                src="https://images.pexels.com/photos/1571463/pexels-photo-1571463.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2   "
                class="d-block w-100 img-fluid" alt="...">
              <div class="carousel-caption">
                <h5>Muebles ideales para tu hogar</h5>
                <p>Transforma cada espacio en un rincón único y acogedor.</p>
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
            <div class="col-10 col-md-5 col-lg-4 mb-4">
              <a href="views/catalogo_silla.php">
                <img src="assets/images/categoria_silla.png" class="img-fluid categoria-img" alt="Imagen 1">
              </a>
            </div>
            <div class="col-10 col-md-5 col-lg-4 mb-4">
              <a href="views/catalogo_mesa.php">
                <img src="assets/images/categoria_mesa.png" class="img-fluid categoria-img" alt="Imagen 2">
              </a>
            </div>
            <div class="col-10 col-md-5 col-lg-4 mb-4">
              <a href="views/catalogo_sillon.php">
                <img src="assets/images/categoria_sillon.png" class="img-fluid categoria-img" alt="Imagen 3">
              </a>
            </div>
          </div>

          <div class="row justify-content-center text-center">
            <div class="col-10 col-md-6 col-lg-6 mb-4">
              <a href="views/catalogo_organizacion.php">
                <img src="assets/images/categoria_organizacion.png" class="img-fluid categoria-img" alt="Imagen 4">
              </a>
            </div>
            <div class="col-10 col-md-6 col-lg-6 mb-5">
              <a href="views/catalogo_cama.php">
                <img src="assets/images/categoria_cama.png" class="img-fluid categoria-img" alt="Imagen 5">
              </a>
            </div>
          </div>
        </div>

      </div>

      <!-- Footer -->
      <footer class="py-4">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-3 mb-3 text-center text-md-start">
              <h5>¡Únete a la familia IKAT!</h5>
              <div class="col-md-9 col-12">
                Regístrate y disfruta de la experiencia completa de IKAT.
                <div class="text-center">
                  <a href="views\menu_registro\registro.php"
                    class="btn btn-light border-dark btn-sm mt-3 text-black text-decoration-none">
                    Registrarme
                  </a>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-3 mb-3 text-center text-md-start">
              <h5>Servicio</h5>
              <ul class="list-unstyled">
                <li><a href="#" class="text-black text-decoration-none">Sigue tu pedido</a></li>
                <li><a href="#" class="text-black text-decoration-none">IKAT Points</a></li>
                <li><a href="#" class="text-black text-decoration-none">Despacho a domicilio</a></li>
                <li><a href="#" class="text-black text-decoration-none">Métodos de pago</a></li>
              </ul>
            </div>

            <div class="col-12 col-md-3 mb-3 text-center text-md-start">
              <h5>Sobre IKAT</h5>
              <ul class="list-unstyled">
                <li><a href="#" class="text-black text-decoration-none">Quienes somos</a></li>
                <li><a href="#" class="text-black text-decoration-none">Misión y Visión</a></li>
              </ul>
            </div>

            <div class="col-12 col-md-3 mb-3 text-center text-md-start">
              <h5>Redes Sociales</h5>
              <ul class="list-unstyled">
                <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-facebook"></i> Facebook</a></li>
                <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-instagram"></i> Instagram</a>
                </li>
                <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-threads"></i> Threads</a></li>
                <li><a href="#" class="text-black text-decoration-none"><i class="bi bi-twitter-x"></i> X</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
  </body>

</php>