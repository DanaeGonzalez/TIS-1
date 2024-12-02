<!doctype php>
<php lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Nombre del Producto</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Archivos CSS personalizados -->
        <link rel="stylesheet" href="../assets/css/styles.css">
        <link rel="stylesheet" href="../assets/css/reseñas.css">
        <link rel="stylesheet" href="../assets/css/carruselReseñas.css">
        <link rel="stylesheet" href="../assets/css/copy.css">
        <link rel="stylesheet" href="../assets/css/heart.css">
        <link rel="stylesheet" href="../assets/scss/cart.scss">


        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Archivos PHP -->
        <?php include '../assets/php/ver_caracteristicas.php'; ?>
        <?php include '../assets/php/ver_resenias.php'; ?>
    </head>

    <body>

        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>

            <!-- Main -->
            <div class="main py-4">
                <!-- Modal para la barra de búsqueda -->
                <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="searchModalLabel">Buscar productos</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            placeholder="Escribe lo que estés buscando: mesa, cama, silla..."
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


                <!-- Sección del producto -->
                <?php
                include_once '..\config\conexion.php';
                require 'menu_registro\auth.php';
                if (isset($_GET['id'])) {
                    $id_producto = (int) $_GET['id'];


                    $sql = "SELECT * FROM producto WHERE id_producto = ? AND activo = 1";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_producto);
                    $stmt->execute();
                    $resultado = $stmt->get_result();


                    if ($resultado->num_rows > 0) {
                        $producto = $resultado->fetch_assoc();
                    } else {
                        echo "<p>Producto no encontrado.</p>";
                        exit();
                    }
                } else {
                    echo "<p>Falta el ID del producto.</p>";
                    exit();
                }
                ?>

                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 text-center position-relative d-flex">
                            <?php
                            //función para ajustar la ruta
                            $ruta_original = $producto['foto_producto'];
                            $ruta_ajustada = str_replace("../../", "../", $ruta_original);
                            ?>
                            <div class="botonImagen d-flex flex-column align-items-center">
                                <div class="botonCopy d-flex justify-content-end w-100 me-5">
                                    <!-- Botón de compartir (copiar al portapapeles) -->
                                    <button id="copyLinkButton" class="copy" onclick="copyLink()">
                                        <span data-text-end="Copiado!" data-text-initial="Copiar enlace"
                                            class="tooltip py-0"></span>
                                        <span>
                                            <svg xml:space="preserve" style="enable-background:new 0 0 512 512"
                                                viewBox="0 0 6.35 6.35" y="0" x="0" height="20" width="20"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg" class="clipboard">
                                                <g>
                                                    <path fill="currentColor"
                                                        d="M2.43.265c-.3 0-.548.236-.573.53h-.328a.74.74 0 0 0-.735.734v3.822a.74.74 0 0 0 .735.734H4.82a.74.74 0 0 0 .735-.734V1.529a.74.74 0 0 0-.735-.735h-.328a.58.58 0 0 0-.573-.53zm0 .529h1.49c.032 0 .049.017.049.049v.431c0 .032-.017.049-.049.049H2.43c-.032 0-.05-.017-.05-.049V.843c0-.032.018-.05.05-.05zm-.901.53h.328c.026.292.274.528.573.528h1.49a.58.58 0 0 0 .573-.529h.328a.2.2 0 0 1 .206.206v3.822a.2.2 0 0 1-.206.205H1.53a.2.2 0 0 1-.206-.205V1.529a.2.2 0 0 1 .206-.206z">
                                                    </path>
                                                </g>
                                            </svg>
                                            <svg xml:space="preserve" style="enable-background:new 0 0 512 512"
                                                viewBox="0 0 24 24" y="0" x="0" height="18" width="18"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg" class="checkmark">
                                                <g>
                                                    <path data-original="#000000" fill="currentColor"
                                                        d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a.5 1.5 0 0 1 2.121 0l.707.707a.5 1.5 0 0 1 0 2.121z">
                                                    </path>
                                                </g>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                                <div class="imagenProducto">
                                    <img width="90%" src="<?= $ruta_ajustada ?>" class="img-fluid rounded product-image"
                                        style="border: 1px solid #f0f0f0;" alt="Imagen del Producto">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-5">
                            <div class="d-flex justify-content-between align-items-center me-2">
                                <h1><?= htmlspecialchars($producto['nombre_producto']) ?></h1>
                                <select id="currencySelector" class="form-select" style="width: auto;">
                                    <option value="CLP" selected>CLP (Peso chileno)</option>
                                    <option value="USD">USD (Dólar)</option>
                                    <option value="EUR">EUR (Euro)</option>
                                    <option value="GBP">GBP (Libra)</option>
                                </select>


                                <?php
                                //Mostrar si el usuario esta registrado
                                if (isset($_SESSION['id_usuario'])) {
                                    ?>
                                    <?php
                                }
                                ?>
                            </div>
                            <h2 class="text-dark">
                                <span
                                    id="productPrice"><?= number_format($producto['precio_unitario'], 0, ',', '.') ?></span>
                            </h2>


                            <?php
                            //Mostrar si el usuario esta registrado
                            if (isset($_SESSION['id_usuario'])) {
                                ?>
                                <!-- Botón para agregar a la lista de deseos -->
                                <button class="btn btn-danger"
                                    onclick="agregarAListaDeDeseos(<?= $producto['id_producto'] ?>)">
                                    <i class="bi bi-heart"></i> <!-- Icono de corazón -->
                                </button>
                                <?php
                            }

                            ?>

                            </h2>
                            <hr>
                            <h5>Características</h5>
                            <ul>
                                <?php
                                // Obtener las características del producto
                                $caracteristicas = obtenerCaracteristicasProducto($conn, $producto['id_producto']);

                                if (!empty($caracteristicas)) {
                                    foreach ($caracteristicas as $caracteristica) {
                                        echo "<li>" . htmlspecialchars($caracteristica) . "</li>";
                                    }
                                } else {
                                    echo "<li>No hay características disponibles</li>";
                                }
                                ?>
                            </ul>

                            <?php
                            //Mostrar si el usuario esta registrado
                            if (isset($_SESSION['id_usuario'])) {
                                ?>
                                <hr>
                                <div class="cantidades d-flex mb-2">
                                    <h5>Cantidad &nbsp; </h5>
                                    <span id="stockStatus"></span>
                                </div>
                                <?php
                            }
                            ?>


                            <?php
                            //Mostrar si el usuario esta registrado
                            if (isset($_SESSION['id_usuario'])) {
                                $id_usuario = $_SESSION['id_usuario'];

                                // Consulta SQL para obtener el stock del producto
                                $sqlStock = "SELECT stock_producto FROM producto WHERE id_producto = $id_producto";

                                // Ejecutar la consulta
                                $resultStock = $conn->query($sqlStock);

                                // Verificar si la consulta se ejecutó correctamente
                                if (!$resultStock) {
                                    die("Error en la consulta: " . $conn->error);
                                }

                                // Inicializar la variable de stock
                                $stockProducto = 0;

                                if ($resultStock->num_rows > 0) {
                                    // Si existe una fila, obtenemos el stock del producto
                                    $row = $resultStock->fetch_assoc();
                                    $stockProducto = $row['stock_producto'];
                                }

                                // Consulta SQL para obtener la cantidad del producto en el carrito
                                $sqlCantidad = "SELECT cantidad
                            FROM carrito
                            WHERE id_producto = $id_producto AND id_usuario = $id_usuario";

                                // Ejecutar la consulta
                                $resultCantidad = $conn->query($sqlCantidad);

                                // Verificar si la consulta se ejecutó correctamente
                                if (!$resultCantidad) {
                                    die("Error en la consulta: " . $conn->error);
                                }

                                // Inicializar la cantidad en el carrito
                                $cantidadEnCarrito = 0;

                                if ($resultCantidad->num_rows > 0) {
                                    // Si existe una fila, obtenemos la cantidad del producto en el carrito
                                    $row = $resultCantidad->fetch_assoc();
                                    $cantidadEnCarrito = $row['cantidad'];
                                }
                            }
                            ?>


                            <?php
                            //Mostrar si el usuario esta registrado
                            if (isset($_SESSION['id_usuario'])) {

                                ?>
                                <!-- Define el stock máximo aquí -->
                                <div class="input-group" style="width: 130px;">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="decrementar()">-</button>
                                    <input type="number" id="cantidadInput" value="1" min="1" max="10"
                                        class="form-control text-center custom-input border border-secondary" readonly>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="incrementar()">+</button>
                                </div>
                                <div id="resultado" style="display: none;">El valor es: 1</div>
                                <?php
                            }
                            ?>

                            <!-- Alerta de éxito -->
                            <div id="alertSuccess" class="alert alert-success alert-dismissible fade show mt-4"
                                role="alert"
                                style="display: none; position: fixed; top: 20px; right: 20px; z-index: 1050;">
                                Producto agregado al carrito!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <!-- Alerta de error -->
                            <div id="alertError" class="alert alert-danger alert-dismissible fade show mt-4"
                                role="alert"
                                style="display: none; position: fixed; top: 20px; right: 20px; z-index: 1050;">
                                No hay suficiente stock.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <!-- Botón de añadir al carrito -->
                            <button id="addToCartButton" class="button mt-3" style="display: none;"
                                onclick="agregarAlCarrito(<?= $producto['id_producto'] ?>, 'cantidadInput'); retrasarRecarga();">
                                <span class="fw-bold fs-6">Añadir al carrito</span>
                                <div class="cart">
                                    <svg viewBox="0 0 36 26">
                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                    </svg>
                                </div>
                            </button>

                            <!-- Segundo botón, solo visible cuando el stock es 0 -->
                            <button id="outOfStockButton" class="btn btn-dark mt-3 w-100" style="display: none;"
                                disabled>
                                <span>Sin stock</span>
                            </button>

                            <hr>
                            <h5>Descripción del producto</h5>
                            <p><?= htmlspecialchars($producto['descripcion_producto']) ?></p>

                            <?php
                            //Mostrar si el no usuario esta registrado
                            if (!isset($_SESSION['id_usuario'])) {

                                ?>
                                <!-- Alerta con Bootstrap -->
                                <div class="alert alert-info fade show mt-3" role="alert">
                                    <strong>¡Importante!</strong> Por favor, inicia sesión para disfrutar de funciones como
                                    añadir productos al carrito, guardar en tu lista de deseos y mucho más.
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Reseñas antiguo -->

                    <?php
                    include_once '..\config\conexion.php'; // Incluir el archivo de conexión a la base de datos
                    
                    // Validar la existencia de id_producto en la URL
                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                        $idProducto = $_GET['id'];
                        $resenias = obtenerReseniasProducto($conn, $idProducto);
                    } else {
                        echo "ID de producto no válido o no definido.";
                        $idProducto = null;
                        $resenias = [];
                    }


                    ?>

                    <div class="row mt-4 mb-3">
                        <div class="col-12">
                            <h2>Reseñas del Producto</h2>
                            <hr>
                            <div class="container-fluid bg-white py-3">
                                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php if (empty($resenias)): ?>
                                            <div class="carousel-item active">
                                                <div class="card">
                                                    <div class="header">
                                                        <div>
                                                            <p class="name">Sin reseñas</p>
                                                        </div>
                                                    </div>
                                                    <p class="message">
                                                        Este producto aún no tiene reseñas.
                                                    </p>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <?php foreach ($resenias as $index => $resenia): ?>
                                                <div class="carousel-item">
                                                    <div class="card">
                                                        <div class="header">
                                                            <div class="image"><img src="../assets/images/profile/01.webp"
                                                                    alt=""></div>
                                                            <div>
                                                                <div class="stars">
                                                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                                                        <svg fill="<?php echo $i < $resenia['calificacion'] ? 'currentColor' : 'none'; ?>"
                                                                            stroke="currentColor" viewBox="0 0 20 20"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                            </path>
                                                                        </svg>
                                                                    <?php endfor; ?>
                                                                </div>
                                                                <p class="name">
                                                                    <?php echo htmlspecialchars($resenia['nombre_usuario']); ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <p class="message">
                                                            <?php echo htmlspecialchars($resenia['comentario']); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#testimonialCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php
                $conn->close();
                ?>

            </div>

            <!-- Footer -->
            <?php include '../templates/footer.php'; ?>

        </div>


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

        <!-- Archivo JS personalizado -->
        <script src="../assets/js/carruselReseñas.js"></script>
        <script src="../assets/js/carritoDeseos.js"></script>




        <script>
            function retrasarRecarga() {
                // Recarga la página después de 4 segundos
                setTimeout(() => {
                    location.reload();
                }, 4000);
            }
        </script>


        <script>
            // Recibir el stock desde PHP
            let maxStock = <?php echo $stockProducto; ?>;
            let cantidadEnCarrito = <?php echo $cantidadEnCarrito; ?>;


            // Obtener los elementos del DOM
            const cantidadInput = document.getElementById("cantidadInput");
            const resultado = document.getElementById("resultado");
            const stockStatus = document.getElementById("stockStatus");
            const addToCartButton = document.getElementById("addToCartButton");
            const outOfStockButton = document.getElementById("outOfStockButton");

            // Función que actualiza el valor en el div
            function actualizarValor() {
                resultado.innerText = "El valor es: " + cantidadInput.value;
                actualizarStock();
            }

            // Función para incrementar la cantidad
            function incrementar() {
                let cantidad = parseInt(cantidadInput.value);
                let stockRestante = maxStock - cantidadEnCarrito - cantidad;

                if (stockRestante > 0) {
                    cantidadInput.value = cantidad + 1;
                    actualizarValor();
                }
            }

            // Función para decrementar la cantidad
            function decrementar() {
                let cantidad = parseInt(cantidadInput.value);
                if (cantidad > 1) {
                    cantidadInput.value = cantidad - 1;
                    actualizarValor();
                }
            }

            // Función que actualiza el estado del stock (mensaje de disponibilidad)
            function actualizarStock() {
                const cantidadSeleccionada = parseInt(cantidadInput.value);

                // Calcula el stock restante en tiempo real
                const stockRestante = maxStock - cantidadEnCarrito;

                // Actualiza el máximo permitido para el input de cantidad
                cantidadInput.max = stockRestante;

                // Corrige el valor si excede el stock restante
                if (cantidadSeleccionada > stockRestante) {
                    cantidadInput.value = stockRestante;
                }

                // Actualiza el mensaje de stock disponible y estado de los botones
                if (stockRestante > 0) {
                    stockStatus.innerText = `( ${stockRestante - cantidadSeleccionada} ) disponibles`;
                    addToCartButton.disabled = false;
                    addToCartButton.classList.remove("disabled-button");
                    addToCartButton.style.display = "inline-block";
                    outOfStockButton.style.display = "none";
                } else {
                    stockStatus.innerText = `( 0 ) disponibles`;
                    addToCartButton.disabled = true;
                    addToCartButton.classList.add("disabled-button");
                    addToCartButton.style.display = "none";
                    outOfStockButton.style.display = "inline-block";
                }
            }

            // Escuchar cambios en el input
            cantidadInput.addEventListener("input", function () {
                let cantidad = parseInt(cantidadInput.value);
                if (cantidad > maxStock) {
                    cantidadInput.value = maxStock;
                }
                actualizarValor();
            });

            // Inicializar el valor al cargar la página
            actualizarValor();
        </script>



        <script>
            function agregarAlCarrito(productId) {

                // Obtén el valor de la cantidad desde el input
                const cantidad = document.getElementById('cantidadInput').value;

                fetch('../assets/php/agregaralCarrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id_producto: productId,
                        cantidad: parseInt(cantidad)
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('alertSuccess').style.display = 'block';
                            setTimeout(() => document.getElementById('alertSuccess').style.display = 'none', 3000);
                        } else {
                            document.getElementById('alertError').style.display = 'block';
                            setTimeout(() => document.getElementById('alertError').style.display = 'none', 3000);
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
        </script>
        <script>
            document.querySelectorAll('.button').forEach(button => button.addEventListener('click', e => {
                if (!button.classList.contains('loading')) {
                    button.classList.add('loading');
                    setTimeout(() => button.classList.remove('loading'), 3700);
                }
                e.preventDefault();
            }));
        </script>
        <script>
            function agregarAListaDeDeseos(productId) {
                fetch('../assets/php/agregarAdeseos.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id_producto: productId
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('alertSuccess').style.display = 'block';
                            document.getElementById('alertSuccess').textContent = 'Producto agregado a la lista de deseos!';
                            setTimeout(() => document.getElementById('alertSuccess').style.display = 'none', 3000);
                        } else {
                            document.getElementById('alertError').style.display = 'block';
                            document.getElementById('alertError').textContent = data.message || 'El producto ya se encuentra en la lista de deseos.';
                            setTimeout(() => document.getElementById('alertError').style.display = 'none', 3000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        </script>

        <script>
            // Función para copiar el enlace al portapapeles
            function copyLink() {
                // Obtiene la URL de la página actual
                var currentUrl = window.location.href;

                // Crea un elemento de texto temporal para copiar el enlace
                var tempInput = document.createElement('input');
                tempInput.value = currentUrl;
                document.body.appendChild(tempInput);

                // Selecciona y copia el texto
                tempInput.select();
                document.execCommand('copy');

                // Elimina el elemento temporal
                document.body.removeChild(tempInput);
            }
        </script>
        <script>
            const API_KEY = '733c6075a58957fdec754104f8e961eb';
            const BASE_URL = 'https://data.fixer.io/api/';
            const baseCurrency = 'EUR'; // Usar EUR como base por ser la permitida por FIXER
            const originalPrice = <?= $producto['precio_unitario'] ?>; // Precio original en CLP
            const currencySelector = document.getElementById('currencySelector');
            const productPriceElement = document.getElementById('productPrice');

            // Función para obtener las tasas de cambio
            async function getExchangeRate(toCurrency) {
                const cacheKey = `exchangeRate_${toCurrency}`;
                const cacheTimeKey = `exchangeRateTime_${toCurrency}`;
                const now = Date.now();

                // Verifica si la tasa está en caché
                const cachedRate = localStorage.getItem(cacheKey);
                const cachedTime = localStorage.getItem(cacheTimeKey);

                if (cachedRate && cachedTime && now - cachedTime < 3600) { // 1 hora
                    return parseFloat(cachedRate);
                }

                // Si no está en caché, realiza la solicitud
                try {
                    const response = await fetch(`${BASE_URL}latest?access_key=${API_KEY}&base=${baseCurrency}&symbols=${toCurrency}`);
                    const data = await response.json();
                    if (data.success) {
                        const rate = data.rates[toCurrency];
                        localStorage.setItem(cacheKey, rate);
                        localStorage.setItem(cacheTimeKey, now);
                        return rate;
                    } else {
                        console.error('Error en la API:', data.error);
                        return null;
                    }
                } catch (error) {
                    console.error('Error en la petición:', error);
                    return null;
                }
            }

            // Función para actualizar el precio en base a la moneda seleccionada
            async function updatePrice() {
                const selectedCurrency = currencySelector.value; // Obtener la moneda seleccionada

                // Si la moneda seleccionada es CLP, simplemente mostrar el precio original sin conversiones
                if (selectedCurrency === 'CLP') {
                    productPriceElement.textContent = new Intl.NumberFormat('es-CL', {
                        style: 'currency',
                        currency: 'CLP'
                    }).format(originalPrice);
                    return;
                }

                const exchangeRate = await getExchangeRate(selectedCurrency); // Obtener la tasa de cambio

                // Manejo de error si no se puede obtener la tasa de cambio
                if (!exchangeRate) {
                    alert('No se pudo obtener la tasa de cambio. Mostrando precio original.');
                    productPriceElement.textContent = new Intl.NumberFormat('es-CL', {
                        style: 'currency',
                        currency: 'CLP'
                    }).format(originalPrice);
                    return; // Salir de la función para evitar errores posteriores
                }

                // Calcular y mostrar el precio convertido
                const convertedPrice = originalPrice * exchangeRate;
                productPriceElement.textContent = new Intl.NumberFormat('es-CL', {
                    style: 'currency',
                    currency: selectedCurrency
                }).format(convertedPrice);
            }

            // Inicializar el precio en CLP por defecto al cargar la página
            function initializeDefaultPrice() {
                productPriceElement.textContent = new Intl.NumberFormat('es-CL', {
                    style: 'currency',
                    currency: 'CLP'
                }).format(originalPrice);
            }

            // Evento para detectar cambios en el selector de moneda
            currencySelector.addEventListener('change', updatePrice);

            // Llamar la función de inicialización al cargar la página
            document.addEventListener('DOMContentLoaded', initializeDefaultPrice);

        </script>
    </body>

</php>