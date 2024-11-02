<!doctype php>
<php lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IKAT - Catálogo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="..\assets\css\styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>

    <body>

        <div class="container-f">
            <!-- Header -->
            <?php include '../templates/header.php'; ?>

            <!-- Main -->
            <div class="nain">
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
                                        <input type="text" class="form-control" placeholder="Buscar productos..."
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
                            <button class="input-group-text" id="search-addon" type="button">
                                <i class="bi bi-list"></i>
                            </button>
                            <input type="text" class="form-control p-2" placeholder="Buscar productos..."
                                aria-label="Buscar productos..." aria-describedby="search-addon">
                            <button class="input-group-text" id="search-addon" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Contenedor de filtros -->
                <div class="container mt-3">
                    <form id="form-filtros" method="GET" action="javascript:void(0);"> <!-- Añadimos el formulario -->
                        <div class="row justify-content-center">
                            <h1 class="text-center mb-3">Productos</h1>
                            <hr class="mb-4">

                            <!-- Filtro de Subcategoría -->
                            <div class="col-auto mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                        id="dropdownSubcategory" data-bs-toggle="dropdown" aria-expanded="false">
                                        Subcategoría
                                    </button>
                                    <div class="dropdown-menu p-2" aria-labelledby="dropdownSubcategory">
                                        <label class="dropdown-item"><input type="checkbox" name="subcategoría"
                                                value="A">
                                            A</label>
                                        <label class="dropdown-item"><input type="checkbox" name="subcategoría"
                                                value="B">
                                            B</label>
                                        <label class="dropdown-item"><input type="checkbox" name="subcategoría"
                                                value="C">
                                            C</label>
                                        <label class="dropdown-item"><input type="checkbox" name="subcategoría"
                                                value="D">
                                            D</label>
                                        <label class="dropdown-item"><input type="checkbox" name="subcategoría"
                                                value="E">
                                            E</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Filtro de Color -->
                            <div class="col-auto mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                        id="dropdownColor" data-bs-toggle="dropdown" aria-expanded="false">
                                        Color
                                    </button>
                                    <div class="dropdown-menu p-2" aria-labelledby="dropdownColor">
                                        <label class="dropdown-item"><input type="checkbox" name="color" value="Rojo">
                                            Rojo</label>
                                        <label class="dropdown-item"><input type="checkbox" name="color" value="Negro">
                                            Negro</label>
                                        <label class="dropdown-item"><input type="checkbox" name="color" value="Blanco">
                                            Blanco</label>
                                        <label class="dropdown-item"><input type="checkbox" name="color" value="Gris">
                                            Gris</label>
                                        <label class="dropdown-item"><input type="checkbox" name="color" value="Café">
                                            Café</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Filtro de Material -->
                            <div class="col-auto mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                        id="dropdownMaterial" data-bs-toggle="dropdown" aria-expanded="false">
                                        Material
                                    </button>
                                    <div class="dropdown-menu p-2" aria-labelledby="dropdownMaterial">
                                        <label class="dropdown-item"><input type="checkbox" name="material"
                                                value="Madera">
                                            Madera</label>
                                        <label class="dropdown-item"><input type="checkbox" name="material"
                                                value="Metal">
                                            Metal</label>
                                        <label class="dropdown-item"><input type="checkbox" name="material"
                                                value="Plástico">
                                            Plástico</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Filtro de Plazas -->
                            <div class="col-auto mb-3">
                                <div class="dropdown">
                                    <button class="btn btn-light border dropdown-toggle rounded-pill" type="button"
                                        id="dropdownPlazas" data-bs-toggle="dropdown" aria-expanded="false">
                                        Plazas
                                    </button>
                                    <div class="dropdown-menu p-2" aria-labelledby="dropdownPlazas">
                                        <label class="dropdown-item"><input type="checkbox" name="plazas" value="1">
                                            1</label>
                                        <label class="dropdown-item"><input type="checkbox" name="plazas" value="1 1/2">
                                            1
                                            1/2</label>
                                        <label class="dropdown-item"><input type="checkbox" name="plazas" value="2">
                                            2</label>
                                        <label class="dropdown-item"><input type="checkbox" name="plazas" value="King">
                                            King</label>
                                        <label class="dropdown-item"><input type="checkbox" name="plazas" value="Queen">
                                            Queen</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Botón para aplicar los filtros -->
                            <div class="col-auto mb-3">
                                <button type="submit" class="btn btn-dark rounded-pill">Aplicar filtros</button>
                            </div>

                        </div>
                    </form> <!-- Fin del formulario -->
                </div>





                <!-- Contenedor de la barra de etiquetas -->
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div id="selectedFilters" class="d-flex flex-wrap align-items-center gap-2"></div>
                        </div>
                    </div>
                </div>

                <?php
                // Incluir la conexión
                include_once '..\config\conexion.php';

                // Consulta para obtener los productos activos que sean camas
                $sql = "SELECT * FROM producto WHERE activo = 1  AND id_subcategoria IN 
                (SELECT id_subcategoria FROM subcategoria JOIN categoria USING (id_categoria) 
                WHERE nombre_categoria = 'Cama')";
                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result->num_rows > 0):
                    ?>

                    <!-- Contenedor catálogo -->
                    <div class="container mt-4">
                        <div id="product-container" class="row justify-content-center">
                            <?php while ($producto = $result->fetch_assoc()): ?>
                                <div class="col-6 col-md-4 mb-4">
                                    <div class="card" style="width: 100%;">
                                        <a href="producto.php?id=<?= $producto['id_producto'] ?>" class="text-decoration-none">
                                            <img src="<?= $producto['foto_producto'] ?>" class="card-img-top" alt="...">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($producto['nombre_producto']) ?>
                                            </h5>
                                            <h6 class="card-text">
                                                $<?= number_format($producto['precio_unitario'], 0, ',', '.') ?></h6>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        onclick="agregarAlCarrito(<?= $producto['id_producto'] ?>)">
                                                        <i class="bi bi-cart-plus"></i>

                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary">
                                                        <i class="bi bi-heart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <?php
                else:
                    echo "<p>No se encontraron productos.</p>";
                endif;

                // Cerrar la conexión
                $conn->close();
                ?>

                <!-- Paginación -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link text-black" href="#">1</a></li>
                        <li class="page-item"><a class="page-link text-black" href="#">2</a></li>
                        <li class="page-item">
                            <a class="page-link text-black" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Footer -->
            <?php include '../templates/footer.php'; ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

        <script src="..\assets\js\filtros.js"></script>

        <script>
            document.getElementById("form-filtros").addEventListener("submit", function (event) {
                event.preventDefault(); // Evita el envío tradicional del formulario

                const formData = new FormData(this);
                const queryString = new URLSearchParams(formData).toString();

                fetch(`../assets/php/filtros_catalogo.php?${queryString}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Error en la respuesta del servidor");
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Selecciona solo el contenedor de los productos
                        const productContainer = document.getElementById("product-container");
                        productContainer.innerHTML = ""; // Limpia solo el área de productos, manteniendo la barra de filtros

                        if (data.length === 0) {
                            productContainer.innerHTML = "<p>No se encontraron productos.</p>";
                        } else {
                            data.forEach(product => {
                                productContainer.innerHTML += `
                                   <div class="col-6 col-md-4 mb-4">
                                       <a href="producto.php?id=${product.id_producto}" class="text-decoration-none">
                                           <div class="card" style="width: 100%;">
                                               <img src="${product.foto_producto}" class="card-img-top" alt="${product.nombre_producto}">
                                               <div class="card-body">
                                                   <h5 class="card-title">${product.nombre_producto}</h5>
                                                   <h6 class="card-text">$${new Intl.NumberFormat().format(product.precio_unitario)}</h6>
                                                   <div class="d-flex align-items-center">
                                                       <div>
                                                           <button type="button" class="btn btn-outline-secondary">
                                                               <i class="bi bi-cart-plus"></i>
                                                           </button>
                                                           <button type="button" class="btn btn-outline-secondary">
                                                               <i class="bi bi-heart"></i>
                                                           </button>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </a>
                                   </div>`;
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error en la solicitud AJAX:", error);
                    });
            });
        </script>


        <script>
            function agregarAlCarrito(productId) {
                fetch('agregarAlCarrito.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id_producto: productId, cantidad: 1 })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Producto agregado al carrito!');
                        } else {
                            alert('Error al agregar el producto al carrito.');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
        </script>



    </body>

</php>