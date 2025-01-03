<!doctype php>
<php lang="es">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKAT - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets\css\styles.css">
    <link rel="stylesheet" href="assets\css\barra_busqueda_index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
    <script src="assets/js/barraBusquedaIndex.js"></script>
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
            <button class="btn btn-link d-lg-none p-0 button-style-header busqueda-btn" data-bs-toggle="modal"
              data-bs-placement="top" title="Buscar" data-bs-target="#searchModal">
              <i class="bi bi-search fs-4 text-white"></i>
            </button>

            <!-- Botón de catálogo -->
            <a href="views\catalogo.php" class="btn btn-link d-lg-none p-0 button-style-header catalogo-btn"
              data-bs-toggle="tooltip" data-bs-placement="top" title="Ir al catálogo">
              <div class="p-1">
                <i class="bi bi-bag fs-4 text-white"></i>
              </div>
            </a>

            <!-- Botón de lista de deseos -->
            <a href="views/menu_registro/login.php"
              class="btn btn-link p-0 d-lg-none d-flex button-style-header wishlist-btn" data-bs-toggle="tooltip"
              data-bs-placement="top" title="Lista de deseos">
              <div class="p-1">
                <i class="bi bi-heart fs-4 text-white"></i>
              </div>
            </a>

            <!-- Botón del carrito -->
            <a href="views/menu_registro/login.php"
              class="btn btn-link p-0 d-lg-none d-flex button-style-header cart-btn" data-bs-toggle="tooltip"
              data-bs-placement="top" title="Ver carrito">
              <div class="p-1">
                <i class="bi bi-cart fs-4 text-white"></i>
              </div>
            </a>

            <!-- Botón de menú -->
            <button class="btn btn-link d-lg-none p-0 button-style-header menu-btn" data-bs-toggle="collapse"
              data-bs-target="#navbarContent" data-bs-placement="top" title="Ver carrito">
              <i class="bi bi-list fs-4  text-white"></i>
            </button>
          </div>

          <!-- Menú de navegación colapsable -->
          <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-center text-center">

              <li class="nav-item d-flex align-items-center gap-3">

                <!-- Botón de catálogo -->
                <a href="views/catalogo.php" class="btn btn-link d-none d-lg-flex p-0 button-style-header catalogo-btn"
                  data-bs-toggle="tooltip" data-bs-placement="top" title="Ir al catálogo">
                  <div class="p-1">
                    <i class="bi bi-bag fs-4 text-white"></i>
                  </div>
                </a>

                <!-- Botón de lista de deseos -->
                <a href="views/menu_registro/login.php"
                  class="btn btn-link p-0 d-none d-lg-flex button-style-header wishlist-btn" data-bs-toggle="tooltip"
                  data-bs-placement="top" title="Lista de deseos">
                  <div class="p-1">
                    <i class="bi bi-heart fs-4 text-white"></i>
                  </div>
                </a>

                <!-- Botón del carrito -->
                <a href="views/menu_registro/login.php"
                  class="btn btn-link p-0 d-none d-lg-flex button-style-header cart-btn" data-bs-toggle="tooltip"
                  data-bs-placement="top" title="Ver carrito">
                  <div class="p-1">
                    <i class="bi bi-cart fs-4 text-white"></i>
                  </div>
                </a>

                <!-- Menú de usuario -->
                <div class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="/xampp/TIS-1/IKAT/assets/images/profile/01.webp" alt="User Image"
                      class="user-avatar me-2">
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
                    <input type="text" class="form-control"
                      placeholder="Escribe lo que estés buscando: mesa, cama, silla..." aria-label="Buscar productos">
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
            <a href="views/catalogo.php" class="btn btn-dark text-white fw-medium rounded-pill" role="button">Explorar
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
              <a href="views/catalogo.php">
                <img src="assets/images/categoria_silla.png" class="img-fluid categoria-img" alt="Imagen 1">
                <p class="text-overlay">Sillas</p>
              </a>
            </div>


            <div class="col-10 col-md-5 col-lg-4 mb-4 inicio-categoria">
              <a href="views/catalogo.php">
                <img src="assets/images/categoria_mesa.png" class="img-fluid categoria-img" alt="Imagen 2">
                <p class="text-overlay">Mesas</p>
              </a>
            </div>

            <div class="col-10 col-md-5 col-lg-4 mb-4 inicio-categoria">
              <a href="views/catalogo.php">
                <img src="assets/images/categoria_sillon.png" class="img-fluid categoria-img" alt="Imagen 3">
                <p class="text-overlay">Sillones</p>
              </a>
            </div>
          </div>

          <div class="row justify-content-center text-center">

            <div class="col-10 col-md-6 col-lg-6 mb-4 inicio-categoria">
              <a href="views/catalogo.php">
                <img src="assets/images/categoria_organizacion.png" class="img-fluid categoria-img" alt="Imagen 4">
                <p class="text-overlay">Organización</p>
              </a>
            </div>

            <div class="col-10 col-md-6 col-lg-6 mb-4 inicio-categoria">
              <a href="views/catalogo.php">
                <img src="assets/images/categoria_cama.png" class="img-fluid categoria-img" alt="Imagen 5">
                <p class="text-overlay">Camas</p>
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

    <script>
      // Habilitar todos los tooltips
      document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
          new bootstrap.Tooltip(tooltipTriggerEl)
        })
      });
    </script>
  </body>

</php>