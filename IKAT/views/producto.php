<!doctype php>
<php lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Nombre del Producto</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\assets\css\styles.css">
        <link rel="stylesheet" href="..\assets\css\heart.css">
        <?php include '../assets/php/ver_caracteristicas.php'; ?>
        <?php include '../assets/php/ver_resenias.php'; ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../assets/scss/cart.scss">
    </head>

    <body>

        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>

            <!-- Main -->
            <div class="main">
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

                <!-- Contenedor de la barra de búsqueda -->
                <div class="d-none d-lg-flex justify-content-center align-items-center mt-4">
                    <div class="search-container col-lg-7 col-10">
                        <div class="input-group">

                            <input type="text" class="form-control p-2"
                                placeholder="Escribe lo que estés buscando: mesa, cama, silla..."
                                aria-label="Escribe lo que estés buscando: mesa, cama, silla..."
                                aria-describedby="search-addon">
                            <button class="input-group-text" id="search-addon" type="button">
                                <i class="bi bi-search"></i>
                            </button>
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
                        <div class="col-md-6 text-center">
                            <?php //función para ajustar la ruta
                            $ruta_original = $producto['foto_producto'];
                            $ruta_ajustada = str_replace("../../", "../", $ruta_original);
                            ?>
                            <img width="90%" src="<?= $ruta_ajustada ?>" class="img-fluid rounded product-image"
                                style="border: 1px solid #f0f0f0;" alt="Imagen del Producto">
                        </div>


                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center me-2">
                                <h1><?= htmlspecialchars($producto['nombre_producto']) ?></h1>
                                <!-- Botón para agregar a la lista de deseos -->
                                <label class="container_heart"
                                    onclick="agregarAListaDeDeseos(<?= $producto['id_producto'] ?>)">
                                    <input type="checkbox">
                                    <svg id="Layer_1" version="1.0" viewBox="0 0 24 24" xml:space="preserve"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path
                                            d="M16.4,4C14.6,4,13,4.9,12,6.3C11,4.9,9.4,4,7.6,4C4.5,4,2,6.5,2,9.6C2,14,12,22,12,22s10-8,10-12.4C22,6.5,19.5,4,16.4,4z">
                                        </path>
                                    </svg>
                                </label>
                            </div>
                            <h2 class="text-dark ">$<?= number_format($producto['precio_unitario'], 0, ',', '.') ?>
                                <!-- Botón para agregar a la lista de deseos -->
                                <button class="btn btn-danger"
                                    onclick="agregarAListaDeDeseos(<?= $producto['id_producto'] ?>)">
                                    <i class="bi bi-heart"></i> <!-- Icono de corazón -->
                                </button>
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
                            <hr>
                            <h5>Cantidad</h5>


                            <?php
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
                            ?>


                            <!-- Define el stock máximo aquí -->
                            <div class="input-group" style="width: 130px;">
                                <button class="btn btn-outline-dark" type="button" onclick="decrementar()">-</button>
                                <input type="number" id="cantidadInput" value="1" min="1" max="10"
                                    class="form-control text-center custom-input">
                                <button class="btn btn-outline-dark" type="button" onclick="incrementar()">+</button>
                            </div>

                            <div id="resultado">El valor es: 1</div>
                            <div id="stockStatus">Stock disponible: </div>

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
                            <button id="addToCartButton" class="button mt-3"
                                onclick="agregarAlCarrito(<?= $producto['id_producto'] ?>); retrasarRecarga();">
                                <span>Añadir al carrito</span>
                                <div class="cart">
                                    <svg viewBox="0 0 36 26">
                                        <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5"></polyline>
                                        <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                    </svg>
                                </div>
                            </button>

                            <!-- Segundo botón, solo visible cuando el stock es 0 -->
                            <button id="outOfStockButton" class="btn btn-dark mt-3" disabled>
                                <span>Sin stock</span>
                            </button>
                            <hr>
                            <h5>Descripción del producto</h5>
                            <p><?= htmlspecialchars($producto['descripcion_producto']) ?></p>
                        </div>
                    </div>

                    <div class="row mt-4 mb-3">
                        <div class="col-12">
                            <h2>Reseñas del Producto</h2>
                            <?php $resenias = obtenerReseniasProducto($conn, $producto['id_producto']); ?>
                            <?php if (empty($resenias)): ?>
                                <p>No hay reseñas para este producto.</p>
                            <?php else: ?>
                                <?php foreach ($resenias as $resenia): ?>
                                    <div class="mb-3">
                                        <strong><?= htmlspecialchars($resenia['nombre_usuario']) ?></strong>
                                        <p>Calificación: <?= htmlspecialchars($resenia['calificacion']) ?>/5</p>
                                        <p><?= htmlspecialchars($resenia['comentario']) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
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


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

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
                if (cantidad < maxStock) {
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
                    //stockStatus.innerText = "Stock disponible: " + (stockRestante - cantidadSeleccionada);
                    addToCartButton.disabled = false;
                    addToCartButton.classList.remove("disabled-button");
                    addToCartButton.style.display = "inline-block";
                    outOfStockButton.style.display = "none";
                } else {
                    //stockStatus.innerText = "Stock disponible: 0";
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

            document.getElementById("resultado").style.display = "none";
            document.getElementById("stockStatus").style.display = "none";

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
                            document.getElementById('alertError').textContent = data.message || 'Error al agregar el producto a la lista de deseos.';
                            setTimeout(() => document.getElementById('alertError').style.display = 'none', 3000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        </script>
    </body>

</php>