<?php
include 'menu_registro/auth.php';
include_once '..\config\conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['direccion_pedido'], $_POST['id_metodo'], $_POST['total'])) {
    // Capturar datos del formulario
    $id_usuario = $_SESSION['id_usuario'];
    $id_carrito = $_SESSION['id_carrito'];
    $direccion_pedido = $_POST['direccion_pedido'];
    $id_metodo = $_POST['id_metodo'];
    $total_compra = $_POST['total'];
    $fecha_compra = date('Y-m-d H:i:s'); // Fecha actual
    $puntos_ganados = $total_compra * 0.1; // (10% del total)

    // Insertar en la base de datos
    $query = "INSERT INTO compra (id_compra, fecha_compra, total_compra, puntos_ganados, tipo_estado, direccion_pedido, id_metodo, id_usuario, id_carrito) 
              VALUES (NULL, '$fecha_compra', '$total_compra', '$puntos_ganados', '', '$direccion_pedido', '$id_metodo', '$id_usuario', '$id_carrito')";

    if ($conn->query($query) === TRUE) {
        echo "Compra registrada exitosamente.";

        // Redirigir a la página de pago o mostrar confirmación
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {

    $total = $_POST['total'] ?? 0; // Obtiene el total enviado desde el carrito

    // Obtener métodos de pago
    $query_metodo = "SELECT * FROM metodo_pago WHERE activo = 1";
    $result_metodo = $conn->query($query_metodo);
    ?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Procesar Compra</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>

    <body>
        <div class="container-f">
            <?php include '../templates/header.php'; ?>

            <div class="main">
                <div class="container mt-4">
                    <div class="row align-items-center">
                        <h2 class="text-center mb-3">Completa tu Compra</h2>
                        <hr>
                        <div class="col-md-8">
                            
                            <form method="POST" action="procesarCompra.php">
                                <!-- Campo oculto para enviar el total de la compra -->
                                <input type="hidden" name="total" value="<?= htmlspecialchars($total); ?>">

                                <!-- Dirección de Envío -->
                                <div class="mb-3">
                                    <label for="direccion_pedido" class="form-label ">Dirección de Envío</label>
                                    <input type="text" class="form-control" id="direccion_pedido" name="direccion_pedido"
                                        required>
                                </div>

                                <!-- Método de Pago -->
                                <div class="mb-3">
                                    <label for="id_metodo" class="form-label">Método de Pago</label>
                                    <select class="form-control" id="id_metodo" name="id_metodo" required>
                                        <?php while ($row = $result_metodo->fetch_assoc()): ?>
                                            <option value="<?= $row['id_metodo'] ?>"><?= $row['nombre_metodo'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-dark w-100 mt-3 mb-4">Continuar con el pago</button>
                            </form>
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
                        </div>
                    </div>
                </div>
            </div>

            <?php include '../templates/footer.php'; ?>
        </div>

        <?php $conn->close();
} ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>