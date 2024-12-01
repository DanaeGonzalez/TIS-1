<?php
include 'menu_registro/auth.php';
include_once '..\config\conexion.php';
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKAT - Lista de Deseados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/scss/delete.scss">
    <link rel="stylesheet" href="../assets/scss/cartPequeño.scss">
    <link rel="stylesheet" href="../assets/scss/cart.scss">



</head>

<body>
    <div class="container-f">
        <!-- Header/Navbar -->
        <?php include '../templates/header.php'; ?>

        <!-- Main -->
        <div class="main">
            <!-- Contenedor deseados -->
            <div class="container mt-4">
                <div class="row">
                    <h1 class="text-center mb-3">Productos deseados</h1>
                    <hr>
                    <div class="col-12 col-md-7">
                        <div class="list-group">
                            <?php
                            $id_usuario = $_SESSION['id_usuario'];

                            // Verificar si el usuario ya tiene una lista de deseos
                            $consulta_lista = $conn->prepare("SELECT id_lista_deseos FROM lista_de_deseos WHERE id_usuario = ?");
                            $consulta_lista->bind_param("i", $id_usuario);
                            $consulta_lista->execute();
                            $resultado_lista = $consulta_lista->get_result();

                            if ($resultado_lista->num_rows === 0) {
                                // Crear una lista de deseos si no existe
                                $crear_lista = $conn->prepare("INSERT INTO lista_de_deseos (id_usuario) VALUES (?)");
                                $crear_lista->bind_param("i", $id_usuario);
                                $crear_lista->execute();
                                $id_lista_deseos = $crear_lista->insert_id;
                            } else {
                                // Obtener el id de la lista de deseos existente
                                $fila_lista = $resultado_lista->fetch_assoc();
                                $id_lista_deseos = $fila_lista['id_lista_deseos'];
                            }

                            // Obtener productos de la lista de deseos
                            $consulta_productos = $conn->prepare("
                    SELECT p.id_producto, p.nombre_producto, p.precio_unitario, p.foto_producto 
                    FROM lista_deseos_producto ldp
                    JOIN producto p ON ldp.id_producto = p.id_producto
                    WHERE ldp.id_lista_deseos = ?
                ");
                            $consulta_productos->bind_param("i", $id_lista_deseos);
                            $consulta_productos->execute();
                            $resultado_productos = $consulta_productos->get_result();

                            $productos_deseados = [];
                            $total_precio = 0;

                            if ($resultado_productos->num_rows > 0) {
                                while ($producto = $resultado_productos->fetch_assoc()) {
                                    $productos_deseados[] = $producto; // Almacenar productos para el resumen
                                    $total_precio += $producto['precio_unitario'];
                                    ?>
                                    <div
                                        class="list-group-item d-flex justify-content-between align-items-center bg-light border mb-4 rounded shadow-sm p-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="d-flex align-items-center" style="cursor: pointer;">
                                                <a href="producto.php?id=<?= $producto['id_producto']; ?>">
                                                    <?php
                                                    // Ajustar la ruta de la imagen
                                                    $ruta_original = $producto['foto_producto'];
                                                    $ruta_ajustada = str_replace("../../", "../", $ruta_original);
                                                    ?>
                                                    <img src="<?= $ruta_ajustada ?>" alt="<?= $producto['nombre_producto']; ?>"
                                                        class="me-3 rounded img-fluid" style="max-width: 150px;">
                                                </a>
                                                <div>
                                                    <h4 class="mb-1 text-dark"><?= $producto['nombre_producto']; ?></h4>
                                                    <h6 class="text-dark">
                                                        $<?= number_format($producto['precio_unitario'], 0, '', '.'); ?></h6>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="d-flex flex-column flex-sm-row align-items-center">
                                            <!-- botón de eliminar -->
                                            <form action="../assets/php/eliminarProducto_deseos.php" method="POST"
                                                class="d-inline-block text-center mb-3 mb-sm-0 ms-sm-1 ms-3">
                                                <input type="hidden" name="id_producto"
                                                    value="<?= htmlspecialchars($producto['id_producto']) ?>">
                                                <button type="submit" class="btn btn-danger btn-sm button_d me-3"
                                                    style="height:35px;">
                                                    <div class="icon">
                                                        <svg class="top">
                                                            <use xlink:href="#top"></use>
                                                        </svg>
                                                        <svg class="bottom">
                                                            <use xlink:href="#bottom"></use>
                                                        </svg>
                                                    </div>
                                                    <span>Borrar</span>
                                                </button>
                                            </form>

                                            <?php
                                            // Obtener el id del producto actual
                                            $id_producto = $producto['id_producto'];

                                            // Consulta para obtener el stock total del producto
                                            $consulta_stock = $conn->prepare("SELECT stock_producto FROM producto WHERE id_producto = ?");
                                            $consulta_stock->bind_param("i", $id_producto);
                                            $consulta_stock->execute();
                                            $consulta_stock->bind_result($stock_total);
                                            $consulta_stock->fetch();
                                            $consulta_stock->close();

                                            // Consulta para obtener la cantidad del producto que ya está en el carrito
                                            $consulta_carrito = $conn->prepare("SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?");
                                            $consulta_carrito->bind_param("ii", $id_usuario, $id_producto);
                                            $consulta_carrito->execute();
                                            $consulta_carrito->bind_result($cantidad_en_carrito);
                                            $consulta_carrito->fetch();
                                            $consulta_carrito->close();

                                            // Calcular el stock disponible restando lo que ya está en el carrito
                                            $stock_disponible = $stock_total - $cantidad_en_carrito;
                                            ?>

                                            <?php if ($stock_disponible > 0): ?>
                                                <!-- Mostrar el botón solo si hay stock disponible -->
                                                <form action="../assets/php/deseoAcarrito.php" method="POST"
                                                    class="d-inline-block text-center">
                                                    <input type="hidden" name="id_producto"
                                                        value="<?= htmlspecialchars($producto['id_producto']); ?>">
                                                    <button type="submit" class="button_c" style="height:35px;">
                                                        <span>Carrito</span>
                                                        <div class="cart">
                                                            <svg viewBox="0 0 36 26">
                                                                <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5">
                                                                </polyline>
                                                                <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                                            </svg>
                                                        </div>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <!-- Mostrar el botón "Sin Stock" si no hay disponibilidad -->
                                                <button class="btn btn-dark rounded-3" style="height:35px; width:100px" disabled>
                                                    <span class="text-center">Agotado</span>
                                                </button>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "
                        <div class='d-flex justify-content-center align-items-center'>
                            <div class='text-center text-muted'>
                                <p>No tienes productos en tu lista de deseos.</p>
                                <a href='catalogo.php' class='btn btn-dark mt-3'>
                                    <i class='bi bi-box-arrow-in-right'></i> Explorar productos
                                </a>
                            </div>
                        </div>";
                            }

                            $consulta_lista->close();
                            $consulta_productos->close();
                            ?>
                        </div>
                    </div>
                    <!-- Resumen de productos -->
                    <div class="col-12 col-md-5">
                        <div class="container mt-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h3 class="text-center">Resumen</h3>

                                    <!-- Lista de productos -->
                                    <ul class="list-unstyled">
                                        <?php foreach ($productos_deseados as $producto) { ?>
                                            <li class="d-flex justify-content-between py-2">
                                                <span><?= htmlspecialchars($producto['nombre_producto']); ?></span>
                                                <span>$<?= number_format($producto['precio_unitario'], 0, '', '.'); ?></span>
                                            </li>
                                        <?php } ?>
                                    </ul>

                                    <!-- Línea separadora -->
                                    <hr class="my-3">

                                    <!-- Total -->
                                    <div class="d-flex justify-content-between">
                                        <?php if ($total_precio > 0): ?>
                                            <span class="fw-bold">Total incl. IVA</span>
                                            <span
                                                class="fw-bold fs-4">$<?= number_format($total_precio, 0, '', '.'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <?php if ($total_precio > 0): ?>
                                <!-- Botón de agregar todos los productos al carrito -->
                                <div class="mt-4 text-center">
                                    <form action="../assets/php/deseoAcarrito.php" method="POST" id="addToCartForm">
                                        <?php foreach ($productos_deseados as $producto) { ?>
                                            <input type="hidden" name="productos[]"
                                                value="<?= htmlspecialchars($producto['id_producto']); ?>">
                                        <?php } ?>
                                        <button type="submit" id="addToCartButton" class="button mt-3"
                                            onclick="activarAnimacion(event)">
                                            <span>Agregar todos los artículos al carrito</span>
                                            <div class="cart">
                                                <svg viewBox="0 0 36 26">
                                                    <polyline points="1 2.5 6 2.5 10 18.5 25.5 18.5 28.5 7.5 7.5 7.5">
                                                    </polyline>
                                                    <polyline points="15 13.5 17 15.5 22 10.5"></polyline>
                                                </svg>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info mt-4 text-center">
                                    <p>Tu lista de deseos está vacía. Agrega productos para continuar.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <?php include '../templates/footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        function activarAnimacion(event) {
            event.preventDefault();  // Evita que el formulario se envíe inmediatamente

            var button = document.getElementById('addToCartButton');
            button.classList.add('loading');  // Agrega la clase loading para activar la animación

            // Después de que pase el tiempo de la animación, enviar el formulario
            setTimeout(function () {
                document.getElementById('addToCartForm').submit();  // Enviar el formulario después de la animación
            }, 3700);  // 3.7 segundos (duración de la animación)
        }

    </script>

    <script>
        document.querySelectorAll('.button_d').forEach(button => button.addEventListener('click', e => {
            // Evitar la acción por defecto (enviar el formulario inmediatamente)
            e.preventDefault();

            if (!button.classList.contains('delete')) {
                button.classList.add('delete');

                // Se espera a que termine la animación (2200ms) antes de enviar el formulario
                setTimeout(() => {
                    // El formulario se envía después de que termine la animación
                    button.closest('form').submit();
                }, 2200); // El tiempo debe coincidir con la duración de la animación
            }
        }));
    </script>
    <script>
        document.querySelectorAll('.button_c').forEach(button => button.addEventListener('click', e => {
            // Evitar la acción por defecto (enviar el formulario inmediatamente)
            e.preventDefault();

            if (!button.classList.contains('agregado')) {
                button.classList.add('agregado'); // Añadir clase para animación

                // Esperar a que termine la animación (por ejemplo, 1500ms) antes de enviar el formulario
                setTimeout(() => {
                    // Enviar el formulario después de que termine la animación
                    button.closest('form').submit();
                }, 4000); // Asegúrate de que este tiempo coincida con la duración de la animación
            }
        }));
    </script>

    <script>
        document.querySelectorAll('.button_c').forEach(button => button.addEventListener('click', e => {
            if (!button.classList.contains('loading')) {

                button.classList.add('loading');

                setTimeout(() => button.classList.remove('loading'), 3700);

            }
            e.preventDefault();
        }));
    </script>
</body>

</html>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="top">
        <path
            d="M15,4 C15.5522847,4 16,4.44771525 16,5 L16,6 L18.25,6 C18.6642136,6 19,6.33578644 19,6.75 C19,7.16421356 18.6642136,7.5 18.25,7.5 L5.75,7.5 C5.33578644,7.5 5,7.16421356 5,6.75 C5,6.33578644 5.33578644,6 5.75,6 L8,6 L8,5 C8,4.44771525 8.44771525,4 9,4 L15,4 Z M14,5.25 L10,5.25 C9.72385763,5.25 9.5,5.47385763 9.5,5.75 C9.5,5.99545989 9.67687516,6.19960837 9.91012437,6.24194433 L10,6.25 L14,6.25 C14.2761424,6.25 14.5,6.02614237 14.5,5.75 C14.5,5.50454011 14.3231248,5.30039163 14.0898756,5.25805567 L14,5.25 Z">
        </path>
    </symbol>
    <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="bottom">
        <path
            d="M16.9535129,8 C17.4663488,8 17.8890201,8.38604019 17.9467852,8.88337887 L17.953255,9.02270969 L17.953255,9.02270969 L17.5309272,18.3196017 C17.5119599,18.7374363 17.2349366,19.0993109 16.8365446,19.2267053 C15.2243631,19.7422351 13.6121815,20 12,20 C10.3878264,20 8.77565288,19.7422377 7.16347932,19.226713 C6.76508717,19.0993333 6.48806648,18.7374627 6.46907425,18.3196335 L6.04751853,9.04540766 C6.02423185,8.53310079 6.39068134,8.09333626 6.88488406,8.01304774 L7.02377738,8.0002579 L16.9535129,8 Z M9.75,10.5 C9.37030423,10.5 9.05650904,10.719453 9.00684662,11.0041785 L9,11.0833333 L9,16.9166667 C9,17.2388328 9.33578644,17.5 9.75,17.5 C10.1296958,17.5 10.443491,17.280547 10.4931534,16.9958215 L10.5,16.9166667 L10.5,11.0833333 C10.5,10.7611672 10.1642136,10.5 9.75,10.5 Z M14.25,10.5 C13.8703042,10.5 13.556509,10.719453 13.5068466,11.0041785 L13.5,11.0833333 L13.5,16.9166667 C13.5,17.2388328 13.8357864,17.5 14.25,17.5 C14.6296958,17.5 14.943491,17.280547 14.9931534,16.9958215 L15,16.9166667 L15,11.0833333 C15,10.7611672 14.6642136,10.5 14.25,10.5 Z">
        </path>
    </symbol>
</svg>