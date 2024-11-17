<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="a.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>



    <!-- Contenedor de la barra de búsqueda -->
    <div class="d-none d-lg-flex justify-content-center align-items-center mt-4">
        <div class="search-container col-lg-7 col-10">
            <div class="input-group">
                <button class="input-group-text" id="search-addon" type="button">
                    <i class="bi bi-list"></i>
                </button>
                <input type="text" class="form-control p-2" name="campo" id="campo" placeholder="Buscar productos..."
                    aria-label="Buscar productos..." aria-describedby="search-addon" oninput="buscarProductos()">
                <button class="input-group-text" id="search-addon" type="button" onclick="buscarProductos()">
                    <i class="bi bi-search"></i>
                </button>
                <ul class="list-group position-absolute w-100" id="lista"></ul>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="a.js"></script>
</body>

</html>