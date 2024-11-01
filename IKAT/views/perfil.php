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
                                <input type="number" class="form-control bg-light" value="150" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre</label>
                                <input type="text" class="form-control" value="Juan" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Apellido</label>
                                <input type="text" class="form-control" value="Pérez" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">RUN</label>
                                <input type="text" class="form-control bg-light" value="12345678-9" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control bg-light" value="juan.perez@gmail.com" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Número de Teléfono</label>
                                <input type="tel" class="form-control" value="+56912345678" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Contraseña</label>
                                <input type="password" class="form-control" value="123456" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dirección</label>
                                <input type="text" id="direccion" class="form-control"
                                    placeholder="Ingresa tu dirección" required>
                                <button type="button" onclick="buscarDireccion()" class="btn btn-primary mt-2">Buscar en
                                    el Mapa</button>
                            </div>
                            <div id="map" style="width: 100%; height: 500px;"></div>
                            <!-- Área para mostrar coordenadas -->
                            <div id="coordenadas" class="mt-3">
                                <h5>Coordenadas (esto lo saco despues):</h5>
                                <p id="latitud">Latitud: </p>
                                <p id="longitud">Longitud: </p>
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
                            const lat = ubicacion.lat;
                            const lng = ubicacion.lon;

                            map.setView([lat, lng], 12);
                            marker.setLatLng([lat, lng]);

                            // Mostrar latitud y longitud
                            document.getElementById('latitud').textContent = `Latitud: ${lat}`;
                            document.getElementById('longitud').textContent = `Longitud: ${lng}`;
                        } else {
                            alert('No se pudo encontrar la dirección.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al buscar la dirección.');
                    });
            }
        </script>
    </body>

</php>