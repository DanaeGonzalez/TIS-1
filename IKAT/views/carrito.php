<?php
include 'menu_registro\auth.php';
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
</head>

<body>

    <div class="container-f">
        <?php include '../templates/header.php'; ?>

        <div class="main">
            <div class="container mt-4">
                <div class="row">
                    <h1 class="text-center mb-3">Productos en el Carrito</h1>
                    <hr>
                    <div class="col-md-8">
                        <div class="list-group me-3">
                            <?php
                            include_once '..\config\conexion.php';

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
                                echo "<input type='checkbox' name='product_ids[]' value='{$row['id_producto']}' id='checkbox{$row['id_producto']}' class='form-check-input me-3 border-dark' style='transform: scale(1.3);'>";
                                echo "<label for='checkbox{$row['id_producto']}' class='d-flex align-items-center' style='cursor: pointer;'>";
                                echo "<a href='producto.php?id={$row['id_producto']}'><img src='{$row['foto_producto']}' alt='{$row['nombre_producto']}' class='me-3 rounded' style='width: 170px;'></a>";
                                echo "<div>";
                                echo "<h4 class='mb-1 text-dark'>{$row['nombre_producto']}</h4>";
                                echo "<h6 class='text-dark'>\$" . number_format(floor($row['precio_unitario']), 0, '', '.') . "</h6>";

                                echo "<div class='d-flex align-items-center'>";
                                echo "<div class='input-group input-group-sm' style='width: 40px;'>";
                                echo "<input type='text' value='{$row['cantidad_producto']}' min='1' class='form-control text-center' readonly>";
                                echo "</div></div></div></label></div>";
                                echo "<p class='mb-0 fw-bold fs-5 text-dark'>\$" . number_format(floor($subtotal), 0, '', '.') . "</p>";
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
                                Envío<span>$0.00</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2 bg-light">
                                Impuestos<span>$0.00</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center fw-bold border-0 px-0 py-2 bg-light">
                                Total<span>$<?= number_format(floor($total), 0, '', '.') ?></span>
                            </li>
                        </ul>
                        <form action="procesarCompra.php" method="POST">
                            <input type="hidden" name="total" value="<?= $total ?>">
                            <button type="submit" class="btn btn-dark mt-4 w-100">Procesar compra</button>
                        </form>


                    </div>

                </div>
                <form id="eliminar-form" method="POST" action="..\assets\php\eliminarProducto_carrito.php">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <button type="submit" class="btn btn-dark mb-4 w-100">Eliminar producto</button>
                        </div>
                    </div>
                </form>


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
        document.getElementById('eliminar-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const selectedProducts = [];
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            checkboxes.forEach(checkbox => {
                const productId = checkbox.id.replace('checkbox', '');
                selectedProducts.push(productId);
            });

            if (selectedProducts.length > 0) {
                // Crea un campo oculto para enviar los IDs de los productos
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'product_ids';
                input.value = JSON.stringify(selectedProducts); 

                this.appendChild(input);
                this.submit();
            } else {
                alert('Por favor, selecciona al menos un producto para eliminar.');
            }
        });
    </script>



</body>

</html>