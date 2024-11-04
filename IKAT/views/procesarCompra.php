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
        header("Location: https://localhost/xampp/TIS-1/IKAT/vendor/transbank/transbank-sdk/examples/webpay-plus/index.php?action=create");
        exit;

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
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    </head>

    <body>
        <div class="container-f">
            <!-- Header -->
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
                                    <button type="submit" class="btn btn-dark w-100 mt-3 mb-4">Continuar con el
                                        pago</button>
                                </form>

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
                                    Envío<span id="valorEnvio">$0.00</span>
                                    <!-- El formato ahora se actualizará dinámicamente -->
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
            // Punto fijo (latitud y longitud)
            const lat1 = -36.80696177670701;
            const lng1 = -73.04647662462334;

            const R = 6371; // Radio de la Tierra en km

            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLng = (lng2 - lng1) * Math.PI / 180;

            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLng / 2) * Math.sin(dLng / 2);

            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            const distancia = R * c;

            // Mostrar la distancia en el HTML
            document.getElementById('distancia').textContent = `Distancia: ${distancia.toFixed(2)} km`;

            // Llamar a la función para calcular el valor del envío
            valor_envio(distancia);
        }

        // Almacenar el valor del envío en una variable
        let costoEnvio = 0; // 

        function valor_envio(distancia) {
            // Verificar si la distancia está en km
            if (typeof distancia === "number" && distancia >= 0) {
                const tarifaBase = 1500;
                costoEnvio = Math.round((distancia * 1500) + tarifaBase); // Almacena el costo de envío en la variable
                const valorEnvioElement = document.getElementById('valorEnvio');

                if (valorEnvioElement) {
                    valorEnvioElement.textContent = `$ ${costoEnvio.toLocaleString('es-CL')}`; // Formato similar al subtotal
                } else {
                    console.error("Error: No se encontró el elemento para mostrar el valor del envío.");
                }
                calcularTotal(); // Llama a la función para calcular el total
            } else {
                console.error("Error: La distancia debe estar en kilómetros.");
                const valorEnvioElement = document.getElementById('valorEnvio');
                if (valorEnvioElement) {
                    valorEnvioElement.textContent = "Error en el cálculo del valor del envío.";
                }
            }
        }


        function calcularTotal() {
            const subtotal = parseFloat('<?= number_format(floor($total), 0, '', '.') ?>'.replace(/\./g, '').replace('$', '')); // Obtiene el subtotal desde PHP
            const impuestos = 0;
            const totalFinal = subtotal + costoEnvio + impuestos;

            // Actualiza el total 
            const totalElement = document.querySelector('.resumen-compra .list-group-item:last-child span');
            if (totalElement) {
                totalElement.textContent = `$ ${totalFinal.toLocaleString('es-CL')}`; // Formato para total
            }
        }

    </script>
</body>

</html>