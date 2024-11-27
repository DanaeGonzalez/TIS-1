<?php
include 'menu_registro/auth.php';
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

// Si hay productos sin stock suficiente, redirigir con alerta
if ($alerta) {
    echo "<script>alert('Algunos productos en tu carrito no tienen suficiente stock.');</script>";
    header("Location: carrito.php");
    exit(); // Asegúrate de que no se ejecute más código después de la redirección
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['direccion_pedido'], $_POST['id_metodo'], $_POST['total_calculado'])) {
    // Capturar datos del formulario
    $id_usuario = $_SESSION['id_usuario'];
    $id_carrito = $_SESSION['id_carrito'];
    $direccion_pedido = $_POST['direccion_pedido'];
    $id_metodo = $_POST['id_metodo'];
    $total_compra = $_POST['total_calculado'];
    $fecha_compra = date('Y-m-d H:i:s');
    $puntos_ganados = $total_compra * 0.05;

    // Insertar en la base de datos
    $query = "INSERT INTO compra (id_compra, fecha_compra, total_compra, puntos_ganados, tipo_estado, direccion_pedido, id_metodo, id_usuario, id_carrito) 
              VALUES (NULL, '$fecha_compra', '$total_compra', '$puntos_ganados', '', '$direccion_pedido', '$id_metodo', '$id_usuario', '$id_carrito')";

    if ($conn->query($query) === TRUE) {
        echo "Compra registrada exitosamente.";
        header("Location: https://localhost/xampp/TIS-1/IKAT/vendor/transbank/transbank-sdk/examples/webpay-plus/index.php?action=create");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {

    $total = $_POST['total'] ?? 0;

    // Obtener métodos de pago
    $query_metodo = "SELECT * FROM metodo_pago WHERE activo = 1";
    $result_metodo = $conn->query($query_metodo);

    // Verificar si la dirección está confirmada
    $direccionConfirmada = isset($_POST['direccion_pedido']) && !empty($_POST['direccion_pedido']);
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
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="../assets/css/payButton.css">
    </head>

    <body>
        <div class="container-f">
            <?php include '../templates/header.php'; ?>

            <div class="main">
                <!-- Modal para la barra de búsqueda -->
                <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="searchModalLabel">Buscar productos</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="searchForm" onsubmit="return buscarProductos()">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="buscarInputModal"
                                            placeholder="Buscar productos..." aria-label="Buscar productos">
                                        <button class="btn btn-dark" type="submit">Buscar</button>
                                    </div>
                                </form>
                                <div id="resultadosBusqueda" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenedor de la barra de búsqueda -->
                <div class="d-none d-lg-flex justify-content-center align-items-center mt-4">
                    <div class="search-container col-lg-7 col-10">
                        <div class="input-group">
                            <button class="input-group-text" id="search-addon" type="button">
                                <i class="bi bi-list"></i>
                            </button>
                            <input type="text" class="form-control p-2" id="buscarInputMain"
                                placeholder="Buscar productos..." aria-label="Buscar productos..."
                                aria-describedby="search-addon" oninput="barraBusqueda()">
                            <button class="input-group-text" id="search-addon" type="button" onclick="buscarProductos()">
                                <i class="bi bi-search"></i>
                            </button>
                            <ul class="list-group position-absolute w-100" id="lista"></ul>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row align-items-center">
                        <h2 class="text-center mb-3">Completa tu Compra</h2>
                        <hr>
                        <div class="col-md-8">
                            <form method="POST" action="procesarCompra.php">
                                <!-- Campo oculto para enviar el total de la compra -->
                                <input type="hidden" name="total" value="<?= htmlspecialchars($total); ?>">

                                <!-- Campo oculto para el total calculado -->
                                <input type="hidden" id="totalCalculado" name="total_calculado"
                                    value="<?= htmlspecialchars($total); ?>">

                                <input type="hidden" id="valorEnvioInput" name="valor_envio" value="0">

                                <?php
                                $id_usuario = $_SESSION['id_usuario']; // Usamos el ID del usuario desde la sesión para la consulta
                                // Consulta SQL para obtener solo la dirección del usuario
                                $queryDireccion = "SELECT direccion_usuario FROM usuario WHERE id_usuario = ?";
                                $stmtDireccion = $conn->prepare($queryDireccion);
                                $stmtDireccion->bind_param("i", $id_usuario); // Vinculamos el ID del usuario como parámetro
                                $stmtDireccion->execute();
                                $resultDireccion = $stmtDireccion->get_result();

                                // Verificamos si se obtuvo un resultado
                                if ($resultDireccion->num_rows > 0) {
                                    $row = $resultDireccion->fetch_assoc();
                                    $direccion = $row['direccion_usuario'];
                                } else {
                                    // Si no se encuentra el usuario, redirigimos o mostramos un error
                                    echo "Usuario no encontrado.";
                                    exit;
                                }
                                ?>

                                <!-- Campo oculto para el subtotal original -->
                                <input type="hidden" name="total" value="<?= htmlspecialchars($total); ?>">
                                <!-- Contenedor de la barra de búsqueda -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Dirección</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="direccion" name="direccion_pedido"
                                            onblur="buscarDireccion();" value="<?php echo htmlspecialchars($direccion); ?>"
                                            placeholder="Av. Alonso de Ribera 2850" required>
                                        <!-- Botón para confirmar dirección -->
                                        <button class="btn btn-outline-secondary" type="button" id="confirmar_direccion"
                                            onclick="buscarDireccion()" required>
                                            <i class="bi bi-check"></i> Confirmar
                                        </button>
                                    </div>
                                </div>

                                <!-- Alerta si la dirección no está confirmada -->
                                <?php if (!$direccionConfirmada): ?>
                                    <div class="alert alert-info" role="alert">
                                        ¡Por favor, confirma tu dirección antes de continuar con la compra!
                                    </div>
                                <?php endif; ?>

                                <!-- Mapa -->
                                <div id="map" style="width: 100%; height: 300px;"></div>

                                <!-- Método de Pago -->
                                <div class="mb-3">
                                    <label for="id_metodo" class="form-label">Método de Pago</label>
                                    <select class="form-control" id="id_metodo" name="id_metodo" required>
                                        <?php while ($row = $result_metodo->fetch_assoc()): ?>
                                            <option value="<?= $row['id_metodo'] ?>"><?= $row['nombre_metodo'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <!-- Área para mostrar coordenadas y distancia -->
                                <div id="coordenadas" style="display: none;" class="mt-3">
                                    <p id="latitud">Latitud: </p>
                                    <p id="longitud">Longitud: </p>
                                    <p id="distancia"></p>
                                </div>

                                <form action="../vendor/transbank/transbank-sdk/examples/index.php?action=create"
                                    method="post">
                                    <!-- Agrega campos adicionales aquí, si necesitas pasar más información -->

                                    <!-- Botón para continuar con el pago -->
                                    <button type="submit" class="BtnPay mt-3 mb-4" id="continuar_pago"
                                        <?= !$direccionConfirmada ? 'disabled' : ''; ?>> Continuar con el pago
                                        <svg class="svgIcon" viewBox="0 0 576 512">
                                            <path
                                                d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </form>
                        </div>

                        <!-- Resumen de la Compra -->
                        <div class="col-md-4 mb-4 p-4 border bg-light rounded shadow-sm resumen-compra">
                            <h3 class="mb-4 text-center">Resumen de la Compra</h3>
                            <ul class="list-group">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2 bg-light">
                                    Subtotal<span>$<?= number_format(floor($total), 0, '', '.') ?></span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2 bg-light">
                                    Envío<span id="valorEnvio">$0.00</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2 bg-light">
                                    Impuestos<span id="valorImpuestos">$0.00</span>
                                </li>

                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center fw-bold border-0 px-0 py-2 bg-light">
                                    Total<span
                                        id="totalConEnvioImpuestos">$<?= number_format(floor($total), 0, '', '.') ?></span>
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

    <script>
        let map = L.map('map').setView([-36.79849246501831, -73.05592193108434], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            Zoom: 15,
        }).addTo(map);

        let marker = L.marker([-36.79849246501831, -73.05592193108434]).addTo(map);

        function buscarDireccion() {
            const direccion = document.getElementById('direccion').value;
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(direccion)}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const ubicacion = data[0];
                        const lat = parseFloat(ubicacion.lat);
                        const lng = parseFloat(ubicacion.lon);

                        map.setView([lat, lng], 12);
                        marker.setLatLng([lat, lng]);

                        // Mostrar latitud y longitud
                        document.getElementById('latitud').textContent = `Latitud: ${lat}`;
                        document.getElementById('longitud').textContent = `Longitud: ${lng}`;

                        // Llamar a la función de distancia con las coordenadas obtenidas
                        distancia(lat, lng);

                        // Aquí se ejecuta la lógica para buscar la dirección
                        console.log("Dirección confirmada");

                        // Habilitar el botón de "Continuar con el pago" después de confirmar la dirección
                        document.getElementById("continuar_pago").disabled = false;
                    } else {
                        alert('No se pudo encontrar la dirección.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al buscar la dirección.');
                });
        }

        function distancia(lat2, lng2) {
            const lat1 = -36.80696177670701;
            const lng1 = -73.04647662462334;
            const R = 6371;

            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLng = (lng2 - lng1) * Math.PI / 180;

            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLng / 2) * Math.sin(dLng / 2);

            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            const distancia_km = R * c;

            const valorEnvio = Math.round(distancia_km * 1500);

            document.getElementById('valorEnvioInput').value = valorEnvio;
            document.getElementById('valorEnvio').textContent = `$${formatNumber(valorEnvio)}`;
            calcularTotal();
        }

        function calcularTotal() {
            const subtotal = parseFloat('<?= number_format(floor($total), 0, '', '.') ?>'.replace(/\./g, '').replace('$', '')); // Obtiene el subtotal desde PHP
            const tasaImpuestos = 0.19; /*IVA*/
            const valorEnvio = parseFloat(document.getElementById('valorEnvioInput').value) || 0;

            // Calcular impuestos
            const impuestos = subtotal * tasaImpuestos;

            // Calcular el total final
            const totalFinal = subtotal + impuestos + valorEnvio;

            // Actualiza el valor de impuestos y el total en la interfaz
            document.getElementById('valorImpuestos').textContent = `$${formatNumber(impuestos)}`;
            document.querySelector('.list-group-item.fw-bold span').textContent = `$${formatNumber(totalFinal)}`;
            document.getElementById('totalCalculado').value = totalFinal;

        }

        function formatNumber(num) {
            return Math.floor(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

    </script>
</body>

</html>