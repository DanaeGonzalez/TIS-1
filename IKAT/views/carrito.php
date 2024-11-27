<?php
include 'menu_registro\auth.php';
include_once '..\config\conexion.php';


// Inicializar un array para almacenar productos con stock insuficiente
$productosSinStock = [];
$alerta = false;

// Consultar productos en el carrito
$sql = "SELECT p.id_producto, p.nombre_producto, p.stock_producto, cp.cantidad_producto 
        FROM carrito_producto cp 
        JOIN producto p ON cp.id_producto = p.id_producto 
        WHERE cp.id_carrito = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['id_carrito']);
$stmt->execute();
$result = $stmt->get_result();

// Recorrer los productos del carrito
while ($row = $result->fetch_assoc()) {
    if ($row['cantidad_producto'] > $row['stock_producto']) {
        // Si hay stock insuficiente, agregar el producto al array
        $productosSinStock[] = $row;
        $alerta = true;  // Marcar que hay un problema con el stock
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IKAT - Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/scss/delete.scss">
    <link rel="stylesheet" href="../assets/css/payButton.css">

</head>

<body>

    <div class="container-f">
        <?php include '../templates/header.php'; ?>

        <div class="main">
            <div class="container mt-4">
                <div class="row">
                    <!-- Mensaje de alerta para productos sin stock -->
                    <?php if (!empty($productosSinStock)): ?>
                        <div class="alert alert-warning" role="alert">
                            <strong>Atención:</strong> Algunos productos en tu carrito no tienen suficiente stock:
                            <ul>
                                <?php foreach ($productosSinStock as $producto): ?>
                                    <li>
                                        <?= htmlspecialchars($producto['nombre_producto']) ?> -
                                        solicitado: <?= htmlspecialchars($producto['cantidad_producto']) ?>,
                                        disponible: <?= htmlspecialchars($producto['stock_producto']) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            Por favor, ajusta las cantidades antes de continuar con la compra.
                        </div>
                    <?php endif; ?>
                    <h1 class="text-center mb-3">Productos en el Carrito</h1>
                    <hr>
                    <div class="col-md-8">
                        <div class="list-group me-3">
                            <?php
                            // Consulta para obtener los productos del carrito
                            $sql = "SELECT p.*, cp.cantidad_producto 
                                FROM carrito_producto cp 
                                JOIN producto p ON cp.id_producto = p.id_producto 
                                WHERE cp.id_carrito = ?";

                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $_SESSION['id_carrito']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $total = 0;

                            // Mostrar productos en el carrito
                            while ($row = $result->fetch_assoc()) {
                                $subtotal = $row['precio_unitario'] * $row['cantidad_producto'];
                                $total += $subtotal;

                                echo "<div class='list-group-item d-flex justify-content-between align-items-center bg-light border mb-4 rounded shadow-sm p-3'>";
                                echo "<div class='d-flex align-items-center'>";
                                echo "<a href='producto.php?id={$row['id_producto']}'><img src='{$row['foto_producto']}' alt='{$row['nombre_producto']}' class='me-3 rounded' style='width: 170px;'></a>";
                                echo "<div>";
                                echo "<h4 class='mb-1 text-dark '>{$row['nombre_producto']}</h4>";
                                echo "<h6 class='text-dark'>\$" . number_format(floor($row['precio_unitario']), 0, '', '.') . "</h6>";
                                echo "<div class='d-flex align-items-center'>";
                                echo "<div class='input-group input-group-sm' style='width: 40px;'>";
                                echo "<input type='text' value='{$row['cantidad_producto']}' min='1' class='form-control text-center' readonly>";
                                echo "</div></div></div>";
                                echo "</div>";

                                // Botón de eliminar producto con SVG
                                echo "<form action='../assets/php/eliminarProducto_carrito.php' method='POST' class='d-inline-block text-center'>";
                                echo "<input type='hidden' name='id_producto' value='{$row['id_producto']}'>";
                                echo "<p class='mb-0 fw-bold fs-4 text-secondary'>\$" . number_format(floor($subtotal), 0, '', '.') . "</p>";
                                echo "<br>";
                                echo "<button type='submit' class='btn btn-danger btn-sm button mt-5'>";
                                echo "<div class='icon'>";
                                echo "<svg class='top'><use xlink:href='#top'></use></svg>";
                                echo "<svg class='bottom'><use xlink:href='#bottom'></use></svg>";
                                echo "</div>";
                                echo "<span>Borrar</span>";
                                echo "</button>";
                                echo "</form>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4 p-4 border bg-light rounded shadow-sm resumen-compra">
                        <h3 class="mb-4 text-center">Resumen de la Compra</h3>
                        <ul class="list-group">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2 bg-light">
                                Subtotal<span>$<?= number_format(floor($total), 0, '', '.') ?></span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2 bg-light">
                                Envío <em>Pendiente</em>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2 bg-light">
                                Impuestos <em>Pendiente</em>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center fw-bold border-0 px-0 py-2 bg-light">
                                Total<span>$<?= number_format(floor($total + ($total * 0.02)), 0, '', '.') ?></span>
                            </li>
                        </ul>
                        <?php if ($total > 0): ?>
                            <form action="procesarCompra.php" method="POST">
                                <input type="hidden" name="total" value="<?= $total ?>">
                                <button type="submit" class="BtnPay mt-4">
                                    Procesar compra
                                    <path
                                        d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z">
                                    </path>
                                    </svg>
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-info mt-4 text-center">
                                Tu carrito está vacío. Agrega productos para continuar con la compra.
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
        <?php include '../templates/footer.php'; ?>
    </div>

    <?php
    $conn->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        document.querySelectorAll('.button').forEach(button => button.addEventListener('click', e => {
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