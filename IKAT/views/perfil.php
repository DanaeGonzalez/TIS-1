<!doctype php>
<php lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Perfil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\assets\css\styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    </head>

    <body>
        <div class="container-f">
            <!-- Header/Navbar -->
            <?php include '../templates/header.php'; ?>

            <!-- Sección Perfil del Usuario -->
            <div class="container mt-4 mb-3">
                <h2 class="text-center mb-4">Perfil de Usuario</h2>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Puntos Totales</label>
                                <input type="number" class="form-control bg-light" value="<?php echo htmlspecialchars($_SESSION['puntos']);?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['nombre_usuario']);?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Apellido</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['apellido_usuario']);?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">RUN</label>
                                <input type="text" class="form-control bg-light" value="<?php echo htmlspecialchars($_SESSION['run_usuario']);?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control bg-light" value="<?php echo htmlspecialchars($_SESSION['correo_usuario']);?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Número de Teléfono</label>
                                <input type="tel" class="form-control" value="<?php echo htmlspecialchars($_SESSION['numero_usuario']);?>" required>
                            </div>
                        
                            <!-- Campo de Dirección -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Dirección</label>
                            <input type="text" id="direccion" class="form-control"
                                placeholder="Ingresa tu dirección" required>
                            <button type="button" onclick="buscarDireccion()" class="btn btn-primary mt-2">Buscar en
                                el Mapa</button>
                        </div>
                        
                        <!-- Mapa -->
                        <div id="map" style="width: 100%; height: 500px;"></div>
                        <!-- Área para mostrar coordenadas y distancia -->
                        <div id="coordenadas" style="display: none;" class="mt-3">
                            <p id="latitud">Latitud: </p>
                            <p id="longitud">Longitud: </p>
                            <p id="distancia"></p>
                        </div>

                        <!-- Botón Guardar Cambios -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark w-50">Guardar Cambios</button>
                        </div>
                    </form>
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
            // Punto fijo (latitud y longitud) para la distancia
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
        }
    </script>
</body>

</html>